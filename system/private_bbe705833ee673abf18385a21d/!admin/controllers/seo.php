<?php
	index($global_arr);
	
	function index($global_arr) {
		$settings = $global_arr['config_array'];
		$errorStrSettings = '';

        $tags = array(

            'main' => array(
                'Main page Meta',
                array(
                    '%domain%'
                )
            ),

            'cat' => array(
                'Category page Meta',
                array(
                    '%category_name%',
                    '%domain%'
                )
            ),
            'item' => array(
                'Item page Meta',
                array(
                    '%pill_name%',
                    '%category_name%',
                    '%active_ingr%',
                    '%synonyms%',
                    '%price_per_pill%',
                    '%price_per_pack%',
                    '%small_description%',
                    '%domain%'
                )
            ),
        );

        $structure = array(
            'en' => array(
                'main' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'cat' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'item' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
            ),
            'de' => array(
                'main' => array(
                    'tit' => 'Title DE',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'cat' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'item' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
            ),
            'fr' => array(
                'main' => array(
                    'tit' => 'Title FR',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'cat' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'item' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
            ),
            'es' => array(
                'main' => array(
                    'tit' => 'Title ES',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'cat' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'item' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
            ),
            'it' => array(
                'main' => array(
                    'tit' => 'Title IT',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'cat' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
                'item' => array(
                    'tit' => 'Title',
                    'kw' => 'Keywords',
                    'desc' => 'Description'
                ),
            ),
        );

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            $settings = $global_arr['config_array'];
            $settings['pill_prefix'] = $_POST['pill_prefix'];
            $settings['pill_postfix'] = $_POST['pill_postfix'];

            file_put_contents('./../../../templates/global/counter.tpl', '{literal}' . $_POST['html'] . '{/literal}');
            $settings['seo'] = $_POST['seo'];
            write_ser_arr(GLOBAL_CONFIG_PATH, $settings, true);
            $global_arr['smarty']->assign('config_array', $settings);
        }
		
		$global_arr['smarty']->assign('errorStrSettings', $errorStrSettings);
        $global_arr['smarty']->assign('structure', $structure);
        $global_arr['smarty']->assign('tags', $tags);
		$global_arr['smarty']->assign('name', 'settings');
		$global_arr['smarty']->display('seo.tpl');
	}
?>