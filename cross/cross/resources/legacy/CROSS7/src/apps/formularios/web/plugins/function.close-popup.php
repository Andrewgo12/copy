
<?php 
/*** @Copyright 2004
* 
* listo las estrategias creadas, si no hay, retorno un espacio en blanco
*/
function smarty_function_close_popup($params, & $smarty)
{
	extract($params);
	extract($_REQUEST);
	$rcUser = Application :: getUserParam();
	if(!is_array($rcUser))
	return;
	
	if(!isset($propiedad__proptipopros))
	   return false;
	
	//incluimos las librerias de lenguaje
	include ($rcUser["lang"]."/".$rcUser["lang"].".topbar.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	
	$rcCommands = Application::getConstant('COMMAND_FORM');
	
	$sbHtml = '<script language="javascript">
				opener.document.frmFormulario.action.value="'.$rcCommands[$propiedad__proptipopros].'";
				opener.document.frmFormulario.submit();
				window.close();
			  </script>';
	
	return $sbHtml;
}
?>