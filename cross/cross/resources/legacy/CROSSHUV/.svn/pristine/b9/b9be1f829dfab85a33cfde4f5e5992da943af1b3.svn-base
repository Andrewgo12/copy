<?php
#!/bin/sh
$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_ACT" => "A", //Indicador de registros activos
            "REG_INACT" => "I", //Indicador de registros inactivos
			"max_combo_options" => 30,
			"LON_MIN_NTI"=>9,//longitud minima nombre de tipo de identificacion
			"LON_MAX_NTI"=>22,//longitud maxima nombre de tipo de identificacion
			"LON_MIN_FNC"=>2,//longitud minima primer nombre cotacto
			"LON_MAX_FNC"=>20,//longitud maxima primer nombre cotacto
			"LON_MIN_LNC"=>3,//longitud minima apellido contacto
			"LON_MAX_LNC"=>30,//longitud maxima apellido contacto
		    "CAN_MAX_EDAD"=>120,//edad maxima de un contacto
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[[CUSTOMERS]] constant file ERROR\n");
}
die("[CUSTOMERS] constant file OK\n");
?>