<?php
require_once "Web/WebRequest.class.php";
Class FeScCmdActiveEntrada
{
    function execute()
    {
        extract($_REQUEST);
        if(($entrada__entrcodigon != NULL) && ($entrada__entrcodigon != ""))
        {
        	$sbStatus = Application::getConstant("ENTRY_CONFIR_STATUS");
            $entrada_manager = Application::getDomainController('EntradaManager');
            $message = $entrada_manager->updateStatusEntrada($entrada__entrcodigon,$sbStatus);
            
            $message = $entrada_manager->updateDescripcionEntrada($entrada__entrcodigon,$justif);
            
            $_REQUEST["date"] = $date;
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