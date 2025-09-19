<?php

/**Copyright 2004  FullEngine

Servicio factory de plugins para manejo de dimensiones
@author mrestrepo@parquesoft.com
@date 01-mar-2006 15:01:00
@location Cali - Colombia*/

class Dimentions {
	var $appName;
	var $appDir;
	var $objDim;

	function Dimentions() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/general";
		$name = "general";
		$objTmp = new Application($name, $dir_name, true);

		//Instancia la clase de las reglas basicas del workflow
		$this->objDim = Application :: getDomainController('DimensionManager');
	}

	/**
	 Copyright 2004  FullEngine

	 Muestra toda la informacion del servicio
	 @author freina <freina@parquesoft.com>
	 @date 10-sep-2004 15:03:00
	 @location Cali-Colombia
	 */
	function serviceInfo() {
		$rcinfo = array ("close" => "Copyright 2004  FullEngine"."Cierra el servicio"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "PluginsFactory" => "Copyright 2004  FullEngine"."Factory de plugins"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "getLabel" => "Copyright 2004  FullEngine"."obtiene el label"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "LoadRequest" => "Copyright 2004  FullEngine"."Carga la data del entorno"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "getAccesskey" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "fncmodificarlabel" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "fncteclarapida" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "fncresaltarlabel" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "fncacute_a_tilde" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia", "fnctildea_a_cute" => "Copyright 2004  FullEngine"."Obtiene los accesskeys"."@author <mrestrepo@parquesoft.com>"."@date	 01-Mar-06 16:03"."@location	 Cali-Colombia",);

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data)
		echo "<tr><td>$key</td><td><pre>$data</pre></td></td>";
		echo "</table>";
	}
	/**
	 Copyright 2004 ï¿½ FullEngine
	 Regresa a la aplicaciï¿½n su configuracion
	 @author creyes <cesar.reyes@parquesoft.com>
	 @date 02-sep-2004 12:06:21
	 @location Cali-Colombia
	 @note NOTA: Este mï¿½todo debe ser ejecutado una vez termine la ejecucion de esta clase
	 */
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}

	function getLabel($rclabels, $nuNotNull, $sbIdField) {
		if ($nuNotNull)
		return "<B>".$rclabels[$sbIdField][0]."</B>";
		else
		return $rclabels[$sbIdField][0];
	}

	function PluginsFactory($rclabels,$rcUser,$rcPlugins,$rcParams,$sbCodidominios="proceso",
	$sbCodidomicams="proccodigos", $sbCodidomivals=null,$nuColumns=2)	{

		settype($rcIncl,"array");
		settype($rcTmp,"array");
		settype($sbHtml,"string");
		settype($sbIndex,"string");
		settype($sbPorColum, "string");
		settype($sbPorFin, "string");
		settype($sbPorcentaje, "string");
		settype($nuCont,"integer");
		settype($nuContR,"integer");
		settype($nuCant,"integer");
		settype($nuTamCol, "integer");
		settype($nuTamColFin, "integer");

		if(!$sbCodidominios){
			$sbCodidominios = "proceso";
		}

		if(!$sbCodidomicams){
			$sbCodidomicams = "proccodigos";
		}

		if(!$sbCodidomivals){
			$sbCodidomivals = $rcParams["tiorcodigos"];
		}

		$generalService = Application::loadServices('General');
		$dimensionManager = $generalService->InitiateClass('DimensionManager');
		$dimensionManager->setCodidominios($sbCodidominios);
		$dimensionManager->setCodidomicams($sbCodidomicams);
		$dimensionManager->setCodidomivals($sbCodidomivals);
		$dimensionManager->setParams($rcParams);
		$dimensionManager->setIdProcess($rcUser["username"]);
		$dimensionManager->setOperation('getDetallesDimension');
		$dimensionManager->execute();
		$rcMetadata = $dimensionManager->getDetalleDimension();
		$rcDim = $dimensionManager->_rcCodDimension;
		$generalService->close();

		if(is_array($rcMetadata) && $rcMetadata){
				
			$this->LoadRequest($rcParams);
			$rclabels = $this->getAccesskey($rclabels,$rcMetadata);

			reset($rcMetadata);
			if($rcMetadata[0]["dedinombres"]=="ordenumeros" || $rcMetadata[0]["dedinombres"]=="acemnumeros"){
				$rcTmp = array_shift($rcMetadata);
				array_push($rcMetadata,$rcTmp);
			}
			$rcMetadata = array_chunk($rcMetadata, $nuColumns);
			$nuCant = sizeof($rcMetadata);
			
			$nuColumns = (int) $nuColumns;
			if(fmod($nuColumns,2)==0){
				$nuTamCol = 100/$nuColumns;
				$sbPorColum = (string) $nuTamCol;
				$sbPorColum = $sbPorColum."%";
				$sbPorFin = $sbPorColum;
			}else{
				$nuTamCol = 100/$nuColumns;
				$nuTamCol = floor($nuTamCol);
				$nuTamColFin = 100 - ($nuTamCol * $nuColumns);
				$sbPorColum = (string) $nuTamCol;
				$sbPorColum = $sbPorColum."%";
				$sbPorFin = (string) $nuTamColFin;
				$sbPorFin = $sbPorFin."%";
			}
			
			for ($nuCont=0;$nuCont<$nuCant;$nuCont++){
				$rcTmp = $rcMetadata[$nuCont];
				$sbHtml .= "<tr>";
				$nuContR = 0;
				foreach($rcTmp as $sbIndex=>$rcRow){
					
					if($nuContR<$nuColumns){
						$sbPorcentaje = $sbPorColum; 
					}else{
						$sbPorcentaje = $sbPorFin;
					}
					
					$sbHtml .= "<td width=\"".$sbPorcentaje."\">";
					$sbHtml .= "<table border=\"0\" align=\"center\" width=\"100%\">";
					if(($rcRow["dedinombres"] != "ordenumeros") && ($rcRow["dedinombres"] != "acemnumeros")){
						$_name = strtolower($rcPlugins[$rcRow["deditipobjes"]]);
						$_type = "function";

						$_plugin_file = Application::getPluginsDirectory()."/".$_type.".".$_name.".php";
						if(file_exists($_plugin_file)){
							$_plugin_func = 'smarty_' .$_type.'_'.$_name;
							if(!in_array($_plugin_func,$rcIncl))
							{
								$rcIncl[] = $_plugin_func;
								include_once $_plugin_file;
							}
							if(!$rcRow["deditamtips"])
							if(strstr($rcRow["deditipodats"],"int") || strstr($rcRow["deditipodats"],"double"))
							$rcRow["deditamtips"] = 14;
							if($rcRow["deditipobjes"]=='void')
							$bold = "<b>";
							else
							$bold = "";
							$sbHtml .= "<tr><td  width='25%'>".$bold.$this->getLabel($rclabels,$rcRow["dedinotnulls"],$rcRow["dedinombres"])."</td>";
							$sbHtml .= "<td width='60%'>".$_plugin_func(array("id"=>$rcRow["dedinombres"],"name"=>"orden__".$rcRow["dedinombres"],"accesskey"=>$rclabels[$rcRow["dedinombres"]][1],
										"typeData"=>$rcRow["deditipodats"],"maxlength"=>$rcRow["deditamtips"],"rcRow"=>$rcRow),$this,false);

							if($rcRow["dedinotnulls"])
							$sbHtml .= "<B>*</B>";
							$sbHtml .= "</td></tr>";
						}
					}
					$sbHtml .= "</table>";
					$sbHtml .= "</td>";
					$nuContR ++;
				}
				$sbHtml .= "</tr>";
			}
		}
		if(strlen($sbHtml))
		{
			$sbHtml .= "<input type=hidden name=orden__dimension value='".join(",",$rcDim)."'>";
			$sbHtml = "<table border=\"0\" align=\"center\" width=\"100%\">".$sbHtml."</table>";
			return $sbHtml;
		}
		else
		return false;
	}

	function LoadRequest($rcParams) {

		settype($objService,"object");
		settype($objManager,"object");
		settype($objGateway,"object");
		settype($objDataType,"object");
		settype($objCross300,"object");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($rcDimension,"array");
		settype($rcField,"array");
		settype($rcDateFields,"array");
		settype($rcExtraData,"array");
		settype($sbProccodigos,"string");
		settype($sbResult,"string");
		settype($sbTable,"string");

		if (is_array($rcParams) && $rcParams) {
			$rcUser = Application :: getUserParam();
			$objDataType = Application :: loadServices('Data_type');

			if($rcParams["ordenumeros"]){
				$objCross300 = Application :: loadServices("Cross300");
				$objGateway = $objCross300->getGateWay("Orden");
				$rcTmp = $objGateway->getByIdOrden($rcParams["ordenumeros"]);
				$objCross300->close();
				if(is_array($rcTmp) && $rcTmp){
					$sbProccodigos = $rcTmp[0]["proccodigos"];
				}
			}else{
				//servicio de reglas del motor
				$objService = Application :: loadServices("Workflow");
				$sbProccodigos = $objService->getIdprocess($rcParams,true);
			}
				
			$objManager = Application :: getDomainController('DimensionManager');
			$objManager->setCodidominios('proceso');
			$objManager->setCodidomicams('proccodigos');
			$objManager->setCodidomivals($sbProccodigos);
			$objManager->setIdProcess($rcUser["username"]);
			$objManager->setVadidominios('ordenumeros');
			$objManager->setVadidomivals($rcParams['ordenumeros']);
			$objManager->setParams($rcParams);
			$objManager->setOperation('getValorDimension');
			$objManager->execute();

			$sbResult = $objManager->getResult();
			$sbTable = $objManager->getTmpTable();
			$rcDimension = $objManager->getDetalleDimension();

			//Consulta los datos adicionales
			if ($sbResult) {
				//Determina los campos fecha
				if (is_array($rcDimension) && $rcDimension) {
					foreach ($rcDimension as $rcField) {
						if ($rcField['dediformatos'] == 'date')
						$rcDateFields[] = $rcField['dedinombres'];
					}
				}
				$objCross300 = Application :: loadServices("Cross300");
				$objGateway = $objCross300->getGateWay("OrdenempresaExtended");
				$rcExtraData = $objGateway->getDataFichaAdicional($sbTable, null, $rcDateFields);
				$objCross300->close();
			}
				
			if ($rcExtraData) {
				foreach ($rcExtraData as $sbKey => $sbValue) {
					$_REQUEST["orden__".$sbKey] = $sbValue;
				}
				$_REQUEST["action"] = "CmdShowById";
			}

			if (WebSession :: issetProperty("rcRequest")) {
				$rcExtraData = $_SESSION["rcRequest"];
				WebSession :: unsetProperty("rcRequest");

				if ($rcExtraData) {
					foreach ($rcExtraData as $sbKey => $sbValue) {
						$_REQUEST[$sbKey] = $objDataType->formatString($sbValue);
					}
					$_REQUEST["action"] = true;
				}
			}
		}
	}

	function getAccesskey($rclabelsFichaOrd, $rcMetadata) {
		settype($rcUsedKeys, "array");
		$rcUsed = WebSession :: getProperty("labels");
		if ($rcUsed) {
			array_push($rcUsed, WebSession :: getProperty("labelscommands"));
			array_push($rcUsed, WebSession :: getProperty("title"));
			foreach ($rcUsed as $key => $rcValues) {
				$rcUsedKeys[] = $rcValues[1];
			}
		}

		foreach ($rcMetadata as $rcRow) {
			$key = $rcRow["dedinombres"];
			if (array_key_exists($key, $rclabelsFichaOrd))
			$rclabels[$key] = $rclabelsFichaOrd[$key];
		}

		foreach ($rclabels as $sbkey => $rcvalue) {
			$rcvalue["label"] = $this->fncacute_a_tilde($rcvalue["label"]);
			if ($rcvalue["accesskey"]) {
				$rctmp = $this->fncmodificarlabel($rcvalue["label"], $rcUsedKeys);
				$rclabel[$sbkey] = array ($rctmp[0], $rctmp[1], $rcvalue["commentary"]);
			} else {
				$sbkey = strtolower($sbkey);
				$rclabel[$sbkey] = array ($rcvalue["label"], null, $rcvalue["commentary"]);
			}
		}
		return $rclabel;
	}

	function fncmodificarlabel($isblabel, & $ircletrasusadas, $isbsenal = true) {
		settype($orcresult, "array");
		settype($sbteclarapida, "string");
		settype($sbresult, "string");

		$sbteclarapida = $this->fncteclarapida($isblabel, $ircletrasusadas);

		if ($sbteclarapida) {
			if ($ircletrasusadas) {
				if (!in_array($sbteclarapida, $ircletrasusadas))
				$ircletrasusadas[] = $sbteclarapida;
			} else
			$ircletrasusadas[] = $sbteclarapida;

			$sbresult = $this->fncresaltarlabel($isblabel, $sbteclarapida, $isbsenal);
			$orcresult[0] = $sbresult;
			$orcresult[1] = $sbteclarapida;
		} else {
			$orcresult[0] = $isblabel;
			$orcresult[1] = false;
		}
		$orcresult[0] = $this->fnctildea_a_cute($orcresult[0]);
		return $orcresult;
	}

	function fncteclarapida($isblabel, $ircletrasusadas) {
		settype($rcletperm, "array");
		settype($osbresult, "string");
		settype($nucontador, "integer");
		settype($nulargocadena, "integer");
		if ($isblabel) {
			//Pasa las tildes HTML a normales
			$isblabel = strtoupper($isblabel);
			$nulargocadena = strlen($isblabel);
			$rcletperm = array ("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
			if (is_array($ircletrasusadas))
			for ($nucontador = 0; $nucontador < $nulargocadena; $nucontador ++)
			if (!in_array($isblabel[$nucontador], $ircletrasusadas))
			if (in_array($isblabel[$nucontador], $rcletperm)) {
				$osbresult = $isblabel[$nucontador];
				break;
			}
		}
		if (!$osbresult)
		$osbresult = $isblabel[0];
		return $osbresult;
	}

	function fncresaltarlabel($isblabel, $isbteclarapida, $isbsenal) {
		settype($osbresult, "string");
		settype($sbinicial, "string");
		settype($sbfinal, "string");
		settype($nuposicion, "integer");

		$isbteclarapida = strtoupper($isbteclarapida);
		$nuposicion = strpos(strtoupper($isblabel), $isbteclarapida);

		if ($isbsenal) {
			if ($nuposicion == 0) {
				$sbfinal = substr($isblabel, $nuposicion +1);
				$osbresult = "<u>".$isbteclarapida."</u>".$sbfinal;
			} else {
				$sbinicial = substr($isblabel, 0, $nuposicion);
				$sbfinal = substr($isblabel, $nuposicion +1);
				$osbresult = $sbinicial."<u>".strtolower($isbteclarapida)."</u>".$sbfinal;
				$osbresult = ucfirst($osbresult);
			}
		} else {
			if ($nuposicion == 0) {
				$sbfinal = substr($isblabel, $nuposicion +1);
				$osbresult = $isbteclarapida.$sbfinal;
			} else {
				$sbinicial = strtolower(substr($isblabel, 0, $nuposicion));
				$sbfinal = strtolower(substr($isblabel, $nuposicion +1));
				$osbresult = $sbinicial.$isbteclarapida.$sbfinal;
			}
		}
		return $osbresult;
	}

	function fncacute_a_tilde($isbcadena) {
		if (!$isbcadena) {
			return $isbcadena;
		}

		$isbcadena = str_replace("&aacute;", "á", $isbcadena);
		$isbcadena = str_replace("&eacute;", "é", $isbcadena);
		$isbcadena = str_replace("&iacute;", "í", $isbcadena);
		$isbcadena = str_replace("&oacute;", "ó", $isbcadena);
		$isbcadena = str_replace("&uacute;", "ú", $isbcadena);
		$isbcadena = str_replace("&Aacute;", "Á", $isbcadena);
		$isbcadena = str_replace("&Eacute;", "É", $isbcadena);
		$isbcadena = str_replace("&Iacute;", "Í", $isbcadena);
		$isbcadena = str_replace("&Oacute;", "Ó", $isbcadena);
		$isbcadena = str_replace("&Uacute;", "Ú", $isbcadena);
		return $isbcadena;
	}

	function fnctildea_a_cute($isbcadena) {
		if (!$isbcadena) {
			return $isbcadena;
		}
		$isbcadena = str_replace("á", "&aacute;", $isbcadena);
		$isbcadena = str_replace("é", "&eacute;", $isbcadena);
		$isbcadena = str_replace("í", "&iacute;", $isbcadena);
		$isbcadena = str_replace("ó", "&oacute;", $isbcadena);
		$isbcadena = str_replace("ú", "&uacute;", $isbcadena);
		$isbcadena = str_replace("Á", "&Aacute;", $isbcadena);
		$isbcadena = str_replace("É", "&Eacute;", $isbcadena);
		$isbcadena = str_replace("Í", "&Iacute;", $isbcadena);
		$isbcadena = str_replace("Ó", "&Oacute;", $isbcadena);
		$isbcadena = str_replace("Ú", "&Uacute;", $isbcadena);
		return $isbcadena;
	}
}
?>