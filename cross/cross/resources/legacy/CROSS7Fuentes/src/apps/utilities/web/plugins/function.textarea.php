<?php

/*
* Smarty plugin
* --------------------------------------------------------------------
* Type:     block
* Name:     textarea
* Version:  1.0
* Date:     Oct 20, 2003
* Author:	 Leider Vivas <leiderv@hotmail.com>
* Purpose:
* Input:
*           name = name of the textarea (optional)
*           cols = cols of the textarea (optional)
*           rows = rows of the textarea (optional)
*           wrap = wrap of the textarea (optional)
*           id = id of the textarea (optional)
*           disabled = disabled the textarea (optional)
*           readonly = only read (optional)
*
*
* Examples : {textarea name="textarea" cols="12" rows="3" wrap="OFF" value="lidis"}
*             USB
*            {/textarea}
*
*Update : Se modifica para que si se ingresa la longitud maxima como parametro
*se asuma, de lo contario se toma el valor por default
*Autor : freina<freina@parquesoft.com>
*Date : 05-Dec-2005
*New variable nuMax
*
* --------------------------------------------------------------------
*/
function smarty_function_textarea($params,&$smarty,$content)
{
	extract($params);
	extract($_REQUEST);
	
	//MAXLENGTH_TEXTAREA
	if(!$nuMax){
		$objServices = Application::loadServices("General");
		$nuMax = $objServices->getParam("general","MAXLENGTH_TEXTAREA");
	}
	
	$html_result = '';
	$html_result .= '<script>function ismaxlength(obj){var mlength=parseInt(obj.getAttribute("maxlength"));if(obj.getAttribute && obj.value.length>mlength)obj.value=obj.value.substring(0,mlength)};</script>';
	$html_result .= "<textarea maxlength=".$nuMax;
	if (isset($name))
	{
		$html_result .= " name='".$name."'";
	}
	$html_result .= " cols='60'";
	$html_result .= " rows='5'";
	if (isset($wrap))
	{
		$html_result .= " wrap='".$wrap."'";
	}
	if (isset($id))
	{
		$html_result .= " id='".$id."'";
	}
    if (isset($accesskey))
    	$html_result .= " accesskey='".$accesskey."'";
	if (isset($disabled))
	{
		$html_result .= " disabled='".$disabled."'";
	}
	if (isset($readonly))
	{
		$html_result .= " readonly='".$readonly."'";
	}
	//$html_result .= ' onkeyup="return ismaxlength(this)"';
	$html_result .= ">";
	
	if ($content != '')
	{
		$html_result .= $content;
	}
	else
	{
		if((strstr($action,"ShowById")==false) && strstr($action,"CancelShowList")==false)
			$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
		$html_result .= $_REQUEST[$name];
	}
	$html_result .= "</textarea>";
	return $html_result;
}

?>