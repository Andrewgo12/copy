<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- El modo al que transformarÃ¡ el XSL --> 
<xsl:output  method="text"/>
<!-- Abre y cierra el documento PHP -->
<xsl:param name="code"/>    
<xsl:template match="profile">&lt;?php
class FeGeProfile<xsl:value-of select="$code"/> {
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Pinta el menu de la aplicacion
	*	@author freina &lt;freina@parquesoft&gt;
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
	
	<xsl:apply-templates select="action" mode="array"/>
	<xsl:apply-templates select="action" mode="node"/>
	
		$nucant = sizeof($rcnode);
		for ($nucont = 0; $nucont&lt;$nucant; $nucont ++) {
			if (!$rcnode[$nucont]["father"]) {
				$rctmpf[$nuindicef] = $rcnode[$nucont];
				$nuindicef ++;
				$this->fncseleccion($rcnode[$nucont]["son"], $rcnode, $rctmps, "father", "son", $nuindices);
			}
		}
	
		$nucant = sizeof($rctmps);
		for($nucont = 0; $nucont&lt;$nucant;$nucont++){
			$rctmp = $rctmps[$nucont];
			$$rctmp["father"]->addItem($$rctmp["son"]);
		}
	
		$nucant = sizeof($rctmpf);
		for($nucont = 0; $nucont&lt;$nucant;$nucont++){
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
	*   @author freina &lt;freina@parquesoft&gt;
	*   @date 18-Dic-2004 16:10 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, &amp; $ircdata, &amp; $ircpadre, $isbindpadre, $isbindhijo, &amp; $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont&lt;$nucant; $nucont ++) {
			if ($ircdata[$nucont][$isbindpadre] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont][$isbindhijo], $ircdata, $ircpadre, $isbindpadre, $isbindhijo, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont];
				$inuindice ++;
			}
		}
		return;
	}
}
?&gt;</xsl:template>
<!-- Forma el arreglo que contiene los nodos -->
<xsl:template match="action" mode="array"><xsl:if test="type = 'node' or type = 'form' or type = 'module'">	$rcnode[]=array("son"=>"<xsl:value-of select="name"/>", "father"=>"<xsl:value-of select="(ancestor::*/name)[last()]" />");
</xsl:if><xsl:apply-templates select="action" mode="array"/>
</xsl:template>
<!-- Crea los nodos del menu -->
<xsl:template match="action" mode="node"><xsl:if test="type = 'node' or type = 'form' or type = 'module'"><xsl:if test="type = 'node' or type = 'module'">	$<xsl:value-of select="name"/> = new HTML_TreeNode($rclabels["<xsl:value-of select="name"/>"],"");
</xsl:if><xsl:if test="type = 'form'">	$<xsl:value-of select="name"/> = new HTML_TreeNode($rclabels["<xsl:value-of select="name"/>"],"javascript:fncLoadCmd(\'<xsl:value-of select="name"/>\',\'<xsl:value-of select="ancestor::action[type='module']/name" />\')");
</xsl:if></xsl:if><xsl:apply-templates select="action" mode="node"/>
</xsl:template>
</xsl:stylesheet>