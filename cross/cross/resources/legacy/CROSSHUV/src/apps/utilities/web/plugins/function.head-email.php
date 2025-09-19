<?php  
/*
 * Smarty plugin
 * Type:     function
 * Name:     head_email
 * Version:  1.0
 * Date:     11-Oct-2004
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  it draws the head of the email in fieldset object
 * Input:
 *
 * Examples:  
 *
 *
 */
function smarty_function_head_email($params, & $smarty) {
	settype($rcuser, "array");
	settype($sbhtml_result, "string");
	settype($sbcontext_head, "string");
	extract($params);
	extract($_REQUEST);

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}

	if ($emaidesdes && $emaiparas) {
		include_once ($rcuser["lang"]."/".$rcuser["lang"].".emailpreview.php");

		$sbcontext_head .= $rclabels["emaidesdes"]["label"]." $emaidesdes<br>";
		$sbcontext_head .= $rclabels["emaiparas"]["label"]." $emaiparas<br>";
		$sbcontext_head .= $rclabels["emaiasuntos"]["label"]." $emaiasuntos<br>";
		$sbcontext_head .= $rclabels["emaifecenvn"]["label"]." $emaifecenvn<br>";

		if (!$sbcontext_head) {
			return "&nbsp;";
		}

		//Escapa las comillas dobles y las sencillas
		$sbcontext_head = str_replace('"', '\\"', $sbcontext_head);
		$sbcontext_head = str_replace("'", "\\'", $sbcontext_head);
		$sbhtml_result = "<fieldset class=context_help>";
		$sbhtml_result .= "&nbsp;&nbsp;";
		$sbhtml_result .= $sbcontext_head;
		$sbhtml_result .= "</fieldset>";
	}
	return $sbhtml_result;
}
?>