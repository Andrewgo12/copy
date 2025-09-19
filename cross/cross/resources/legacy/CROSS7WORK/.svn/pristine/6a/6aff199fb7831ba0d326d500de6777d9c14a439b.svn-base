<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta un javascript quesetea ewl acceskey de los inputs
*	@param array  
*	@author freina
*	@date 17-Jul-2004 13:47 
*	@location Cali-Colombia
*/

function smarty_function_putjsacceskey_pub($params, &$smarty) 
{
	settype($rclabels,"array");
	settype($rclabelscommands,"array");
	settype($rcvalue,"array");
	settype($sbhtml_result,"string");
	settype($sbkey,"string");
	
	$rclabels = WebSession::getProperty("labels");
	$rclabelscommands = WebSession::getProperty("labelscommands");
	
	$sbhtml_result=	"<script language=\"javascript\">";
	if($rclabels){
		foreach($rclabels as $sbkey => $rcvalue){
			if($rcvalue[1]){
				$sbhtml_result.="jsAccessKey('".$sbkey."','".$rcvalue[1]."');";
			}
		}
	}
	
	unset($rcvalue);
	if($rclabelscommands){
		foreach($rclabelscommands as $sbkey => $rcvalue){
			$sbhtml_result.="jsAccessKey('".$sbkey."','".$rcvalue[1]."','".$rcvalue[0]."');";
		}
	}
	
	$sbhtml_result.=	"</script>";	
	return $sbhtml_result;
	
}
?>