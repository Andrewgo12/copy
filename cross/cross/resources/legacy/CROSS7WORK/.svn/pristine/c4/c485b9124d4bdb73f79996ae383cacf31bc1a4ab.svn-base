<?php
/*
 * Created on 18/08/2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function smarty_function_text_editor($params, & $smarty) {

	extract($params);
	settype($sbString, "string");
	settype($sbBorder, "string");

	if ($border) {
		$sbBorder .= " style=\"border:1px solid #1c4ab9;\"";
	}
	
	$sbString .="<table width=\"100%\"><tr tr align=\"center\"><td>";
	$sbString .= "<div dojoType=\"Editor2\" " .
	//"toolbarTemplatePath=\"".$toolbarTemplatePath."\" " .
	"toolbarGroup=\"\" " .
	"focusOnLoad=\"false\" " .
	"widgetId=\"".$widgetId."\" " .
	"id=\"".$id."\" ".
	$sbBorder.">";
	$sbString .= '</div>';
	$sbString .="</td></tr></table>";

	return $sbString;
}
?>