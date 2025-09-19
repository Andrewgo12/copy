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

function smarty_compiler_putjsacceskey($params, &$smarty) 
{
	settype($rclabels,"array");
	settype($rclabelscommands,"array");
	settype($rcvalue,"array");
	settype($sbhtml_result,"string");
	settype($sbkey,"string");
	
	$rclabels = WebSession::getProperty("labels");
	$rclabelscommands = WebSession::getProperty("labelscommands");
	
	$sbhtml_result=	"echo \"\\n\".'<script language=\"javascript\">'.\"\\n\"";
	if($rclabels){
		foreach($rclabels as $sbkey => $rcvalue){
			if($rcvalue[1]){
				$sbhtml_result.=".'	jsAccessKey(\'".$sbkey."\',\'".$rcvalue[1]."\');'.\"\\n\"";
			}
		}
	}
	
	unset($rcvalue);
	if($rclabelscommands){
		foreach($rclabelscommands as $sbkey => $rcvalue){
			$sbhtml_result.=".'	jsAccessKey(\'".$sbkey."\',\'".$rcvalue[1]."\',\'".$rcvalue[0]."\');'.\"\\n\"";
		}
	}
	
	$sbhtml_result.=	".'</script>'.\"\\n\";";	
	return $sbhtml_result;
}
?>