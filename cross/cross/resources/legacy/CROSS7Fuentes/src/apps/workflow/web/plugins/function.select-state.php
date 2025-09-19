<?php      
/*
 * Smarty plugin
 * Type:     function
 * Name:     select_state_table
 * Version:  1.0
 * Date:     23-Sep-2004
 * Author:	 freina<freina@parquesoft.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      size = this sets the number of visible choices (optional)
 *      option = group of values to show (required)
 *      is_null = especifica si el 'select_row_table' debe tener el valor nulo.  'true|false' (optional)
 *      onchange = especifica la funcion javascript que debe ejecutarse en el onchange
 *
 * Examples: 
 *       {select_state name="Mycombo" }
 *       {select_state name="Mycombo"  label="dname" size="5" is_null="true"}
 *
 *		Se modifica el plugin para habilitarlo para que en el onchange del select haga un submit
 * Input:
       $command = is the name of the command
       form_name =is the form name(required)
 */

function smarty_function_select_state($params, & $smarty) {

	settype($rcuser, "array");
	settype($rcopcion, "array");
	settype($rctmp, "array");
	settype($sboption, "string");
	settype($sbhtml_result, "string");
	settype($sbonchange, "string");
	settype($nucant, "integer");
	settype($nucont, "integer");
	extract($params);

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}

	include ($rcuser["lang"]."/".$rcuser["lang"].".state.php");

	switch ($option) {
		case 1 :
			$rcopcion = $rcstate[0];
			break;	
		default :
			}

	if (!isset ($size)) {
		$size = 1;
	}

	if (isset ($onchange)) {
		$sbonchange = " onChange= \"".$onchange.";\"";
	} else {
		if (isset ($command)) {
			$sbonchange = " onChange= \"action.value = '".$command."';".$form_name.".submit();\" ";
		}
	}

	if (isset ($id)) {
		$id = " id= '$id' ";
	}

	$sbhtml_result .= "<select name='$name' size='$size' ".$id." ".$sbonchange.">";
	if ($is_null == "true") {
		$sbhtml_result .= "<option value=''>---</optional>";
	}

	$nucant = sizeof($rcopcion);
	for ($nucont = 0; $nucont < $nucant; $nucont ++) {

		$rctmp = $rcopcion[$nucont];
		$sboption .= "<option value='";
		$sboption .= $rctmp["value"];
		if ($_REQUEST[$name] == $rctmp["value"]) {
			$sboption .= "' selected>";
		} else {
			$sboption .= "'>";
		}
		$sboption .= $rctmp["label"];
		$sboption .= "</option>";
	}

	$sbhtml_result .= $sboption;
	$sbhtml_result .= "</select>";
	print $sbhtml_result;
}
?>