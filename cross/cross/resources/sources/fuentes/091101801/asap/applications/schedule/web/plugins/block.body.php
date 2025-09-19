<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta el bloque para el body
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_block_body($params, $content, &$smarty) 
{
	if (!isset($content))
		return;
	if(!is_array($params))
	{
		return "<body>$content</body>";
	}
    $html_result = "<body";
	foreach($params as $event => $function)
		$html_result .=  " $event=\"$function\" ";		
	$html_result .= ">\n";
	$html_result .= $content."\n";
	$html_result .= "</body>";
	return $html_result;
}
?>