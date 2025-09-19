<?php  
/**
*   Propiedad intelectual del FullEngine.
*	
*	Consulta desde el NavigationFile de una aplicación los comandos validos y los pinta
*	@param array  
*	@author creyes
*	@date 10-ago-2004 11:28:56
*	@location Cali-Colombia
*/

function smarty_function_viewcommands($params, & $smarty) {
	extract($params);
	//Consulta el nombre de la Aplicación
	$ActCom_manager = Application :: getDomainController('ActualCommandsManager');
	$ActCom_manager->getAppName($applcodigos);
	if (!$ActCom_manager->AppName)
		return null;

	//Actualiza los caomndos en la DB	
	$ActCom_manager->actualCommads($applcodigos);
	if (!is_array($ActCom_manager->rcInsertComm))
		return null;

	//descarga de sesion las particularidades del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	//Pinta la tabla
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	//$rcHtml[] = "<div align='center'><th>".$rclabels["actuliza_title"]["label"].$ActCom_manager->AppName."</th><div>";
	$rcHtml[] = "<table cellSpacing='1' cellPadding='3' align='center' border='0'>";
	$rcHtml[] = "<tr><th colspan='2'><div align=\"left\">".$rclabels["actualiza_title"]["label"].$ActCom_manager->AppName."</div></th></tr>";
	$rcHtml[] = "\t<tr><td class='titulofila'>".$rclabels["commnombres"]["label"]."</td>";
	$rcHtml[] = "\t<td class='titulofila'>".$rclabels["applcodigos"]["label"]."</th></td>";
	$nuCont = 0;
	foreach ($ActCom_manager->rcInsertComm as $command) {
		//Selecciona el interlineado
		if(fmod($nuCont,2) == 0)
			$clase = "celda";
			else
				$clase = "celda2";
		$rcHtml[] = "\t<tr><td class='$clase'>$command</td>";
		$rcHtml[] = "\t<td class='$clase'>".$ActCom_manager->AppName."</td></tr>";
		$nuCont++;
	}
	$rcHtml[] = "</table>";
	unset ($ActCom_manager);
	return implode("\n", $rcHtml);
}
?>