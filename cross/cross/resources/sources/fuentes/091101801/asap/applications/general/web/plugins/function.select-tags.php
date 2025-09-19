<?php

/*
 * Smarty plugin
 * Type:     function
 * Name:     select_tags
 * Version:  1.0
 * Date:     28-Oct-2004
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
 *       {select_tags name="Mycombo" }
 *       {select_tags name="Mycombo"  label="dname" size="5" is_null="true"}
 *
 *		Se modifica el plugin para habilitarlo para que en el onchange del select haga un submit
 * Input:
       $command = is the name of the command
       form_name =is the form name(required)
 */

function smarty_function_select_tags($params, & $smarty) {

	settype($rcOpcion, "array");
	settype($rcTmp, "array");
	settype($sbOption, "string");
	settype($sbHtml, "string");
	settype($sbOnchange, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	extract($params);

	if ($id_tag) {
		$rcOpcion = Application :: getConstant($id_tag);

		if (!isset ($dojoObject)) {
			
			if (!isset ($size)) {
				$size = 1;
			}

			if (isset ($onchange)) {
				$sbOnchange = " onChange= \"".$onchange.";\"";
			} else {
				if (isset ($command)) {
					$sbOnchange = " onChange= \"action.value = '".$command."';".$form_name.".submit();\" ";
				}
			}

			if (isset ($id)) {
				$id = " id= '$id' ";
			}

			$sbHtml .= "<select name='$name' size='$size' ".$id." ".$sbOnchange.">";
			if ($is_null == "true") {
				$sbHtml .= "<option value=''>---</optional>";
			}

			$nuCant = sizeof($rcOpcion);
			for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {

				$rcTmp = $rcOpcion[$nuCont];
				$sbOption .= "<option value='";
				$sbOption .= $rcTmp["value"];
				if ($_REQUEST[$name] == $rcTmp["value"]) {
					$sbOption .= "' selected>";
				} else {
					$sbOption .= "'>";
				}
				$sbOption .= $rcTmp["label"];
				$sbOption .= "</option>";
			}

			$sbHtml .= $sbOption;
			$sbHtml .= "</select>";

			return $sbHtml;
		} else {
			//Obtiene los datos del usuario
			$rcuser = Application :: getUserParam();
			if (!is_array($rcuser)) {
				//Si no existe usuario en sesion 
				$rcuser["lang"] = Application :: getSingleLang();
			}
			include_once ($rcuser["lang"]."/".$rcuser["lang"].".tags.php");

			$sbHtml .= '<table width=\"100%\" id="toolbar">';
			foreach ($rcOpcion as $key => $rcData) {
				if($nuCont==0){
					$sbHtml .= '<tr align="center">';
				}
				$sbHtml .= '<td><a href="#" id="paste_'.$key.'">['.$rclabels[$rcData['label']]['label'].']</a></td>';
				$sbHtml .= '<script language="JavaScript" type="text/javascript">
									    						var pasteButton = dojo.byId("paste_'.$key.'");
									    						dojo.event.connect(pasteButton, "onclick", function(){
									        					var editableRT = dojo.widget.byId("'.$widgetId.'");
									        					editableRT.execCommand("inserthtml", "['.$rcData['value'].']");
									    					});</script>';
				if($nuCont==3){
					$sbHtml .= '</tr>';
					$nuCont = 0;
				}else{
					$nuCont ++;
				}
			}
			$sbHtml .= '</table>';
			return $sbHtml;
		}
	}
}
?>