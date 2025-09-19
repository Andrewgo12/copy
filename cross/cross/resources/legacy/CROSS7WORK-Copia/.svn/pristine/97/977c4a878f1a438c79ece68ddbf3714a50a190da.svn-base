<?php
function smarty_compiler_printlabel($params, &$smarty) 
{
	settype($rctmp,"array");
	settype($rctmpindice,"array");
	settype($rclabels,"array");
	settype($nucont,"integer");
	settype($nucant,"integer");
	settype($sbtmp,"string");

	//se organiza el arreglo
	if(isset($params))
		parse_str($params);
	if(!$name)
		return;
	$rclabels = WebSession::getProperty("labels");
	if(!is_array($rclabels))
		$sbtmp .= $name;
	else
		$sbtmp .= $rclabels[$name][0];
	if($blBold)
		$sbtmp = "<B>".$sbtmp."</B>";
	return  "echo \"$sbtmp \"";
}
?>