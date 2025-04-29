<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_mytranslate($string) {
    $w = $_SERVER['DOCUMENT_ROOT'] . BASE_FOLDER . 'system/tmp/template.txt';
    
    $c = file_get_contents($w);

    $c = unserialize($c);
	#p($c);
    #p($c[$string][$_COOKIE['lang']]);
    #die;
    #return 'xxx';

    if ( $c[strtolower($string)][$_COOKIE['lang']] ) {
		return $c[strtolower($string)][$_COOKIE['lang']];
    } else {
//    	$c[strtolower($string)] = array(
//    		'en' => $string,
//    		'de' => $string,
//    		'es' => $string,
//    		'fr' => $string,
//    		'it' => $string,
//	    );
//	    $c = serialize($c);
//	    file_put_contents($w, $c);

		return $string;
    }
    
    


	return strtolower($string);
}

?>
