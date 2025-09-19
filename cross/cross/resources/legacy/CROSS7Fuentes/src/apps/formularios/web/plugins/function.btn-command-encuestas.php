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

function smarty_function_btn_command_encuestas($params, &$smarty)
{
    extract($params);
    extract($_REQUEST);
    
    if(!isset($showButton))
    	return false;
    if($action)
    {
    	if(strstr($action,"CmdShowById") || strstr($action,"CmdUpdate"))
    	{
    		if(strstr($name,"CmdAdd"))
    			return false;
    	}
    	if(strstr($action,"CmdAdd") || strstr($action,"CmdDefault") || strstr($action,"CmdDelete"))
    	{
    		if(strstr($name,"CmdUpdate"))
    			return false;
    	}
    }
    
    $html_result = '';
    $html_result .= "<input class=boton";

	//Hace la validacion de permisos
	if(Application :: validateProfiles($name) == false)
		$disabled = "true";
    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    if (isset($type)){
        $html_result .= " type='".$type."'";
    }
    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }
    if (isset($disabled)){
        $html_result .= " disabled='".$disabled."'";
    }

    $html_result .= " onClick=\"var result = doClick$name(); if(result){";
    
    if (isset($onClick)){
        $html_result .= $onClick;
    }
    if (($type == "Button")||($type == "button")){
        $html_result .= "action.value = '".$name."';".$form_name.".submit();";
    }
    if (($type == "Submit")||($type == "submit")){
        $html_result .= "action.value = '".$name."';";
    }
    //cierra la doble comilla del onClick
    $html_result .= "}\"";
    $html_result .= ">";

    if(isset($loadFields))
    {
        $rcFields = explode(",",$loadFields);
        if(is_array($rcFields))
        {
        	$rcUser = Application :: getUserParam();
        	if (!is_array($rcUser)) 
        	{
            	//Si no existe usuario en sesion 
            	$rcUser["lang"] = Application :: getSingleLang();
        	}
        	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        	
            foreach($rcFields as $field)
                $rcJs[] = "!document.$form_name.$field.value";
            $jsFieldls = "if(".implode(" || ",$rcJs)."){
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
        include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        $jsConfirm = " var result = confirm('{$rcmessages[$confirm]}');
            if(result == false){enableButtons(); return false;}";
        
    }
    $html_result .= "<script language='javascript'>
        function doClick$name(){
            disableButtons();
            ".$jsFieldls ."
            ".$jsConfirm;
    if(isset($userFunc))
    {
      $html_result .="blresp=";
    	$html_result .= $userFunc;
    	$html_result .="
    	 if(blresp == false)
    	{
    	   enableButtons();
    	   return false;
    	}
    	 else";
    }
    $html_result .= " return true;
        }
        </script>";
    
    return $html_result;

}

?>
