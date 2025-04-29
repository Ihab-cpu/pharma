<?php
// ─── CONFIG ────────────────────────────────────────────────────────────────
const PHARM_API_KEY   = 'N1TUFwNT0U2jgt9ZH1xEtZPtEnVWFjds';
const PHARM_API_URL   = 'https://pharmempire.com/index.php?service=api'
                      . '&api_key=' . PHARM_API_KEY
                      . '&date_from=%s&date_to=%s'
                      . '&format=json';
const PROCESSED_FILE  = __DIR__ . '/processed_sales.json';
const BRIDGE_URL      = 'https://healuslab.com/fb-capi.php';
const LOG_FILE        = __DIR__ . '/sync-sales.log';
const RAW_FILE        = __DIR__ . '/raw-response.json';

// ─── LOGGING ───────────────────────────────────────────────────────────────
function logmsg($msg) {
    file_put_contents(LOG_FILE, date('Y-m-d\TH:i:sP') . "  $msg\n", FILE_APPEND);
}

logmsg("=== sync-sales.php START ===");

// ─── LOAD PROCESSED IDs ────────────────────────────────────────────────────
if (!file_exists(PROCESSED_FILE)) {
    file_put_contents(PROCESSED_FILE, json_encode([], JSON_PRETTY_PRINT));
}
$seen = json_decode(file_get_contents(PROCESSED_FILE), true) ?: [];

// ─── FETCH RAW JSON from PharmEmpire ───────────────────────────────────────
$today = date('Y-m-d');
$url = sprintf(PHARM_API_URL, $today, $today);
logmsg("Fetching: $url");

$raw = @file_get_contents($url);
if (!$raw) {
    logmsg("❌ Failed to fetch data from PharmEmpire");
    exit;
}

// Save raw for debugging
file_put_contents(RAW_FILE, $raw);

// Clean response just in case (strip BOM, trim)
$clean = trim(preg_replace('/^\xEF\xBB\xBF/', '', $raw));

// Attempt decode
$data = json_decode($clean, true);
if (!isset($data['orders']) || !is_array($data['orders'])) {
    logmsg("❌ JSON decode error or missing 'orders'");
    exit;
}

// ─── STATUS MAP ────────────────────────────────────────────────────────────
$statuses = [
    'Approved' => ['ev' => 'Purchase', 'ktr' => 'sale'],
    'Waiting'  => ['ev' => 'Purchase', 'ktr' => 'upsale'],
    'Declined' => ['ev' => 'Purchase', 'ktr' => 'rejected'],
];

// ─── PROCESS ORDERS ────────────────────────────────────────────────────────
$count = 0;
foreach ($data['orders'] as $o) {
    $orderId = $o['order_id'] ?? null;
    $subid   = $o['sub_id']   ?? null;
    $status  = ucfirst(strtolower($o['status'] ?? ''));

    if (!$orderId || !$subid || !isset($statuses[$status])) continue;
    if (in_array($orderId, $seen, true)) continue;

    $event = $statuses[$status];

    $payload = [
        'evName' => $event['ev'],
        'eid'    => "{$event['ev']}_{$orderId}",
        'kp'     => $subid,
        'extra'  => [], // no amount
    ];

    $ch = curl_init(BRIDGE_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 8
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    logmsg("✔️ Sent: Order $orderId | subid=$subid | status=$status");
    $seen[] = $orderId;
    $count++;
}

// ─── SAVE UPDATED PROCESSED LIST ───────────────────────────────────────────
file_put_contents(PROCESSED_FILE, json_encode(array_values($seen), JSON_PRETTY_PRINT));
logmsg("✅ Sync complete. $count orders sent.");
