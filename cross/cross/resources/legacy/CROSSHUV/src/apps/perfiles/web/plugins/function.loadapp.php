<?php  
/**
*   Propiedad intelectual del FullEngine.
*	
*	Carga una aplicacion para un auasrio
*	@param array  
*	@author creyes
*	@date 02-ago-20049:15:54
*	@location Cali-Colombia
*/
function smarty_function_loadapp($params, & $smarty) {

	//Pone en sesion los datos del usuario
	$_authsession = Application :: getUserParam();
	if (!is_array($_authsession))
		return false;
		
	
	//Determina si es la misma aplicacion de profiles
	if ($_authsession["application"] == "profiles")
		echo "<script language=\"javascript\">location='index.php?action=FePrCmdViewApp'</script>";
	else
		echo "<script language=\"javascript\">location='../".$_authsession["application"]."/index.php'</script>";
	
}

?>