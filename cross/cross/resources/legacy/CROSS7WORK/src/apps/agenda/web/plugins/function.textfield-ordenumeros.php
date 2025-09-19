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
function smarty_function_textfield_ordenumeros($params, &$smarty)
{
    extract($params);
    extract($_REQUEST);
    
    settype($objService,"object");
    settype($sbHtml,"string");
    settype($sbAuto,"string");
    
    $sbHtml .= "<input";
    if (isset($name)){
        $sbHtml .= " name='".$name."'";
    }
    if (isset($type))
        $sbHtml .= " type='".$type."'";
    else
        $sbHtml .= " type='text'";

    if (isset($id)){
        $sbHtml .= " id='".$id."'";
    }
    if (isset($value)){
        $sbHtml .= " value='".$value."'";
    }else{
    	if(strstr($action,"ShowById")==false)
    		$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
    	$cadStrip = htmlspecialchars($_REQUEST[$name]);
        $sbHtml .= " value=\"$cadStrip\"";
    }
    if (isset($size)){
        $sbHtml .= " size='".$size."'";
    }
    //Determina el maxlength desde los parametros
    $sbAuto = Application :: getConstant("COD_AUT_REQ");
    if($sbAuto===false){
        $objService = Application::loadServices('General');
        $maxlength = $objService->getParam("cross300","MAXLENGTH_ORDENUMEROS");
    }
    
    if(isset($maxlength)){
        $sbHtml .= " maxlength='".$maxlength."'";
    }

    if (isset($disabled)){
        $sbHtml .= " disabled='".$disabled."'";
    }
    if (isset($readonly)){
        if (($readonly == "true")||($readonly == "True")){
           $sbHtml .= " readonly";
        }
    }
    if (isset($onClick)){
        $sbHtml .= " onClick='".$onClick."'";
    }
    if(isset($onChange)){
    	$sbHtml .= " onChange=\"".$onChange."\"";
    }
    if(isset($onBlur)){
    	$sbHtml .= " onBlur=\"".$onBlur."\"";
    }
    
    ////////////////////// INTERNET EXPLORER / OPERA ////////////////////////////
    
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
     if (isset($typeData)){
        if ($typeData == 'int'){
         $sbHtml .= " onkeypress=\"if (!((event.keyCode>=48) && (event.keyCode<=57)))";
         $sbHtml .= " event.returnValue = false;\"";
        }
        if ($typeData == 'double'){
         $sbHtml .= " onkeypress=\"if(event.keyCode != 45){";
         $sbHtml .= " if(event.keyCode != 46){";
         $sbHtml .= " if(!((event.keyCode>=48) && (event.keyCode<=57)))";
         $sbHtml .= " event.returnValue = false;";
         $sbHtml .= " }else{if((value.indexOf('.') != -1) || (value == '-') || (value.length == 0))";
		 $sbHtml .= " event.returnValue = false;}";
         $sbHtml .= " }else{if(value.length != 0)event.returnValue = false;}\"";
        }
        if ($typeData == 'string'){
         $sbHtml .= " onkeypress=\"if (!(((event.keyCode>=97) && (event.keyCode<=122)) ||";
         $sbHtml .= " ((event.keyCode>=65) && (event.keyCode<=90)) || (event.keyCode==32)";
         $sbHtml .= " || (event.keyCode==241) || (event.keyCode==209)))";
         $sbHtml .= " event.returnValue = false;\"";
        }
     }
    }

    ////////////////////////////NETSCAPE/////////////////////////////

    else{
     if (isset($typeData)){
        if ($typeData == 'int'){
         $sbHtml .= " onkeypress=\"if (!((event.charCode>=48) && (event.charCode<=57) ||";
         $sbHtml .= " (event.charCode == 0) || (event.charCode == 8)))";
		 $sbHtml .= " event.preventDefault();\"";
		}
        if ($typeData == 'double'){
         $sbHtml .= " onkeypress=\"if(event.charCode != 45){";
         $sbHtml .= " if(event.charCode != 46){";
         $sbHtml .= " if(!((event.charCode>=48) && (event.charCode<=57) || (event.charCode == 0) ||";
         $sbHtml .= " (event.charCode == 8)))";
         $sbHtml .= " event.preventDefault();";
         $sbHtml .= " }else{if((value.indexOf('.') != -1) || (value == '-') || (value.length == 0))";
		 $sbHtml .= " event.preventDefault();}";
         $sbHtml .= " }else{if(value.length != 0)event.preventDefault();}\"";
        }
        if ($typeData == 'string'){
         $sbHtml .= " onkeypress=\"if (!(((event.charCode>=97) && (event.charCode<=122)) ||";
         $sbHtml .= " ((event.charCode>=65) && (event.charCode<=90)) || (event.charCode==32)";
         $sbHtml .= " || (event.charCode==241) || (event.charCode==209) ||";
         $sbHtml .= " (event.charCode == 0) || (event.charCode == 8)))";
         $sbHtml .= " event.preventDefault();\"";
        }
     }
    }
    $sbHtml .= ">";
    
    return $sbHtml;

}

?>
