<?php    
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdSendEmail {
	function execute() {

		settype($objServ, "object");
		settype($email_manager,"object");
		settype($objCentroEmail, "object");
		settype($rcarchivo, "array");
		settype($sbmessage, "string");
		settype($sbmaxtamfile, "string");
		settype($sbpath, "string");
		settype($sbresult, "string");
		settype($sbUmask,"string");
		settype($numaxtamfile, "integer");
		extract($_REQUEST);

		if (($email__emaiparas != NULL) && ($email__emaiparas != "") 
		&& ($email__emaiasuntos != NULL) && ($email__emaiasuntos != "") 
		&& ($email__ordenumeros != NULL) && ($email__ordenumeros != "") 
		&& ($email__emaitextos != NULL) && ($email__emaitextos != "")) {

			$objServ = Application :: loadServices("Data_type");

			if (!$objServ->IsEmail($email__emaiparas)) {
				WebRequest :: setProperty('cod_message', $sbmessage = 29);
				return "fail";
			}

			$email__emaiasuntos = $objServ->formatString($email__emaiasuntos);

			$email__emaitextos = $objServ->formatString($email__emaitextos);

			//Se obtiene la data del archivo
			$rcarchivo = WebRequest :: getPostFiles("email__emaiadjuntos");
			if ($rcarchivo["name"]) {
				
				//Se valida que el tamaño del archivo no sea mayor a el limite configurado e el php.ini
				$sbmaxtamfile = ini_get("upload_max_filesize");
				$numaxtamfile = $objServ->string_to_bytes($sbmaxtamfile);
				if ($numaxtamfile < $rcarchivo["size"]) {
					WebRequest :: setProperty('cod_message', $sbmessage = 17);
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
					WebRequest :: setProperty('cod_message', $sbmessage = 5);
					return "fail";
				}
				//se completa la ruta del archivo
				$sbpath .= "/".$rcarchivo["name"];
				//se sube al servidor
				$sbresult = copy($rcarchivo["tmp_name"], $sbpath);
				if (!$sbresult) {
					WebRequest :: setProperty('cod_message', $sbmessage = 5);
					return "fail";
				}
				//resultado exitoso
				$rcarchivo["path"][0] = $sbpath;
			}
			
			$objCentroEmail = Application :: getDomainController('CentroEmailManager');
			$sbmessage = $objCentroEmail->fncSendEmail($email__emaiparas, $email__emaiasuntos, $email__ordenumeros, $email__emaitextos, $email__foemcodigos, $rcarchivo);
			WebRequest :: setProperty('cod_message', $sbmessage);
			if($sbmessage==3){
				$email_manager = Application::getDomainController("EmailManager"); 
				$email_manager->UnsetRequest();
			}
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>	