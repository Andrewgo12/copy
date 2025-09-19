<?php
#!/bin/sh

$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
        'COD_REC_SER' => '01', //Codigo de un recurso seriado
        'DB_NULL' => 'NULL', //Null para las bases de datos
        "BOD_NO_VALIDATE" => "2", //Bodegas a las cuales no se le valida saldo de salida separadas por coma
        "EXTERNAL_WAREHOUSE" => "2", //Tipo de bodega extaerna procedente desde tipobodega no se les hace validacion de saldos 
        "INTERNAL_WAREHOUSE" => "1", //Tipo de bodega interna procedente desde tipobodega
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
    die("[STORAGE] constant file ERROR\n");
}
die("[STORAGE] constant file OK\n");
?>