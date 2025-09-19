<?php   
class FeGeFileConfigurationManager {
	var $gateway;
	var $gatewayc;
	var $gatewayd;
	var $objtmp;
	function FeGeFileConfigurationManager() {
		$this->gateway = Application :: getDataGateway("configarchiv");
		$this->gatewayc = Application :: getDataGateway("configarchivExtended");
		$this->gatewayd = Application :: getDataGateway("detaconfarchExtended");
		$this->objtmp = Application :: getDomainController('NumeradorManager');
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Ingresa o actualiza una configuracion de archivo para un posterior formateo
	*   @author freina
	*	@param array $ircconfigarchiv (Arreglo con la data de el maestro de configuracion)
	*	@param array $ircdetaconfarch (Arreglo con la data del detalle de configuracion)
	*	@return boolean true o false (true proceso ok, false error en el proceso)
	*   @date 28-Sep-2004 09:19
	*   @location Cali-Colombia
	*/
	function updateFileConfiguration($ircconfigarchiv, $ircdetaconfarch) {
		extract($ircconfigarchiv);
		settype($rcsql, "array");
		settype($rctmp, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nuindex, "integer");
		settype($onuresult, "integer");
		if ($this->gateway->existConfigarchiv($cogacodigos) == 0) {
			//Insert de Configarchiv
			$rcsql[0] = $this->gatewayc->addConfigarchivSql($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis);
			$nucant = sizeof($ircdetaconfarch);
			//se obtiene los codigos
			$nuindex = $this->objtmp->fncgetByIdNumerador("detaconfarch", $nucant);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rctmp = $ircdetaconfarch[$nucont];
				$rcsql[$nucont +1] = $this->gatewayd->addDetaconfarchSql(($nuindex + $nucont), $cogacodigos, $rctmp["decodescris"], $rctmp["decolon_posn"], $rctmp["decotipos"], $rctmp["decoformats"], $rctmp["decovalinis"], $rctmp["decovalfins"]);
			}
			$this->gatewayc->ConfigarchivTrans($rcsql);
			if ($this->gatewayc->consult) {
				$this->UnsetRequestConfigarchiv();
				$this->UnsetRequestDetaconfarch();
				$onuresult = 3;
			} else {
				$onuresult = 14;
			}
		} else {
			//update al archivo
			$nucontr = 0;
			$rcsql[$nucontr] = $this->gatewayc->updateConfigarchivSql($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis);
			$nucontr = 1;
			$rcsql[$nucontr] = $this->gatewayd->deleteDetaconfarchSql($cogacodigos);
			$nucontr =2;
			$nucant = sizeof($ircdetaconfarch);
			//se obtiene los codigos
			$nuindex = $this->objtmp->fncgetByIdNumerador("detaconfarch", $nucant);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rctmp = $ircdetaconfarch[$nucont];
				$rcsql[$nucontr] = $this->gatewayd->addDetaconfarchSql(($nuindex + $nucont), $cogacodigos, $rctmp["decodescris"], $rctmp["decolon_posn"], $rctmp["decotipos"], $rctmp["decoformats"], $rctmp["decovalinis"], $rctmp["decovalfins"]);
				$nucontr ++;
			}
			$sbresult = $this->gatewayc->ConfigarchivTrans($rcsql);
			if ($this->gatewayc->consult) {
				$this->UnsetRequestConfigarchiv();
				$this->UnsetRequestDetaconfarch();
				$onuresult = 3;
			} else {
				$onuresult = 15;
			}
		}
		return $onuresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Elimina una configuracion de la bd
	*   @author freina
	*	@param string $isbcogacodigos (Cadena con el codigo configuracion)
	*	@return boolean true o false (true proceso ok, false error en el proceso)
	*   @date 28-Sep-2004 10:43
	*   @location Cali-Colombia
	*/
	function deleteConfigarchiv($isbcogacodigos) {
		settype($rcsql,"array");
		settype($onuresult,"integer");
		if ($this->gateway->existConfigarchiv($isbcogacodigos) == 1) {
			$rcsql[0] = $this->gatewayd->deleteDetaconfarchSql($isbcogacodigos);
			$rcsql[1] = $this->gatewayc->deleteConfigarchivSql($isbcogacodigos);
			$this->gatewayc->ConfigarchivTrans($rcsql);
			if ($this->gatewayc->consult) {
				$this->UnsetRequestConfigarchiv();
				$this->UnsetRequestDetaconfarch();
				$onuresult = 3;
			} else {
				$onuresult = 16;
			}
		} else {
			$onuresult = 2;
		}
		return $onuresult;
	}
	function UnsetRequestConfigarchiv() {
		unset ($_REQUEST["configarchiv__cogacodigos"]);
		unset ($_REQUEST["configarchiv__coganombres"]);
		unset ($_REQUEST["configarchiv__cogaobservas"]);
		unset ($_REQUEST["configarchiv__tiarcodigos"]);
		unset ($_REQUEST["configarchiv__cogamarmaess"]);
		unset ($_REQUEST["configarchiv__cogamardetas"]);
		unset ($_REQUEST["configarchiv__cogaposmaess"]);
		unset ($_REQUEST["configarchiv__cogaposdetas"]);
		unset ($_REQUEST["configarchiv__cogasepainis"]);
		unset ($_REQUEST["configarchiv__cogasepafins"]);
		unset ($_REQUEST["configarchiv__coarencabezs"]);
		unset ($_REQUEST["configarchiv__coarextencis"]);
	}
	function UnsetRequestDetaconfarch() {
		unset ($_REQUEST["detaconfarch__decocodigon"]);
		unset ($_REQUEST["detaconfarch__cogacodigos"]);
		unset ($_REQUEST["detaconfarch__decodescris"]);
		unset ($_REQUEST["detaconfarch__decolon_pos"]);
		unset ($_REQUEST["detaconfarch__decotipos"]);
		unset ($_REQUEST["detaconfarch__decoformats"]);
		unset ($_REQUEST["detaconfarch__decovalinis"]);
		unset ($_REQUEST["detaconfarch__decovalfins"]);
	}
}
?>	