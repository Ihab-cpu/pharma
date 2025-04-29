<?php
/*  Healuslab  –  server‑side Conversions API + Keitaro postback  */
const PIXEL_ID     = '1072930954666050';
const ACCESS_TOKEN = 'EAAPyRQeWv8kBO9JOZAZCh4DEzyRR5m7AtHV5LvUnpGeJ6CXG54tz9QtMuvVYRsrTp2ekg5AdnvkWJ1M7v7LQYD1dycZACJDVDLxXQ6rAfRP7F1PoBrZBGGxWVhC6dPaUHJvDSajllguIsjw0xHoN106YvAQsrUBgmVLWrY73e2YYrmd8As1SfuMBAxe9tF4EYwZDZD';

/*  CHANGE ONLY THIS LINE → your Keitaro domain  */
const KTR_URL = 'https://adv-rl.com/a08c202/postback?subid=%s&status=%s';
/* --------------------------------------------------------------------- */

header('Content-Type: application/json');

$raw = file_get_contents('php://input');
$req = json_decode($raw, true);
if (!$req || empty($req['eid'])) {
    http_response_code(400);
    exit('{"e":"bad"}');
}

/* ---------- build CAPI payload ---------- */
$payload = [
    'data' => [[
        'event_name'       => $req['evName'],
        'event_id'         => $req['eid'],
        'event_time'       => time(),
        'event_source_url' => $req['url'] ?? 'https://healuslab.com/',
        'action_source'    => 'website',
        'user_data' => [
            'client_ip_address' => $_SERVER['REMOTE_ADDR'],
            'client_user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'fbc'               => $req['fbc'] ?? null,  // Click ID (fbc)
            'fbp'               => $req['fbp'] ?? null,  // Browser ID (fbp)
            'external_id'       => $req['external_id'] ?? null,  // External ID
        ],
        'custom_data'      => $req['extra'] ?? []
    ]],
    'access_token' => ACCESS_TOKEN,
];
$endpoint = 'https://graph.facebook.com/v18.0/' . PIXEL_ID . '/events';

/* -------- Send to Facebook CAPI -------- */
$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS     => json_encode($payload),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 8,
]);
$fb = curl_exec($ch);
curl_close($ch);

/* ---------- S2S postback to Keitaro with debug logging ---------- */
if (!empty($req['kp'])) {
    $st = $req['evName'] === 'Purchase'
        ? 'sale'
        : ($req['evName'] === 'AddToCart' ? 'lead' : '');
    if ($st) {
        // build URL
        $pb_url = sprintf(KTR_URL, urlencode($req['kp']), $st);
        // log for debugging
        file_put_contents(__DIR__ . '/ktr_debug.log', date('c') . " → $pb_url\n", FILE_APPEND);
        // fire the postback
        @file_get_contents($pb_url);
    }
}

echo $fb ?: '{"ok":1}';
