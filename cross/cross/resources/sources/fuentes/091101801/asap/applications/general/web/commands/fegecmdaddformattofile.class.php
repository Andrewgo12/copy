<?php    
/**
*   Propiedad intelectual del FullEngine.
*   
*   Este comando recive el archivo y lo pone en el servidor
*   @author freina
*   @date 14-Sep-2004 
*   @location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddFormattofile {
	function execute() {
		settype($objtmp, "object");
		settype($objServ, "object");
		settype($rcarchivo, "array");
		settype($sbpath, "string");
		settype($sbmessage, "string");
		settype($sbresult, "string");
		settype($sbmaxtamfile, "string");
		settype($sbUmask,"string");
		settype($numaxtamfile, "double");

		extract($_REQUEST);
		//Se valida si se ha determinado la configuracion del archivo
		if ($configarchiv__cogacodigos == NULL && $configarchiv__cogacodigos == "") {
			WebRequest :: setProperty('cod_message', $message = 6);
			return "fail";
		}
		//Se obtiene la data del archivo
		$rcarchivo = WebRequest :: getPostFiles("formattofile__pathtofile");
		if (!$rcarchivo["name"]) {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}

		//Se valida que el tamaño del archivo no sea mayor a el limite configurado e el php.ini
		$objServ = Application :: loadServices("Data_type");
		$sbmaxtamfile = ini_get("upload_max_filesize");
		$numaxtamfile = $objServ->string_to_bytes($sbmaxtamfile);
		if ($numaxtamfile < $rcarchivo["size"]) {
			WebRequest :: setProperty('cod_message', $message = 17);
			return "fail";
		}

		//ruta en donde quedara el archivo
		$sbpath = Application :: getTmpDirectory();
		
		if(!is_dir($sbpath)){
			$sbUmask = umask(0);
			mkdir($sbpath, 0775);
			umask($sbUmask);
		}
		
		//se valida que el archivo se pueda escribir
		clearstatcache();
		$sbresult = is_writeable($sbpath);
		if (!$sbresult) {
			WebRequest :: setProperty('cod_message', $message = 5);
			return "fail";
		}
		//se completa la ruta del archivo
		$sbpath .= "/".$rcarchivo["name"];
		//se sube al servidor
		$sbresult = copy($rcarchivo["tmp_name"], $sbpath);
		if (!$sbresult) {
			WebRequest :: setProperty('cod_message', $message = 5);
			return "fail";
		}
		//resultado exitoso
		$rcarchivo["path"] = $sbpath;
		$objtmp = Application :: getDomainController('FormattoFileManager');
		$sbmessage = $objtmp->fncformattofile($configarchiv__cogacodigos, $rcarchivo);
		WebRequest :: setProperty('cod_message', $sbmessage);
		return "success";
	}
}
?>	