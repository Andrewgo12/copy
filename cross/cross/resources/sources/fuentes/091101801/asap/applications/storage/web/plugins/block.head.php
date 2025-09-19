<?php
/**
 *   Propiedad intelectual del FullEngine.
 *
 *	Pinta el bloque para el body
 *	@param array
 *	@author freina
 *	@date 17-Jun-2004 11:59
 *	@location Cali-Colombia
 */

function smarty_block_head($params, $content, &$smarty){

	settype($sbHtml,"string");
	settype($sbCharset,"string");
	extract($params);
	
	if (!isset($content))
		return;
	
	$sbCharset = Application :: getCharset();
	if(!$sbCharset){
		$sbCharset = 'iso-8859-1';
	}
	
	$sbHtml = '<head>';
	$sbHtml .= '	<meta http-equiv="Content-Type" content="text/html; charset='.$sbCharset.'" />';
	$sbHtml .= $content;
	$sbHtml .= '</head>';
	print $sbHtml;
}
?>