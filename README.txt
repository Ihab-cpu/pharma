1. PHP version MUST be 7.2 to install the template
Index.php changed and update
2. fp-capi.php is the engine (bridge) which sending the events
3. .htaccess also changed and updated, its hidden can be shows in filezila
4. Pharmbot folder is the the fetching purchase and send them keitaro and FP pharmbot.php is the script
5. Create cron job for /usr/bin/php /home/USER/public_html/pharmbot/pharmbot.php

-------------------------
To Change PIXEL
1- Copy the new Pixel ID and Access-Token from Events Manager.

2- Open /public_html/index.php, search for
fbq("init","1279673910025759" → replace the number with the new ID.

3- Open /public_html/fb-capi.php, at the very top replace

const PIXEL_ID     = 'OLD_ID';
const ACCESS_TOKEN = 'OLD_TOKEN';

-------------------------
To Change Domain

1- Uploaded 
/index.php (OVERWRITE), 
/fb-capi.php, 
/pharmbot/…, 
fb-session-store.json (blank, 0644), 
/.htaccess <--hidden (OVERWRITE)

2- edit pharmbot/pharmbot.php	const BRIDGE_URL = 'https://healuslab.com/fb-capi.php';	Replace healuslab.com with the new host so pharmbot can reach the bridge.

3- edit fb-capi.php	In the fallback URL
'event_source_url'=> $req['url'] ?? 'https://healuslab.com/',	Change the domain (or leave as-is; FB uses it only if the browser fails to send a URL).
