<?php
class FeGeProfile_2_4 {
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Pinta el menu de la aplicacion
	*	@author freina <freina@parquesoft>
	*   @date 18-Dic-2004 16:10 
	*	@location Cali-Colombia
	*/
	function printmenu() {
		settype($objArbol, "object");
         settype($objService, "object");
		settype($rctmp, "array");
         settype($rclabels, "array");
		settype($rcuser, "array");
		settype($rctmpf, "array");
		settype($rctmps, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nuindicef, "integer");
		settype($nuindices, "integer");

		include_once ('HTML_Menu.php');
		
		//Obtiene los datos del usuario
		$rcuser = Application::getUserParam();
		if(!is_array($rcuser)){
			//Si no existe usuario en sesion 
			$rcuser["lang"] = Application::getSingleLang();
		}
         
          //Se obtiene el arreglo con los labels
          $objService = Application :: loadServices("Profiles");
          $rclabels = $objService->getMetaProfilesLabels($rcuser["lang"]);
	
		$objArbol = new HTML_TreeMenu("menuLayer1", 'web/images/menu');
	
		$rcnode[]=array("son"=>"cross", "father"=>"");
	$rcnode[]=array("son"=>"cross300", "father"=>"cross");
	$rcnode[]=array("son"=>"registro_cross", "father"=>"cross300");
	$rcnode[]=array("son"=>"FeCrCmdDefaultOrden", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultAdminTareas", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultRevertPerformance", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultSolucion", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"reportes_cross", "father"=>"cross300");
	$rcnode[]=array("son"=>"FeCrCmdDefaultFichaOrd", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultListadoOrden", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultConsolidado", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultDetallado", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultReqeps", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultIndoprequre", "father"=>"reportes_cross");
	$cross = new HTML_TreeNode($rclabels["cross"],"");
	$cross300 = new HTML_TreeNode($rclabels["cross300"],"");
	$registro_cross = new HTML_TreeNode($rclabels["registro_cross"],"");
	$FeCrCmdDefaultOrden = new HTML_TreeNode($rclabels["FeCrCmdDefaultOrden"],"javascript:fncLoadCmd(\'FeCrCmdDefaultOrden\',\'cross300\')");
	$FeCrCmdDefaultAdminTareas = new HTML_TreeNode($rclabels["FeCrCmdDefaultAdminTareas"],"javascript:fncLoadCmd(\'FeCrCmdDefaultAdminTareas\',\'cross300\')");
	$FeCrCmdDefaultRevertPerformance = new HTML_TreeNode($rclabels["FeCrCmdDefaultRevertPerformance"],"javascript:fncLoadCmd(\'FeCrCmdDefaultRevertPerformance\',\'cross300\')");
	$FeCrCmdDefaultSolucion = new HTML_TreeNode($rclabels["FeCrCmdDefaultSolucion"],"javascript:fncLoadCmd(\'FeCrCmdDefaultSolucion\',\'cross300\')");
	$reportes_cross = new HTML_TreeNode($rclabels["reportes_cross"],"");
	$FeCrCmdDefaultFichaOrd = new HTML_TreeNode($rclabels["FeCrCmdDefaultFichaOrd"],"javascript:fncLoadCmd(\'FeCrCmdDefaultFichaOrd\',\'cross300\')");
	$FeCrCmdDefaultListadoOrden = new HTML_TreeNode($rclabels["FeCrCmdDefaultListadoOrden"],"javascript:fncLoadCmd(\'FeCrCmdDefaultListadoOrden\',\'cross300\')");
	$FeCrCmdDefaultConsolidado = new HTML_TreeNode($rclabels["FeCrCmdDefaultConsolidado"],"javascript:fncLoadCmd(\'FeCrCmdDefaultConsolidado\',\'cross300\')");
	$FeCrCmdDefaultDetallado = new HTML_TreeNode($rclabels["FeCrCmdDefaultDetallado"],"javascript:fncLoadCmd(\'FeCrCmdDefaultDetallado\',\'cross300\')");
	$FeCrCmdDefaultReqeps = new HTML_TreeNode($rclabels["FeCrCmdDefaultReqeps"],"javascript:fncLoadCmd(\'FeCrCmdDefaultReqeps\',\'cross300\')");
	$FeCrCmdDefaultIndoprequre = new HTML_TreeNode($rclabels["FeCrCmdDefaultIndoprequre"],"javascript:fncLoadCmd(\'FeCrCmdDefaultIndoprequre\',\'cross300\')");

	
		$nucant = sizeof($rcnode);
		for ($nucont = 0; $nucont<$nucant; $nucont ++) {
			if (!$rcnode[$nucont]["father"]) {
				$rctmpf[$nuindicef] = $rcnode[$nucont];
				$nuindicef ++;
				$this->fncseleccion($rcnode[$nucont]["son"], $rcnode, $rctmps, "father", "son", $nuindices);
			}
		}
	
		$nucant = sizeof($rctmps);
		for($nucont = 0; $nucont<$nucant;$nucont++){
			$rctmp = $rctmps[$nucont];
			$$rctmp["father"]->addItem($$rctmp["son"]);
		}
	
		$nucant = sizeof($rctmpf);
		for($nucont = 0; $nucont<$nucant;$nucont++){
			$rctmp = $rctmpf[$nucont];
			$objArbol->addItem($$rctmp["son"]);
		}
	
		$objArbol->printMenu();	
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Inicia el formateo de la matriz utilizada para pintar el arbol
	*   @param $ircdata array   Data total
	*   @param $ircpadre array  Data acumulada
	*   @param $isbpadre string Codigo a analizar
	*   @param $isbindpadre string Indice Padre
	*   @param $isbindhijo string   Indice hijo
	*   @param $inuindice integer   Indice consecutivo
	*   @author freina <freina@parquesoft>
	*   @date 18-Dic-2004 16:10 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $ircdata, & $ircpadre, $isbindpadre, $isbindhijo, & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont<$nucant; $nucont ++) {
			if ($ircdata[$nucont][$isbindpadre] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont][$isbindhijo], $ircdata, $ircpadre, $isbindpadre, $isbindhijo, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont];
				$inuindice ++;
			}
		}
		return;
	}
}
?>