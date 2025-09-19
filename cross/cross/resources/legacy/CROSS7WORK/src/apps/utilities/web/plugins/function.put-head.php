<?php
/*
 * Smarty plugin
 * Type:     function
 * Name:     put_Head
 * Version:  1.0
 * Date:     Jun 11, 2007
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  display the communication's head 
 * Input:
 *           name = name of the image (required)
 *           form_name = name of the form that content image (required)
 *           icon = file (and path) of image (optional)
 *			 id=object id (required)
 *			 jsfunction=function (required)
 *			 command=command (required)
 *
 * Examples:  
 *
 *
 */
function smarty_function_put_Head($params, & $smarty) {

	settype($objManager, "object");
	settype($objService, "object");
	settype($rcTmp, "array");
	settype($rcUser, "array");
	settype($sbHtml, "string");
	settype($sbPath, "string");
	extract($params);
	
	
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

	$objManager = Application :: getDomainController("EmpresaManager");
	$objService = Application :: loadServices("Data_type");

	//se obtiene la informacion de la empresa
	$rcTmp = $objManager->getByIdEmpresa();
	
	//Arma la ruta de la imagen
	$sbPath = Application :: getImagesDirectory()."/".$rcTmp["emprlogos"];
	
	$sbHtml .= "<table width=\"90%\"  border=\"0\" align=\"center\">";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class='piedefoto' width=\"89%\" height=\"84\"><div align=\"center\"><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 9px; \">".$rcmessages[63]."</span></div>      " ;
	$sbHtml .= "<p align=\"center\" style=\"font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-weight: bold;\">".$rcmessages[64]."</p>";
	$sbHtml .= "<p align=\"center\" style=\"font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-weight: bold;\">".$rcmessages[65]."</p></td>";
	$sbHtml .= "<td width=\"11%\"><img src=\"".$sbPath."\" width=\"97\" height=\"88\"></td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "</table>";
	
	
	$sbHtml = $objService->encode($sbHtml);

	echo $sbHtml;
}
?>
