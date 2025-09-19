<?php
#!/bin/sh
$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
            'ACT_REA' => '1', //Indica que una actividad dentro de una tarea ha sido realizada
            'COD_AUT_REQ' => true, //Indica si el codigo de los requerimientos se genera o no
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_ACT" => "A", //Indicador de registros activos
            "REG_INACT" => "I", //Indicador de registros inactivos
            "ANEXOS" => $app_dir = dirname(dirname(__FILE__))."/data/anexos", //Path de los archivos anexos
            "N_ANEXO" => "N", //Flag que indica un nuevo anexo
            "O_ANEXO" => "O", //Flag que indica un anexo ya ingresado
            "MOD_REQ_FIN" => false, //Indica si un requerimiento finalizado puede ser modificado
            "CAMP_MOD" => array("tiorcodigos","evencodigos",'ordefecregd','orgacodigos'), //Arreglo con los nombres de los campos que no se pueden modificar de un req.
            "ACT_REQ"=>true,//Indica que las actividades son requeridas
            "MOD_ACT"=>true,//Indica si solo se debe modificar las actas de las dependecias a cargo o tambien las actas de las depencias descendentes
            'INT_INNOVA'=>array('status'=>false,'url'=>'http://localhost/innova.php', 'paramname'=>'id_cross'), //Indica Si existe la integracion con docunet
           
            'RCPLUGINS'=>array('select'=>'select_dimentions',
            					'text'=>'textarea', 
            					'textarea'=>'textarea', 
            					'textfield'=>'textfield', 
            					'multiple'=>'select_multiple_dimentions',
            					'void'=>'void',
            					'calendar'=>'calendar_dimention',), //Alisas de los plugins
            'DIM_ERR_MSG'=>array("format"=>4,"null"=>0,"rule"=>4),//codigos de error para las senhales de validacion de columnas dinamicas
            
            'TIPOGRAPH_METHODS' => array(
            				'pie1'=>'createSimplePieplot',
            				'pie2'=>'create3DPieplot',
            				'pie3'=>'createExplode3DPieplot',
            				'bar1'=>'createBarCenterValues',
            				'bar2'=>'createBarBgCenterValues',
            				'bar3'=>'createBarFreqCenterValues',
            				'line1'=>'createCenterLines',
            				'line2'=>'createSimpleSLines',
            				'line3'=>'createLinesIcon',
            			),            
            'ACCOACTIVAS' => array(
            				'A'=>'Pendiente',
            				'C'=>'Cumpli&oacute;',
            				'N'=>'No Cumpli&oacute;',
            			),
            'EXCEL_EXT' => ".xls",//Estado Asignado
            'SLASH' => "/",//slash
            'SEP_DOC' => "-",//Separador del serial del documento
            "EXCEL_IMAGE0" => "<img src='web/images/generar_excel.gif' alt='Exportar a Excel' border=0>",
            "EXCEL_IMAGE1" => "<img src='web/images/generar_excel.gif' alt='Exportar a Excel' border=0 onClick=\"win=window.open('",
     		"EXCEL_IMAGE2" => "','','');\">",
     		'HR_DEPEND_BASE' => array('100','110','120','130','140','200','300','400','500','600','700','710','720','730','740','750','760','770','780'),
            'PIPE'=>'|',
            'MEDIO_RECEPCION_TELEFONICO'=>'5',
            'DATE_FIELD'=>array("ordefecingd","ordefecregd","ordefecvend","ordefecfinad","ordefecentn","actafechingn","actafechfinn","actafechvenn","actafechinin","acemfeccren","acemfecaten"),//campos tipo fecha delos casos y de las actas
            "max_combo_options" => 30,						
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[CROSS] constant file ERROR\n");
}
die("[CROSS] constant file OK\n");
?>