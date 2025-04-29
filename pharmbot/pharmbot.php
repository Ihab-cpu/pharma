<?php
/**************************************************************************
 *  Pharmbot  –  fetch today’s orders from PharmEmpire, push to:
 *     – Facebook CAPI   (via your fb-capi.php bridge)
 *     – Keitaro postback (always as “sale”)
 *  © 2025 — tailor-made for healuslab.com
 **************************************************************************/

/*** CONFIG **************************************************************/
const USERNAME      = 'txt';
const PASSWORD      = '123qwe';
const API_KEY       = 'N1TUFwNT0U2jgt9ZH1xEtZPtEnVWFjds';

const LOGIN_URL     = 'https://pharmempire.com/index.php';
const API_URL       =
    'https://pharmempire.com/index.php?service=api&api_key=' . API_KEY .
    '&date_from=%s&date_to=%s&format=json';

const BRIDGE_URL    = 'https://healuslab.com/fb-capi.php';
const POSTBACK_URL  = 'https://adv-rl.com/a08c202/postback?subid=%s&status=%s';

const PROCESSED_IDS = __DIR__ . '/processed.json';
const SESSION_FILE  = __DIR__ . '/../fb-session-store.json'; // alongside index.php
const LOG_FILE      = __DIR__ . '/logs/sync.log';
/**************************************************************************/

date_default_timezone_set('UTC');
@mkdir(__DIR__ . '/logs', 0755, true);

function logMsg($m) {
    file_put_contents(LOG_FILE,
        date('Y-m-d\TH:i:sP') . ' ' . $m . PHP_EOL,
        FILE_APPEND
    );
}

logMsg("=== pharmbot.php START ===");

/* ------------------------------------------------------------------ */
/* 1. Login and keep cookies                                          */
/* ------------------------------------------------------------------ */
$cookie = tempnam(sys_get_temp_dir(), 'pe_');
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEJAR      => $cookie,
    CURLOPT_COOKIEFILE     => $cookie,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT        => 15,
]);
curl_setopt_array($ch, [
    CURLOPT_URL  => LOGIN_URL,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'page'     => 'authorize',
        'pagetogo' => 'sales',
        'username' => USERNAME,
        'password' => PASSWORD,
    ]),
]);
curl_exec($ch);

/* ------------------------------------------------------------------ */
/* 2. Call JSON-API for today’s orders                                 */
/* ------------------------------------------------------------------ */
$today = date('Y-m-d');
$api   = sprintf(API_URL, $today, $today);
curl_setopt_array($ch, [
    CURLOPT_URL     => $api,
    CURLOPT_HTTPGET => true,
    CURLOPT_POST    => false,
]);
$json = curl_exec($ch);
curl_close($ch);

if (!$json) { logMsg("❌ Empty API response"); exit; }

$data = json_decode($json, true);
if (!is_array($data) || empty($data['orders'])) {
    logMsg("❌ JSON decode error or missing 'orders'");
    exit;
}

/* ------------------------------------------------------------------ */
/* 3. Load already-sent list & fb-session store                        */
/* ------------------------------------------------------------------ */
$seen      = json_decode(@file_get_contents(PROCESSED_IDS), true) ?: [];
$fbSession = json_decode(@file_get_contents(SESSION_FILE),  true) ?: [];

/* ------------------------------------------------------------------ */
/* 4. Process each order  (EVERYTHING ⇒ sale)                          */
/* ------------------------------------------------------------------ */
$sent = 0;
foreach ($data['orders'] as $o) {
    $orderId = $o['order_id'] ?? null;
    $subid   = $o['sub_id']   ?? null;
    $status  = $o['status']   ?? null;
    $amount  = floatval($o['comission'] ?? 0);

    if (!$orderId || !$subid || !$status)      continue;
    if (in_array($orderId, $seen, true))       continue;

    /* — always treat as sale — */
    $ktrStatus = 'sale';

    /* – capture _fbp / _fbc if present – */
    $fbp = $fbSession[$subid]['fbp'] ?? null;
    $fbc = $fbSession[$subid]['fbc'] ?? null;

    /* – build CAPI payload – */
    $payload = [
        'evName' => 'Purchase',
        'eid'    => "Purchase_$orderId",
        'kp'     => $subid,
        'fbp'    => $fbp,
        'fbc'    => $fbc,
        'extra'  => [
            'value'        => $amount,
            'currency'     => 'USD',
            'external_id'  => $subid,
        ],
    ];

    $c = curl_init(BRIDGE_URL);
    curl_setopt_array($c, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_TIMEOUT        => 8,
    ]);
    curl_exec($c);
    curl_close($c);

    /* – S2S postback to Keitaro – */
    @file_get_contents(sprintf(POSTBACK_URL, urlencode($subid), $ktrStatus));

    $seen[] = $orderId;
    $sent++;
    logMsg("✔ Sent order $orderId  subid=$subid  status=$ktrStatus");
}

/* ------------------------------------------------------------------ */
/* 5. Save state & finish                                             */
/* ------------------------------------------------------------------ */
file_put_contents(PROCESSED_IDS, json_encode(array_values($seen), JSON_PRETTY_PRINT));

logMsg("✅ Done. $sent new sent.");
echo "OK";
