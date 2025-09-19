<?php
/**
 *   Propiedad intelectual del FullEngine.
 *
 *	Pinta el menu de la aplicacion
 *	@param array
 *	@author freina <freina@parquesoft.com>
 *	@date 20-Dic-2004 14:44
 *	@location Cali-Colombia
 */
function smarty_function_printmenu($params, & $smarty) {

	settype($objtmp, "object");
	settype($objxh, "object");
	settype($objXslDoc,"object");
	settype($objXmlDoc,"object");
	settype($rcuser, "array");
	settype($sbprefix, "string");
	settype($sbpath, "string");
	settype($sbpathXml, "string");
	settype($sbpathXsl,"string");
	settype($sbpathcache, "string");
	settype($sbresult, "string");
	settype($sbname, "string");
	settype($sbclassname, "string");
	settype($sbcachename, "string");

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if(!is_array($rcuser)){
		return null;	
	}
	if(!$rcuser["schema"] && $rcuser["schecodigon"]) {
		$rcuser["schema"] = $rcuser["schecodigon"];
		WebSession::setProperty("_authsession",$rcuser);
	}
	

	//Path del modulo
	$sbpath = Application :: getBaseDirectory();

	//Path del Xml
	$sbpathXml = $sbpath."/../profiles/config/profiles/".$rcuser["schecodigon"]."_".$rcuser["prof_code"].".xml";
	if(!file_exists($sbpathXml)){
		return null;	
	}
	$sbpathXsl = $sbpath."/xslt/GenerateMenu.xsl";

	$sbcachename = Application :: getConstant("CACHE_MENU");

	//valida si el archivo a cambiado
	$objtmp = Application :: getDomainController("AdministerCacheManager");
	$sbresult = $objtmp->ValidateCache($sbpathXml, $sbcachename);

	$sbprefix = Application :: getConstant("PROFILE");
	$sbname = Application :: getAppId().$sbprefix."_".$rcuser["schecodigon"]."_".$rcuser["prof_code"];

	//Nombre de la clase
	$sbclassname = $sbname.".class.php";

	//Ruta del cache
	$sbpathcache = Application :: getDirCache()."/";

	if ($sbresult) {

		$objXslDoc = new DOMDocument();
		$objXslDoc->load($sbpathXsl);

		$objXmlDoc = new DOMDocument();
		$objXmlDoc->load($sbpathXml);

		$objxh = new XSLTProcessor();
		$objxh->importStylesheet($objXslDoc);
		$objxh->setParameter('','code',"_".$rcuser["schecodigon"]."_".$rcuser["prof_code"]);
		$sbresult = $objxh->transformToXML($objXmlDoc);

		if (!($sbresult===false)) {
			$handle = fopen($sbpathcache.$sbclassname, "w");
			fwrite($handle,$sbresult);
			fclose($handle);
			include_once($sbpathcache.$sbclassname);
			$objtmp = new $sbname();
			$objtmp->printmenu();
		}

	} else {
		include_once($sbpathcache.$sbclassname);
		$objtmp = new $sbname();
		$objtmp->printmenu();
	}
}
?>