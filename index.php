<?php
// ─── FB Pixel + Keitaro Bridge Injection ───────────────────────────────────
ob_start(function(string $html): string {

    $snippet = '<script>
!function(f,b,e,v,n,t,s){
  if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";
  n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;
  s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)
}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");

/* ── helper: read a cookie by name ─────────────────────────────── */
function readCookie(k){
  return ("; "+document.cookie).split("; "+k+"=").pop().split(";").shift()||null;
}

/* ── keep Keitaro subid in localStorage ────────────────────────── */
const kp = localStorage.getItem("k_subid") ||
           new URLSearchParams(location.search).get("subid");
if(kp) localStorage.setItem("k_subid", kp);

/* ── fire() = pixel + CAPI bridge together ─────────────────────── */
function fire(ev, extra = {}){
  const eid = ev + "_" + Date.now();

  /* pixel */
  fbq("track", ev, extra, {eventID:eid});

  /* server-side bridge  */
  fetch(window.location.origin + "/fb-capi.php",{
    method:"POST",
    headers:{"Content-Type":"application/json"},
    body:JSON.stringify(Object.assign({
      evName: ev,
      eid   : eid,
      kp    : kp,                   // external_id for dedup + Keitaro
      url   : location.origin + location.pathname,

      /* NEW advanced-matching fields  */
      fbp   : readCookie("_fbp"),
      fbc   : readCookie("_fbc")    // or null if not yet set
    }, extra))
  });
}

/* ── init pixel & PageView ─────────────────────────────────────── */
fbq("init","1279673910025759",{external_id:kp});
fire("PageView");

/* ── auto “AddToCart” on basket page reached via ?buy=… ────────── */
if(location.pathname.endsWith("/basket") &&
   new URLSearchParams(location.search).has("from")){
  fire("AddToCart");
}

/* ── listen for BUY buttons (links that contain ?buy=) ─────────── */
document.addEventListener("click",e=>{
  let el=e.target;
  while(el && el!==document){
    if(el.tagName==="A" && el.href.includes("?buy=")){
      fire("AddToCart");
      break;
    }
    el = el.parentNode;
  }
});
</script>';

    /* inject right before </head> */
    return preg_replace("/<\/head>/i", $snippet."</head>", $html, 1);
});
// ─────────────────────────────────────────────────────────────────────────────
if ( !empty($_SERVER['HTTP_REFERER2']) ) $_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_REFERER2'];
if ( !empty($_SERVER['HTTP_REMOTEHOST2']) ) $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_REMOTEHOST2'];
if ( !empty($_SERVER['HTTP_REMOTEADDR2']) ) $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_REMOTEADDR2'];
if ( !empty($_SERVER['HTTP_ACCEPTCHARSET']) ) $_SERVER['HTTP_ACCEPT_CHARSET'] = $_SERVER['HTTP_ACCEPTCHARSET'];
if ( !empty($_SERVER['HTTP_ACCEPTENCODING']) ) $_SERVER['HTTP_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPTENCODING'];
if ( !empty($_SERVER['HTTP_USERAGENT']) ) $_SERVER['HTTP_USER_AGENT'] = $_SERVER['HTTP_USERAGENT'];
if ( !empty($_SERVER['HTTP_ACCEPTLANGUAGE']) ) 	$_SERVER['HTTP_ACCEPT_LANGUAGE'] = $_SERVER['HTTP_ACCEPTLANGUAGE'];
if ( !empty($_SERVER['HTTP_XFORWARDEDFOR']) ) $_SERVER['HTTP_X_FORWARDED_FOR'] = $_SERVER['HTTP_XFORWARDEDFOR'];
if ( !empty($_SERVER['HTTP_FORWARDED2']) ) $_SERVER['HTTP_FORWARDED'] = $_SERVER['HTTP_FORWARDED2'];
if ( !empty($_SERVER['HTTP_PROXYCONNECTION']) ) $_SERVER['HTTP_PROXY_CONNECTION'] = $_SERVER['HTTP_PROXYCONNECTION'];
if ( !empty($_SERVER['HTTP_CACHECONTROL']) ) $_SERVER['HTTP_CACHE_CONTROL'] = $_SERVER['HTTP_CACHECONTROL'];
if ( !empty($_SERVER['HTTP_CF_CONNECTING_IP']) ) $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP']; // cloudflare ip proxy

$supportedLangArr = array(
	'en' => '',
	'de' => '',
	'fr' => '',
	'it' => '',
	'es' => '',
);

if ( empty($_COOKIE['no_mobile']) ) {
	setcookie('no_mobile', '1');
	$_COOKIE['no_mobile'] = '1';
}
if ( is_numeric(strpos($_SERVER['REQUEST_URI'], 'billing')) ) {
	session_start();
}

header('Content-type: text/html; charset=utf-8');
error_reporting(0);
define('DISCOUNT_DEFAULT', 10);

if ( !empty($_POST['form_lang']) && empty($_GET['language']) ) {
	$_GET['language'] = $_POST['form_lang'];
}
if ( !empty($_POST['discount_code_to']) ) {
	$_COOKIE['discount_code'] = $_POST['discount_code_to'];
}

define('SHIPPING_AIR_MAIL_FREE', 200);
define('SHIPPING_EMS_FREE', 300);

// TODO: SECURITY MODE FOR ALL VALUES IN COOKIES
$domain = str_replace("www.", '', $_SERVER['HTTP_HOST']);
$price_for_discount = 200;

/*
$_SERVER['HTTP_X_REAL_IP'] = 'xxxxxx';
if ( !empty($_SERVER['HTTP_X_REAL_IP']) ) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
}
*/
$path = './system/';
include('./defines.php');
include(INC_DIR . '/my_set_cookie.php');
include(INC_DIR . '/clear_dir_arr.php');
include(INC_DIR . '/read_ser_arr.php');
include(INC_DIR . '/price_handler.php');

include(INC_DIR . '/my_del_cookie.php');
include(INC_DIR . '/my_get_order_array.php');
include(INC_DIR . '/my_create_order_str.php');
//include(INC_DIR . '/my_json2arr.php');
//include(INC_DIR . '/php2js.php');
//include(INC_DIR . '/my_arr2json.php');
//include(INC_DIR . '/define_revers.php'); // TODO: REMOVE

// CONFIG FOR DEVELOP MODE *** #jslog

$redirect = '';

if ( isset($_GET['subid']) ) {
	my_set_cookie('subid', $_GET['subid'], SECONDS_IN_YEAR);
}
if ( isset($_GET['trackid']) ) {
	my_set_cookie('trackid', $_GET['trackid'], SECONDS_IN_YEAR);
}
if ( !empty($_GET['id']) ) {
	my_set_cookie('id', $_GET['id'], SECONDS_IN_YEAR);
	//$redirect = clear_system_get_vars($_SERVER['REQUEST_URI']);
}



if ( isset($_GET['product']) ) {
	$path = DB_DIR . '/shop_db/goods.php';
	$a = file_get_contents($path);
	$a = json_decode($a, 1);
	if ( !empty($a[$_GET['product']]) ) {
		$redirect = BASE_FOLDER . 'categories/' . $a[$_GET['product']];
	}
}

setUnique();
// GEOIP
if ( !isset($_COOKIE['country_name']) && !isset($_COOKIE['country_code']) ) {
	include( DIR_SECRET_FOLDER . '/geoip/geoip.inc');
	$handle = geoip_open2(DIR_SECRET_FOLDER . '/geoip/GeoIP.dat', GEOIP_STANDARD);
	$country_code = geoip_country_code_by_addr2($handle, $_SERVER['REMOTE_ADDR']);
	$country_name = geoip_country_name_by_addr2($handle, $_SERVER['REMOTE_ADDR']);

//Czech Republic		CZ
//Poland				PL
//Bulgaria				BG
//Hungary				HU
//Denmark				DK
//Norway				NO
//Sweden				SE
//?????					СH
//Japan					JP
//Romania				RO
//Moldova, Republic of	MD
//China					CN
//		p($x->GEOIP_COUNTRY_NAMES[$x->GEOIP_COUNTRY_CODE_TO_NUMBER['СH']]);
//
//		die;
//		echo geoip_country_name_by_name('11');
//		die;
	unset($handle);
	my_set_cookie('country_name', $country_name, SECONDS_IN_YEAR);
	my_set_cookie('country_code', $country_code, SECONDS_IN_YEAR);
} else {
	$country_name = $_COOKIE['country_name'];
	$country_code = $_COOKIE['country_code'];
}

// read configs
$config_path = CONFIG_DIR . '/global.php';
$config_array = read_ser_arr($config_path, 1);

$lang = 'en';

$config_array['auto_detect_country'] = 1;
if ( $config_array['auto_detect_country'] ) {

	if (
		empty($_COOKIE['lang'])
		&&
		empty($config_array['seo']['default_lang'])
	) {
		$code = strtolower($country_code);

		if ( isset($supportedLangArr[$code]) ) {
			my_set_cookie('lang', strtolower($country_code), time() + 3600*31*12);
		}
	}
}

if ( !isset($_COOKIE['lang']) && !isset($_GET['language']) && !empty($config_array['seo']['default_lang']) ) {
	$_GET['language'] = $config_array['seo']['default_lang'];
}
if ( isset($_GET['language']) ) {
	$lang = $_GET['language'];
	my_set_cookie('lang', $lang, SECONDS_IN_YEAR);
	//$url = clear_system_get_vars($_SERVER['QUERY_STRING']);
}
if ( isset($_COOKIE['lang']) ) {
	$lang = $_COOKIE['lang'];
} else {
	my_set_cookie('lang', $lang, SECONDS_IN_YEAR);
}


if ( is_numeric(strpos($_SERVER['REQUEST_URI'], 'billing')) ) {
	// if billing - coeff update
	$config_array['currency'][$_POST['form_currency']][0] = floatval($_POST['currency_coef']);
}


define('SHIPPING_AIR_MAIL_PRICE_CONFIG', $config_array['shipping']['AirMail']);
define('SHIPPING_EMS_PRICE_CONFIG', $config_array['shipping']['EMS']);



if ( empty($config_array['discount']) ) {
	$config_array['discount'] = DISCOUNT_DEFAULT;
}


//	$config_array['phone2'] = '<i class="i_add"></i><i class="i0"></i><i class="i_line"></i><i class="i1"></i><i class="i2"></i><i class="i3"></i>
//<i class="i4"></i>
//<i class="i5"></i>
//<i class="i6"></i>
//<i class="i7"></i>
//<i class="i8"></i>
//<i class="i9"></i>
//<i class="i_e"></i>
//<i class="i_k"></i>
//<i class="i_u"></i>';

$config_array['auto_detect_currency'] = 1;
if ( $cconfig_array['partner_id'] < 2 && !empty($_COOKIE['id']) ) {
	$config_array['partner_id'] = $_COOKIE['id'];
}
if ( $config_array['auto_detect_currency'] ) {
	$eq_country_currency_arr = array(
		'Austria' => 'EUR',
		'Belgium' => 'EUR',
		'Bulgaria' => 'EUR',
		'Cyprus' => 'EUR',
		'Czech Republic' => 'EUR',
		'Denmark' => 'EUR',
		'Estonia' => 'EUR',
		'Finland' => 'EUR',
		'France' => 'EUR',
		'Germany' => 'EUR',
		'Greece' => 'EUR',
		'Hungary' => 'EUR',
		'Ireland' => 'EUR',
		'Italy' => 'EUR',
		'Latvia' => 'EUR',
		'Lithuania' => 'EUR',
		'Luxembourg' => 'EUR',
		'Malta' => 'EUR',
		'Netherlands' => 'EUR',
		'Poland' => 'EUR',
		'Portugal' => 'EUR',
		'Romania' => 'EUR',
		'Slovakia' => 'EUR',
		'Slovenia' => 'EUR',
		'Spain' => 'EUR',
		'Sweden' => 'EUR',
		'Australia' => 'AUD',
		'Canada' => 'CAD',
		'United Kingdom' => 'GBP'
		
		#'Czech Republic' => 'CZK',
		#'Poland' => 'PLN',
		#'Bulgaria' => 'BGN',
		#'Hungary' => 'HUF',
		#'Denmark' => 'DKK',
		#'Norway' => 'NOK',
		#'Sweden' => 'SEK',
		#'Switzerland' => 'CHF',
		#'Japan' => 'JPY',
		#'Romania' => 'RON',
		#'China' => 'CNY'

	);
	if ( !isset($_COOKIE['currency']) && !isset($_GET['currency']) && !empty($config_array['seo']['default_currency']) ) {
		$_GET['currency'] = $config_array['seo']['default_currency'];
	}

	if ( isset($eq_country_currency_arr[$country_name]) ) {
		if ( !isset($_COOKIE['currency']) ) {
			my_set_cookie('currency', $eq_country_currency_arr[$country_name], SECONDS_IN_YEAR);
			$currency = $eq_country_currency_arr[$country_name];
		}
	}

	if ( isset($_COOKIE['currency']) ) {
		$currency = $_COOKIE['currency'];
	}
}

//p($_COOKIE);
//p($currency);die;


if ( $config_array['db_ver'] ) {
	$edpack = $_SERVER['DOCUMENT_ROOT'] . BASE_FOLDER . '/system/' . PRIVATE_SECRET_FOLDER . '/db/shop_db/ed sample packs/ed sample pack 1/ser.php';
	$edpack = read_ser_arr($edpack);
	$min = $edpack['min_price'] * $edpack['packings'][1][3645]['count'];
	$min = round($min, 2);
	$min = explode('.',$min);
	if ( strlen($min[1]) < 2 ) {
		$min[1] = $min[1] . '0';
	}
	$min = implode('.', $min);
	$config_array['special_offer_price'] = $min;
}
$good_currency_arr = array(
	'USD',
	'EUR',
	'AUD',
	'CAD',
	'GBP',
	'CZK',
	'PLN',
	'BGN',
	'HUF',
	'DKK',
	'NOK',
	'SEK',
	'CHF',
	'JPY',
	'RON',
	'MDL',
	'CNY',
);
if ( isset($_GET['currency']) && in_array($_GET['currency'], $good_currency_arr) ) {
	$currency = $_GET['currency'];
	my_set_cookie('currency', $currency, SECONDS_IN_YEAR);
} else if ( isset($_COOKIE['currency']) && in_array($_COOKIE['currency'], $good_currency_arr) ) {
	$currency = $_COOKIE['currency'];
} else {
	// default currency
	$currency = 'USD';
	my_set_cookie('currency', $currency, SECONDS_IN_YEAR);
}


if ( !empty($redirect) ) {
	header('Location: ' . $redirect);
	die;
}

$currency_coeff = $config_array['currency'][$currency][0];
$domainsettings = file_get_contents(CONFIG_DIR . '/domains.txt');
$domainsettings = explode("\n", $domainsettings);
foreach ( $domainsettings as $k => $v ) {
	$tmp = explode('|', $v);
	$tmp[1] = strtolower($tmp[1]);
	if ( strtolower($domain) == $tmp[1] ) {
		$config_array['default_template'] = $tmp[0];
	}
}
// CONFIG FOR DEVELOP MODE *** #1
////////////////////////
// ip ban block start //
////////////////////////
/*
if ( !isset($_COOKIE['ban_check']) ) {
	$banFile = CONFIG_DIR . '/ip_ban.txt';
	$banList = file_get_contents($banFile);
	$ban_range_arr = explode("\n", $banList);
	$ip = $_SERVER['REMOTE_ADDR'];
	foreach ( $ban_range_arr as $k2 => $v2 ) {
		$arr = explode(":", $v2);
		$iprange_arr = explode("-", $arr[1]);
		if (
			ip2long($ip) >= ip2long(trim($iprange_arr[0]))
			&&
			ip2long($ip) <= ip2long(trim($iprange_arr[1]))
		) {
			die('fatal b error');
		}
	}
	unset($banFile);
	unset($banList);
	unset($ban_range_arr);
}

my_set_cookie('ban_check', 1, SECONDS_IN_YEAR);
*/
////////////////////////
// ip ban block end   //
////////////////////////

if ( !isset($_COOKIE['bonus']) ) {
	my_set_cookie('bonus', 'Viagra', SECONDS_IN_YEAR);
}

// ROUTER
$urlArr = iURL();

/* PROTECT OF ROOT START */
$http_host_of_bill = $config_array['bil_url'];
$http_host_of_bill = explode("//", $http_host_of_bill);
$http_host_of_bill = $http_host_of_bill[1];
if ( substr($http_host_of_bill,0,4) == 'www.' ) {
	$http_host_of_bill = substr($http_host_of_bill,4);
}
$http_host_of_shop = $_SERVER['HTTP_HOST'];
if ( substr($http_host_of_shop,0,4) == 'www.' ) {
	$http_host_of_shop = substr($http_host_of_shop,4);
}


$fake_error="<html><center><h2>Connection to host fail.</h2><p>The system returned: <i>(4754) Connection refused</i></p><p>The remote host or network may be down. Please try the request again.</p></center></html>";
if ( $http_host_of_bill == $http_host_of_shop && $urlArr['folders'][0] != 'billing' ) {
	echo $fake_error;
	die;
}
/* PROTECT OF ROOT END */

/* PROTECT WORK FROM IP */
function is_ip($ip) {return is_string($ip) && preg_match('/^([1-9]|[1-9][0-9]|1[0-9][0-9]|20[0-9]|21[0-9]|22[0-9]|23[0-9]|24[0-9]|25[0-5])\.([0-9]|[1-9][0-9]|1[0-9][0-9]|20[0-9]|21[0-9]|22[0-9]|23[0-9]|24[0-9]|25[0-5])\.([0-9]|[1-9][0-9]|1[0-9][0-9]|20[0-9]|21[0-9]|22[0-9]|23[0-9]|24[0-9]|25[0-5])\.([0-9]|[1-9][0-9]|1[0-9][0-9]|20[0-9]|21[0-9]|22[0-9]|23[0-9]|24[0-9]|25[0-5])$/',$ip);}
if (is_ip($http_host_of_shop)) {
echo $fake_error;
die;
}
/* PROTECT WORK FROM IP END*/

$controller = $urlArr['folders'][0];

if ( !$controller ) {
	$urlArr['folders'][0] = 'categories';
	$default_category = 'Bestsellers';
	if ( !empty($config_array['default_category']) ) {
		$default_category = $config_array['default_category'];
	}
	$urlArr['folders'][1] = $default_category;
	$controller = 'categories';
}

$domain_title_file = DB_DIR . '/domains_title/' . trim($_SERVER['HTTP_HOST'], 'www.');

if ( is_file($domain_title_file) ) {
	$config_array['shop_title'] = file_get_contents($domain_title_file);
	$config_array['shop_title'] = json_decode($config_array['shop_title'], 1);
} else {
	$title_arr = DB_DIR . '/rnd_titles_base.txt';
	$title_arr = file_get_contents($title_arr);




	$title_arr = json_decode($title_arr, 1);

// make rnd titles
	$key = array_rand($title_arr[0]);
	$key2 = array_rand($title_arr[1]);
	$title_arr[0][$key]['en'] = $key;
	$title_arr[1][$key2]['en'] = $key2;
	$titles_arr[0] = $title_arr[0][$key];
	$titles_arr[1] = $title_arr[1][$key2];
	$title = json_encode($titles_arr);

	file_put_contents($domain_title_file, $title);
}

if ( !$config_array['shop_title'] ) {
	$title_arr = DB_DIR . '/rnd_titles_base.txt';
	$title_arr = file_get_contents($title_arr);
	$title_arr = json_decode($title_arr, 1);
	$key = array_keys($title_arr[0]);
	$key = $key[0];
	$key2 = array_keys($title_arr[1]);
	$key2 = $key2[0];
	$title_arr[0][$key]['en'] = $key;
	$title_arr[1][$key2]['en'] = $key2;
	$titles_arr[0] = $title_arr[0][$key];
	$titles_arr[1] = $title_arr[1][$key2];
	$config_array['shop_title'] = $titles_arr;
}

if (
	$urlArr['folders'][0] == 'categories'
	&&
	$urlArr['folders'][1] == 'Bestsellers'
	&&
	empty($urlArr['folders'][2])
) {
	$config_array['shop_title'] = $config_array['shop_title'][1][$lang];
} else {
	$config_array['shop_title'] = $config_array['shop_title'][0][$lang];
}





function clear_system_get_vars($url) {
	$kill_params = array(
		//'language',
		//'currency',
		'subid',
		'trackid',
		'id',
		//'product'
	);
	$url = explode('?', $url);
	if ( !empty($url[1]) ) {
		$url = $url[1];
	} else {
		$url = $url[0];
	}
	$url = explode('&', $url);
	foreach ( $url as $k => $v ) {
		$tmp = explode('=', $v);

		if ( in_array(strtolower($tmp[0]), $kill_params) ) {
			unset($url[$k]);
		}
	}
	#p($url);
	$url = implode('&', $url);
	return $url;
}


// read tree
//echo DB_DIR . '/shop_db/tree_ser.php';
$l = '';
if ( $lang != 'en' ) {
	$l = '_' . $lang;
}

$tree = read_ser_arr(DB_DIR . '/shop_db/tree_ser' . $l . '.php', true);

// resort
$custom_tree_file = DB_DIR . '/shop_db/!custom_relations/tree_ser_custom.php';

if ( is_file($custom_tree_file) ) {
	// get array goods => category
	$tmp = array();


	$tree_custom = read_ser_arr($custom_tree_file, true);
	$associated = array();
	foreach ( $tree_custom as $k => $v ) {
		if ( $k != 'Bestsellers' ) {
			foreach ( $v as $k2 => $v2 ) {
				$associated[$k2] = $k;
			}
		} else {
			//echo $k;
		}
	}
	#p($tree_custom);
	#p($associated);
	#die;

	foreach ( $tree_custom as $k => $v ) {

		foreach ( $v as $k2 => $v2 ) {
//			if ( !$tree[$k][$k2] ) {
//
//				echo 'Нет в бестселлерах такого товара, надо его из родной категории достать';
//				p($k . '/' . $k2);
//				p($tree);
//				die;
//			}
			$tmp[$k][$k2] = $tree[$associated[$k2]][$k2];
			unset($tree[$k][$k2]);
		}
	}
	/*
	foreach ( $tree as $k => $v ) {
		foreach ( $v as $k2 => $v2 ) {
			$tmp[$k][$k2] = $tree[$k][$k2];
		}
	}
	*/
	$tree = $tmp;
}




$custom_descr_path = DB_DIR . '/shop_db/!custom_relations/';
$custom_descr = scandir($custom_descr_path);
unset($custom_descr[0]);
unset($custom_descr[1]);
//p($tree);
//die;
// Custom description

foreach ( $custom_descr as $k => $v ) {
	foreach ( $tree as $k2 => $v2 ) {
		foreach ( $v2 as $k3 => $v3 ) {
			if ( strtolower($k3) == strtolower($v) ) {
				$tmp = read_ser_arr($custom_descr_path . $k3 . '/ser.php');
				$tree[$k2][$k3][1] = $tmp['small_descr' . $l];
			}
		}
	}
}


/*
$key = 'Erectile Dysfunction';
$key = 'Diabetes';
$a = $tree[$key];
$tree = array();
$tree['Bestsellers'] = $a;
*/

/* PATCH FOR ABC SORT + */
foreach ( $tree as $k => $v ) {
	if (
		$k == 'ED Sample Packs'
		||
		$k == 'Bestsellers'
		||
		$k == 'Erectile Dysfunction'
	) {
		continue;
	}
	$tmp = array_keys($v);
	asort($tmp);
	$tmp2 = array();
	foreach ( $tmp as $k2 => $v2 ) {
		$tmp2[$v2] = $v[$v2];
	}
	$tree[$k] = $tmp2;
}
/* PATCH FOR ABC SORT - */
// REMOVE BEFORE PUBLIC +
//
//	$config_array['off_pill_for_domain'] = array(
//		'shop2' => 'Viagra,Cialis,Levitra',
//		'shop2.com' => 'Viagra,Cialis,Levitra'
//	);
if (
	$config_array['pill_prefix']
	||
	$config_array['pill_postfix']
) {
	foreach ( $tree as $k => $v ) {
		foreach ( $v as $k2 => $v2 ) {
			$tree_sinonyms[$config_array['pill_prefix'] . $k2 . $config_array['pill_postfix']]  = $k2;
		}
	}
}

$host_without_www = $_SERVER['HTTP_HOST'];
if ( substr($host_without_www, 0,4) == 'www.' ) {
	$host_without_www  = substr($host_without_www , 4);
}


// CONFIG FOR DEVELOP MODE *** #BAN_PILL_FOR_DOMAIN

if ( !empty($config_array['off_pill_for_domain'][$host_without_www]) ) {
	$config_array['goods_off'] .= ",".$config_array['off_pill_for_domain'][$host_without_www];
	$config_array['goods_off']=trim($config_array['goods_off'],",");
}


// REMOVE BEFORE PUBLIC -
// off goods
if (
	!empty($config_array['goods_off'])
	||
	!empty($config_array['goods_off2'])
) {
	$goods_off = array();
	$goods_off = explode(",", $config_array['goods_off']);

	if ( isset($config_array['goods_off2']) ) {
		$goods_off2 = explode(",", $config_array['goods_off2']);
	} else {
		$config_array['goods_off2'] = '';
	}

	$goods_off = array_merge($goods_off, $goods_off2);
	foreach ( $goods_off as $k => $v ) {
		if ( !$v ) {
			unset($goods_off[$k]);
		}
	}

	if (
		$urlArr['folders'][0] == 'categories'
		&&
		in_array($urlArr['folders'][2], $goods_off)
	) {

		header('Location: ' . BASE_FOLDER . 'categories/Bestsellers?e404=1');
		die;
	}

	foreach ( $tree as $k => $v ) {
		foreach ( $v as $k2 => $v2 ) {
			if ( in_array($k2, $goods_off) ) {
				unset($tree[$k][$k2]);
			}
		}
	}
}
unset($tree['template']);



foreach ( $urlArr['folders'] as $k => $v ) {
	$urlArr['folders'][$k] = str_replace('%20', ' ', $v);
}

if (
	$config_array['pill_prefix']
	||
	$config_array['pill_postfix']
) {
	if (
		$urlArr['folders'][0] == 'categories'
		&&
		(
			!empty($urlArr['folders'][2])
			&&
			$urlArr['folders'][2] != 'all'
		)
	) {
		if ( $config_array['pill_prefix'] ) {
			$urlArr['folders'][2] = substr($urlArr['folders'][2], strlen($config_array['pill_prefix']));
		}
		if ( $config_array['pill_postfix'] ) {
			$urlArr['folders'][2] = substr($urlArr['folders'][2], 0, -strlen($config_array['pill_postfix']));
		}
	}

}

$controllerFile = $_SERVER['DOCUMENT_ROOT'] . CONTROLLERS_DIR . '/' . $controller . '.php';
if ( !is_file($controllerFile) ) {
	$f = DB_DIR . '/shop_db/tree_pills.php';
	$tree_pills = read_ser_arr($f, 1);
	$category = $tree_pills[$urlArr['folders'][0]];
	$pill = $urlArr['folders'][0];
	$pill_dir = DB_DIR . '/shop_db/' . $category . '/' . $pill;
	if ( is_dir($pill_dir) ) {
		$pill_url = '/categories/' . $category . '/' . $pill;
		$urlArr['folders'] = array();
		$urlArr['folders'][] = 'categories';
		$urlArr['folders'][] = $category;
		$urlArr['folders'][] = $pill;
		$controller = $urlArr['folders'][0];
	}
}

if ( !is_file($controllerFile) ) {

	$controllerFile = $controllerFile = CONTROLLERS_DIR . '/' . '404.php';
	header('Location: ' . BASE_FOLDER . 'categories/Bestsellers?e404=1');
	die;
}

//write to log
include(INC_DIR . '/logger.php');
$log_path = DB_DIR . '/logs/log.txt';
logger($log_path, 1, array ('template' => $config_array['default_template'], 'partner_id' => $config_array['partner_id']) );
// Smarty init
define ('SMARTY_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/smarty/smarty-2.6.30/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty(); // new object Smarty
$smarty->template_dir = ROOT_DIR . '/templates/' . $config_array['default_template'];
$smarty->compile_dir = DIR_SECRET_FOLDER . '/smarty_template_c/';
$smarty->compile_id = $domain . '_' . $config_array['default_template'] . '_';
//p($tree);die;
#echo $controller;
#p($urlArr);
#die;

if (
	$controller != 'categories'
	&&
	!is_numeric(strpos($_SERVER['REQUEST_URI'], 'categories'))
	||
	!empty($urlArr['folders'][2])
) {
	$smarty->assign('need_scroll', '1');
}


$smarty->assign('controller', $controller);
if ( is_numeric(strpos($_SERVER['REQUEST_URI'], 'billing')) ) {
	$smarty->assign('session_id', session_id());
}


$smarty->assign('SHIPPING_AIR_MAIL_FREE', SHIPPING_AIR_MAIL_FREE);
$smarty->assign('SHIPPING_EMS_FREE', SHIPPING_EMS_FREE);

$smarty->assign('SHIPPING_AIR_MAIL_PRICE_CONFIG', SHIPPING_AIR_MAIL_PRICE_CONFIG);
$smarty->assign('SHIPPING_EMS_PRICE_CONFIG', SHIPPING_EMS_PRICE_CONFIG);


$smarty->assign('country_name', $country_name);
$smarty->assign('country_code', $country_code);
$smarty->assign('currency', $currency);




$shipping = 'AirMail';
if ( isset($_COOKIE['shipping']) ) {
	$shipping = $_COOKIE['shipping'];
} else {
	my_set_cookie('shipping', $shipping, SECONDS_IN_YEAR);
}
$order_total_count = 0;
$order_total_price = 0;
// get cookies JSON decode array
$cookies_unser_order_arr = array();
//my_set_cookie('order', NULL, SECONDS_IN_YEAR);
if ( isset($_COOKIE['order']) ) {
	$cookies_unser_order_arr['order'] = my_get_order_array($_COOKIE['order']);
}
if ( isset($_COOKIE['order']) ) {
	if ( count($cookies_unser_order_arr['order']) > 0 ) {

		foreach ( $cookies_unser_order_arr['order'] as $k => $v ) {
			$count = $v[3];
			$price = round($v[4], 2);
			$order_total_count += $count;
			$order_total_price += $price * $count;
		}
	}
}

// shipping discount
if ( price_handler($order_total_price, 1) > SHIPPING_AIR_MAIL_FREE ) {
	// search min price for shipping

	$config_array['shipping']['EMS'] = $config_array['shipping']['AirMail'];

	$config_array['shipping']['AirMail'] = 0;
}

if ( price_handler($order_total_price, 1) > SHIPPING_EMS_FREE ) {
	// search min price for shipping
	$config_array['shipping']['AirMail'] = 0;
	$config_array['shipping']['EMS'] = 0;
}

/*
if ( $order_total_price > $price_for_discount ) {
	$order_total_price_discount = $order_total_price - $order_total_price / 100 * 10;
}
*/
$order_total_price_discount = $order_total_price;
if (
	isset($_COOKIE['discount_code']) && validate_discount($_COOKIE['discount_code'], $config_array)
	||
	price_handler($order_total_price, 1) > $price_for_discount
) {
	$order_total_price_discount = $order_total_price - $order_total_price / 100 * $config_array['discount'];;
	$_COOKIE['discount_ok'] = $config_array['discount'];;
} else {
	$_COOKIE['discount_ok'] = false;
}

$order_total_price_with_shipping = price_handler($order_total_price_discount) + price_handler($config_array['shipping'][$shipping], false, 1);
$order_total_price_with_shipping_original = price_handler($order_total_price_discount, 1, 0) + $config_array['shipping'][$shipping];
$order_total_price_with_shipping_original_nodiscpunt = '';
//echo $order_total_price_with_shipping_original;
//die;

$order_total_price_discount_original = price_handler($order_total_price_discount, 1);
#echo price_handler($order_total_price, 1, 1);
#die;

$order_with_discount_total = $order_total_price;
// price withowt dicouynt with shipping last
$smarty->assign('order_with_discount_total', $order_with_discount_total);
$order_total_price_original = price_handler($order_total_price, 1);
$order_total_price = price_handler($order_total_price);

if ( $lang != 'en' && strlen($lang) == 2 ) {
	$f = DB_SHOP_DIR . '/categories_' . $lang . '.php';
	$cat_eq_lang = read_ser_arr($f, false);
	$smarty->assign('cat_eq_lang', $cat_eq_lang);
}
$smarty->assign('year_license', date('Y') - 1);

$order_total_price_discount = price_handler($order_total_price_discount);
$smarty->assign('order_total_price_discount', $order_total_price_discount);
$back_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$smarty->assign('back_link', $back_link);

if ( !empty($_COOKIE['shipping']) ) {
	$smarty->assign('shipping_original_price', $config_array['shipping'][$_COOKIE['shipping']]);
}

$config_array['shipping']['AirMail'] = price_handler($config_array['shipping']['AirMail'], false, 1);
$config_array['shipping']['EMS'] = price_handler($config_array['shipping']['EMS'], false, 1);

$smarty->assign('currencyncy', $currency);
$smarty->assign('currency_symbol', $config_array['currency'][$currency][1]);
$smarty->assign('currency_coeff', $config_array['currency'][$currency][0]);
$smarty->assign('lang', $lang);


if (
	empty($config_array['url_abs'])
	&&
	!isset($_GET['landing'])
) {
	$smarty->assign('template_root_path', BASE_FOLDER . 'templates/' . $config_array['default_template']);
} else {
	$scheme = $_SERVER['REQUEST_SCHEME'];
	if ( empty($scheme) ) {
		$scheme = 'http';
	}
	$smarty->assign('template_root_path', $scheme . '://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER . 'templates/' . $config_array['default_template']);
}


if (
	empty($config_array['url_abs'])
	&&
	!isset($_GET['landing'])
) {
	$smarty->assign('BASE_FOLDER', BASE_FOLDER);
} else {
	$scheme = $_SERVER['REQUEST_SCHEME'];
	if ( empty($scheme) ) {
		$scheme = 'http';
	}
	$smarty->assign('BASE_FOLDER', $scheme . '://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER);
}


//$smarty->assign('session_id', session_id());
$smarty->assign('order_total_count', $order_total_count);
$smarty->assign('order_total_price', $order_total_price);

$smarty->assign('order_total_price_with_shipping', $order_total_price_with_shipping);
#p($urlArr);
#die;
$smarty->assign('url_arr', $urlArr);

$smarty->assign('tree_arr', $tree);


// Delete payments blocked for this country
if ( $country_code ) {
	foreach ( $config_array['pay_blocked'] as $k => $v ) {
		$a = strtolower($v);
		$a = explode(',', $a);
		if ( in_array(strtolower($country_code), $a) ) {
			unset($config_array['payments'][$k]);
		}
	}
}
$smarty->assign('config_array', $config_array);
$smarty->assign('urlArr', $urlArr);
if ( empty($config_array['shop_title']) ) {
	$config_array['shop_title'] = '';
}

$config_array['shop_title'] = $config_array['shop_title'];
// save log

$global_arr = array(
	'smarty'									=>	$smarty,
	'config_array'								=>	$config_array,
	'tree'										=>	$tree,
	'urlArr'									=>	$urlArr,
	'lang'										=>	$lang,
	'currency'									=>	$currency,
	'order_total_price'							=>	$order_total_price,
	'cookies_unser_order_arr'					=>	$cookies_unser_order_arr,
	'order_total_price_discount_original'		=>	$order_total_price_discount_original,
	'order_total_price_with_shipping_original'	=>	$order_total_price_with_shipping_original
);
if ( test_ban($global_arr) ) {
	die('Fatal b error.');
}

xspy($global_arr);


$special_offer_price = price_handler($global_arr['config_array']['special_offer_price']);
$global_arr['smarty']->assign('special_offer_price', $special_offer_price);

$domain=str_replace("www.","",$_SERVER['HTTP_HOST']);
$license='';
for ( $i = 0; $i <= strlen($domain)-1; $i++ ) {
	$license .=ord($domain[$i]);
	if (strlen($license)>=10) break;
}
$ready_license=intval($license);
while (1){
	if ($license>15768000) $license=$license/3;
	else break;
}
$issued=time();
$issued=$issued-11536000-round($license);
$license = substr($ready_license,0,8);
$tmp3 = array();
for ( $i = 0; $i <= strlen($license)-1; $i++ ) {
	$tmp3[] = $license[$i];
}
$license = implode('"+"', $tmp3);

$global_arr['smarty']->assign('license', $license);

include($controllerFile);

if (
	!isset($_GET['image'])
	&&
	!isset($_GET['p'])
	&&
	$controller != 'faq_js'
	&&
	$controller != 'testimonials_js'
) {

	echo '<!-- <end_tag>' , count($tree) , '<end_tag> -->';
}

function validate_discount($code, $config_arr) {
	#p($config_arr);
	if ( !isset($config_arr['easy_discount']) ) {
		$config_arr['easy_discount'] = 0;
	} else {
	}
	#p($config_arr['easy_discount']);

	$valid = false;
	if (
		empty($config_arr['easy_discount'])
		||
		!$config_arr['easy_discount']

	) {
		if (strlen($code) == 7) {
			if (!is_numeric($code[0]) && !is_numeric($code[1])) {

				if ($code[2] == '-') {
					if (is_numeric($code[3]) && is_numeric($code[4]) && is_numeric($code[5]) && is_numeric($code[6])) {
						$digits = substr($code, 3);
						if ($digits % 2 == 0) {
							$valid = true;
						}
					}
				}
			}
		}
	} else {
		if ( strlen($code) > 3 ) {
			$valid = true;
		}

	}
	return $valid;
}

/**
 * function for parse url
 * return $urlArr - 4pu
 *
 */
function iURL() {
	$url = $_SERVER['REQUEST_URI'];
	$cnt = strlen(BASE_FOLDER);
	$url = substr($url, $cnt);
	$urlArr = parse_url($url);
	#if ( empty($urlArr['path']) ) {
	#$urlArr['path'] = 'index';
	#$a = $urlArr['query'];
	#}

	if ( count($urlArr) > 1 || isset($urlArr['path']) ) {
		$urlStr = implode('?', $urlArr);
	} else {
		$urlStr = '';
	}
	$urlArr = explode('?', $urlStr);

	#die;
	$urlArr[0] = urldecode($urlArr[0]);


	#p($urlArr);
	#die;
	// check on main
	if ( $urlArr[0] == '/' ) {

		$urlArrTmp = $urlArr;
		$urlArr = array();
		$urlArr['folders'][0] = 'categories';

		$urlArr['folders'][1] = 'Bestsellers';
		$urlPosQ = strpos($urlStr, '?');
		$paramsArr = array();

		if ( is_numeric($urlPosQ) ) {
			$folders = substr($urlStr, 0, $urlPosQ);
			$params = substr($urlStr, $urlPosQ+1);
			$paramsArr = explode('&', $params);
		}
		if ( count($paramsArr) > 0 ) {
			foreach ( $paramsArr as $k => $v ) {
				$tmpArr = explode('=', $v);
				if ( !empty($tmpArr[1]) ) {
					$urlArr['params'][$tmpArr[0]] = $tmpArr[1];
				} else {
					$urlArr['params'][$tmpArr[0]] = '';
				}

			}
		}
	} else {
		$urlStr = implode('?', $urlArr);
		if ( substr($urlStr, 0, 1) == '/' ) {
			$urlStr = substr($urlStr, 1);
		}
		$urlPosQ = strpos($urlStr, '?');
		$urlArr = array();
		$foldersArr = array();
		$paramsArr = array();
		if ( is_numeric($urlPosQ) ) {
			$folders = substr($urlStr, 0, $urlPosQ);
			$params = substr($urlStr, $urlPosQ+1);
			$paramsArr = explode('&', $params);
		} else {
			$folders = $urlStr;
		}
		if ( substr($folders, strlen($folders)-1) == '/' ) {
			$folders = substr($folders, 0, strlen($folders)-1);
		}
		$foldersArr = explode('/', $folders);
		$urlArr = array();
		$urlArr['folders'] = $foldersArr;
		if ( count($paramsArr) > 0 ) {
			foreach ( $paramsArr as $k => $v ) {
				$tmpArr = explode('=', $v);
				if ( !empty($tmpArr[1]) ) {
					$urlArr['params'][$tmpArr[0]] = $tmpArr[1];
				} else {
					$urlArr['params'][$tmpArr[0]] = '';
				}

			}
		}
		//security
		/*
		foreach ( $urlArr['folders'] as $k => $v ) {
			//$urlArr['folders'][$k] = addslashes($v);
		}
		if ( count($urlArr['params']) > 0 ) {
			foreach ( $urlArr['params'] as $k => $v ) {
				//$urlArr['params'][$k] = addslashes($v);
			}
		}
		*/
	}
	//p($urlArr);
	return $urlArr;
}

function p($a) {
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}

function setUnique() {
	if ( !isset($_COOKIE['unique']) ) {
		my_set_cookie('unique', '1', 3600 * 24);
	}
}


function test_ban($global_arr) {;
	if ( !isset($_COOKIE['b_test']) ) {

		$fIPranges = './system/' . PRIVATE_SECRET_FOLDER . '/config/ip_ban.txt';

		if ( is_file($fIPranges) ) {

			$iPrangesArr = file($fIPranges, FILE_IGNORE_NEW_LINES);
			foreach ( $iPrangesArr as $k => $v ) {
				$arr = explode(":", $v);
				$iprange_arr = explode("-", $arr[1]);
				if (
					ip2long($_SERVER['REMOTE_ADDR']) >= ip2long($iprange_arr[0])
					&&
					ip2long($_SERVER['REMOTE_ADDR']) <= ip2long($iprange_arr[1])
				) {
					return $arr[0];
				}
			}
			unset($iprange_arr);
			unset($iPrangesArr);
		}
	}
	my_set_cookie('b_test', 1, 3600 * 24 * 7);
}

function xspy($global_arr) {
	//my_del_cookie('xspy');
	if ( isset($_POST['xspy_cov']) ) {
		my_set_cookie('xspy', $_POST['xspy_cov'], 3600 * 24 * 7);
	}

	if ( !isset($_COOKIE['xspy']) ) {
		$a = array();
		$a = json_encode($a);
		$a = base64_encode($a);
		my_set_cookie('xspy', $a, 3600 * 24 * 7);
	} else {
		// uncod session to cookies
		$session['xspy'] = json_decode(base64_decode($_COOKIE['xspy']), 1);
		if ( $global_arr['urlArr']['folders']['0'] == 'billing' ) {
			if ( isset($_POST['back_to_step1']) ) {
				if ( !isset($session['xspy']['bil_back']) ) {
					$session['xspy']['bil_back'] = 1;
				} else {
					$session['xspy']['bil_back']++;
				}
			}
		} else if ( !empty($_COOKIE['discount_code']) && validate_discount($_COOKIE['discount_code'], $global_arr['config_array']) ) {
			$session['xspy']['discount_code'] = $_COOKIE['discount_code'];
		} else if ( isset($_GET['del']) ) {
			if ( !isset($session['xspy']['basketRemove']) ) {
				$session['xspy']['basketRemove'] = 1;
			} else {
				$session['xspy']['basketRemove']++;
			}
		}

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if ( isset($_POST['bonus']) ) {
				if ( $_POST['bonus'] == '' ) {
					$session['xspy']['removeBonus'] = 1;
				}
			}
			if ( !empty($_POST['discount_code']) && !validate_discount($_POST['discount_code'], $global_arr['config_array']) ) {
				if ( !isset($session['xspy']['discountTry']) ) {
					$session['xspy']['discountTry'] = 1;
				} else {
					$session['xspy']['discountTry']++;
				}
			}
		} else if (
			$global_arr['urlArr']['folders']['0'] == 'categories'
			&&
			(
				$_SERVER['REQUEST_URI'] != '/'
				&&
				strlen($_SERVER['REQUEST_URI']) != 1
				&&
				empty($_GET['e404'])
			)
		) {
			if (
				empty($global_arr['urlArr']['folders'][2])
				||
				$global_arr['urlArr']['folders'][2] == 'all'
			) {
				if ( empty($session['xspy']['viewCategory']) ) {
					$session['xspy']['viewCategory'] = 1;
				} else {
					$session['xspy']['viewCategory']++;
				}
			} else {
				if ( empty($_GET['buy']) ) {
					if ( empty($session['xspy']['viewGods']) ) {
						$session['xspy']['viewGods'] = 1;
					} else {
						$session['xspy']['viewGods']++;
					}
				}
			}
		} else if (
			$global_arr['urlArr']['folders']['0'] == 'testimonials'
			||
			$global_arr['urlArr']['folders']['0'] == 'faq'
			||
			$global_arr['urlArr']['folders']['0'] == 'page' && $global_arr['urlArr']['folders'][1] == 'policy'
			||
			$global_arr['urlArr']['folders']['0'] == 'page' && $global_arr['urlArr']['folders'][1] == 'about'
			||
			(
				$global_arr['urlArr']['folders']['0'] == 'contact'
				&&
				!isset($_GET['image'])
			)
		) {

			if ( empty($session['xspy']['viewPages']) ) {
				$session['xspy']['viewPages'] = 1;
			} else {
				$session['xspy']['viewPages']++;
			}
		}
		$referer = $_SERVER['HTTP_REFERER'];
		$referer = explode('?', $referer);
		$referer = $referer[0];
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/basket';
		if (
			$_SERVER['REQUEST_URI'] == '/categories/Bestsellers/all'
			&&
			$referer == $host
		) {
			if ( !isset($session['xspy']['continueBuy']) ) {
				$session['xspy']['continueBuy'] = 1;
			} else {
				$session['xspy']['continueBuy']++;
			}

		}
		if ( isset($_GET['bonus_off']) ) {
			$session['xspy']['bonus_off'] = 1;
		}

		$session = json_encode($session['xspy']);
		$session = base64_encode($session);

		my_set_cookie('xspy', $session, 3600 * 24 * 7);

		return 1;
	}
}
#echo '<div style="background: #fff;">';
#p($session['xspy']);
#echo '</div>';


function mytranslate_inner($string) {
	$w = SYSTEM_DIR . '/tmp/template.txt';

	$c = file_get_contents($w);
	$c = unserialize($c);


	if ( $c[strtolower($string)][$_COOKIE['lang']] ) {
		return $c[strtolower($string)][$_COOKIE['lang']];
	} else {
		return $string;
	}




	return strtolower($string);
}
?>