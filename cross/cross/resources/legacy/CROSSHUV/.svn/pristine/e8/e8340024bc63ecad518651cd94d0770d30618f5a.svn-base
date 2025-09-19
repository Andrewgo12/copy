<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_viewPiedePagina($params, & $smarty) {
	extract($_REQUEST);
	
	$rcuser = Application :: getUserParam();
	include ($rcuser["lang"]."/".$rcuser["lang"].".fichaord.php");

	//Firmas
	$rcHtml[] = "<table align='center' cellpadding=0 cellspacing=0 border=1 width='100%'>";
	$rcHtml[] = "<tr><td rowspan=3 align='center' class='piedefoto'><B>".$rclabels['comentarios']['label']."</B><BR><BR><BR></td></tr>";
    $rcHtml[] = "</table>";
	$rcHtml[] = "<table align='center' cellpadding=0 cellspacing=0 border=0 width='100%'>";
	$rcHtml[] = "<tr><td><BR></td></tr>";
	$rcHtml[] = "<tr>";
	$rcHtml[] = "<td align='center' class='piedefoto'>______________________________</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>______________________________</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>______________________________</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>______________________________</td>";
	$rcHtml[] = "</tr>";
	$rcHtml[] = "<tr>";
	$rcHtml[] = "<td align='center' class='piedefoto'>".$rclabels['firma']['label']."</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>".$rclabels['registro']['label']."</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>".$rclabels['funcionario']['label']."</td>";
	$rcHtml[] = "<td align='center' class='piedefoto'>".$rclabels['lider']['label']."</td>";
	$rcHtml[] = "</tr>";
    $rcHtml[] = "</table>";
	echo implode("\n", $rcHtml);
}
?>