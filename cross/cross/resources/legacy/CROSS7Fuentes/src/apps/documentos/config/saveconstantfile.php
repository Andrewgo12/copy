<?php
#!/bin/sh

$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
            'ACT_REA' => '1', //Indica que una actividad dentro de una tarea ha sido realizada
            'COD_AUT_REQ' => true, //Indica si el codigo de los requerimientos se genera o no
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_ACT" => "A", //Indicador de registros activos
            "REG_INACT" => "I", //Indicador de registros inactivos
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[DOCUNET] constant file ERROR\n");
}
die("[DOCUNET] constant file OK\n");
?>