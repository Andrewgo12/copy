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
function smarty_function_textfield($params, &$smarty)
{
    extract($params);
    extract($_REQUEST);
    
    $html_result = '';
    $html_result .= "<input";
    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    if (isset($type))
        $html_result .= " type='".$type."'";
    else
        $html_result .= " type='text'";

    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($accesskey))
        $html_result .= " accesskey='".$accesskey."'";
    if($_REQUEST[$name])
    {
    	if((strstr($action,"ShowById")==false) && strstr($action,"CancelShowList")==false)
			$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
		$value = htmlspecialchars($_REQUEST[$name]);
    }
    if ($value)
    {
        $html_result .= ' value="'.$value.'" ';
    }
    
    if (isset($size)){
        $html_result .= " size='".$size."'";
    }
    if (isset($maxlength)){
        $html_result .= " maxlength='".$maxlength."'";
    }
    if (isset($disabled)){
        $html_result .= " disabled='".$disabled."'";
    }
    if (isset($readonly)){
        if (($readonly == "true")||($readonly == "True")){
           $html_result .= " readonly";
        }
    }
    if (isset($onClick)){
        $html_result .= " onClick='".$onClick."'";
    }
    if(isset($onChange)){
    	$html_result .= " onChange=\"".$onChange."\"";
    }
    if(isset($onBlur)){
    	$html_result .= " onBlur=\"".$onBlur."\"";
    }
    
    ////////////////////// INTERNET EXPLORER / OPERA ////////////////////////////
	
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
     if (isset($typeData)){
        if ($typeData == 'int' || strstr($typeData,"int")){
         $html_result .= " onkeyup=\"if (!((event.keyCode>=48) && (event.keyCode<=57)))";
         $html_result .= " event.returnValue = false;\"";
        }
        if ($typeData == 'double'){
         $html_result .= " onkeypress=\"if(event.keyCode != 45){";
         $html_result .= " if(event.keyCode != 46){";
         $html_result .= " if(!((event.keyCode>=48) && (event.keyCode<=57)))";
         $html_result .= " event.returnValue = false;";
         $html_result .= " }else{if((value.indexOf('.') != -1) || (value == '-') || (value.length == 0))";
		 $html_result .= " event.returnValue = false;}";
         $html_result .= " }else{if(value.length != 0)event.returnValue = false;}\"";
        }
        /*if ($typeData == 'string'){
         $html_result .= " onkeypress=\"if (!(((event.keyCode>=97) && (event.keyCode<=122)) ||";
         $html_result .= " ((event.keyCode>=65) && (event.keyCode<=90)) || (event.keyCode==32)";
         $html_result .= " || (event.keyCode==241) || (event.keyCode==209) || (event.keyCode==225) || (event.keyCode==233)
          || (event.keyCode==237) || (event.keyCode==243) || (event.keyCode==250) || (event.keyCode==193) || (event.keyCode==201)
           || (event.keyCode==205) || (event.keyCode==211) || (event.keyCode==218)))";
         $html_result .= " event.returnValue = false;\"";
        }*/
     }
    }

    ////////////////////////////NETSCAPE/////////////////////////////

    else{
     if (isset($typeData)){
        if ($typeData == 'int' || strstr($typeData,"int")){
         $html_result .= " onkeyup=\"if (!((event.charCode>=48) && (event.charCode<=57) ||";
         $html_result .= " (event.charCode == 0) || (event.charCode == 8)))";
		 $html_result .= " event.preventDefault();\"";
		}
        if ($typeData == 'double'){
         $html_result .= " onkeypress=\"if(event.charCode != 45){";
         $html_result .= " if(event.charCode != 46){";
         $html_result .= " if(!((event.charCode>=48) && (event.charCode<=57) || (event.charCode == 0) ||";
         $html_result .= " (event.charCode == 8)))";
         $html_result .= " event.preventDefault();";
         $html_result .= " }else{if((value.indexOf('.') != -1) || (value == '-') || (value.length == 0))";
		 $html_result .= " event.preventDefault();}";
         $html_result .= " }else{if(value.length != 0)event.preventDefault();}\"";
        }
        /*if ($typeData == 'string'){
         $html_result .= " onkeypress=\"if (!(((event.charCode>=97) && (event.charCode<=122)) ||";
         $html_result .= " ((event.charCode>=65) && (event.charCode<=90)) || (event.charCode==32)";
         $html_result .= " || (event.charCode==241) || (event.charCode==209) ||";
         $html_result .= " (event.charCode == 0) || (event.charCode == 8) || (event.charCode==225) || (event.charCode==233)
          || (event.charCode==237) || (event.charCode==243) || (event.charCode==250) || (event.charCode==193) || (event.charCode==201)
           || (event.charCode==205) || (event.charCode==211) || (event.charCode==218)))";
         $html_result .= " event.preventDefault();\"";
        }*/
     }
    }
    $html_result .= ">";
    
    return $html_result;

}

?>
