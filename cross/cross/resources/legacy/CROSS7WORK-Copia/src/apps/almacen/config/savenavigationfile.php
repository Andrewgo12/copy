<?php
#!/bin/sh

$Navigation_config = array (
    'default_action' => 'FeStdefault',
    'error_view' => 'error',
    'login_view' => 'Login',
    'commands' => array (
        'FeStdefault' => array(
            'class' => 'FeStDefaultCommand',
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
			
           'FeStCmdDefaultBodega' => array(
                'class' => 'FeStCmdDefaultBodega',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Bodega',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddBodega' => array(
                'class' => 'FeStCmdAddBodega',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateBodega' => array(
                'class' => 'FeStCmdUpdateBodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteBodega' => array(
                'class' => 'FeStCmdDeleteBodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListBodega' => array(
                'class' => 'FeStCmdShowListBodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdBodega' => array(
                'class' => 'FeStCmdShowByIdBodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListBodega' => array(
                'class' => 'FeStCmdCancelShowListBodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Bodega',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultConcepmovimi' => array(
                'class' => 'FeStCmdDefaultConcepmovimi',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Concepmovimi',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddConcepmovimi' => array(
                'class' => 'FeStCmdAddConcepmovimi',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateConcepmovimi' => array(
                'class' => 'FeStCmdUpdateConcepmovimi',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteConcepmovimi' => array(
                'class' => 'FeStCmdDeleteConcepmovimi',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListConcepmovimi' => array(
                'class' => 'FeStCmdShowListConcepmovimi',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdConcepmovimi' => array(
                'class' => 'FeStCmdShowByIdConcepmovimi',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListConcepmovimi' => array(
                'class' => 'FeStCmdCancelShowListConcepmovimi',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Concepmovimi',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultGruporecurso' => array(
                'class' => 'FeStCmdDefaultGruporecurso',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Gruporecurso',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddGruporecurso' => array(
                'class' => 'FeStCmdAddGruporecurso',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateGruporecurso' => array(
                'class' => 'FeStCmdUpdateGruporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteGruporecurso' => array(
                'class' => 'FeStCmdDeleteGruporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListGruporecurso' => array(
                'class' => 'FeStCmdShowListGruporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdGruporecurso' => array(
                'class' => 'FeStCmdShowByIdGruporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListGruporecurso' => array(
                'class' => 'FeStCmdCancelShowListGruporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Gruporecurso',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultMovimialmace' => array(
                'class' => 'FeStCmdDefaultMovimialmace',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Movimialmace',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
           'FeStCmdDefaultMovimialmace_in' => array(
                'class' => 'FeStCmdDefaultMovimialmace_in',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Movimialmace',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddMovimialmace' => array(
                'class' => 'FeStCmdAddMovimialmace',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateMovimialmace' => array(
                'class' => 'FeStCmdUpdateMovimialmace',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteMovimialmace' => array(
                'class' => 'FeStCmdDeleteMovimialmace',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace_Consult',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListMovimialmace' => array(
                'class' => 'FeStCmdShowListMovimialmace',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdMovimialmace' => array(
                'class' => 'FeStCmdShowByIdMovimialmace',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListMovimialmace' => array(
                'class' => 'FeStCmdCancelShowListMovimialmace',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Movimialmace',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultProveedor' => array(
                'class' => 'FeStCmdDefaultProveedor',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Proveedor',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddProveedor' => array(
                'class' => 'FeStCmdAddProveedor',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateProveedor' => array(
                'class' => 'FeStCmdUpdateProveedor',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteProveedor' => array(
                'class' => 'FeStCmdDeleteProveedor',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListProveedor' => array(
                'class' => 'FeStCmdShowListProveedor',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdProveedor' => array(
                'class' => 'FeStCmdShowByIdProveedor',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListProveedor' => array(
                'class' => 'FeStCmdCancelShowListProveedor',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveedor',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultProveerecurs' => array(
                'class' => 'FeStCmdDefaultProveerecurs',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Proveerecurs',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddProveerecurs' => array(
                'class' => 'FeStCmdAddProveerecurs',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateProveerecurs' => array(
                'class' => 'FeStCmdUpdateProveerecurs',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteProveerecurs' => array(
                'class' => 'FeStCmdDeleteProveerecurs',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListProveerecurs' => array(
                'class' => 'FeStCmdShowListProveerecurs',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdProveerecurs' => array(
                'class' => 'FeStCmdShowByIdProveerecurs',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListProveerecurs' => array(
                'class' => 'FeStCmdCancelShowListProveerecurs',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Proveerecurs',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultRecurso' => array(
                'class' => 'FeStCmdDefaultRecurso',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Recurso',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddRecurso' => array(
                'class' => 'FeStCmdAddRecurso',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateRecurso' => array(
                'class' => 'FeStCmdUpdateRecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteRecurso' => array(
                'class' => 'FeStCmdDeleteRecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListRecurso' => array(
                'class' => 'FeStCmdShowListRecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdRecurso' => array(
                'class' => 'FeStCmdShowByIdRecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListRecurso' => array(
                'class' => 'FeStCmdCancelShowListRecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recurso',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultRecuseribode' => array(
                'class' => 'FeStCmdDefaultRecuseribode',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Recuseribode',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddRecuseribode' => array(
                'class' => 'FeStCmdAddRecuseribode',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateRecuseribode' => array(
                'class' => 'FeStCmdUpdateRecuseribode',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteRecuseribode' => array(
                'class' => 'FeStCmdDeleteRecuseribode',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListRecuseribode' => array(
                'class' => 'FeStCmdShowListRecuseribode',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdRecuseribode' => array(
                'class' => 'FeStCmdShowByIdRecuseribode',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListRecuseribode' => array(
                'class' => 'FeStCmdCancelShowListRecuseribode',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Recuseribode',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultTipobodega' => array(
                'class' => 'FeStCmdDefaultTipobodega',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tipobodega',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddTipobodega' => array(
                'class' => 'FeStCmdAddTipobodega',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateTipobodega' => array(
                'class' => 'FeStCmdUpdateTipobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteTipobodega' => array(
                'class' => 'FeStCmdDeleteTipobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListTipobodega' => array(
                'class' => 'FeStCmdShowListTipobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdTipobodega' => array(
                'class' => 'FeStCmdShowByIdTipobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListTipobodega' => array(
                'class' => 'FeStCmdCancelShowListTipobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipobodega',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultTipodocument' => array(
                'class' => 'FeStCmdDefaultTipodocument',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tipodocument',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddTipodocument' => array(
                'class' => 'FeStCmdAddTipodocument',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateTipodocument' => array(
                'class' => 'FeStCmdUpdateTipodocument',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteTipodocument' => array(
                'class' => 'FeStCmdDeleteTipodocument',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListTipodocument' => array(
                'class' => 'FeStCmdShowListTipodocument',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdTipodocument' => array(
                'class' => 'FeStCmdShowByIdTipodocument',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListTipodocument' => array(
                'class' => 'FeStCmdCancelShowListTipodocument',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tipodocument',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultTiporecurso' => array(
                'class' => 'FeStCmdDefaultTiporecurso',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Tiporecurso',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddTiporecurso' => array(
                'class' => 'FeStCmdAddTiporecurso',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateTiporecurso' => array(
                'class' => 'FeStCmdUpdateTiporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteTiporecurso' => array(
                'class' => 'FeStCmdDeleteTiporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListTiporecurso' => array(
                'class' => 'FeStCmdShowListTiporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdTiporecurso' => array(
                'class' => 'FeStCmdShowByIdTiporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListTiporecurso' => array(
                'class' => 'FeStCmdCancelShowListTiporecurso',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Tiporecurso',
                       'redirect' => 0
                       )
                    )
                ),
           'FeStCmdDefaultUnidadmedida' => array(
                'class' => 'FeStCmdDefaultUnidadmedida',
                'validated' => 'false', 
                'views' => array (
                    'success' => array(
                        'view' => 'Form_Unidadmedida',
                        'redirect' => 0
                        ),
                    'fail' => array(
                        'view' => 'error',
                        'redirect' => 0
                        )
                    )
                ),
            'FeStCmdAddUnidadmedida' => array(
                'class' => 'FeStCmdAddUnidadmedida',
               'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
			    ),
            'FeStCmdUpdateUnidadmedida' => array(
                'class' => 'FeStCmdUpdateUnidadmedida',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDeleteUnidadmedida' => array(
                'class' => 'FeStCmdDeleteUnidadmedida',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowListUnidadmedida' => array(
                'class' => 'FeStCmdShowListUnidadmedida',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida_Consult',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdShowByIdUnidadmedida' => array(
                'class' => 'FeStCmdShowByIdUnidadmedida',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdCancelShowListUnidadmedida' => array(
                'class' => 'FeStCmdCancelShowListUnidadmedida',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_Unidadmedida',
                       'redirect' => 0
                       )
                    )
                ),
    'FeStCmdLstHelp' => 
    array (
      'class' => 'FeStCmdLstHelp',
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
    'FeStCmdDefaultSaldobodega' => 
    array (
      'class' => 'FeStCmdDefaultSaldobodega',
      'views' => 
      array (
        'success' => 
        array (
          'view' => 'Form_Saldobodega',
          'redirect' => 0,
        ),
        'fail' => 
        array (
          'view' => 'Form_Saldobodega',
          'redirect' => 0,
        ),
      ),
    ),
             'FeStCmdDefaultFichas' => array(
                'class' => 'FeStCmdDefaultFichas',
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
            'FeStCmdDefaultHeadSaldobodega' => array(
                'class' => 'FeStCmdDefaultHeadSaldobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_HeadSaldobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_HeadSaldobodega',
                       'redirect' => 0
                       )
                    )
                ),
            'FeStCmdDefaultBodySaldobodega' => array(
                'class' => 'FeStCmdDefaultBodySaldobodega',
                'validated' => 'false',
                'views' => array (
                    'success' => array(
                       'view' => 'Form_BodySaldobodega',
                       'redirect' => 0
                       ),
                    'fail' => array(
                       'view' => 'Form_BodySaldobodega',
                       'redirect' => 0
                       )
                    )
                ),
               'FeStCmdDefaultRepomovimialmace' => array (
					'class' => 'FeStCmdDefaultRepomovimialmace',
					'views' => 
					array (
						'success' => 
						array (
						'view' => 'Form_Repomovimialmace',
						'redirect' => 0,
						),
						'fail' => 
						array (
						'view' => 'Form_Repomovimialmace',
						'redirect' => 0,
						),
					),
				),
				'FeStCmdDefaultHeadRepomovimialmace' => array(
							'class' => 'FeStCmdDefaultHeadRepomovimialmace',
							'validated' => 'false',
							'views' => array (
								'success' => array(
								'view' => 'Form_HeadRepomovimialmace',
								'redirect' => 0
								),
								'fail' => array(
								'view' => 'Form_HeadRepomovimialmace',
								'redirect' => 0
								)
							)
					),
				'FeStCmdDefaultBodyRepomovimialmace' => array(
					'class' => 'FeStCmdDefaultBodyRepomovimialmace',
					'validated' => 'false',
					'views' => array (
						'success' => array(
						'view' => 'Form_BodyRepomovimialmace',
						'redirect' => 0
						),
						'fail' => array(
						'view' => 'Form_BodyRepomovimialmace',
						'redirect' => 0
						)
						)
					),

               'FeStCmdDefaultReporecuseribode' => array (
					'class' => 'FeStCmdDefaultReporecuseribode',
					'views' => 
					array (
						'success' => 
						array (
						'view' => 'Form_Reporecuseribode',
						'redirect' => 0,
						),
						'fail' => 
						array (
						'view' => 'Form_Reporecuseribode',
						'redirect' => 0,
						),
					),
				),
				'FeStCmdDefaultHeadReporecuseribode' => array(
							'class' => 'FeStCmdDefaultHeadReporecuseribode',
							'validated' => 'false',
							'views' => array (
								'success' => array(
								'view' => 'Form_HeadReporecuseribode',
								'redirect' => 0
								),
								'fail' => array(
								'view' => 'Form_HeadReporecuseribode',
								'redirect' => 0
								)
							)
					),
				'FeStCmdDefaultBodyReporecuseribode' => array(
					'class' => 'FeStCmdDefaultBodyReporecuseribode',
					'validated' => 'false',
					'views' => array (
						'success' => array(
						'view' => 'Form_BodyReporecuseribode',
						'redirect' => 0
						),
						'fail' => array(
						'view' => 'Form_BodyReporecuseribode',
						'redirect' => 0
						)
						)
					),
					
               'FeStCmdDefaultBalance' => array (
					'class' => 'FeStCmdDefaultBalance',
					'views' => 
					array (
						'success' => 
						array (
						'view' => 'Form_Balance',
						'redirect' => 0,
						),
						'fail' => 
						array (
						'view' => 'Form_Balance',
						'redirect' => 0,
						),
					),
				),
				'FeStCmdDefaultHeadBalance' => array(
							'class' => 'FeStCmdDefaultHeadBalance',
							'validated' => 'false',
							'views' => array (
								'success' => array(
								'view' => 'Form_HeadBalance',
								'redirect' => 0
								),
								'fail' => array(
								'view' => 'Form_HeadBalance',
								'redirect' => 0
								)
							)
					),
				'FeStCmdDefaultBodyBalance' => array(
					'class' => 'FeStCmdDefaultBodyBalance',
					'validated' => 'false',
					'views' => array (
						'success' => array(
						'view' => 'Form_BodyBalance',
						'redirect' => 0
						),
						'fail' => array(
						'view' => 'Form_BodyBalance',
						'redirect' => 0
						)
						)
					),
					    
 	    ),
	'views' => array(
        'Form_Menu'=> array (
            'template' => 'Form_Menu.tpl'
            ),
        'Form_Bodega' => array (
            'template' => 'Form_Bodega.tpl'
            ),
        'Form_Bodega_Consult' => array (
            'template' => 'Form_Bodega_Consult.tpl'
            ),
        'Form_Concepmovimi' => array (
            'template' => 'Form_Concepmovimi.tpl'
            ),
        'Form_Concepmovimi_Consult' => array (
            'template' => 'Form_Concepmovimi_Consult.tpl'
            ),
        'Form_Gruporecurso' => array (
            'template' => 'Form_Gruporecurso.tpl'
            ),
        'Form_Gruporecurso_Consult' => array (
            'template' => 'Form_Gruporecurso_Consult.tpl'
            ),
        'Form_Movimialmace' => array (
            'template' => 'Form_Movimialmace.tpl'
            ),
        'Form_Movimialmace_Consult' => array (
            'template' => 'Form_Movimialmace_Consult.tpl'
            ),
        'Form_Proveedor' => array (
            'template' => 'Form_Proveedor.tpl'
            ),
        'Form_Proveedor_Consult' => array (
            'template' => 'Form_Proveedor_Consult.tpl'
            ),
        'Form_Proveerecurs' => array (
            'template' => 'Form_Proveerecurs.tpl'
            ),
        'Form_Proveerecurs_Consult' => array (
            'template' => 'Form_Proveerecurs_Consult.tpl'
            ),
        'Form_Recurso' => array (
            'template' => 'Form_Recurso.tpl'
            ),
        'Form_Recurso_Consult' => array (
            'template' => 'Form_Recurso_Consult.tpl'
            ),
        'Form_Recuseribode' => array (
            'template' => 'Form_Recuseribode.tpl'
            ),
        'Form_Recuseribode_Consult' => array (
            'template' => 'Form_Recuseribode_Consult.tpl'
            ),
        'Form_Tipobodega' => array (
            'template' => 'Form_Tipobodega.tpl'
            ),
        'Form_Tipobodega_Consult' => array (
            'template' => 'Form_Tipobodega_Consult.tpl'
            ),
        'Form_Tipodocument' => array (
            'template' => 'Form_Tipodocument.tpl'
            ),
        'Form_Tipodocument_Consult' => array (
            'template' => 'Form_Tipodocument_Consult.tpl'
            ),
        'Form_Tiporecurso' => array (
            'template' => 'Form_Tiporecurso.tpl'
            ),
        'Form_Tiporecurso_Consult' => array (
            'template' => 'Form_Tiporecurso_Consult.tpl'
            ),
        'Form_Unidadmedida' => array (
            'template' => 'Form_Unidadmedida.tpl'
            ),
        'Form_Unidadmedida_Consult' => array (
            'template' => 'Form_Unidadmedida_Consult.tpl'
            ),
		    'Form_LstHelp' => 
		    array (
		      'template' => 'Form_LstHelp.tpl',
		    ),
	    'Form_Saldobodega' => 
		    array (
		      'template' => 'Form_Saldobodega.tpl',
		    ),
        'Form_Fichas' => array (
            'template' => 'Form_Fichas.tpl'
            ),
        'Form_HeadSaldobodega' => array (
            'template' => 'Form_HeadSaldobodega.tpl'
            ),
        'Form_BodySaldobodega' => array (
            'template' => 'Form_BodySaldobodega.tpl'
            ),
	    'Form_Repomovimialmace' => array (
		      'template' => 'Form_Repomovimialmace.tpl',
		    ),
        'Form_HeadRepomovimialmace' => array (
            'template' => 'Form_HeadRepomovimialmace.tpl'
            ),
        'Form_BodyRepomovimialmace' => array (
            'template' => 'Form_BodyRepomovimialmace.tpl'
            ),
	    'Form_Reporecuseribode' => array (
		      'template' => 'Form_Reporecuseribode.tpl',
		    ),
        'Form_HeadReporecuseribode' => array (
            'template' => 'Form_HeadReporecuseribode.tpl'
            ),
        'Form_BodyReporecuseribode' => array (
            'template' => 'Form_BodyReporecuseribode.tpl'
            ),
	    'Form_Balance' => array (
		      'template' => 'Form_Balance.tpl',
		    ),
        'Form_HeadBalance' => array (
            'template' => 'Form_HeadBalance.tpl'
            ),
        'Form_BodyBalance' => array (
            'template' => 'Form_BodyBalance.tpl'
            ),
        )
    );


$path = dirname(__FILE__)."/web.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Navigation_config));
    fclose($fd);
}else{
    die("[STORAGE] navigation file ERROR\n");
}
die("[STORAGE] navigation file OK\n");
?>