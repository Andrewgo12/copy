<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdAddCategoria {

    function execute()
    {
        extract($_REQUEST);

        if(($categoria__catenombres != NULL) && ($categoria__catenombres != ""))
        {
        	//Revisamos el formato de los campos alfanuméricos
        	$sbdbnull = Application :: getConstant("DB_NULL");
        	$objServ = Application::loadServices("Data_type");
        	if ($categoria__catedescris)
				$categoria__catedescris = $objServ->formatString($categoria__catedescris);
			else
				$categoria__catedescris = $sbdbnull;
	
        	//Obtenemos el consecutivo para la tabla entrada
			$objNumerador = Application::getDomainController("NumeradorManager");
			$categoria__catecodigon = $objNumerador->fncgetByIdNumerador("categoria");
			
			//Guardamos
            $categoria_manager = Application::getDomainController('CategoriaManager'); 
            $message = $categoria_manager->addCategoria($categoria__catecodigon,$categoria__catenombres,$categoria__catedescris,$categoria__cateactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }
        else
        {
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>