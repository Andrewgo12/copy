<?php 
/*
 * Smarty plugin
 * Type:     function
 * Name:     menu_frame
 * Version:  1.0
 * Date:     08-Jul-2005
 *  Author:                                freina<freina@parquesoft.com>
 * Purpose: display a Frameset 
 * Input: frame_principal:
 *
 * Examples: {menu_frame
 * frame_principal="" 
 * }
 *
 */
function smarty_function_tree_frame($params, & $smarty) {
	extract($params);
	extract($_REQUEST);
	
	settype($sbTemplate,"string");
	settype($sbHtml,"string");

	$sbTemplate = $frame_principal
	."&table=".$table
	."&sqlid=".$sqlid
	."&return_obj=".$return_obj
	."&return_key=".$return_key
	."&father=".$father
	."&son=".$son
	."&label=".$label;
	
	switch ($sqlid) {
			case "organizacion" :
				$sbTemplate .= "&organizacion__organombres=".$orgacodigos_desc;
				break;
			case "localizacion" :
				$sbTemplate .= "&localizacion__locanombres=".$locacodigos_desc;
				break;
	}
	
	if($value){
		$sbTemplate .="&valor=".$value;
	}
	
	if($param){
		$sbTemplate .="&param=".$param;
	}
	
	$sbHtml .= "<frameset rows='*' cols='*' frameborder='NO' border='0' framespacing='0'> \n";
	$sbHtml .= "<frame src='".$sbTemplate."' name='treeFrame' scrolling='AUTO'>\n";
	$sbHtml .= "</frameset>\n";
	$sbHtml .= "<noframes>\n";
	$sbHtml .= "<body>\n";
	$sbHtml .= "Parece que su navegador no soporta Frames!!!.\n";
	$sbHtml .= "</body>\n";
	$sbHtml .= "</noframes>\n";

	print $sbHtml;
}
?>