<?php
#!/bin/sh

$Navigation_config = array (
    'default_action' => 'FePrdefault',
    'error_view' => 'error',
    'login_view' => 'Login',
    'commands' => array (
        'FePrdefault' => array(
            'class' => 'FePrDefaultCommand',
            'views' => array (
                'success' => array(
					'view' => 'Form_Login',
					'redirect' => 0
				    ),
				'fail' => array(
					'view' => 'error',
					'redirect' => 0
				    )
				)
			),
           'FePrCmdDefaultApplications' => array(
                'class' => 'FePrCmdDefaultApplications',
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Applications',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FePrCmdAddApplications' => array(
                'class' => 'FePrCmdAddApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
			    ),
            'FePrCmdUpdateApplications' => array(
                'class' => 'FePrCmdUpdateApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDeleteApplications' => array(
                'class' => 'FePrCmdDeleteApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowListApplications' => array(
                'class' => 'FePrCmdShowListApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowByIdApplications' => array(
                'class' => 'FePrCmdShowByIdApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdCancelShowListApplications' => array(
                'class' => 'FePrCmdCancelShowListApplications',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Applications',
                       'redirect' => 0
                       )
                    )
                ),
           'FePrCmdDefaultAuth' => array(
                'class' => 'FePrCmdDefaultAuth',
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Auth',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FePrCmdAddAuth' => array(
                'class' => 'FePrCmdAddAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
			    ),
            'FePrCmdUpdateAuth' => array(
                'class' => 'FePrCmdUpdateAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       ),
                    'admin' => array(
                       'view' => 'Form_AuthAdmin',
                       'redirect' => 0
                       ),
                    'webuser' => array(
                       'view' => 'Form_AuthWebuser',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDeleteAuth' => array(
                'class' => 'FePrCmdDeleteAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowListAuth' => array(
                'class' => 'FePrCmdShowListAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowByIdAuth' => array(
                'class' => 'FePrCmdShowByIdAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       ),
                    'admin' => array(
                       'view' => 'Form_AuthAdmin',
                       'redirect' => 0
                       ),
                    'webuser' => array(
                       'view' => 'Form_AuthWebuser',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdCancelShowListAuth' => array(
                'class' => 'FePrCmdCancelShowListAuth',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       ),
                    'admin' => array(
                       'view' => 'Form_AuthAdmin',
                       'redirect' => 0
                       ),
                    'webuser' => array(
                       'view' => 'Form_AuthWebuser',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Auth',
                       'redirect' => 0
                       )
                    )
                ),
           'FePrCmdDefaultLanguage' => array(
                'class' => 'FePrCmdDefaultLanguage',
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Language',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FePrCmdAddLanguage' => array(
                'class' => 'FePrCmdAddLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
			    ),
            'FePrCmdUpdateLanguage' => array(
                'class' => 'FePrCmdUpdateLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDeleteLanguage' => array(
                'class' => 'FePrCmdDeleteLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowListLanguage' => array(
                'class' => 'FePrCmdShowListLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowByIdLanguage' => array(
                'class' => 'FePrCmdShowByIdLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdCancelShowListLanguage' => array(
                'class' => 'FePrCmdCancelShowListLanguage',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Language',
                       'redirect' => 0
                       )
                    )
                ),
                'FePrCmdDefaultPermisions' => 
                        array (
                      'class' => 'FePrCmdDefaultPermisions',
                      'validated' => 'true',
                      'views' => 
                          array (
                            'success' => 
                            array (
                              'view' => 'Form_Permisions',
                              'redirect' => 0,
                            ),
                            'fail' => 
                            array (
                              'view' => 'error',
                              'redirect' => 0,
                            ),
                          ),
                    ),
                'FePrCmdAddPermisions' => 
                    array (
                      'class' => 'FePrCmdAddPermisions',
                      'validated' => 'true',
                      'views' => 
                          array (
                        'success' => 
                            array (
                              'view' => 'Form_Permisions',
                              'redirect' => 0,
                            ),
                            'fail' => 
                            array (
                              'view' => 'Form_Permisions',
                              'redirect' => 0,
                            ),
                          ),
                    ),
           'FePrCmdDefaultProfiles' => 
    array (
      'class' => 'FePrCmdDefaultProfiles',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'error',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdAddProfiles' => 
    array (
      'class' => 'FePrCmdAddProfiles',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdUpdateProfiles' => 
    array (
      'class' => 'FePrCmdUpdateProfiles',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdDeleteProfiles' => 
    array (
      'class' => 'FePrCmdDeleteProfiles',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdShowListProfiles' => 
    array (
      'class' => 'FePrCmdShowListProfiles',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles_Consult',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdShowByIdProfiles' => 
    array (
      'class' => 'FePrCmdShowByIdProfiles',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
    'FePrCmdCancelShowListProfiles' => 
    array (
      'class' => 'FePrCmdCancelShowListProfiles',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Profiles',
          'redirect' => 0,
        ),
      ),
    ),
           'FePrCmdDefaultStyle' => array(
                'class' => 'FePrCmdDefaultStyle',
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Style',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FePrCmdAddStyle' => array(
                'class' => 'FePrCmdAddStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
			    ),
            'FePrCmdUpdateStyle' => array(
                'class' => 'FePrCmdUpdateStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDeleteStyle' => array(
                'class' => 'FePrCmdDeleteStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowListStyle' => array(
                'class' => 'FePrCmdShowListStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowByIdStyle' => array(
                'class' => 'FePrCmdShowByIdStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdCancelShowListStyle' => array(
                'class' => 'FePrCmdCancelShowListStyle',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Style',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdViewApp' => array(
                'class' => 'FePrCmdViewApp',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Frame',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Frame',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDefaultHead' => array(
                'class' => 'FePrCmdDefaultHead',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Head',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Head',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDefaultMenu' => array(
                'class' => 'FePrCmdDefaultMenu',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Menu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Menu',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDefaultSplash' => array(
                'class' => 'FePrCmdDefaultSplash',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Splash',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Splash',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdLogin' => array(
                'class' => 'FePrCmdLogin',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Redirect',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Login',
                       'redirect' => 0
                       ),
                    'setschema' => array(
                       'view' => 'Form_Setschema',
                       'redirect' => 0
                       )
                    )
                ),

            'FePrCmdSetschema' => array(
                'class' => 'FePrCmdSetschema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Redirect',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Login',
                       'redirect' => 0
                       ),
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
                
		    'FePrCmdExit' => 
		    array (
		      'class' => 'FePrCmdExit',
		      'validated' => 'false',
		      'views' => 
		      array (
		        'success' => 
		        array (
		          'view' => 'Form_Head',
		          'redirect' => 0,
		        ),
		        'fail' => 
		        array (
		          'view' => 'Form_Head',
		          'redirect' => 0,
		        )
		      )
		    ),
           'FePrCmdDefaultSchema' => array(
                'class' => 'FePrCmdDefaultSchema',
				'validated' => 'false',
				'desc' => 'Cargar Forma Schema',
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Schema',
                        'redirect' => 0
                        )
                      )
                ),
            'FePrCmdAddSchema' => array(
                'class' => 'FePrCmdAddSchema',
				'validated' => 'false',
				'desc' => 'Adicionar Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       )
                    )
			    ),
            'FePrCmdUpdateSchema' => array(
                'class' => 'FePrCmdUpdateSchema',
				'validated' => 'false',
				'desc' => 'Modificar Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdDeleteSchema' => array(
                'class' => 'FePrCmdDeleteSchema',
				'validated' => 'false',
				'desc' => 'Eliminar Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowListSchema' => array(
                'class' => 'FePrCmdShowListSchema',
				'validated' => 'false',
				'desc' => 'Consultar Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema_Consult',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdShowByIdSchema' => array(
                'class' => 'FePrCmdShowByIdSchema',
				'validated' => 'false',
				'desc' => 'Seleccionar Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       )
                    )
                ),
            'FePrCmdCancelShowListSchema' => array(
                'class' => 'FePrCmdCancelShowListSchema',
				'validated' => 'false',
				'desc' => 'Cancelar Seleccion Schema',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Schema',
                       'redirect' => 0
                       )
                    )
                ),
 	    ),
	'views' => array(
        'Form_Login'=> array (
            'template' => 'Form_Login.tpl'
            ),
        'Form_Frame'=> array (
            'template' => 'Form_Frame_profiles.tpl'
            ),
        'Form_Redirect' => array (
            'template' => 'Form_Redirect.tpl'
            ),
        'Form_Head' => array (
            'template' => 'Form_Head.tpl'
            ),
        'Form_Menu' => array (
            'template' => 'Form_Menu.tpl'
            ),
        'Form_Splash' => array (
            'template' => 'Form_Splash.tpl'
            ),
        'Form_Applications' => array (
            'template' => 'Form_Applications.tpl'
            ),
        'Form_Applications_Consult' => array (
            'template' => 'Form_Applications_Consult.tpl'
            ),
        'Form_Auth' => array (
            'template' => 'Form_Auth.tpl'
            ),
        'Form_AuthAdmin' => array (
            'template' => 'Form_AuthAdmin.tpl'
            ),
        'Form_AuthWebuser' => array (
            'template' => 'Form_AuthWebuser.tpl'
            ),
        'Form_Auth_Consult' => array (
            'template' => 'Form_Auth_Consult.tpl'
            ),
        'Form_Language' => array (
            'template' => 'Form_Language.tpl'
            ),
        'Form_Language_Consult' => array (
            'template' => 'Form_Language_Consult.tpl'
            ),
        'Form_Permisions' => array (
            'template' => 'Form_Permisions.tpl'
            ),
        'Form_Profiles' => array (
            'template' => 'Form_Profiles.tpl'
            ),
        'Form_Profiles_Consult' => array (
            'template' => 'Form_Profiles_Consult.tpl'
            ),
        'Form_Style' => array (
            'template' => 'Form_Style.tpl'
            ),
        'Form_Style_Consult' => array (
            'template' => 'Form_Style_Consult.tpl'
            ),
        'Form_Schema' => array (
            'template' => 'Form_Schema.tpl'
            ),
        'Form_Schema_Consult' => array (
            'template' => 'Form_Schema_Consult.tpl'
            ),
        'Form_Setschema' => array (
            'template' => 'Form_Setschema.tpl'
            ),
       )
    );

$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[PROFILES] navigation file ERROR\n");
}
die("[PROFILES] navigation file OK \n");
?>