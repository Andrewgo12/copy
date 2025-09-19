
<html>
<head>
       <title>Save Navigation Configuration File</title>
</head>
<body>
<h2>Save Navigation Configuration File</h2>
<hr>
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
           'FeScCmdDefaultCategoria' => array(
                'class' => 'FeScCmdDefaultCategoria',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Categoria',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeScCmdAddCategoria' => array(
                'class' => 'FeScCmdAddCategoria',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeScCmdUpdateCategoria' => array(
                'class' => 'FeScCmdUpdateCategoria',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDeleteCategoria' => array(
                'class' => 'FeScCmdDeleteCategoria',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdShowListCategoria' => array(
                'class' => 'FeScCmdShowListCategoria',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdShowByIdCategoria' => array(
                'class' => 'FeScCmdShowByIdCategoria',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdCancelShowListCategoria' => array(
                'class' => 'FeScCmdCancelShowListCategoria',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Categoria',
                       'redirect' => 0
                       )
                    )
                ),
           'FeScCmdDefaultEntrada' => array(
                'class' => 'FeScCmdDefaultEntrada',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Entrada',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
           'FeScCmdDefaultFichaEvento' => array(
                'class' => 'FeScCmdDefaultFichaEvento',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_FichaEvento',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
           'FeScCmdDefaultFichaEventoSP' => array(
                'class' => 'FeScCmdDefaultFichaEvento',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_FichaEventoSP',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
           'FeScCmdShowListSchedule' => array(
                'class' => 'FeScCmdShowListSchedule',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_ShowListSchedule',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'Form_ShowListSchedule',
                        'redirect' => 0
                        )
                    )
                ),
           'FeScCmdDefaultEntradaAudiencia' => array(
                'class' => 'FeScCmdDefaultEntradaAudiencia',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_EntradaAudiencia',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeScCmdAddEntrada' => array(
                'class' => 'FeScCmdAddEntrada',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeScCmdAddEntradaAudiencia' => array(
                'class' => 'FeScCmdAddEntradaAudiencia',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_EntradaAudiencia',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeScCmdUpdateEntradaAudiencia' => array(
                'class' => 'FeScCmdUpdateEntradaAudiencia',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_EntradaAudiencia',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeScCmdUpdateEntrada' => array(
                'class' => 'FeScCmdUpdateEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdCancelEntrada' => array(
                'class' => 'FeScCmdCancelEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdCancelEntradaAud' => array(
                'class' => 'FeScCmdCancelEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdActiveEntrada' => array(
                'class' => 'FeScCmdActiveEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdActiveEntradaAud' => array(
                'class' => 'FeScCmdActiveEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDeleteEntrada' => array(
                'class' => 'FeScCmdDeleteEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDeleteEntradaWeb' => array(
                'class' => 'FeScCmdDeleteEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_CitasWebConsult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_CitasWebConsult',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDeleteEntradaAud' => array(
                'class' => 'FeScCmdDeleteEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_JudgeSchedule',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdShowListEntrada' => array(
                'class' => 'FeScCmdShowListEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Entrada_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdShowByIdEntrada' => array(
                'class' => 'FeScCmdShowByIdEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdShowByIdEntradaAudiencia' => array(
                'class' => 'FeScCmdShowByIdEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_EntradaAudiencia',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_EntradaAudiencia',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdCancelShowListEntrada' => array(
                'class' => 'FeScCmdCancelShowListEntrada',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Entrada',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDefaultDayview' => array(
                'class' => 'FeScCmdDefaultDayview',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Dayview',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDefaultDayviewAvail' => array(
                'class' => 'FeScCmdDefaultDayviewAvail',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_DayviewAvail',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_DayviewAvail',
                       'redirect' => 0
                       )
                    )
                ),
            'FeScCmdDefaultCitasWeb' => 
    			array (
      				'class' => 'FeScCmdDefaultCitasWeb',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_CitasWeb','redirect' => 0,),
        						'fail' =>array ('view' => 'error','redirect' => 0,),
      				),
    			),
            'FeScCmdDefaultCitasWebConsult' => 
    			array (
      				'class' => 'FeScCmdDefaultCitasWebConsult',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_CitasWebConsult','redirect' => 0,),
        						'fail' =>array ('view' => 'error','redirect' => 0,),
      				),
    			),
            'FeScCmdDeletePreentrada' => 
    			array (
      				'class' => 'FeScCmdDeletePreentrada',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_CitasWebConsult','redirect' => 0,),
        						'fail' =>array ('view' => 'error','redirect' => 0,),
      				),
    			),
            'FeScCmdAddEntradaWeb' => 
    			array (
      				'class' => 'FeScCmdAddEntradaWeb',
      				'validated' => 'false',
      				'views' => 
      				array ('success' =>array ('view' => 'Form_CitasWeb','redirect' => 0,),
        						'fail' =>array ('view' => 'Form_CitasWeb','redirect' => 0,),
      				),
    			),
    		
		    'FeScCmdTreeHelp' => 
		    array (
		      'class' => 'FeScCmdTreeHelp',
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

	'FeScCmdLstHelp' => 
    array (
      'class' => 'FeScCmdLstHelp',
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

	    'FeScCmdDefaultContactoWeb' => array(
                'class' => 'FeScCmdDefaultContactoWeb',
                'validated' => 'false', 
                'views' => array ('success' => array('view' => 'Form_ContactoWeb','redirect' => 0),
                                          'fail' => array('view' => 'error','redirect' => 0)
                                        )
                ),

		'FeScCmdAddContactoWeb' => array(
                    'class' => 'FeScCmdAddContactoWeb',
                   'validated' => 'false',
                    'views' => array ('success' => array('view' => 'Form_ContactoWeb','redirect' => 0),
                                          'fail' => array('view' => 'Form_ContactoWeb','redirect' => 0)
                                        )
                ),
                
         'FeScCmdLoadIdioma' => 
		    array (
		      'class' => 'FeScCmdLoadIdioma',
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
		'FeScCmdDefaultAutoreference' => 
		    array (
		      'class' => 'FeScCmdDefaultAutoreference',
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
		'FeScCmddrawOrg' => 
    		array (
      			'class' => 'FeScCmddrawOrg',
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
    	'FeScCmdDeleteOrg' => 
    		array (
      			'class' => 'FeScCmdDeleteOrg',
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
    	'FeScCmdloadEntrada' => 
    		array (
      			'class' => 'FeScCmdloadEntrada',
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
    	'FeScCmdTreeHelpEsp' => 
				    array (
				      'class' => 'FeScCmdTreeHelpEsp',
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
        'Form_Menu'=> array (
            'template' => 'Form_Menu.tpl'
            ),
    'Form_LstHelp' => 
    array (
      'template' => 'Form_LstHelp.tpl',
    ),
	    'Form_ContactoWeb' => array (
            'template' => 'Form_ContactoWeb.tpl'
            ),
        'Form_Categoria' => array (
            'template' => 'Form_Categoria.tpl'
            ),
        'Form_Categoria_Consult' => array (
            'template' => 'Form_Categoria_Consult.tpl'
            ),
        'Form_Entrada' => array (
            'template' => 'Form_Entrada.tpl'
            ),
        'Form_Entrada_Consult' => array (
            'template' => 'Form_Entrada_Consult.tpl'
            ),
        'Form_Dayview' => array (
            'template' => 'Form_Dayview.tpl'
            ),
        'Form_DayviewAvail' => array (
            'template' => 'Form_DayviewAvail.tpl'
            ),
        'Form_ShowListSchedule' => array (
            'template' => 'Form_ShowListSchedule.tpl'
            ),
        'Form_FichaEvento' => array (
            'template' => 'Form_FichaEvento.tpl'
            ),
        'Form_FichaEventoSP' => array (
            'template' => 'Form_FichaEventoSP.tpl'
            ),
         'Form_CitasWeb' => array (
            'template' => 'Form_CitasWeb.tpl'
            ),
	     'Form_TreeHelp' => array (
	      'template' => 'Form_TreeHelp.tpl',
	    	),
	     'Form_CitasWebConsult' => array (
	      'template' => 'Form_CitasWebConsult.tpl',
	    	),
	    'Form_TreeHelpEsp' => 
		    array (
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
    die("[SCHEDULE] navigation file ERROR\n");
}
die("[SCHEDULE] navigation file OK\n");
?>

?>
</body>
</html>
