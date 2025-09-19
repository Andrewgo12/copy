<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pone el estilo de las formas
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_function_get_schemas($params, &$smarty) 
{
	extract($params);
	$rcUser = Application::getUserParam();
	
	//Consulta los esquemas del usuario
	$objGateway = Application :: getDataGateway("Extend");
	$rcSchemas = $objGateway->getUserSchemas($rcUser['username']);

	if(!is_array($rcSchemas))
		return null;
	
	foreach($rcSchemas as $rcTmp){
		$rcHtml[] =  "<tr>";
		$rcHtml[] =  "    <td><div align='left'><b>{$rcTmp['schenombres']}</b><br>{$rcTmp['scheobservas']}</div></td>";
		$rcHtml[] =  "    <td><a href='index.php?action=FePrCmdSetschema&schecodigon={$rcTmp['schecodigon']}'><img src='web/images/adelante_002.gif' border='0' title='{$rcTmp['schenombres']}'></a></td>";
		$rcHtml[] =  "    <td class='piedefoto'></td>";
		$rcHtml[] =  "</tr>";
	}	
	return implode("\n",$rcHtml);
}
?>