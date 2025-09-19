<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta un input type password
*	@param array  
*	@author creyes
*	@date 02-ago-20049:15:54
*	@location Cali-Colombia
*/

function smarty_function_password($params, &$smarty)
{
    extract($params);
    $html_result = '';
    $html_result .= "<input";
    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    if (isset($type))
        $html_result .= " type='".$type."'";
    else
        $html_result .= " type='password'";

    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }else{
        $html_result .= " value='".$_REQUEST[$name]."'";
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
    
    ////////////////////// INTERNET EXPLORER / OPERA ////////////////////////////
    
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
     if (isset($typeData)){
        if ($typeData == 'int'){
         $html_result .= " onkeypress=\"if (!((event.keyCode>=48) && (event.keyCode<=57)))";
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
        if ($typeData == 'string'){
         $html_result .= " onkeypress=\"if (!(((event.keyCode>=97) && (event.keyCode<=122)) ||";
         $html_result .= " ((event.keyCode>=65) && (event.keyCode<=90)) || (event.keyCode==32)";
         $html_result .= " || (event.keyCode==241) || (event.keyCode==209)))";
         $html_result .= " event.returnValue = false;\"";
        }
     }
    }

    ////////////////////////////NETSCAPE/////////////////////////////

    else{
     if (isset($typeData)){
        if ($typeData == 'int'){
         $html_result .= " onkeypress=\"if (!((event.charCode>=48) && (event.charCode<=57) ||";
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
        if ($typeData == 'string'){
         $html_result .= " onkeypress=\"if (!(((event.charCode>=97) && (event.charCode<=122)) ||";
         $html_result .= " ((event.charCode>=65) && (event.charCode<=90)) || (event.charCode==32)";
         $html_result .= " || (event.charCode==241) || (event.charCode==209) ||";
         $html_result .= " (event.charCode == 0) || (event.charCode == 8)))";
         $html_result .= " event.preventDefault();\"";
        }
     }
    }
    $html_result .= ">";
    
    print $html_result;

}

?>