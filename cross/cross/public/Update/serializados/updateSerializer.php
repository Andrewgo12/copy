<?php
#!/bin/sh
/*
 * Created on 08/05/2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

if(!$argv[1])
	die('Error: No se pudo modificar el serializado: no existe el parametro con el path del archivo serializado\n');

if(!is_file($argv[1]))
	die('Error: No se pudo modificar el serializado: no existe el archivo '.$argv[1].'\n');

if(!is_writable($argv[1]))
	die('Error: No se pudo modificar el serializado: no hay permisos de escritura sobre '.$argv[1].'\n');


$hoy = fncintdatehour();
$filename = $argv[1];
$svnRevision = $argv[2];
$operation = $argv[3];

$bckNameFile = dirname(__FILE__) . '/old_files/' . str_replace(array('/', '..'), array('_', ''), $filename) . '.' .$hoy;
//Crea una copia del archivo a modificar 
echo 'Respaldo de serializado ' . $filename . ' : ' . copy($filename, $bckNameFile) . "\n";
echo 'Copia de serializado ' . $filename . ' : ' . copy($filename, $filename.'.'.$hoy) . "\n";

//Se deserializa el objeto
$flo = fopen($filename, 'r');
$file = fread($flo, filesize($filename));
fclose($flo);
$unserialized = unserialize(trim($file));
$module = dirname(dirname($filename));
$rcModule = explode("/",$module);
$module = array_pop($rcModule);
$module = strtolower($module);

include('setupSerialize.inc.php');

switch($operation){
	case 'params':
		$unserialized = updateParams($rcAddParams, $rcDelParams, $unserialized);
		break;
	case 'constant':
		$unserialized = updateConstant($rcAddConstants, $unserialized, $module);
		break;
}


//var_dump($unserialized);
//Guarda el serializado
save($unserialized, $filename);


function updateConstant($rcAddConstants, $unserialized, $module){
	
	if(is_array($rcAddConstants)){
		foreach($rcAddConstants as $cte){
			if($module == $cte['modulo']){
				$script = generaScript($cte['contexto'], $cte['nombre'], $cte['valor'], $cte['pathindex']);
				eval($script);
			}
		}
	}
	
	return $unserialized;
}

function generaScript($contexto, $nombre, $valor, $strpathindex){

	$script = "\$unserialized[$contexto]['$nombre']";
	
	if($strpathindex){
		$pathindex = explode('/', $strpathindex);
		foreach($pathindex as $index)
			$script .= "['$index']";
	}

	$script .= ' = '.var_export($valor, true).';';
	return $script;
}

function updateParams($rcAddParams, $rcDelParams, $unserialized){
	
	//Si existe paramatros para adicionar o modificar
	if(is_array($rcAddParams)){
		foreach($rcAddParams as $param){
			$contexto = $param['contexto'];
			$modulo = $param['modulo'];
			$nombre = $param['nombre'];
			$valor = $param['valor'];
			
			if(!$contexto){ //Debe aplicar a todos los contextos
				$cantContextos = count($unserialized);
				for($x=0; $x<$cantContextos;$x++)
					$unserialized[$x][$modulo][$nombre] = $valor;		
			}else{
				//Modifica o adiciona
				$unserialized[$contexto][$modulo][$nombre] = $valor;
			}
		}
	}
	
	//Si se deben eliminar parametros
	if(is_array($rcDelParams)){
		foreach($rcDelParams as $param){
			$contexto = $param['contexto'];
			$modulo = $param['modulo'];
			$nombre = $param['nombre'];
			
			if(!$contexto){ //Debe aplicar a todos los contextos
				$cantContextos = count($unserialized);
				for($x=0; $x<$cantContextos;$x++)
					unset($unserialized[$x][$modulo][$nombre]);		
			}else{
				//Elimina
				unset($unserialized[$contexto][$modulo][$nombre]);
			}
		}
	}
	
	return $unserialized;
}


function save($obj, $filename) {

	if (!is_object($obj) && !is_array($obj)) {
		echo "trying to serialize a non-object\n";
		return false;
	} else {

		$SerializedObj = serialize($obj);

		$fp = @ fopen($filename, "w");
		if (!$fp) {
			echo "cannot open file $filename \n";
			return false;
		}

		$write = @ fwrite($fp, $SerializedObj);
		if (!$write) {
			echo "error writing serialized data to $filename";
			return false;
		}

		$close = fclose($fp);
		if (!$close) {
			echo "error closing the serialisation file $filename \n";
			return false;
		}

		return true;
	}
}

function fncintdatehour() {
	$rctoday = getdate();
	return $rctoday["mon"].$rctoday["mday"].$rctoday["year"].$rctoday["hours"].$rctoday["minutes"].$rctoday["seconds"];
}
?>
