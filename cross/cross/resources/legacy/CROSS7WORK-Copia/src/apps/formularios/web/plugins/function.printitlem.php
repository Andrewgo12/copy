<?php 
/*** @Copyright 2004
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"
* queryparam=" perscodigos,persnombres"}
*/
function smarty_function_printitlem($params, & $smarty)
{
	extract($params);
	extract($_REQUEST);
	
	$rcUser = Application :: getUserParam();
	if(!is_array($rcUser))
	 return;
	 
  include($rcUser["lang"]."/".$rcUser["lang"].".tipopropiedad.php");
	
	if(!is_array($rclabels))
		$sbtmp .= "";
	else
		$sbtmp .= "<b>".$rclabels[$propiedad__proptipopros]["label"]."</b>";
	
	return  $sbtmp;
   
}
?>