<?php
/*  Healuslab  –  server‑side Conversions API + Keitaro postback  */
const PIXEL_ID     = '1279673910025759';
const ACCESS_TOKEN = 'EAAORKFQQNpQBO0hlyWlSbuYViOExErDcWw4wRZBHTv5l8MXkpUkbTlW1DZBI5HUZBZAHWXCfCKMDaYgoXCzecJX0yzBaELWBkK22TPrJMCGll3tjERIuauj13MNRaJA8VjeVVwJDZBGPiTFIPQDYgBzZB0lLxtgDtT4LJ2bepsY2itY90L3st0lL2lHTacGl9kIQZDZD';

/*  CHANGE ONLY THIS LINE → your Keitaro domain  */
const KTR_URL = 'https://adv-rl.com/postback?clickid=%s&status=%s';
/* --------------------------------------------------------------------- */

header('Content‑Type: application/json');
$req = json_decode(file_get_contents('php://input'), true);
if(!$req || empty($req['eid'])){ http_response_code(400); exit('{"e":"bad"}'); }

/* ---------- build CAPI payload ---------- */
$payload = [
 'data'=> [[
   'event_name'      => $req['evName'],
   'event_id'        => $req['eid'],
   'event_time'      => time(),
   'event_source_url'=> $req['url'] ?? 'https://healuslab.com/',
   'action_source'   => 'website',
   'user_data'       => [
      'client_ip_address' => $_SERVER['REMOTE_ADDR'],
      'client_user_agent' => $_SERVER['HTTP_USER_AGENT'],
      'em' => $req['em'] ?? null,
      'ph' => $req['ph'] ?? null,
   ],
   'custom_data'     => $req['extra'] ?? []
 ]],
 'access_token'=> ACCESS_TOKEN,
];
$endpoint = 'https://graph.facebook.com/v18.0/'.PIXEL_ID.'/events';

$ch = curl_init($endpoint);
curl_setopt_array($ch,[
  CURLOPT_POST=>1,
  CURLOPT_HTTPHEADER=>['Content‑Type: application/json'],
  CURLOPT_POSTFIELDS=>json_encode($payload),
  CURLOPT_RETURNTRANSFER=>1,
  CURLOPT_TIMEOUT=>8,
]);
$fb  = curl_exec($ch);
curl_close($ch);

/* ---------- S2S postback to Keitaro ---------- */
if(!empty($req['kp'])){
   $st = $req['evName']==='Purchase' ? 'sale' :
        ($req['evName']==='AddToCart' ? 'lead' : '');
   if($st) @file_get_contents(sprintf(KTR_URL,urlencode($req['kp']),$st));
}
echo $fb ?: '{"ok":1}';

