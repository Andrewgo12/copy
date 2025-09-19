<?php 
#!/bin/sh

$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 0)
            'DIR_IMG' => 'productos', //Directorio en donde se almacenaran las imagenes de un producto
			'IMG_EXT' => array("image/jpeg","image/gif"), //imagenes
			'REG_ACT' => "A", //Indicador de registros activos
			'REG_INACT' => "I", //Indicador de registros activos
			'DB_NULL' => 'NULL', //Null para las bases de datos
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[PRODUCTS] constant file ERROR\n");
}
die("[PRODUCTS] constant file OK\n");
?>