== Setup Instructions ==
1. Upload this folder to /public_html/pharmbot
2. Set a CRON job in cPanel to run every 5 min:
   */5 * * * * /usr/bin/php /home/YOURUSER/public_html/pharmbot/pharmbot.php
3. Logs will be saved to logs/sync.log
