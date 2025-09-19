<?php
#!/bin/sh

$Navigation_config = array (
    'default_action' => 'FePodefault',
    'error_view' => 'error',
    'login_view' => 'Login',
    'commands' => array (
        'FePodefault' => array(
            'class' => 'FePoDefaultCommand',
            'validated' => 'false',
            'views' => array (
                'success' => array(
					'view' => 'Form_Menu',
					'redirect' => 0
				    ),
				'fail' => array(
					'view' => 'error',
					'redirect' => 0
				    )
				)
			),
			
		'CmdExit' => 
		    array (
		      'class' => 'CmdExit',
		      'validated' => 'false',
		      'views' => 
		      array (
		        'success' => 
		        array (
		          'view' => 'false',
		          'redirect' => 0,
		        ),
		        'fail' => 
		        array (
		          'view' => 'false',
		          'redirect' => 0,
		        )
		      )
		    ),                       
 	    ),
	'views' => array(
        'Form_Menu'=> array (
            'template' => 'Form_Menu.tpl'
            ),
        )
    );

$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[PRODUCTS] navigation file ERROR\n");
}
die("[PRODUCTS] navigation file OK\n");
?>