<?php
// ─── CONFIG ────────────────────────────────────────────────────────────────
const PHARM_URL     = 'https://pharmempire.com/index.php';
const USERNAME      = 'txt';
const PASSWORD      = '123qwe';
const BRIDGE_URL    = 'https://healuslab.com/fb-capi.php';
const POSTBACK_URL  = 'https://adv-rl.com/trk/postback?subid=%s&status=%s';
const PROCESSED_IDS = __DIR__ . '/processed.json';
const LOG_FILE      = __DIR__ . '/logs/sync.log';

// ─── START LOG ─────────────────────────────────────────────────────────────
date_default_timezone_set('UTC');
@mkdir(__DIR__ . '/logs');
@file_put_contents(LOG_FILE, date('Y-m-d\TH:i:s') . " === pharmbot.php START ===\n", FILE_APPEND);

// ─── INIT CURL SESSION ─────────────────────────────────────────────────────
$cookieFile = tempnam(sys_get_temp_dir(), 'ph');
$ch = curl_init();
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_COOKIEJAR      => $cookieFile,
  CURLOPT_COOKIEFILE     => $cookieFile,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_TIMEOUT        => 15,
]);

// ─── LOGIN ─────────────────────────────────────────────────────────────────
curl_setopt_array($ch, [
  CURLOPT_URL  => PHARM_URL,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query([
    'page'      => 'authorize',
    'pagetogo'  => 'sales',
    'username'  => USERNAME,
    'password'  => PASSWORD
  ])
]);
curl_exec($ch);

// ─── LOAD SALES PAGE ───────────────────────────────────────────────────────
curl_setopt_array($ch, [
  CURLOPT_URL  => PHARM_URL . '?page=sales',
  CURLOPT_POST => false
]);
$html = curl_exec($ch);
if (!$html || stripos($html, 'Order') === false || stripos($html, 'SubID') === false) {
  file_put_contents(LOG_FILE, date('c') . " ❌ Login may have failed\n", FILE_APPEND);
  exit;
}
file_put_contents(__DIR__ . '/logs/raw-response.html', $html);

// ─── LOAD PROCESSED LIST ───────────────────────────────────────────────────
$seen = @json_decode(@file_get_contents(PROCESSED_IDS), true) ?: [];

// ─── PARSE SALES ──────────────────────────────────────────────────────────
preg_match_all('/#(\d+).*?SubID:(.*?)<.*?Status.*?>(\w+)/s', $html, $matches, PREG_SET_ORDER);
$count = 0;
foreach ($matches as $m) {
  [$full, $orderId, $subid, $status] = $m;
  $orderId = trim($orderId);
  $subid   = trim($subid);
  $status  = ucfirst(strtolower(trim($status)));

  if (!$orderId || !$subid || in_array($orderId, $seen)) continue;

  // Map status to FB/Keitaro
  $map = [
    'Approved' => 'sale',
    'Waiting'  => 'upsale',
    'Declined' => 'rejected',
  ];
  if (!isset($map[$status])) continue;
  $ktrStatus = $map[$status];

  // Send to FB
  $payload = [
    'evName' => 'Purchase',
    'eid'    => "Purchase_$orderId",
    'kp'     => $subid,
    'extra'  => ['currency'=>'USD'] // no amount from HTML
  ];
  $fb = curl_init(BRIDGE_URL);
  curl_setopt_array($fb, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS     => json_encode($payload),
    CURLOPT_TIMEOUT        => 8,
  ]);
  curl_exec($fb);
  curl_close($fb);

  // Send to Keitaro
  $url = sprintf(POSTBACK_URL, urlencode($subid), $ktrStatus);
  file_get_contents($url);

  $seen[] = $orderId;
  file_put_contents(LOG_FILE, date('c') . " ✔ Sent $orderId [$subid] → $ktrStatus\n", FILE_APPEND);
  $count++;
}

// ─── SAVE PROCESSED LIST ───────────────────────────────────────────────────
file_put_contents(PROCESSED_IDS, json_encode(array_values($seen), JSON_PRETTY_PRINT));
file_put_contents(LOG_FILE, date('c') . " ✅ Done. $count new sent.\n", FILE_APPEND);
