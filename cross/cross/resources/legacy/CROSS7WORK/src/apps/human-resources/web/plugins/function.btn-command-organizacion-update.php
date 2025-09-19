<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     btn_command
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of btn_command (optional)
 *           id = id of btn_command (optional)
 *           type = define the type of the btn_command ('button'|'submit')(required)
 *           disabled = disable the btn_command (optional)
 *           onClick = To introduce code javascript (optional)
 *           value = define the label of the btn_command (optional)
 *           form_name = nombre de la forma que contiene el btn_command
 *                      (SI type = 'button' entonces form_name es requerido)
 *           loadFields = Campos de la forma que deben estar cargados para ejecutar dicha acción,
 *                          separados por coma. (optional)
 *           confirm = numero del mensaje para hacer confirmación antes de ejecutar la acción (optional).
 *
 *
 * Examples : {btn_command type="button" form_name="frmPais" value="Modificar" name="CmdUpdatePais" onClick="alert('click al button');"}
 *            {btn_command type="submit" value="Adicionar" name="CmdAddPais" onClick="alert('click al submit');"}
 *
 *
 * --------------------------------------------------------------------
 */

function smarty_function_btn_command_organizacion_update($params, &$smarty)
{

	settype($objService, "object");
	settype($rcFields, "array");
	settype($rcUser, "array");
	settype($rcJs, "array");
	settype($rcState, "array");
	settype($sbHtml, "string");
	settype($sbField, "string");
	settype($sbJsConfirm, "string");
	settype($sbJsFieldls, "string");
	settype($sbState, "string");
	settype($sbTmp, "string");
	settype($sbMessage, "string");
	settype($nuCont, "integer");

	extract($params);
	$objService = Application :: loadServices("General");
	$rcState = $objService->getParam("human_resources", "ORG_INACT");

	$sbHtml .= "<input class=boton";

	//Hace la validacion de permisos
	if(Application :: validateProfiles($name) == false)
	$disabled = "true";
	if (isset($name)){
		$sbHtml .= " name='".$name."'";
	}
	if (isset($type)){
		$sbHtml .= " type='".$type."'";
	}
	if (isset($id)){
		$sbHtml .= " id='".$id."'";
	}
	if (isset($value)){
		$sbHtml .= " value='".$value."'";
	}
	if (isset($disabled)){
		$sbHtml .= " disabled='".$disabled."'";
	}

	$sbHtml .= " onClick=\"var result = doClick$name(); if(result){";

	if (isset($onClick)){
		$sbHtml .= $onClick;
	}
	if (($type == "Button")||($type == "button")){
		$sbHtml .= "action.value = '".$name."';".$form_name.".submit();";
	}
	if (($type == "Submit")||($type == "submit")){
		$sbHtml .= "action.value = '".$name."';";
	}
	//cierra la doble comilla del onClick
	$sbHtml .= "}\"";
	$sbHtml .= ">";

	if(isset($loadFields))
	{
		$rcFields = explode(",",$loadFields);
		if(is_array($rcFields) && $rcFields)
		{
			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser))
			{
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
			 
			foreach($rcFields as $sbField)
			$rcJs[] = "!document.$form_name.$sbField.value";
			$sbJsFieldls = "if(".implode(" || ",$rcJs)."){
                alert('".$rcmessages[0]."');
                enableButtons();
            	putFocus();
                return false;
            }";
		}
	}
	
	if(isset($confirm)){
		
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		$sbMessage = html_entity_decode($rcmessages[$confirm]);
		
		//se valida que el estdo al cual se quiere colocar la dependencia este parametrizado como inactivo
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		if(is_array($rcState) && $rcState){
			foreach($rcState as  $nuCont=>$sbState){
				$rcState[$nuCont]= "document.".$form_name.".esorcodigos.value == '".$sbState."'";
			}
			
			$sbTmp = implode(" || ",$rcState);
			$sbJsConfirm .= " if(".$sbTmp."){ ";
			$sbJsConfirm .= "var result = confirm('".html_entity_decode($rcmessages[28])."');if(result == false){enableButtons(); return false;}";
			$sbJsConfirm .=" }else{";
			$sbJsConfirm .= "var result = confirm('".$sbMessage."');if(result == false){enableButtons(); return false;}";			
			$sbJsConfirm .=" }";
		}else{
			$sbJsConfirm .= "var result = confirm('".$sbMessage."');if(result == false){enableButtons(); return false;}";	
		}
	}
	
	$sbHtml .= "<script language='javascript'>
        function doClick$name(){
            disableButtons();
            $sbJsFieldls
            $sbJsConfirm
            return true;
        }
        </script>";

            print $sbHtml;

}
?>