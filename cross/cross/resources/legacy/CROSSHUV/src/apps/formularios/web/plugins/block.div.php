<?php

/*
 * Smarty plugin
 * Type:     function
 * Name:     div
 * Version:  1.0
 * Date:     March 01 2006
 * Author:	 freina<freina@parquesoft.com>
 * Purpose:
 * Input:
 *           name = name of the textfield (optional)
 *           id = id of the textfield (optional)
 * 			 disabled = disabled the textfield (optional)
 *
 *
 *
 * Examples : {div name="textfield" id="id"}
 */
function smarty_block_div($params, $content, & $smarty) {
	extract($params);
	settype($sbHtml, "string");

	if (isset ($content)) {
		$sbHtml .= "<div ";

		if (isset ($id)) {
			$sbHtml .= " id='".$id."'";
		}
		if (isset ($align)) {
			$sbHtml .= " align='".$align."'";
		}
		$sbHtml .= " style=\"visibility:hidden;display:'none';height:0\"";
		$sbHtml .= ">";
		$sbHtml .= $content;
		$sbHtml .= "</div>";

		print $sbHtml;
	}
}
?>