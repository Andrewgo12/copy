
<?php 
/*** @Copyright 2004
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"
* queryparam=" perscodigos,persnombres"}
*/
function smarty_function_printlogo($params, & $smarty)
{
    extract($params);
    extract($_REQUEST);
    
    $rcUser = Application :: getUserParam();
    if(!is_array($rcUser))
    	return;
    
	$objProfiles = Application::loadServices("Profiles");
	$rcCliente = $objProfiles->loadLogoCliente();
	$sbLogo = $rcCliente["cliecodigon"];
	
	$path_parts=pathinfo($rcCliente['clielogos']);
   	$sbExtension = $path_parts["extension"];
   	
	$sbNombre = $rcCliente["clienombres"];
	$objProfiles->close();
    	
    $pathimage = "web/images/".$sbLogo.".".$sbExtension;
    $sbHtml ='<img src="'.$pathimage.'" name="logo"><B>'.$sbNombre.'</B>';
    return $sbHtml;
}
?>