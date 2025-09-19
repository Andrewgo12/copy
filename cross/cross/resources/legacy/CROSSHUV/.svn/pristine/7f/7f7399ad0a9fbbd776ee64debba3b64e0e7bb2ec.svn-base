<?php
#!/bin/sh
$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
        'TAR_INI_PRO' => 'IP',// Indica en la tabla de rutas si una(s) tarea(s) es(son) inicial(es)
        'INI_TAR' => 'IT',// Indica en la tabla de rutas el nodo en el que comienza una tarea
        'ACTA_AC' => 'A',//Indica que un acta esta activa
        'ACTA_INAC' => 'I',//Indica que un acta esta inactiva
        'ACTA_FIN' => 'F',//Indica que un acta esta finalizada
        'DB_NULL' => 'NULL',//Null para las bases de datos
        'TAREA_REQ' => 'REQ',//tarea requerida
        'TAREA_OPC' => 'OPC',//tarea opcional
        'PIPE' => '|',//pipe
        'ACT_REA' => '1',//Indica que una actividad dentro de una tarea ha sido realizada
        "REG_ACT" => "A", //Indicador de registros activos
        "REG_INACT" => "I", //Indicador de registros inactivos
        "MAR_INS" => "1", //Indicador acta que instancia (tabla de recorrido)
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[WORKFLOW] constant file ERROR\n");
}
die("[WORKFLOW] constant file OK\n");
?>