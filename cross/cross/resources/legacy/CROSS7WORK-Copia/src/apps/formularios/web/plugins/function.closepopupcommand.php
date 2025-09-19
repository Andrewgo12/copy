
<?php 
/*** @Copyright 2004
* 
* listo las estrategias creadas, si no hay, retorno un espacio en blanco
*/
function smarty_function_closePopupCommand($params, & $smarty)
{
	extract($params);
	extract($_REQUEST);
	echo $id;
	if($action==$command_name || $id==3)
		return "<script>window.close();</script>";
}
?>