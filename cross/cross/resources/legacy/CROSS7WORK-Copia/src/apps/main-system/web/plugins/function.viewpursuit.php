<?php
/**Copyright 2007 FullEngine
Consolidado de seguimiento
@author freina <freina@parquesoft.com>
@date 29-May-2007 19:24
@location Cali - Colombia
*/
function smarty_function_viewpursuit($params, & $smarty) {
	extract($_REQUEST);

	settype($objManager, "object");
	settype($objService, "object");
	settype($rcUser, "array");
	settype($sbHtml, "string");
	settype($sbPeriodo, "string");

	if (!$ordefecingdini || !$ordefecingdfin) {
		return false;
	}

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		$rcUser['lang'] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".pursuit.php");

	//Convierto las fechas
	if ($ordefecingdini && $ordefecingdfin) {

		//Carga el servicio de control de fechas
		$sbPeriodo = "$ordefecingdini - $ordefecingdfin";
		$objService = Application :: loadServices("DateController");
		$ordefecingdini = $objService->fncdatetoint($ordefecingdini);
		$ordefecingdfin = $objService->fncdatetoint($ordefecingdfin) + 86399;
	}

	$objManager = new pursuit($ordefecingdini, $ordefecingdfin, $orgacodigos, $rclabels, $sbPeriodo);

	$sbHtml = $objManager->makeReport();

	//Valida si existen datos para el reporte
	if (!$sbHtml) {
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		echo "<script language='javascript'>alert('".$rcmessages[22]."')\n"." if(parent.opener!=null){\n"." parent.close();\n"."}\n"."</script>";
		return null;
	}
	return $sbHtml;
}
class pursuit {
	function pursuit($ordefecingdini, $ordefecingdfin, $orgacodigos, $rclabels, $periodo) {

		settype($objService, "object");
		settype($rcTmp, "array");

		//Obtiene la compuerta
		$this->objGateway = Application :: getDataGateway("pursuit");

		//se obtiene el nombre de la dependencia
		$objService = Application :: loadServices("Human_resources");
		$rcTmp = $objService->getDataEntesOrg($orgacodigos, true);
		if ($rcTmp) {
			$this->sbOrganombres = $rcTmp["nombre"];
		}

		$this->sbPeriodo = $periodo;
		$this->rcLabels = $rclabels;
		$this->objGateway->setsbOrgacodigos($orgacodigos);

		//Se obtiene los tipos de caso que no deben presentarse en las tablas.
		$objService = Application :: loadServices("General");
		$rcSeguimiento = $objService->getParam("cross300", "TYPES_CASE_PURSUIT");
		$this->objGateway->setrcType($rcSeguimiento);

		//$this->objGateway->setnuSenal();
		$this->objGateway->setnuFechaini($ordefecingdini);
		$this->objGateway->setnuFechafin($ordefecingdfin);
		$this->objGateway->setrcParams("");

		//objeto de control de graficos
		$this->objGraph = Application :: getDomainController("GraphicManager");

	}

	function makeReport() {
		
		settype($rcUser, "string");
		settype($sbCadena,"string");

		//Se obtienen los datos

		define("TOTALREQ", 100);

		$sbCadena .= "<table border=0>";
		$sbCadena .= "	<tr>\n";
		$sbCadena .= "		<th>".$this->rcLabels["titulo1"]["label"]." ";
		if ($this->sbOrganombres) {
			$sbCadena .= $this->sbOrganombres;
		}
		$sbCadena .= "			<br> ".$this->rcLabels["titulo2"]["label"]." ".$this->sbPeriodo;
		$sbCadena .= "		</th>\n";
		$sbCadena .= "	</tr>\n";
		$sbCadena .= "	<tr>\n";
		$sbCadena .= "		<td class=\"piedefoto\">&nbsp;</td>\n";
		$sbCadena .= "	</tr>\n";
		$sbCadena .= "</table>";
		
		//Para versión "2008" de CVC se esconde la parte de términos y se agrega la parte de denuncias
		$sbCadena .= $this->report_TipoReq();
		
		//PARA CVC 2008 SE AGREGA COMPROMISOS POR TIPO DE CASO
		$sbCadena .= $this->report_TipoReqCommitments();
		$sbCadena .= $this->report_Terminos();
		
		//PARA CVC 2008 SE QUITA DARN Y MEDIOS DE RECEPCIÓN
		//$sbCadena .= $this->fncReporteClasificacion($this->rcLabels,$this->objGraph);
		//$sbCadena .= $this->report_Recepcion();
		return $sbCadena;
	}
	
	function report_TipoReqCommitments() {

		settype($sbCadena, "string");

		$sbCadena .= "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"titulofila\">".$this->rcLabels["titulo8"]["label"]."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"piedefoto\">".$this->_paintTipoReqCommitments();
		$sbCadena .= "      <br><p>".$this->rcLabels["pietiporeq"]["label"]."</td>";

		if (is_array($this->rcReport)) {
			//EXCEL
			if (is_array($this->rcReport[2])) {
				array_unshift($this->rcReport[2], array ($this->rcLabels["tiporeq"]["label"],$this->rcLabels["commitment"]["label"],$this->rcLabels["no"]["label"], $this->rcLabels["acumulado"]["label"]));
				array_unshift($this->rcReport[2], array ($this->rcLabels["titulo8"]["label"]));
				$sbCadena .= $this->getExcelBook($this->rcReport[2], $this->rcLabels);
			}
			//IMAGEN
			$this->objGraph->nuWidth = 500;
			$this->objGraph->nuHeight = 300;
			$blGraph = $this->objGraph->createExplode3DPieplot($this->rcReport[1], $this->rcReport[0], '');
			if ($blGraph)
				$sbCadena .= "<td class='piedefoto'><img src='".$this->objGraph->sbFileName."' align='center'></td>";
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		return $sbCadena;
	}
	
	function report_TipoReq() {

		settype($sbCadena, "string");

		$sbCadena .= "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"titulofila\">".$this->rcLabels["titulo3"]["label"]."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"piedefoto\">".$this->_paintTipoReq();
		$sbCadena .= "      <br><p>".$this->rcLabels["pietiporeq"]["label"]."</td>";

		if (is_array($this->rcReport)) {
			//EXCEL
			if (is_array($this->rcReport[2])) {
				array_unshift($this->rcReport[2], array ($this->rcLabels["tiporeq"]["label"], $this->rcLabels["no"]["label"], $this->rcLabels["acumulado"]["label"]));
				array_unshift($this->rcReport[2], array ($this->rcLabels["titulo3"]["label"]));
				$sbCadena .= $this->getExcelBook($this->rcReport[2], $this->rcLabels);
			}
			//IMAGEN
			$this->objGraph->nuWidth = 500;
			$this->objGraph->nuHeight = 300;
			$blGraph = $this->objGraph->createExplode3DPieplot($this->rcReport[1], $this->rcReport[0], '');
			if ($blGraph)
				$sbCadena .= "<td class='piedefoto'><img src='".$this->objGraph->sbFileName."' align='center'></td>";
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		return $sbCadena;
	}
	
	function _paintTipoReqCommitments() {

		settype($rcDatos, "array");
		settype($rcReport, "array");
		settype($sbCadena, "string");
		settype($nuReg, "integer");
		settype($nuTotal, "integer");
		settype($nuCant, "integer");
		settype($nuCont, "integer");
		settype($nuPorcentaje, "integer");

		//Data Principal
		$this->objGateway->setnuSenal(8);
		$rcDatos = $this->objGateway->fncConsultar();
		
		$nuReg = sizeof($rcDatos);
		for ($nuCant = 0; $nuCant < $nuReg; $nuCant ++) {
			$nuTotal += $rcDatos[$nuCant]["cuantos"];
		}
		$sbCadena = "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
		$sbCadena .= "<td rowspan=2><b>".$this->rcLabels["tiporeq"]["label"]."</b></td>";
		$sbCadena .= "<td rowspan=2><b>".$this->rcLabels["commitment"]["label"]."</b></td>";
		$sbCadena .= "<td colspan=2><b>".$this->rcLabels["acumulado"]["label"]."<b></td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td><b>".$this->rcLabels["no"]["label"]."</b></td>";
		$sbCadena .= "<td><b>".$this->rcLabels["porcentaje"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		if(is_array($rcDatos))
		foreach ($rcDatos as $rcRow) {
			$sbCadena .= "<tr>";
			$sbCadena .= "<td align=center>". ($nuCont +1)."</td>";
			$sbCadena .= "<td align=left>".$rcRow["tiornombres"]."</td>";
			$sbCadena .= "<td align=left>".$rcRow["compdescris"]."</td>";
			$sbCadena .= "<td align=center>".$rcRow["cuantos"]."</td>";
			$nuPorcentaje = $this->fnuPorcentaje($rcRow["cuantos"], $nuTotal);
			$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
			$sbCadena .= "</tr>";

			//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
			$rcReport[0][$nuCont] = $nuCont +1;
			$rcReport[1][$nuCont] = $rcRow["cuantos"];
			$rcReport[2][$nuCont] = array ($rcRow["tiornombres"], $rcRow["compdescris"], $rcRow["cuantos"], $nuPorcentaje);
		}

		$sbCadena .= "<tr>";
		$sbCadena .= "<td>&nbsp;</td>";
		$sbCadena .= "<td>&nbsp;</td>";
		$sbCadena .= "<td align=right>".$this->rcLabels["total"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuTotal."</td>";
		if ($nuReg > 0) {
			$sbCadena .= "<td align=center>".TOTALREQ."</td>";
		} else {
			$sbCadena .= "<td align=center>".$nuTotal."</td>";
		}
		$rcReport[2][] = array ($this->rcLabels["total"]["label"], $nuTotal, 100);
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";

		$this->rcReport = $rcReport;
		return $sbCadena;
	}
	function _paintTipoReq() {

		settype($rcDatos, "array");
		settype($rcTipoReq, "array");
		settype($rcTipoorden, "array");
		settype($rcReport, "array");
		settype($sbCadena, "string");
		settype($nuReg, "integer");
		settype($nuCant, "integer");
		settype($nuTipoordenactual, "integer");
		settype($nuValorReq, "integer");
		settype($nuCantReg, "integer");
		settype($nuCont, "integer");
		settype($nuPorcentaje, "integer");

		//Data Principal
		$this->objGateway->setnuSenal(1);
		$rcDatos = $this->objGateway->fncConsultar();
		$this->objGateway->setnuSenal(2);
		$rcTipoReq = $this->objGateway->fncConsultar();

		$nuReg = sizeof($rcDatos);
		for ($nuCant = 0; $nuCant < $nuReg; $nuCant ++) {
			$nuTipoordenactual = $rcDatos[$nuCant]["tiorcodigos"];
			$rcTipoorden[$nuTipoordenactual]++;
		}
		$sbCadena = "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
		$sbCadena .= "<td rowspan=2><b>".$this->rcLabels["tiporeq"]["label"]."</b></td>";
		$sbCadena .= "<td colspan=2><b>".$this->rcLabels["acumulado"]["label"]."<b></td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td><b>".$this->rcLabels["no"]["label"]."</b></td>";
		$sbCadena .= "<td><b>".$this->rcLabels["porcentaje"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		$nuCantReg = sizeof($rcTipoReq);
		for ($nuCont = 0; $nuCont < $nuCantReg; $nuCont ++) {
			$sbCadena .= "<tr>";
			$sbCadena .= "<td align=center>". ($nuCont +1)."</td>";
			$sbCadena .= "<td align=left>".$rcTipoReq[$nuCont]["tiornombres"]."</td>";
			$nuValorReq = $rcTipoorden[$rcTipoReq[$nuCont]["tiorcodigos"]];
			if ($nuValorReq == "" || is_null($nuValorReq)) {
				$nuValorReq = 0;
			}
			$sbCadena .= "<td align=center>".$nuValorReq."</td>";
			$nuPorcentaje = $this->fnuPorcentaje($nuValorReq, $nuReg);
			$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
			$sbCadena .= "</tr>";

			//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
			$rcReport[0][$nuCont] = $nuCont +1;
			$rcReport[1][$nuCont] = $nuValorReq;
			$rcReport[2][$nuCont] = array ($rcTipoReq[$nuCont]["tiornombres"], $nuValorReq, $nuPorcentaje);
		}

		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
		$sbCadena .= "<td align=right>".$this->rcLabels["total"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuReg."</td>";
		if ($nuReg > 0) {
			$sbCadena .= "<td align=center>".TOTALREQ."</td>";
		} else {
			$sbCadena .= "<td align=center>".$nuReg."</td>";
		}
		$rcReport[2][] = array ($this->rcLabels["total"]["label"], $nuReg, 100);
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";

		$this->rcReport = $rcReport;
		return $sbCadena;
	}

	function report_Terminos() {

		settype($sbCadena, "string");
		
		$sbCadena .= "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"titulofila\">".$this->rcLabels["titulo5"]["label"]."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		
		$sbCadena .= "  <td class=\"piedefoto\">".$this->_paintTerminos();
		$sbCadena .= "      <br><p>".$this->rcLabels["pieatencion"]["label"]."</td>";

		if (is_array($this->rcReport)) {
			//EXCEL
			if (is_array($this->rcReport[2])) {
				array_unshift($this->rcReport[2], array ($this->rcLabels["atencion"]["label"], $this->rcLabels["no"]["label"], $this->rcLabels["acumulado"]["label"]));
				array_unshift($this->rcReport[2], array ($this->rcLabels["titulo5"]["label"]));
				$sbCadena .= $this->getExcelBook($this->rcReport[2], $this->rcLabels);
			}
			//IMAGEN
			$this->objGraph->nuWidth = 500;
			$this->objGraph->nuHeight = 300;
			$blGraph = $this->objGraph->createExplode3DPieplot($this->rcReport[1], $this->rcReport[0], '');
			if ($blGraph) {
				$sbCadena .= "<td class='piedefoto'><img src='".$this->objGraph->sbFileName."' align='center'></td>";
			}
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		return $sbCadena;
	}
	function _paintTerminos() {

		settype($objDate, "object");
		settype($rcDatos, "array");
		settype($rcOrden, "array");
		settype($rcReport, "array");
		settype($sbCadena, "array");
		settype($nuDia, "integer");
		settype($nuReg, "integer");
		settype($nuNoFechatermino, "integer");
		settype($nuSiFechatermino, "integer");
		settype($nuPendiente, "integer");
		settype($nuPendienteFuera, "integer");
		settype($hour, "integer");
		settype($nuCont, "integer");
		settype($nuPorcentaje, "integer");

		//Data Principal
		$this->objGateway->setnuSenal(3);
		$rcDatos = $this->objGateway->fncConsultar();

		//Inicializo el servicio
		$objDate = Application :: loadServices("DateController");
		$active = Application::getConstant("REG_ACT");

		//$nuDia = $objDate->fncintdate() + 86399;
		$nuDia = $objDate->fncintdatehour();
		$nuReg = sizeof($rcDatos);

		$nuNoFechatermino = 0;
		$nuSiFechatermino = 0;
		$nuPendiente = 0;
		$nuPendienteFuera = 0;
		if (is_array($rcDatos)) {
			foreach ($rcDatos as $rcOrden) 
			{
				//Verifica si esta finalizada
				if ($rcOrden['ordefecfinad'] && $rcOrden["accoactivas"]!=$active) 
				{
					//Verifica si esta finalizada fuera del termino
					//Ver si es con horas
					$hour = $objDate->getHour2DateInSecs($rcOrden['ordefecvend']);
					if (!$hour)
						$rcOrden['ordefecvend'] += 86399;
					if ($rcOrden['ordefecfinad'] > $rcOrden['ordefecvend'])
						$nuNoFechatermino ++;
					else
						$nuSiFechatermino ++;
				} else {
					//Ver si es con horas
					$hour = $objDate->getHour2DateInSecs($rcOrden['ordefecvend']);
					if (!$hour)
						$rcOrden['ordefecvend'] += 86399;
					//Verifica si es pendiente vencida
					if ($nuDia < $rcOrden['ordefecvend'])
						$nuPendiente ++;
					else
						$nuPendienteFuera ++;
				}
			}
		}
		$nuCont = 0;
		$sbCadena = "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
		$sbCadena .= "<td rowspan=2><b>".$this->rcLabels["atencion"]["label"]."</b></td>";
		$sbCadena .= "<td colspan=2><b>".$this->rcLabels["acumulado"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td><b>".$this->rcLabels["no"]["label"]."</b></td>";
		$sbCadena .= "<td><b>".$this->rcLabels["porcentaje"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>". (++ $nuCont)."</td>";
		$sbCadena .= "<td align=left>".$this->rcLabels["dentro"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuSiFechatermino."</td>";
		$nuPorcentaje = $this->fnuPorcentaje($nuSiFechatermino, $nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";

		$rcReport[0][$nuCont] = $nuCont;
		$rcReport[1][$nuCont] = $nuSiFechatermino;
		$rcReport[2][$nuCont] = array ($this->rcLabels["dentro"]["label"], $nuSiFechatermino, $nuPorcentaje);

		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>". (++ $nuCont)."</td>";
		$sbCadena .= "<td align=left>".$this->rcLabels["fuera"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuNoFechatermino."</td>";
		$nuPorcentaje = $this->fnuPorcentaje($nuNoFechatermino, $nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";

		$rcReport[0][$nuCont] = $nuCont;
		$rcReport[1][$nuCont] = $nuNoFechatermino;
		$rcReport[2][$nuCont] = array ($this->rcLabels["fuera"]["label"], $nuNoFechatermino, $nuPorcentaje);

		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>". (++ $nuCont)."</td>";
		$sbCadena .= "<td align=left>".$this->rcLabels["pendnovenci"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuPendiente."</td>";
		$nuPorcentaje = $this->fnuPorcentaje($nuPendiente, $nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";

		$rcReport[0][$nuCont] = $nuCont;
		$rcReport[1][$nuCont] = $nuPendiente;
		$rcReport[2][$nuCont] = array ($this->rcLabels["pendnovenci"]["label"], $nuPendiente, $nuPorcentaje);

		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>". (++ $nuCont)."</td>";
		$sbCadena .= "<td align=left>".$this->rcLabels["pendvenci"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuPendienteFuera."</td>";
		$nuPorcentaje = $this->fnuPorcentaje($nuPendienteFuera, $nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";

		$rcReport[0][$nuCont] = $nuCont;
		$rcReport[1][$nuCont] = $nuPendienteFuera;
		$rcReport[2][$nuCont] = array ($this->rcLabels["pendvenci"]["label"], $nuPendienteFuera, $nuPorcentaje);

		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
		$sbCadena .= "<td align=right>".$this->rcLabels["total"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuReg."</td>";
		$rcReport[2][] = array ($this->rcLabels["total"]["label"], $nuReg, 100);

		if ($nuReg > 0) {
			$sbCadena .= "<td align=center>".TOTALREQ."</td>";
		} else {
			$sbCadena .= "<td align=center>".$nuReg."</td>";
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		$this->rcReport = $rcReport;
		return $sbCadena;
	}
	
	function report_Recepcion() {

		settype($rcAdit, "array");
		settype($sbCadena, "string");

		//$rcDatos, $rcTipoReq, $rcMedios, $rcLabels, $objGraph
		$sbCadena .= "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"titulofila\">".$this->rcLabels["titulo6"]["label"]."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"piedefoto\">".$this->_paintMedioRecepcion();
		$sbCadena .= "      <br><p>".$this->rcLabels["pierecepcion"]["label"]."</td>";

		if (is_array($this->rcReport)) {
			//EXCEL
			if (is_array($this->rcReport[2])) {
				array_unshift($this->rcReport[2], array ($this->rcLabels["medio"]["label"], $this->rcLabels["total"]["label"]));
				array_unshift($this->rcReport[2], array ($this->rcLabels["titulo6"]["label"]));
				$sbCadena .= $this->getExcelBook($this->rcReport[2], $this->rcLabels);
			}
			//IMAGEN
			$this->objGraph->nuWidth = 500;
			$this->objGraph->nuHeight = 300;
			$rcAdit["rcSeries"] = $this->rcReport[3];
			$blGraph = $this->objGraph->createExplode3DPieplot($this->rcReport[1], $this->rcReport[0], '', $rcAdit);
			if ($blGraph){
				$sbCadena .= "<td class='piedefoto'><img src='".$this->objGraph->sbFileName."' align='center'></td>";
			}
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		return $sbCadena;
	}
	function _paintMedioRecepcion() {
		
		settype($rcDatos,"array");
		settype($rcTipoReq,"array");
		settype($rcMedios,"array");
		settype($rcReport, "array");
		settype($rcTipoMedio, "array");
		settype($rcSubTipo, "array");
		settype($rcMatriz, "array");
		settype($rcTipoReqMedioActual, "array");
		settype($sbTipoordenactual, "string");
		settype($sbMedio, "string");
		settype($sbTiorcodigos, "string");
		settype($sbMerecodigos, "string");
		settype($sbTipoOrdennom, "string");
		settype($sbCadena, "string");
		settype($sbMedioActual, "string");
		settype($nuReg, "integer");
		settype($nuCant, "integer");
		settype($nuSizeTipoReq, "integer");
		settype($nuSizeMedios, "integer");
		settype($nuCont, "integer");
		settype($nuCantReg, "integer");
		settype($nuTamano, "integer");
		settype($nusubTotalMedio, "integer");
		settype($nuValorReq, "integer");
		settype($nuSize, "integer");
		settype($nuConta, "integer");
		settype($nuSubValor, "integer");
		
		//Data Principal
		$this->objGateway->setnuSenal(3);
		$rcDatos = $this->objGateway->fncConsultar();
		$this->objGateway->setnuSenal(4);
		$rcTipoReq = $this->objGateway->fncConsultar();
		$this->objGateway->setnuSenal(5);
		$rcMedios = $this->objGateway->fncConsultar();
		
		//Cuento cuantos req. de un evento llegaron segun un medio de recepcion
		$nuReg = sizeof($rcDatos);
		for ($nuCant = 0; $nuCant < $nuReg; $nuCant ++) {
			$sbTipoordenactual = $rcDatos[$nuCant]["tiorcodigos"];
			$sbMedio = $rcDatos[$nuCant]["merecodigos"];

			$rcTipoMedio[$sbMedio][$sbTipoordenactual]++;
			$rcSubTipo[$sbTipoordenactual]++;
		}

		$nuSizeTipoReq = sizeof($rcTipoReq);
		$nuSizeMedios = sizeof($rcMedios);

		//Lleno la matriz inicialmente
		for ($nuCont = 0; $nuCont < $nuSizeMedios; $nuCont ++) {
			for ($nuCant = 0; $nuCant < $nuSizeTipoReq; $nuCant ++) {
				$sbTiorcodigos = $rcTipoReq[$nuCant]["tiorcodigos"];
				$sbMerecodigos = $rcMedios[$nuCont]["merecodigos"];
				if ($rcTipoMedio[$sbMerecodigos][$sbTiorcodigos]) {
					$rcMatriz[$sbMerecodigos][$sbTiorcodigos] = $rcTipoMedio[$sbMerecodigos][$sbTiorcodigos];
				} else {
					$rcMatriz[$sbMerecodigos][$sbTiorcodigos] = 0;
				}
			}
		}

		$sbCadena = "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td>&nbsp;</td>";
		$sbCadena .= "<td><b>".$this->rcLabels["medio"]["label"]."</b></td>";
		$nuCantReg = sizeof($rcTipoReq);

		for ($nuCont = 0; $nuCont < $nuCantReg; $nuCont ++) {
			$sbTiorcodigos = $rcTipoReq[$nuCont]["tiorcodigos"];
			$sbTipoOrdennom = $rcTipoReq[$nuCont]["tiornombres"];
			$sbCadena .= "<td align=left>".$sbTipoOrdennom."</td>";

		}
		$sbCadena .= "<td align=left>".$this->rcLabels["total"]["label"]."</td>";
		$sbCadena .= "</tr>";

		$nuTamano = sizeof($rcMedios);
		for ($nuCont = 0; $nuCont < $nuTamano; $nuCont ++) {
			$nusubTotalMedio = 0;
			$sbCadena .= "<tr>";
			$sbCadena .= "<td align=left>". ($nuCont +1)."</td>";
			$sbCadena .= "<td align=left>".$rcMedios[$nuCont]["merenombres"]."</td>";

			$sbMedioActual = $rcMedios[$nuCont]["merecodigos"];
			if ($rcTipoMedio[$sbMedioActual]) {
				$rcTipoReqMedioActual = array_keys($rcMatriz[$sbMedioActual]);
			}

			$nuSize = sizeof($rcTipoReqMedioActual);
			for ($nuConta = 0; $nuConta < $nuSize; $nuConta ++) {
				$nuValorReq = $rcMatriz[$sbMedioActual][$rcTipoReqMedioActual[$nuConta]];
				if ($nuValorReq == "" || is_null($nuValorReq)) {
					$nuValorReq = 0;
				}
				$sbCadena .= "<td align=center>".$nuValorReq."</td>";
				$nusubTotalMedio += $nuValorReq;
			}
			if ($nuSize == 0) {
				for ($nuContador = 0; $nuContador < $nuSizeTipoReq; $nuContador ++) {
					$sbCadena .= "<td align=center>0</td>";
				}
				$sbCadena .= "<td align=right>".$nusubTotalMedio."</td>";
			} else {
				$sbCadena .= "<td align=right>".$nusubTotalMedio."</td>";
			}
			$sbCadena .= "</tr>";

			//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
			$rcReport[0][$nuCont] = $nuCont +1;
			$rcReport[1][$nuCont] = $nusubTotalMedio;
			$rcReport[2][$nuCont] = array ($rcMedios[$nuCont]["merenombres"], $nusubTotalMedio);
		}

		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=right>&nbsp;</td>";
		$sbCadena .= "<td align=right>".$this->rcLabels["total"]["label"]."</td>";
		$nuCantReg = sizeof($rcTipoReq);
		for ($nuConta = 0; $nuConta < $nuCantReg; $nuConta ++) {
			$sbTiorcodigos = $rcTipoReq[$nuConta]["tiorcodigos"];
			$nuSubValor = $rcSubTipo[$sbTiorcodigos];
			if (!$nuSubValor) {
				$nuSubValor = 0;
			}
			$sbCadena .= "<td align=center>".$nuSubValor."</td>";
		}
		$rcReport[2][] = array ($this->rcLabels["total"]["label"], $nuReg);
		$sbCadena .= "<td align=right>".$nuReg."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		$this->rcReport = $rcReport;
		return $sbCadena;
	}

	function fnuPorcentaje($nuCantReq, $nuTotal) {
		$nuPorcentaje = 0;
		if ($nuTotal > 0)
			$nuPorcentaje = (($nuCantReq * TOTALREQ) / $nuTotal);
		return number_format($nuPorcentaje, 2, ',', '.');
	}

	function getExcelBook($rcDatos, $rcLabels) {
		$sbTmp = "tmp/";
		$nameExcel = $name.rand(0, 1000).".xls";
		$sbPath = $sbTmp.$nameExcel;

		$objLib = Application :: loadLib("excel");
		$sbResult = $objLib->execute($rcDatos, $sbPath);

		return "<td class='piedefoto'><a href=javascript:abrirPdf('".$sbPath."');>" .
				"<img border=0 src='web/images/generar_excel.gif' alt='".$this->rcLabels['excel']['label']."'></a></td>";
	}
	
	function fncReporteClasificacion($rclabels,$objGraph)
	{
		$this->objGateway->setnuSenal(1);
		$rcDatos = $this->objGateway->fncConsultar();
		$this->objGateway->setnuSenal(6);
		$rcClasifica = $this->objGateway->fncConsultar();
		$this->objGateway->setnuSenal(7);
		$rcSubClasificacion = $this->objGateway->fncConsultar();
		
		$sbCadena .= "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"titulofila\">".$rclabels["titulo8"]["label"]."</td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "  <td class=\"piedefoto\">".$this->fncPaintClasificacion($rcDatos,$rcClasifica,$rcSubClasificacion,$rclabels,$rcDatosReporteTipos);
		$sbCadena .= "      <br><p>".$rclabels["piedarn1"]["label"]."</td>";
		
		if(is_array($rcDatosReporteTipos))
		{
			//EXCEL
			if(is_array($rcDatosReporteTipos[2]))
			{
				array_unshift($rcDatosReporteTipos[2],array($rclabels["darn"]["label"],$rclabels["suma"]["label"],$rclabels["sumapor"]["label"]));
				array_unshift($rcDatosReporteTipos[2],array($rclabels["titulo8"]["label"]));
				$sbCadena .= $this->getExcelBook($rcDatosReporteTipos[2],$rclabels);
			}
			//IMAGEN
			$objGraph->nuWidth=500;
			$objGraph->nuHeight=300;
			$blGraph = $objGraph->createExplode3DPieplot($rcDatosReporteTipos[1],$rcDatosReporteTipos[0],'');
			if($blGraph)
				$sbCadena .= "<td class='piedefoto'><img src='".$objGraph->sbFileName."' align='center'></td>";
		}	
		$sbCadena .= "</tr>";
	    $sbCadena .= "</table>";
		return $sbCadena;
	}
	
	function fncPaintClasificacion($rcDatos, $rcClasifica, $rcSubClasificacion, $rcLabels,&$rcDatosReporteClasifica) 
	{
		//Obtiene la compuerta
		$gateway = Application :: getDataGateway("consolidado");
	
		//Para la consulta 1 se realiza sobre el evento = Denuncia
		$objGeneral = Application::loadServices("General");
		$rcDenuncias = $objGeneral->getParam("cross300","DENUNCIA_TC");
	
		$nuReg = sizeof($rcDatos);
		
		//Contabilizo la cantidad de requerimientos por clasificacion
		$nuDenuncias = 0;
		$nuClasificacion = 0;
		for ($nuCant = 0; $nuCant < $nuReg; $nuCant ++) {
			$nuEventoactual = $rcDatos[$nuCant]["evencodigos"];
			$nuSubclaactual = $rcDatos[$nuCant]["causcodigos"];
	
			$rcCausa[$nuEventoactual]++;
			
			//Contabilizo la cantidad de requerimientos por subclasificacion
			if (!is_null($nuSubclaactual) || $nuSubclaactual != "") {
				$rcSubClasi[$nuEventoactual][$nuSubclaactual]++;
			}
	
			$sbTipoReqactual = $rcDatos[$nuCant]["tiorcodigos"];
			if (in_array($sbTipoReqactual,$rcDenuncias)) 
			{
				$nuDenuncias ++;
			}
		}
	
		$sbCadena = "<table border=0>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2>&nbsp;</td>";
		$sbCadena .= "<td rowspan=2 colspan=2><b>".$rcLabels["darn"]["label"]."</b></td>";
		$sbCadena .= "<td colspan=4><b>".$rcLabels["acumulado"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		$sbCadena .= "<tr>";
		$sbCadena .= "<td><b>".$rcLabels["no"]["label"]."</b></td><td><b>".$rcLabels["porcentaje"]["label"]."</b></td>";
		$sbCadena .= "<td><b>".$rcLabels["suma"]["label"]."</b></td><td><b>".$rcLabels["sumapor"]["label"]."</b></td>";
		$sbCadena .= "</tr>";
		$nuSubTotal = 0;
		$nuSubSubTotal = 0; //Variable que almacenara el subtotal de requerimientos con subclasificacion
		$nuCantReg = sizeof($rcClasifica);
		for ($nuCont = 0; $nuCont < $nuCantReg; $nuCont ++) {
			$sbCadena .= "<tr>";
			$nuCols = 1;
			
			//Codigo de la clasificacion actual
			$nuCauscodigos = $rcClasifica[$nuCont]["evencodigos"];
			
			//Cantidad de subclasificaciones que tiene la actual clasificacion
			$nuTamSubcodigos = sizeof($rcSubClasi[$nuCauscodigos]);
			
			//Para darle la cantidad de columnas que ocupara en el cuadro la clasificacion respectiva
			if ($nuTamSubcodigos == 0) {
				
				//Si no tiene subclasificaciones
				$nuCols = 2;
			} else {
				
				//Si tiene clasificaciones
				$nuCols = 1;
			}
			//Saco las llaves donde estan los codigos de las subclasificaciones de la clasificacion actual
			if ($rcSubClasi[$nuCauscodigos]) {
				$rcLlaves = array_keys($rcSubClasi[$nuCauscodigos]);
				$nuSize = sizeof($rcLlaves);
			}
			//Consulto los descriptores en la tabla subclasificacion para el evento y la causa actual
			unset ($rcSubclasifica);
			for ($nuConta = 0; $nuConta < $nuSize; $nuConta ++) {
				$rcParametros["campo"][0] = "tiorcodigos";
				$rcParametros["valor"][0] = $rcClasifica[$nuCont]["tiorcodigos"];
				$rcParametros["campo"][1] = "evencodigos";
				$rcParametros["valor"][1] = $rcClasifica[$nuCont]["evencodigos"];
				$rcParametros["campo"][2] = "causcodigos";
				$rcParametros["valor"][2] = $rcLlaves[$nuConta];
				$rcSubTempo = $gateway->fncConsultar(5, null, null, null, $rcParametros);
	
				if ($rcSubTempo) {
					$rcSubclasifica[] = $rcSubTempo;
				} else {
					$nuTamSubcodigos --;
				}
			}
			//Validacion adicional para la incongruencia de data
			if (!is_array($rcSubclasifica[0])) {
				$nuCols = 2;
				unset ($rcSubClasi[$rcClasifica[$nuCont]["evencodigos"]]);
			}
			$sbCadena .= "<td rowspan=".$nuTamSubcodigos.">".($nuCont+1)."</td>";
			$sbCadena .= "<td align=left colspan=".$nuCols." rowspan=".$nuTamSubcodigos.">".$rcClasifica[$nuCont]["evennombres"]."</td>";
			if ($nuTamSubcodigos > 0) {
				
				//Pinto las subclasificaciones de esta clasificacion
				$sbFlag = 0;
				for ($nuContador = 0; $nuContador < $nuTamSubcodigos; $nuContador ++) {
					
					//Complemento de la validacion adicional por incongruencia de data
					if ($nuCols == 1) {
						$nuSubcodigos = $rcSubclasifica[$nuContador][0]["causcodigos"];
						$sbSubnombres = $rcSubclasifica[$nuContador][0]["causnombres"];
						
						//$sbCadena .= "<td>".$nuSubcodigos.$sbSubnombres."</td>";
						$sbCadena .= "<td>".$sbSubnombres."</td>";
					}
					//Cuando tiene subclasificaciones se saca el subtotal
					$nuValorReq = $rcSubClasi[$nuCauscodigos][$nuSubcodigos];
					
					//Cuando no las tiene se saca de las clasificaciones
					$nuValorSum = $rcCausa[$nuCauscodigos];
					//Valido que el tipo
					if ($nuValorSum == "" || is_null($nuValorSum)) {
						$nuValorSum = 0;
					}
					if ($nuValorReq == "" || is_null($nuValorReq)) {
						$nuValorReq = 0;
					}
					$sbCadena .= "<td align=center>".$nuValorReq."</td>";
					$nuPorcentaje = $this->fnuPorcentaje($nuValorReq, $nuDenuncias);
					$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
					
					//Para las sumatorias
					if ($sbFlag == 0) {
						$sbCadena .= "<td align=center rowspan=".$nuTamSubcodigos.">".$nuValorSum."</td>";
						$nuPorcentaje = $this->fnuPorcentaje($nuValorSum, $nuDenuncias);
						$sbCadena .= "<td align=center rowspan=".$nuTamSubcodigos.">".$nuPorcentaje."</td>";
						$sbFlag = 1;
					}
					$sbCadena .= "</tr>";
					$nuSubSubTotal += $nuValorReq;
				}
			} else {
				
				//Cuando no las tiene se saca de las clasificaciones
				$nuValorSum = $rcCausa[$nuCauscodigos];
				
				//Valido que el tipo
				if ($nuValorSum == "" || is_null($nuValorSum)) {
					$nuValorSum = 0;
				}
				$sbCadena .= "<td align=center>".$nuValorSum."</td>";
				$nuPorcentaje = $this->fnuPorcentaje($nuValorSum, $nuDenuncias);
				$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
				$sbCadena .= "<td align=center>".$nuValorSum."</td>";
				$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
				$sbCadena .= "</tr>";
				$nuSubTemp += $nuValorSum;
				$nuSubSubTotal += $nuValorSum;
			}
			//Subtotal de lo que digito sin subclasificacion
			$nuSubTotalReq += $nuValorReq;
			
			//Subtotal de la sumatoria
			$nuSubTotal += $nuValorSum;
			
			//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
			$rcDatosReporteClasifica[0][$nuCont] = $nuCont +1;
			$rcDatosReporteClasifica[1][$nuCont] = $nuValorSum;
			$nuPorcentaje = $this->fnuPorcentaje($nuValorSum,$nuDenuncias);
			$rcDatosReporteClasifica[2][$nuCont] = array ($rcClasifica[$nuCont]["evennombres"], $nuValorSum,$nuPorcentaje);
		}
		$sbCadena .= "<tr>";
		$sbCadena .= "<td rowspan=2>&nbsp;</td>";
		$sbCadena .= "<td align=right colspan=2>".$rcLabels["total"]["label"]."</td>";
		$sbCadena .= "<td align=center>".$nuSubSubTotal."</td>";
		
		//$sbCadena .= "<td align=center>".$nuSubTotalReq."</td>";
		if ($nuDenuncias > 0) {
			$sbCadena .= "<td align=center>".TOTALREQ."</td>";
			$sbCadena .= "<td align=center>".$nuSubTotal."</td>";
			$sbCadena .= "<td align=center>".TOTALREQ."</td>";
		} else {
			$sbCadena .= "<td align=center>0</td>";
			$sbCadena .= "<td align=center>0</td>";
			$sbCadena .= "<td align=center>0</td>";
		}
		$sbCadena .= "</tr>";
		$sbCadena .= "</table>";
		return $sbCadena;
	}
}
?>