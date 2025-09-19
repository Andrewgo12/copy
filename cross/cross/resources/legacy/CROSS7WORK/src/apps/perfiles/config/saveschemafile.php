<?php
#!/bin/sh
/*
 Para crear un nuevo esquema se deve tener en cuenta los valores de la tabla schema
 de la base de datos del profiles, los valores deben concondar, tanbien deben ser tenidos en cuenta los
 archivos de constant de todos los modulos para adicionar un item, y el archivo de params del modulo
 general para adicionar un item.
 */
$schema = array (
0 =>
	array (
	    'schenombres' => 'Plantilla',
	    'schedbusers' => 'crossvossdb',
	    'schedbkeys' => 'awd.rgy.jil.p',
	),
	1 =>
	array (
	    'schenombres' => 'profiles',
	    'schedbusers' => 'crossvossdb',
	    'schedbkeys' => 'awd.rgy.jil.p',
	),
);

$rcTmpOp = array_slice($argv, 1);
$nuOptions = sizeof($rcTmpOp);
if($nuOptions > 0){

	foreach($rcTmpOp as $key => $value){
		$rcTmp = explode("=", $value);
		$rcOption[$rcTmp[0]] = $rcTmp[1];
	}
	unset($rcTmpOp);
	foreach($schema as $schecodigon => $rcData){
		if($rcOption["user"])
		$rcData['schedbusers'] = $rcOption["user"];
		if($rcOption["password"])
		$rcData["schedbkeys"] = $rcOption["password"];
		$rcTmp[$schecodigon] = $rcData;
	}
	$schema = $rcTmp;
}

$path = dirname(__FILE__)."/schema.data";
$fd = fopen($path,"w");
if($fd){
	fwrite($fd, serialize($schema));
	fclose($fd);
}else{
	die("[PROFILES] schemas file ERROR\n");
}
die("[PROFILES] schemas file OK\n");
?>