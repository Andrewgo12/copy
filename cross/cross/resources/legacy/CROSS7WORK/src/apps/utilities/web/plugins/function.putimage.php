<?php   
/*
 * Smarty plugin
 * Type:     function
 * Name:     putimage
 * Version:  1.0
 * Date:     Oct 17, 2003
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  display image
 * Input:
 *           name = name of the image (required)
 *           form_name = name of the form that content image (required)
 *           icon = file (and path) of image (optional)
 *			 id=object id (required)
 *			 jsfunction=function (required)
 *			 command=command (required)
 *
 * Examples:  
 *
 *
 */
function smarty_function_putimage($params, & $smarty) {
	
	settype($rcuser, "array");
	settype($sbhtml_result, "string");
	settype($sbicon, "string");
	settype($sbid, "string");
	settype($sbname, "string");
	extract($params);
	
	//Obtiene los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}
	
	include($rcuser["lang"]."/".$rcuser["lang"].".generic.php");

	if (isset ($sbicon)) {
		$sbicon = "src='".$icon."'";
	}

	if (isset ($id)) {
		$sbid = " id=\"$id\" ";
	}
	if (isset ($name)) {
		$sbname = " name=\"$name\" ";
	}
	
	$sbhtml_result .= "<a href=\"#\" onclick=\"javascript:".$jsfunction."('".$command."');\" onMouseOver=\"window.status='".$rclabels_crl[$id]."'; return true;\" $sbname $sbid><img "
	.$sbicon."  border=\"0\" align=\"middle\" alt='".$rclabels_crl[$id]."';></a>";
	print $sbhtml_result;
}
?>