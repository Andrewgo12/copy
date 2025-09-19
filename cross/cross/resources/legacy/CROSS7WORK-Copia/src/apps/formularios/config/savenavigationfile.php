<?php

$Navigation_config = array (
    'default_action' => 'default',
    'error_view' => 'error',
    'login_view' => 'Login',
    'commands' => array (
        'default' => array(
            'class' => 'DefaultCommand',
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
			
           'FeEnCmdDefaultEjetematico' => array(
                'class' => 'FeEnCmdDefaultEjetematico',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Ejetematico',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddEjetematico' => array(
                'class' => 'FeEnCmdAddEjetematico',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateEjetematico' => array(
                'class' => 'FeEnCmdUpdateEjetematico',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteEjetematico' => array(
                'class' => 'FeEnCmdDeleteEjetematico',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListEjetematico' => array(
                'class' => 'FeEnCmdShowListEjetematico',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdEjetematico' => array(
                'class' => 'FeEnCmdShowByIdEjetematico',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListEjetematico' => array(
                'class' => 'FeEnCmdCancelShowListEjetematico',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Ejetematico',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultFormulario' => array(
                'class' => 'FeEnCmdDefaultFormulario',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Formulario',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddFormulario' => array(
                'class' => 'FeEnCmdAddFormulario',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateFormulario' => array(
                'class' => 'FeEnCmdUpdateFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteFormulario' => array(
                'class' => 'FeEnCmdDeleteFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdActiveFormulario' => array(
                'class' => 'FeEnCmdActiveFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListFormulario' => array(
                'class' => 'FeEnCmdShowListFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdFormulario' => array(
                'class' => 'FeEnCmdShowByIdFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListFormulario' => array(
                'class' => 'FeEnCmdCancelShowListFormulario',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Formulario',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultModeloresp' => array(
                'class' => 'FeEnCmdDefaultModeloresp',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Modeloresp',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddModeloresp' => array(
                'class' => 'FeEnCmdAddModeloresp',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateModeloresp' => array(
                'class' => 'FeEnCmdUpdateModeloresp',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteModeloresp' => array(
                'class' => 'FeEnCmdDeleteModeloresp',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListModeloresp' => array(
                'class' => 'FeEnCmdShowListModeloresp',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdModeloresp' => array(
                'class' => 'FeEnCmdShowByIdModeloresp',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListModeloresp' => array(
                'class' => 'FeEnCmdCancelShowListModeloresp',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Modeloresp',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultPregformula' => array(
                'class' => 'FeEnCmdDefaultPregformula',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Pregformula',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddPregformula' => array(
                'class' => 'FeEnCmdAddPregformula',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdatePregformula' => array(
                'class' => 'FeEnCmdUpdatePregformula',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeletePregformula' => array(
                'class' => 'FeEnCmdDeletePregformula',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListPregformula' => array(
                'class' => 'FeEnCmdShowListPregformula',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdPregformula' => array(
                'class' => 'FeEnCmdShowByIdPregformula',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListPregformula' => array(
                'class' => 'FeEnCmdCancelShowListPregformula',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregformula',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultPregunta' => array(
                'class' => 'FeEnCmdDefaultPregunta',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Pregunta',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddPregunta' => array(
                'class' => 'FeEnCmdAddPregunta',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdatePregunta' => array(
                'class' => 'FeEnCmdUpdatePregunta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeletePregunta' => array(
                'class' => 'FeEnCmdDeletePregunta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListPregunta' => array(
                'class' => 'FeEnCmdShowListPregunta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdPregunta' => array(
                'class' => 'FeEnCmdShowByIdPregunta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListPregunta' => array(
                'class' => 'FeEnCmdCancelShowListPregunta',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Pregunta',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultRespuestausu' => array(
                'class' => 'FeEnCmdDefaultRespuestausu',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Respuestausu',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddRespuestausu' => array(
                'class' => 'FeEnCmdAddRespuestausu',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateRespuestausu' => array(
                'class' => 'FeEnCmdUpdateRespuestausu',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteRespuestausu' => array(
                'class' => 'FeEnCmdDeleteRespuestausu',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListRespuestausu' => array(
                'class' => 'FeEnCmdShowListRespuestausu',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdRespuestausu' => array(
                'class' => 'FeEnCmdShowByIdRespuestausu',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListRespuestausu' => array(
                'class' => 'FeEnCmdCancelShowListRespuestausu',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Respuestausu',
                       'redirect' => 0
                       )
                    )
                ),
           'FeEnCmdDefaultTema' => array(
                'class' => 'FeEnCmdDefaultTema',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tema',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddTema' => array(
                'class' => 'FeEnCmdAddTema',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateTema' => array(
                'class' => 'FeEnCmdUpdateTema',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteTema' => array(
                'class' => 'FeEnCmdDeleteTema',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListTema' => array(
                'class' => 'FeEnCmdShowListTema',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdTema' => array(
                'class' => 'FeEnCmdShowByIdTema',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListTema' => array(
                'class' => 'FeEnCmdCancelShowListTema',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tema',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDefaultFichas' => array(
                'class' => 'FeEnCmdDefaultFichas',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Fichas',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Fichas',
                       'redirect' => 0
                       )
                    )
                ),
    		'FeEnCmdDefaultHeadFicha' => array (
				'class' => 'FeenCmdDefaultHeadFicha',
				'views' => array (
			        'success' => array (
						'view' => 'Form_HeadFicha',
          				'redirect' => 0,
        				),
			        'fail' => array (
          				'view' => 'Form_HeadFicha',
          				'redirect' => 0,
        				)
      			)
    		),
				'FeEnCmdDefaultHeadRepoTiemposEjec' => array(
							'class' => 'FeEnCmdDefaultHeadRepoTiemposEjec',
							'validated' => 'false',
							'views' => array (
								'success' => array(
								'view' => 'Form_HeadRepoTiemposEjec',
								'redirect' => 0
								),
								'fail' => array(
								'view' => 'Form_HeadRepoTiemposEjec',
								'redirect' => 0
								)
							)
					),
                'FeEnCmdDefaultReport' => array(
                'class' => 'FeEnCmdDefaultReport',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Report',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Report',
                       'redirect' => 0
                       )
                    )
                ),
                'FeEnCmdViewReport' => array(
                'class' => 'FeEnCmdViewReport',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_ViewReport',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_ViewReport',
                       'redirect' => 0
                       )
                    )
                ),

		'FeEnCmdDefaultEncuestaWeb' => 
    			array (
      				'class' => 'FeEnCmdDefaultEncuestaWeb',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_EncuestaWeb','redirect' => 0,),
        						'fail' =>array ('view' => 'Form_EncuestaWeb','redirect' => 0,),
      				),
    			),
    	'FeEnCmdDefaultEncuesta' => 
    			array (
      				'class' => 'FeEnCmdDefaultEncuesta',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_Encuesta','redirect' => 0,),
        						'fail' =>array ('view' => 'Form_Encuesta','redirect' => 0,),
      				),
    			),
    	'FeEnCmdDefaultConfigEncuesta' => array(
                'class' => 'FeEnCmdDefaultConfigEncuesta',
                'validated' => 'true',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_ConfigEncuesta',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_ConfigEncuesta',
                       'redirect' => 0
                       )
                    )
                ),
        'FeEnCmdloadRespuestas' => 
    		array (
      			'class' => 'FeEnCmdloadRespuestas',
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
    	'FeEnCmddrawRespuestas' => 
    		array (
      			'class' => 'FeEnCmddrawRespuestas',
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
    	'FeEnCmdAddAnswers' => 
    		array (
      			'class' => 'FeEnCmdAddAnswers',
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
    	'FeEnCmdDeleteAnswers' => 
    		array (
      			'class' => 'FeEnCmdDeleteAnswers',
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
    	'FeEnCmdloadFormulario' => 
    		array (
      			'class' => 'FeEnCmdloadFormulario',
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
    	'FeEnCmdSaveConfig' => 
    		array (
      			'class' => 'FeEnCmdSaveConfig',
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
    	'FeEnCmdShowFormulario' => 
    		array (
      			'class' => 'FeEnCmdShowFormulario',
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
    	'FeEnCmdDrawFormulario'=> 
    		array (
      			'class' => 'FeEnCmdDrawFormulario',
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
    	'FeEnCmdSaveEncuesta'=> 
    		array (
      			'class' => 'FeEnCmdSaveEncuesta',
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
    	'FeEnCmdDefaultOpcionrepues' => array(
                'class' => 'FeEnCmdDefaultOpcionrepues',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Opcionrepues',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeEnCmdAddOpcionrepues' => array(
                'class' => 'FeEnCmdAddOpcionrepues',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeEnCmdUpdateOpcionrepues' => array(
                'class' => 'FeEnCmdUpdateOpcionrepues',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdDeleteOpcionrepues' => array(
                'class' => 'FeEnCmdDeleteOpcionrepues',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowListOpcionrepues' => array(
                'class' => 'FeEnCmdShowListOpcionrepues',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdShowByIdOpcionrepues' => array(
                'class' => 'FeEnCmdShowByIdOpcionrepues',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
                ),
            'FeEnCmdCancelShowListOpcionrepues' => array(
                'class' => 'FeEnCmdCancelShowListOpcionrepues',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Opcionrepues',
                       'redirect' => 0
                       )
                    )
                ),
    	'FeEnCmdUpdateAnswers' => 
    		array (
      			'class' => 'FeEnCmdUpdateAnswers',
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
    	'FeEnCmdDefaultAutoreference' => 
		    array (
		      'class' => 'FeEnCmdDefaultAutoreference',
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
		    'FeEnCmdShowOpenAnswers' => array(
                'class' => 'FeEnCmdShowOpenAnswers',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_ShowOpenAnswers',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
                'FeEnCmdDefaultIndicador' => array(
                'class' => 'FeEnCmdDefaultIndicador',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Indicador',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Indicador',
                       'redirect' => 0
                       )
                    )
                ),
                'FeEnCmdViewIndicador' => array(
                'class' => 'FeEnCmdViewIndicador',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_ViewIndicador',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_ViewIndicador',
                       'redirect' => 0
                       )
                    )
                ),
 	    ),
	'views' => array(
		'Form_EncuestaWeb'=> array (
            'template' => 'Form_EncuestaWeb.tpl'
            ),
        'Form_Menu'=> array (
            'template' => 'Form_Menu.tpl'
            ),
        'Form_Ejetematico' => array (
            'template' => 'Form_Ejetematico.tpl'
            ),
        'Form_Ejetematico_Consult' => array (
            'template' => 'Form_Ejetematico_Consult.tpl'
            ),
        'Form_Formulario' => array (
            'template' => 'Form_Formulario.tpl'
            ),
        'Form_Formulario_Consult' => array (
            'template' => 'Form_Formulario_Consult.tpl'
            ),
        'Form_Modeloresp' => array (
            'template' => 'Form_Modeloresp.tpl'
            ),
        'Form_Modeloresp_Consult' => array (
            'template' => 'Form_Modeloresp_Consult.tpl'
            ),
        'Form_Pregformula' => array (
            'template' => 'Form_Pregformula.tpl'
            ),
        'Form_Pregformula_Consult' => array (
            'template' => 'Form_Pregformula_Consult.tpl'
            ),
        'Form_Pregunta' => array (
            'template' => 'Form_Pregunta.tpl'
            ),
        'Form_Pregunta_Consult' => array (
            'template' => 'Form_Pregunta_Consult.tpl'
            ),
        'Form_Respuestausu' => array (
            'template' => 'Form_Respuestausu.tpl'
            ),
        'Form_Respuestausu_Consult' => array (
            'template' => 'Form_Respuestausu_Consult.tpl'
            ),
        'Form_Tema' => array (
            'template' => 'Form_Tema.tpl'
            ),
        'Form_Tema_Consult' => array (
            'template' => 'Form_Tema_Consult.tpl'
            ),
        'Form_Fichas' => array (
            'template' => 'Form_Fichas.tpl'
            ),
	    'Form_HeadFicha' => array (
      		'template' => 'Form_HeadFicha.tpl',
    		),
	    'Form_HeadRepoTiemposEjec' => array (
      		'template' => 'Form_HeadRepoTiemposEjec.tpl',
    		),
    	'Form_Report' => array (
      		'template' => 'Form_Report.tpl',
    		),
    	'Form_ViewReport' => array (
      		'template' => 'Form_ViewReport.tpl',
    		),
    	'Form_Encuesta'=> array (
            'template' => 'Form_Encuesta.tpl'
            ),
        'Form_ConfigEncuesta'=> array (
            'template' => 'Form_ConfigEncuesta.tpl'
            ),
        'Form_Opcionrepues'=> array (
            'template' => 'Form_Opcionrepues.tpl'
            ),
        'Form_Opcionrepues_Consult'=> array (
            'template' => 'Form_Opcionrepues_Consult.tpl'
            ),
        'Form_ShowOpenAnswers'=> array (
            'template' => 'Form_ShowOpenAnswers.tpl'
            ),
        'Form_Indicador'=> array (
            'template' => 'Form_Indicador.tpl'
            ),
        'Form_ViewIndicador' => array (
      		'template' => 'Form_ViewIndicador.tpl',
    		),  	
        )
    );

$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[ENCUESTAS] navigation file ERROR\n");
}
die("[ENCUESTAS] navigation file OK \n");
?>
