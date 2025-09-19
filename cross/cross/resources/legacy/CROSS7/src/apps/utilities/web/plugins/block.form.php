<?php


/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     block
 * Name:     form
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of the form (optional)
 *           action = value of the action (optional)
 *           method = value of the method (optional)
 *           enctype = value of the enctype (optional)
 *           target = value of the target (optional)
 *
 *
 * Examples : {form name="FActualizarUsuario" method="post" action="destino.php"}
 *             
 *            {/form}
 *
 *
 * --------------------------------------------------------------------
 */

function smarty_block_form($params, $content, & $smarty) {
	extract($params);
	settype($sbHtml, "string");

	if (isset ($content)) {
		$sbHtml .= "<form";
		if ($action != '') {
			$sbHtml .= " action=\"$action\"";
		}
		if ($method != '') {
			$sbHtml .= " method=\"$method\"";
		}
		if ($enctype != '') {
			$sbHtml .= " enctype=\"$enctype\"";
		}
		if ($name != '') {
			$sbHtml .= " name=\"$name\"";
		}
		if ($target != '') {
			$sbHtml .= " target=\"$target\"";
		}
		if ($id != '') {
			$sbHtml .= " id=\"$id\"";
		}
		if ($dojoType != '') {
			$sbHtml .= " dojoType=\"$dojoType\"";
		}
		$sbHtml .= ">";
		$sbHtml .= $content;
		$sbHtml .= "</form>";
		print $sbHtml;
	}
}
?>