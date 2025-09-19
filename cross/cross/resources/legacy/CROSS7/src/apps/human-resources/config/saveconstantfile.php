<?php
#!/bin/sh
$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_ACT" => "A", //Indicador de registros activos
            "REG_INACT" => "I", //Indicador de registros inactivos
            "GRUP_RESP" => "S", // Codigo de estado para determinar el responsable de un grupo
			"ENTE_INACTIVO" => "02",
			"MOVE_DEP_MESS_CODE" => "21",
			"ENTE_ROTACION" => "3",
			"PERFIL_AGENTES_BPO" => "6",
			"PERFIL_ADMIN" => array("1","4"),
			"DEP_DEFAULT" => "DEP_DEFAULT",
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[HR] constant file ERROR\n");
}
die("[HR] constant file OK\n");
?>