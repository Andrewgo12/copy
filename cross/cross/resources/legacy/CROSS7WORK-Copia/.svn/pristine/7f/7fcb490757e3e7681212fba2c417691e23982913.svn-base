<?php

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     textfield
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of the textfield (optional)
 *           type = define the type of the textfield (required)
 *           id = id of the textfield (optional)
 *           value = puts text inside the textfield (optional)
 *           size = Long of the textfield (optional)
 *           typeData = define the type of data that you can introduce (optional)
 *           readonly = readonly ('true'|'false') (optional)
 *           disabled = disabled the textfield (optional)
 *           onClick =  introduce code javascript (optional)
 *           maxlength = Maximum of characters of the textfield (optional)
 *
 *
 *
 * Examples : {textfield name="textfield" type="text" size="60" value="LIDIS"}
 *
 *
 *
 * --------------------------------------------------------------------
 */
function smarty_function_proctiempon($params, &$smarty)
{
    extract($params);
    extract($_REQUEST);
    $generalService = Application::loadServices('General');
    $paramHour = $generalService->getParam('workflow','PROC_HOURS');
    //Determina la validacion de tipo de dato
    ////////////////////// INTERNET EXPLORER / OPERA ////////////////////////////
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
        $dataVal = " onkeypress=\"if (!((event.keyCode>=48) && (event.keyCode<=57)))";
        $dataVal .= " event.returnValue = false;\"";
    }
    ////////////////////////////NETSCAPE/////////////////////////////
    else{
        $dataVal = " onkeypress=\"if (!((event.charCode>=48) && (event.charCode<=57) ||";
        $dataVal .= " (event.charCode == 0) || (event.charCode == 8)))";
		$dataVal .= " event.preventDefault();\"";
    }
    
    $rcHtml[] = "<input id=\"proctiempon\" name=\"proceso__proctiempon\" maxlength=\"4\" value=\"".$_REQUEST['proceso__proctiempon']."\" $dataVal>";
    if($paramHour == false){
        $dataVal = "disabled=\"true\"";
    }
    $rcHtml[] = "<input id=\"horas\" name=\"horas\" maxlength=\"2\" value=\"".$_REQUEST['horas']."\" $dataVal>";
    return implode("\n",$rcHtml);
}

?>
