<?php
#!/bin/sh

$Navigation_config = array (
    'default_action' => 'FeGedefault',
    'error_view' => 'error',
    'login_view' => 'Login',
    'commands' => array (
        'FeGedefault' => array(
            'class' => 'FeGeDefaultCommand',
            'validated' => 'false',
            'views' => array (
                'success' => array(
					'view' => 'Form_Frame',
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
			
		'FeGeCmdDefaultHead' => 
    	array (
      	'class' => 'FeGeCmdDefaultHead',
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
        ),
      ),
    ),
    'FeGeCmdExit' => 
    array (
      'class' => 'FeGeCmdExit',
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
    'FeGeCmdDefaultMenu' => 
    array (
      'class' => 'FeGeCmdDefaultMenu',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Menu',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Menu',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdDefaultSplash' => 
    array (
      'class' => 'FeGeCmdDefaultSplash',
      'validated' => 'false',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Splash',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Splash',
          'redirect' => 0,
        ),
      ),
    ),
           'FeGeCmdDefaultParametros' => array(
                'class' => 'FeGeCmdDefaultParametros',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Parametros',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdUpdateParametros' => array(
                'class' => 'FeGeCmdUpdateParametros',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Parametros',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Parametros',
                       'redirect' => 0
                       )
                    )
			    ),
           'FeGeCmdDefaultPermisosEntes' => array(
                'class' => 'FeGeCmdDefaultPermisosEntes',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_PermisosEntes',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_PermisosEntes',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdUpdatePermisosEntes' => array(
                'class' => 'FeGeCmdUpdatePermisosEntes',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_PermisosEntes',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_PermisosEntes',
                       'redirect' => 0
                       )
                    )
			    ),
           'FeGeCmdDefaultActiviPares' => array(
                'class' => 'FeGeCmdDefaultActiviPares',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_ActiviPares',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_ActiviPares',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdUpdateActiviPares' => array(
                'class' => 'FeGeCmdUpdateActiviPares',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_ActiviPares',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_ActiviPares',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdDeleteActiviPares' => array(
                'class' => 'FeGeCmdDeleteActiviPares',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_ActiviPares',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_ActiviPares',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdDeletePermisosEntes' => array(
                'class' => 'FeGeCmdDeletePermisosEntes',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_PermisosEntes',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_PermisosEntes',
                       'redirect' => 0
                       )
                    )
			    ),
           'FeGeCmdDefaultLocalizacion' => array(
                'class' => 'FeGeCmdDefaultLocalizacion',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Localizacion',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddLocalizacion' => array(
                'class' => 'FeGeCmdAddLocalizacion',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateLocalizacion' => array(
                'class' => 'FeGeCmdUpdateLocalizacion',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteLocalizacion' => array(
                'class' => 'FeGeCmdDeleteLocalizacion',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListLocalizacion' => array(
                'class' => 'FeGeCmdShowListLocalizacion',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdLocalizacion' => array(
                'class' => 'FeGeCmdShowByIdLocalizacion',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListLocalizacion' => array(
                'class' => 'FeGeCmdCancelShowListLocalizacion',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Localizacion',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdDefaultTipolocaliza' => array(
                'class' => 'FeGeCmdDefaultTipolocaliza',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tipolocaliza',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddTipolocaliza' => array(
                'class' => 'FeGeCmdAddTipolocaliza',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateTipolocaliza' => array(
                'class' => 'FeGeCmdUpdateTipolocaliza',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteTipolocaliza' => array(
                'class' => 'FeGeCmdDeleteTipolocaliza',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListTipolocaliza' => array(
                'class' => 'FeGeCmdShowListTipolocaliza',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdTipolocaliza' => array(
                'class' => 'FeGeCmdShowByIdTipolocaliza',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListTipolocaliza' => array(
                'class' => 'FeGeCmdCancelShowListTipolocaliza',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipolocaliza',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDefaultTipoarchivo' => array(
                'class' => 'FeGeCmdDefaultTipoarchivo',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tipoarchivo',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddTipoarchivo' => array(
                'class' => 'FeGeCmdAddTipoarchivo',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateTipoarchivo' => array(
                'class' => 'FeGeCmdUpdateTipoarchivo',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteTipoarchivo' => array(
                'class' => 'FeGeCmdDeleteTipoarchivo',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListTipoarchivo' => array(
                'class' => 'FeGeCmdShowListTipoarchivo',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdTipoarchivo' => array(
                'class' => 'FeGeCmdShowByIdTipoarchivo',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListTipoarchivo' => array(
                'class' => 'FeGeCmdCancelShowListTipoarchivo',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipoarchivo',
                       'redirect' => 0
                       )
                    )
                ),    
            'FeGeCmdDefaultFormattofile' => array(
                'class' => 'FeGeCmdDefaultFormattofile',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Formattofile',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddFormattofile' => array(
                'class' => 'FeGeCmdAddFormattofile',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formattofile',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formattofile',
                       'redirect' => 0
                       )
                    )
			    ),
			'FeGeCmdDefaultConfigarchiv' => array(
                'class' => 'FeGeCmdDefaultConfigarchiv',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Configarchiv',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddConfigarchiv' => array(
                'class' => 'FeGeCmdAddConfigarchiv',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       )
                    )
			    ),
			'FeGeCmdAddConfigarchivFinal' => array(
                'class' => 'FeGeCmdAddConfigarchivFinal',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configarchiv',	
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       )
                    )
			    ),    
            'FeGeCmdDeleteConfigarchiv' => array(
                'class' => 'FeGeCmdDeleteConfigarchiv',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListConfigarchiv' => array(
                'class' => 'FeGeCmdShowListConfigarchiv',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configarchiv_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdConfigarchiv' => array(
                'class' => 'FeGeCmdShowByIdConfigarchiv',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListConfigarchiv' => array(
                'class' => 'FeGeCmdCancelShowListConfigarchiv',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configarchiv',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdDefaultDetaconfarch' => array(
                'class' => 'FeGeCmdDefaultDetaconfarch',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Detaconfarch',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddDetaconfarch' => array(
                'class' => 'FeGeCmdAddDetaconfarch',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateDetaconfarch' => array(
                'class' => 'FeGeCmdUpdateDetaconfarch',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteDetaconfarch' => array(
                'class' => 'FeGeCmdDeleteDetaconfarch',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Detaconfarch',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDefaultCentroEmail' => array(
                'class' => 'FeGeCmdDefaultCentroEmail',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCentroEmailTools' => array(
                'class' => 'FeGeCmdCentroEmailTools',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailTools',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailTools',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailConsult' => array(
                'class' => 'FeGeCmdCentroEmailConsult',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailConsult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailConsult',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailList' => array(
                'class' => 'FeGeCmdCentroEmailList',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailPreview' => array(
                'class' => 'FeGeCmdCentroEmailPreview',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailPreview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailPreview',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailSend' => array(
                'class' => 'FeGeCmdCentroEmailSend',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailDelete' => array(
                'class' => 'FeGeCmdCentroEmailDelete',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       )
                    )
                ),
           'FeGeCmdCentroEmailGenerate' => array(
                'class' => 'FeGeCmdCentroEmailGenerate',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailList',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCentroEmailCreate' => array(
                'class' => 'FeGeCmdCentroEmailCreate',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailCreate',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailCreate',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdSendEmail' => array(
                'class' => 'FeGeCmdSendEmail',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroEmailCreate',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroEmailCreate',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDefaultFormatocarta' => array(
                'class' => 'FeGeCmdDefaultFormatocarta',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Formatocarta',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddFormatocarta' => array(
                'class' => 'FeGeCmdAddFormatocarta',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateFormatocarta' => array(
                'class' => 'FeGeCmdUpdateFormatocarta',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteFormatocarta' => array(
                'class' => 'FeGeCmdDeleteFormatocarta',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListFormatocarta' => array(
                'class' => 'FeGeCmdShowListFormatocarta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdFormatocarta' => array(
                'class' => 'FeGeCmdShowByIdFormatocarta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListFormatocarta' => array(
                'class' => 'FeGeCmdCancelShowListFormatocarta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatocarta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDefaultFormatoemail' => array(
                'class' => 'FeGeCmdDefaultFormatoemail',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Formatoemail',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddFormatoemail' => array(
                'class' => 'FeGeCmdAddFormatoemail',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdUpdateFormatoemail' => array(
                'class' => 'FeGeCmdUpdateFormatoemail',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDeleteFormatoemail' => array(
                'class' => 'FeGeCmdDeleteFormatoemail',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListFormatoemail' => array(
                'class' => 'FeGeCmdShowListFormatoemail',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdFormatoemail' => array(
                'class' => 'FeGeCmdShowByIdFormatoemail',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListFormatoemail' => array(
                'class' => 'FeGeCmdCancelShowListFormatoemail',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formatoemail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdDefaultCentroComunicacion' => array(
                'class' => 'FeGeCmdDefaultCentroComunicacion',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroComunicacionConsult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroComunicacionConsult',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCentroComunicacionPreview' => array(
                'class' => 'FeGeCmdCentroComunicacionPreview',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroComunicacionPreview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroComunicacionPreview',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCentroComunicacionDownload' => array(
                'class' => 'FeGeCmdCentroComunicacionDownload',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroComunicacionOpen',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroComunicacionOpen',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCentroComunicacionCreate' => array(
                'class' => 'FeGeCmdCentroComunicacionCreate',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroComunicacionCreate',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroComunicacionCreate',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdAddComunicacion' => array(
                'class' => 'FeGeCmdAddComunicacion',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CentroComunicacionCreate',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CentroComunicacionCreate',
                       'redirect' => 0
                       )
                    )
			    ),                                                                               
            'FeGeCmdDefaultDiasInhabiles' => array(
                'class' => 'FeGeCmdDefaultDiasInhabiles',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_DiasInhabiles',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_DiasInhabiles',
                       'redirect' => 0
                       )
                    )
			    ),                                                                               
            'FeGeCmdAddDiasInhabiles' => array(
                'class' => 'FeGeCmdAddDiasInhabiles',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_DiasInhabiles',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_DiasInhabiles',
                       'redirect' => 0
                       )
                    )
			    ),                                                                               
            'FeGeCmdDefaultAuth' => array(
                'class' => 'FeGeCmdDefaultAuth',
                'validated' => 'true',
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
            'FeGeCmdAddAuth' => array(
                'class' => 'FeGeCmdAddAuth',
                'validated' => 'true',
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
            'FeGeCmdUpdateAuth' => array(
                'class' => 'FeGeCmdUpdateAuth',
                'validated' => 'true',
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
            'FeGeCmdUpdatePassAuth' => array(
                'class' => 'FeGeCmdUpdatePassAuth',
                'validated' => 'true',
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
            'FeGeCmdDeleteAuth' => array(
                'class' => 'FeGeCmdDeleteAuth',
                'validated' => 'true',
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
            'FeGeCmdShowListAuth' => array(
                'class' => 'FeGeCmdShowListAuth',
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
            'FeGeCmdShowByIdAuth' => array(
                'class' => 'FeGeCmdShowByIdAuth',
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
            'FeGeCmdCancelShowListAuth' => array(
                'class' => 'FeGeCmdCancelShowListAuth',
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
            'FeGeCmdDefaultConfigformat' => array(
                'class' => 'FeGeCmdDefaultConfigformat',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Configformat',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdUpdateConfigformat' => array(
                'class' => 'FeGeCmdUpdateConfigformat',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Configformat',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Configformat',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdLstHelp' => 
    			array (
      				'class' => 'FeGeCmdLstHelp',
      				'views' => 
      			array (
        			'success' => 
        		array (
          			'view' => 'Form_LstHelp',
          			'redirect' => 0,
        		),
        		'fail' => 
        		array (
          			'view' => 'Form_LstHelp',
          			'redirect' => 0,
        	),
      	),
    ),
    'FeGeCmdTreeHelp' => 
    array (
      'class' => 'FeGeCmdTreeHelp',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_TreeHelp',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_TreeHelp',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdDefaultDatabases' => 
    array (
      'class' => 'FeGeCmdDefaultDatabases',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Databases',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Databases',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdBackup' => 
    array (
      'class' => 'FeGeCmdBackup',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Vacio',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Vacio',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdMaintenance' => 
    array (
      'class' => 'FeGeCmdMaintenance',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Databases',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Databases',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdCreatetext' => array(
       'class' => 'FeGeCmdCreatetext',
          'validated' => 'false',
           'views' => array (
             'success' => array(
               'view' => 'Form_CentroComunicacionCreate',
               'redirect' => 0
             ),
             'fail' => array(    
                'view' => 'Form_CentroComunicacionCreate',
               'redirect' => 0
            )
        )
	),
	'FeGeCmdPutHead' => array(
       'class' => 'FeGeCmdPutHead',
       'validated' => 'false',
            	'views' => array (
           	'success' => array(
                'view' => 'Form_PutHead',
            	'redirect' => 0
            ),
            'fail' => array(
                'view' => 'Form_PutHead',
            	'redirect' => 0
        	)
    	)
	),
	'FeGeCmdGetFormatocarta' => array(
        'class' => 'FeGeCmdGetFormatocarta',
        'validated' => 'false',
        'views' => array (
            'success' => array(
                'view' => 'Form_Formatocarta',
            	'redirect' => 0
            ),
            'fail' => array(
                'view' => 'Form_Formatocarta',
            	'redirect' => 0
        	)
    	)
	),
	
	'FeGeCmdDefaultPermisosPersonal' => array(
                'class' => 'FeGeCmdDefaultPermisosPersonal',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_PermisosPersonal',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_PermisosPersonal',
                        'redirect' => 0
                        )
                    )
                ),
     'FeGeCmdUpdatePermisosPersonal' => array(
                'class' => 'FeGeCmdUpdatePermisosPersonal',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_PermisosPersonal',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_PermisosPersonal',
                        'redirect' => 0
                        )
                    )
                ),
     
     'FeGeCmdDeletePermisosPersonal' => array(
                'class' => 'FeGeCmdDeletePermisosPersonal',
               'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_PermisosPersonal',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_PermisosPersonal',
                       'redirect' => 0
                       )
                    )
			    ),
	  'FeGeCmdCentroComunicacionConsult'=> 
    		array (
      			'class' => 'FeGeCmdCentroComunicacionConsult',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
       'FeGeCmdCentroComunicacionDelete'=> 
    		array (
      			'class' => 'FeGeCmdCentroComunicacionDelete',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdCentroComunicacionGenerate'=> 
    		array (
      			'class' => 'FeGeCmdCentroComunicacionGenerate',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdDefaultNuevaDescripcion' => array(
                'class' => 'FeGeCmdDefaultNuevaDescripcion',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_NuevaDescripcion',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_NuevaDescripcion',
                       'redirect' => 0
                       )
                    )
                ),
        'FeGeCmdloadTabla'=> 
    		array (
      			'class' => 'FeGeCmdloadTabla',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdDrawListTablastipole'=> 
    		array (
      			'class' => 'FeGeCmdDrawListTablastipole',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdSaveListTablastipole'=> 
    		array (
      			'class' => 'FeGeCmdSaveListTablastipole',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdDeleteListTablastipole'=> 
    		array (
      			'class' => 'FeGeCmdDeleteListTablastipole',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    		
    		
    	'FeGeCmdDefaultDatosAdicionalesWeb'=> 
    		array (
      			'class' => 'FeGeCmdDefaultDatosAdicionalesWeb',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
      				),
    		),	
    	'FeGeCmdAddDatosAdicionalesWeb'=> 
    		array (
      			'class' => 'FeGeCmdAddDatosAdicionalesWeb',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
      				),
    		),	 
    	'FeGeCmdDeleteDetalledimens'=> 
    		array (
      			'class' => 'FeGeCmdDeleteDetalledimens',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => 'Form_DatosAdicionales',
          					'redirect' => 0,
        				),
      				),
    		),	                
    'FeGeCmdDefaultRelacionTarea_Persona' => 
    array (
      'class' => 'FeGeCmdDefaultRelacionTarea_Persona',
      'validated' => 'true',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_RelacionTarea_Persona',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_RelacionTarea_Persona',
          'redirect' => 0,
        ),
      ),
    ),
    'FeGeCmdloadTareas' => 
    		array (
      			'class' => 'FeGeCmdloadTareas',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
     'FeGeCmdAddEnte' => 
    		array (
      			'class' => 'FeGeCmdAddEnte',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdDeleteEnte' => 
    		array (
      			'class' => 'FeGeCmdDeleteEnte',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdSaveRelacion' => 
    		array (
      			'class' => 'FeGeCmdSaveRelacion',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdDrawRelacion' => 
    		array (
      			'class' => 'FeGeCmdDrawRelacion',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdDeleteRelacion' => 
    		array (
      			'class' => 'FeGeCmdDeleteRelacion',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdLoadReadme' => 
    		array (
      			'class' => 'FeGeCmdLoadReadme',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => 'Form_Readme',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => 'Form_Readme',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdDefaultEquivalencias' => array(
                'class' => 'FeGeCmdDefaultEquivalencias',
                'validated' => 'true', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Equivalencias',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeGeCmdAddEquivalencias' => array(
                'class' => 'FeGeCmdAddEquivalencias',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
			    ),
			'FeGeCmdUpdateEquivalencias' => array(
                'class' => 'FeGeCmdUpdateEquivalencias',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeGeCmdDeleteEquivalencias' => array(
                'class' => 'FeGeCmdDeleteEquivalencias',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowListEquivalencias' => array(
                'class' => 'FeGeCmdShowListEquivalencias',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdShowByIdEquivalencias' => array(
                'class' => 'FeGeCmdShowByIdEquivalencias',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
                ),
            'FeGeCmdCancelShowListEquivalencias' => array(
                'class' => 'FeGeCmdCancelShowListEquivalencias',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Equivalencias',
                       'redirect' => 0
                       )
                    )
                ), 
           'FeGeCmdDefaultIntegralog' => array(
                'class' => 'FeGeCmdDefaultIntegralog',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Integralog',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_Integralog',
                        'redirect' => 0
                        )
                    )
                ),
       'FeGeCmdloadIntegraLog' => 
    		array (
      			'class' => 'FeGeCmdloadIntegraLog',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
     'FeGeCmdSendIntegraLog'  => 
    		array (
      			'class' => 'FeGeCmdSendIntegraLog',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdloadEquivField'  => 
    		array (
      			'class' => 'FeGeCmdloadEquivField',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdDefaultIntelogdoc' => array(
                'class' => 'FeGeCmdDefaultIntelogdoc',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Intelogdoc',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_Intelogdoc',
                        'redirect' => 0
                        )
                    )
                ),
    'FeGeCmdUpdateIntelogdoc'  => 
    		array (
      			'class' => 'FeGeCmdUpdateIntelogdoc',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    'FeGeCmdLoadExcel' => 
		    array (
		      'class' => 'FeGeCmdLoadExcel',
		      'validated' => 'false',
		      'views' => 
		      array (
		        'success' => 
		        array (
		          'view' => '',
		          'redirect' => 0,
		        ),
		        'fail' => 
		        array (
		          'view' => '',
		          'redirect' => 0,
		        )
		      )
		    ),
    'FeGeCmdDefaultTransferDependencies' => array(
                'class' => 'FeGeCmdDefaultTransferDependencies',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_TransferDependencies',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_TransferDependencies',
                       'redirect' => 0
                       )
                    )
                ),
        'FeGeCmdAddTransferdependencies' => array(
                'class' => 'FeGeCmdAddTransferdependencies',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_TransferDependencies',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_TransferDependencies',
                       'redirect' => 0
                       )
                    )
                ),
          'FeGeCmdGetValues' => 
    		array (
      			'class' => 'FeGeCmdGetValues',
      			'validated' => 'false',
      			'views' => 
      				array (
        			'success' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
        			'fail' => 
        				array (
          					'view' => '',
          					'redirect' => 0,
        				),
      				),
    		),
    	'FeGeCmdTreeHelpEsp' => 
		    array (
		      'class' => 'FeGeCmdTreeHelpEsp',
		      'views' => 
		      array (
		        'success' => 
		        array (
		          'view' => 'Form_TreeHelpEsp',
		          'redirect' => 0,
		        ),
		        'fail' => 
		        array (
		          'view' => 'Form_TreeHelpEsp',
		          'redirect' => 0,
		        ),
		      ),
		    ),
  ),
	'views' => array(
		'Form_Frame' => 
    	array (
      	'template' => 'Form_Frame_cross.tpl',
    	),
    	'Form_Head' => 
    		array (
      		'template' => 'Form_Head.tpl',
    	),
    	'Form_Splash' => 
    		array (
      		'template' => 'Form_Splash.tpl',
    	),
        'Form_Menu'=> array (
            'template' => 'Form_Menu.tpl'
            ),
        'Form_Localizacion' => array (
            'template' => 'Form_Localizacion.tpl'
            ),
        'Form_Localizacion_Consult' => array (
            'template' => 'Form_Localizacion_Consult.tpl'
            ),
        'Form_Tipolocaliza' => array (
            'template' => 'Form_Tipolocaliza.tpl'
            ),
        'Form_Tipolocaliza_Consult' => array (
            'template' => 'Form_Tipolocaliza_Consult.tpl'
            ),
        'Form_Formattofile' =>array (
      		'template' => 'Form_Formattofile.tpl',
    		),
    	'Form_Tipoarchivo' => array (
            'template' => 'Form_Tipoarchivo.tpl'
            ),
        'Form_Tipoarchivo_Consult' => array (
            'template' => 'Form_Tipoarchivo_Consult.tpl'
            ),
        'Form_Configarchiv' => array (
            'template' => 'Form_Configarchiv.tpl'
            ),
        'Form_Configarchiv_Consult' => array (
            'template' => 'Form_Configarchiv_Consult.tpl'
            ),
        'Form_Detaconfarch' => array (
            'template' => 'Form_Detaconfarch.tpl'
            ),
        'Form_CentroEmail' => array (
            'template' => 'Form_CentroEmail.tpl'
            ),
        'Form_CentroEmailTools' => array (
            'template' => 'Form_CentroEmailTools.tpl'
            ),
        'Form_CentroEmailConsult' => array (
            'template' => 'Form_CentroEmailConsult.tpl'
            ),
        'Form_CentroEmailList' => array (
            'template' => 'Form_CentroEmailList.tpl'
            ),
        'Form_CentroEmailPreview' => array (
            'template' => 'Form_CentroEmailPreview.tpl'
            ),
        'Form_CentroEmailCreate' => array (
            'template' => 'Form_CentroEmailCreate.tpl'
            ),
        'Form_Formatocarta' => array (
            'template' => 'Form_Formatocarta.tpl'
            ),
        'Form_Formatocarta_Consult' => array (
            'template' => 'Form_Formatocarta_Consult.tpl'
            ),
        'Form_Formatoemail' => array (
            'template' => 'Form_Formatoemail.tpl'
            ),
        'Form_Formatoemail_Consult' => array (
            'template' => 'Form_Formatoemail_Consult.tpl'
            ),
        'Form_CentroComunicacionConsult' => array (
            'template' => 'Form_CentroComunicacionConsult.tpl'
            ),
        'Form_CentroComunicacionPreview' => array (
            'template' => 'Form_CentroComunicacionPreview.tpl'
            ),
        'Form_CentroComunicacionCreate' => array (
            'template' => 'Form_CentroComunicacionCreate.tpl'
            ),                                            
        'Form_DiasInhabiles' => array (
            'template' => 'Form_DiasInhabiles.tpl'
            ),                                            
        'Form_Auth' => array (
            'template' => 'Form_Auth.tpl'
            ),
        'Form_Auth_Consult' => array (
            'template' => 'Form_Auth_Consult.tpl'
            ),
        'Form_Configformat' => array (
            'template' => 'Form_Configformat.tpl'
            ),
        'Form_LstHelp' => array (
		      'template' => 'Form_LstHelp.tpl',
		    ),
		'Form_CentroComunicacionOpen' => array (
            'template' => 'Form_CentroComunicacionOpen.tpl',
        ),
        'Form_Databases' => array (
            'template' => 'Form_Databases.tpl',
        ),
        'Form_TreeHelp' => array (
            'template' => 'Form_TreeHelp.tpl',
        ),
        'Form_Vacio' => array (
            'template' => 'Form_Vacio.tpl',
        ),
        'Form_Parametros' => array (
            'template' => 'Form_Parametros.tpl',
        ),
        'Form_PermisosEntes' => array (
            'template' => 'Form_PermisosEntes.tpl',
        ),
        'Form_PutHead' => array (
            'template' => 'Form_PutHead.tpl',
        ),
        'Form_ActiviPares' => array (
            'template' => 'Form_ActiviPares.tpl',
        ),
        'Form_PermisosPersonal' => array (
            'template' => 'Form_PermisosPersonal.tpl',
        ),
        'Form_NuevaDescripcion' => array (
            'template' => 'Form_NuevaDescripcion.tpl',
        ),
        'Form_DatosAdicionales' => array (
            'template' => 'Form_DatosAdicionales.tpl',
        ),
        'Form_RelacionTarea_Persona' => array (
            'template' => 'Form_RelacionTarea_Persona.tpl',
        ),
        'Form_Readme' => array (
            'template' => 'Form_Readme.tpl',
        ),
        'Form_Equivalencias' => array (
            'template' => 'Form_Equivalencias.tpl',
        ),
        'Form_Equivalencias_Consult' => array (
            'template' => 'Form_Equivalencias_Consult.tpl',
        ),
        'Form_Integralog' => array (
            'template' => 'Form_Integralog.tpl',
        ),
        'Form_Intelogdoc' => array (
            'template' => 'Form_Intelogdoc.tpl',
        ),
        'Form_TransferDependencies' => array (
			'template' => 'Form_TransferDependencies.tpl',
	    	),
	    'Form_TreeHelpEsp' => array (
            'template' => 'Form_TreeHelpEsp.tpl',
        ),
  )
);

$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[GENERAL] navigation file ERROR\n");
}
die("[GENERAL] navigation file OK\n");
?>
