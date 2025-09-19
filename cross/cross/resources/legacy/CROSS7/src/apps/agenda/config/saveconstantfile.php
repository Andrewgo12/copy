<?php
#!/bin/sh
$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
            'ACT_REA' => '1', //Indica que una actividad dentro de una tarea ha sido realizada
            'COD_AUT_REQ' => true, //Indica si el codigo de los requerimientos se genera o no
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_ACT" => "A", //Indicador de registros activos
            "REG_INACT" => "I", //Indicador de registros inactivos
            "ENTRY_ACTIVE_STATUS" => "A", //Indicador de registros activos
            "ENTRY_CANCEL_STATUS" => "C", //Indicador de registros activos
            "ENTRY_CONFIR_STATUS" => "F", //Indicador de registros activos
            "ANEXOS" => $app_dir = dirname(dirname(__FILE__))."/data/anexos", //Path de los archivos anexos
            "N_ANEXO" => "N", //Flag que indica un nuevo anexo
            "O_ANEXO" => "O", //Flag que indica un anexo ya ingresado
            "MOD_REQ_FIN" => false, //Indica si un requerimiento finalizado puede ser modificado
            "CAMP_MOD" => array("tiorcodigos","evencodigos",'ordefecregd','orgacodigos'), //Arreglo con los nombres de los campos que no se pueden modificar de un req.
            "ACT_REQ"=>true,//Indica que las actividades son requeridas
            "MOD_ACT"=>true,//Indica si solo se debe modificar las actas de las dependecias a cargo o tambien las actas de las depencias descendentes
            'INT_INNOVA'=>array('status'=>false,'url'=>'http://localhost/innova.php', 'paramname'=>'caso'), //Indica Si existe la integracion con docunet
           
            'RCPLUGINS'=>array('select'=>'select_dimentions',
            					'text'=>'textarea', 
            					'textarea'=>'textarea', 
            					'textfield'=>'textfield', 
            					'multiple'=>'select_multiple',
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
            'DV_URL' => 'FeScCmdDefaultDayview',
            'DV_URL_AV' => 'FeScCmdDefaultDayviewAvail',
            'NEW_URL' => 'FeScCmdDefaultEntrada',
            'DV_URL_JUDGE' => 'FeScCmdDefaultJudgeSchedule',
            'NEW_URL_JUDGE' => 'FeScCmdDefaultEntradaAudiencia',

            'ATTEMP_URL' => '../cross300/index.php?action=FeCrCmdDefaultActaempresa',
            'VIZ_OPC' => array("VER_EXP"=>"E","VER_ORD"=>"O","VER_ACT"=>"A","VER_PER"=>"P"),
            'ENDCLONDATE_LIMIT' => 1514782799,
            'DCLOSE_TASK_PRYOR' => '3',
            'DCLOSE_SESS_CATEG' => '1',
            'DCLOSE_DESCRIPTION' => 'Sesión de Cierre Definitivo',
            'FREQUENCY' => array('daily'=>'Diaria',
                                 'weekly'=>'Semanal',
                                 'monthly'=>'Mensual',
                                 'yearly'=>'Anual',
                                 ),
            'FREQUENCY_ALIAS' => array('DF'=>'daily',
                                 'WF'=>'weekly',
                                 'MF'=>'monthly',
                                 'YF'=>'yearly',
                                 ),
            'type_JUEZ' => 1,
            'type_FISC' => 2,
            'type_RRFF' => 3,
            'type_FUNC' => 4,
            'type_DEF' => 5,
            'DATOS_EMAIL' => array('subject'=>'CITA ELECTRÓNICA POR ASIGNAR','body'=>'POR FAVOR SÍRVASE DARLE EL TRÁMITE ADECUADO A LA CITA #'),
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