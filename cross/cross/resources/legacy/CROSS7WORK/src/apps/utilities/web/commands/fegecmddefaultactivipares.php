<?php
require_once "Web/WebRequest.class.php";
class FeGeCmdDefaultActiviPares {
    function execute()
    {
    	extract($_REQUEST);
    	
		//SI limpia el $_REQUEST
		if($clean_table)
		{
			$cargo_manager = Application::getDomainController("ParamsManager"); 
			$cargo_manager->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
        return "success";  
    }
}
?>
