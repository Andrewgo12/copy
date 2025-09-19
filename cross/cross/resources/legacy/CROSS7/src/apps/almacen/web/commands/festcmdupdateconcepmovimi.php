<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateConcepmovimi {
    function execute()
    {
        extract($_REQUEST);
        if(($concepmovimi__comocodigos != NULL) && ($concepmovimi__comocodigos != "") && ($concepmovimi__comonombres != NULL) && ($concepmovimi__comonombres != "") && ($concepmovimi__comosentidos != NULL) && ($concepmovimi__comosentidos != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($concepmovimi__comocodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$concepmovimi__comodescrips = $objServ->formatString($concepmovimi__comodescrips);
            $concepmovimi_manager = Application::getDomainController('ConcepmovimiManager'); 
            $message = $concepmovimi_manager->updateConcepmovimi($concepmovimi__comocodigos,$concepmovimi__comonombres,$concepmovimi__comosentidos,$concepmovimi__comodescrips,$concepmovimi__comoactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
