<?php
require_once "Web/WebRequest.class.php";
Class FeScCmdUpdateCategoria 
{
    function execute()
    {
        extract($_REQUEST);

        if(($categoria__catecodigon != NULL) && ($categoria__catecodigon != "") 
        && ($categoria__catenombres != NULL) && ($categoria__catenombres != ""))
        {
        	//Revisamos el formato de los campos alfanuméricos
        	$sbdbnull = Application :: getConstant("DB_NULL");
        	$objServ = Application::loadServices("Data_type");
        	if ($categoria__catedescris)
				$categoria__catedescris = $objServ->formatString($categoria__catedescris);
			else
				$categoria__catedescris = $sbdbnull;
	
            $categoria_manager = Application::getDomainController('CategoriaManager'); 
            $message = $categoria_manager->updateCategoria($categoria__catecodigon,$categoria__catenombres,$categoria__catedescris,$categoria__cateactivas); 
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