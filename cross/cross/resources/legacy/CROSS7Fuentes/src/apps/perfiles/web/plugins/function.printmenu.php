<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta el menu de la aplicacion
*	@param array  
*	@author creyes
*	@date 01-Jul-2004 14:01 
*	@location Cali-Colombia

upgrade:
    Add multilanguage features
    mrestrepo
    ene 5 2006
*/
function smarty_function_printmenu($params, &$smarty) 
{
	extract($params);
	
        //Obtiene los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}
    include_once($rcuser["lang"]."/".$rcuser["lang"].".menu.php");
        
	include_once('menu/HTML_Menu.php');

	$objArbol  = new HTML_TreeMenu("menuLayer1", 'web/images/menu');
	
	$rcobjgral[0] = new HTML_TreeNode($rclabels["profiles"]["label"], "","");
		$rcobj[0] = new HTML_TreeNode($rclabels["users"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultAuth\')");	
		$rcobj[1] = new HTML_TreeNode($rclabels["profiles"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultProfiles\')");	
		$rcobj[2] = new HTML_TreeNode($rclabels["permissions"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultPermisions\')");	
	foreach ($rcobj as $obj)
		$rcobjgral[0]->addItem($obj);
	

	unset($rcobj);
	$rcobjgral[1] = new HTML_TreeNode($rclabels["basic"]["label"], "","");
		$rcobj[0] = new HTML_TreeNode($rclabels["schemas"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultSchema\')");
		$rcobj[1] = new HTML_TreeNode($rclabels["languages"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultLanguage\')");
		$rcobj[2] = new HTML_TreeNode($rclabels["styles"]["label"], "javascript:fncLoadCmd(\'FePrCmdDefaultStyle\')");
	foreach ($rcobj as $obj)
		$rcobjgral[1]->addItem($obj);
	
	//foreach($rcobjgral as $obj)
	$objArbol->addItem($rcobjgral[1]);
	$objArbol->addItem($rcobjgral[0]);
	
	
	$objArbol->printMenu();
	return;
}
?>