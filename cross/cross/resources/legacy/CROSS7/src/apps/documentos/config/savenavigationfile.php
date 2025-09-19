<?php    

$Navigation_config = array (
  'default_action' => 'FeCrdefault',
  'error_view' => 'error',
  'login_view' => 'Login',
  'commands' => 
  array (
    'FeCrdefault' => 
    array (
      'class' => 'FeCrDefaultCommand',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Menu',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'error',
          'redirect' => 0,
        ),
      ),
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
  'views' => 
  array (
    'Form_Menu' => 
    array (
      'template' => 'Form_Menu.tpl',
    ),
    'Form_LstHelp' => 
    array (
      'template' => 'Form_LstHelp.tpl',
    ),
     'Form_TreeHelp' => 
    array (
      'template' => 'Form_TreeHelp.tpl',
    ),
 ),
);

$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[DOCUNET] navigation file ERROR\n");
}
die("[DOCUNET] navigation file OK\n");
?>