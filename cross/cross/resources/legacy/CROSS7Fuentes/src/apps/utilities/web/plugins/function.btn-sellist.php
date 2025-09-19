<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta un boton dependiendo de si existen las listas de seleccion en la forma
*	@param string  $applcodigos 
*	@param string  $perfcodigos 
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/
function smarty_function_btn_selList($params, &$smarty)
{
    extract($params);
    extract($_REQUEST);
    
	if (!$applcodigos || !$profcodigos)
		return false;
    
    $html_result = '';
    $html_result .= "<input class=boton";

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

    $html_result .= " onClick=\"";
    
    if (isset($onClick)){
        $html_result .= $onClick;
    }
    
/*    if (($type == "Button")||($type == "button")){
        $html_result .= "action.value = '".$name."';".$form_name.".submit();";
    }

    if (($type == "Submit")||($type == "submit")){
        $html_result .= "action.value = '".$name."';";
    }
*/
    //cierra la doble comilla del onClick
    $html_result .= "\"";

    $html_result .= ">";
    
    print $html_result;

}

?>
