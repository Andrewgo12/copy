<?php
/**
	Copyright 2014 FullEngine
	Comando que limpia la sesion y saca al usuario del sistema
	@author freina<freina@fullengine.com>
	@date 22-Oct-2014 15:07
	@location Cali - Colombia
*/
class CmdExit {
    function execute() {
    	
    	settype($sbHtml,"string");
		//Limpia la sesion
		session_unset();
		$sbHtml = '<script language="javascript">';
		$sbHtml .= 'parent.location.href="../profiles/index.php';
		if($_REQUEST["cod_message"]){
			$sbHtml .= '?cod_message='.$_REQUEST["cod_message"].'"'; 
    	}else{
    		$sbHtml .= '"';
    	}
		$sbHtml .= '</script>';
		echo $sbHtml;
		return "success";
    }
}
?>