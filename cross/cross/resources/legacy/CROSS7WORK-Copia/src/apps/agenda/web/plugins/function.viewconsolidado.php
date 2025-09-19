<?php
/**Copyright 2004 ï¿½ FullEngine
Libreria de Centro de Consulta al cliente
@author cazapata <cazapata@parquesoft.com>
@date 03-sep-2004 11:08:26
@location Cali - Colombia
*/
function smarty_function_viewconsolidado($params, &$smarty){
	extract($_REQUEST);
	settype($objService,"object");
	settype($rcTmp,"array");

	//Carga el servicio de control de fechas
	$serviceDate = Application :: loadServices("DateController");

	if(!$ordefecingdini || !$ordefecingdfin)
        return false;
	
	//Obtiene la compuerta
	$gateway = Application :: getDataGateway("consolidado");
	
	//Convierto las fechas
	if($ordefecingdini && $ordefecingdfin)
	{
        $periodo = "$ordefecingdini - $ordefecingdfin";
		$ordefecingdini = $serviceDate->fncdatetoint($ordefecingdini);
		$ordefecingdfin = $serviceDate->fncdatetoint($ordefecingdfin);
        //Aï¿½ade a la fecha final la cantidad de segundos del dï¿½a
        $ordefecingdfin += 86399;
	}
	
	if(!$sbnameDepend){
		//se obtiene el nombre de la dependencia
		$objService = Application :: loadServices("Human_resources");
		$rcTmp = $objService->getDataEntesOrg($orgacodigos, true);
		if($rcTmp){
			$sbnameDepend = $rcTmp["nombre"];
		}
	}
	 
	
	//Primero busco la Data Principal
	$rcDatos = $gateway->fncConsultar(1,$ordefecingdini,$ordefecingdfin,$orgacodigos,null);
	$rcTipoReq = $gateway->fncConsultar(2,null,null,null,null);
	//$rcReqEstado = $gateway->fncConsultar(3,$ordefecingdini,$ordefecingdfin,$orgacodigos,null);
	//$rcEstadoReq = $gateway->fncConsultar(4,null,null,null,null);
	$rcClasifica = $gateway->fncConsultar(6,null,null,null,null);
	$rcSubClasificacion = $gateway->fncConsultar(7,null,null,null,null);
	$rcMedios = $gateway->fncConsultar(9,null,null,null,null);

	fncPaintReporte($periodo,$sbDependencia,$sbnameDepend,$rcDatos,$rcTipoReq,$rcReqEstado,$rcEstadoReq,$rcClasifica,$rcSubClasificacion,$rcMedios,$rcLabels);
}

function fncPaintReporte($sbPeriodo,$sbDependencia,$sbnameDepend,$rcDatos,$rcTipoReq,$rcReqEstado,$rcEstadoReq,$rcClasifica,$rcSubClasificacion,$rcMedios,$rcLabels)
{
	$objGraph = Application::getDomainController("GraphicManager");
    $rcuser = Application::getUserParam();
    if(!is_array($rcuser)){
        $rcuser['lang'] = Application::getSingleLang();
    }
    
    include($rcuser["lang"]."/".$rcuser["lang"].".consolidado.php");

	define("TOTALREQ",100);
	
	$sbCadena .= "<table border=0>";
	$sbCadena .= "<tr>";
	if($sbnameDepend)
        $sbCadena .= "  <th>".$rclabels["titulo1"]["label"]." ".$sbnameDepend;
	else
        $sbCadena .= "  <th>".$rclabels["titulo7"]["label"];
    
	$sbCadena .= "      <br> ".$rclabels["titulo2"]["label"]." ".$sbPeriodo." ";
	$sbCadena .= "  </th>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td colspan=2 class=\"piedefoto\">&nbsp;</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";
	
	//POR TIPO DE CASOS RECIBIDOS
	$sbCadena .= fncReporteTiposReq($rcDatos,$rcTipoReq,$rclabels,$objGraph);
	
	//GESTIÓN DE SOLUCIÓN DE LAS TAREAS POR ESTADO
	//$sbCadena .= fncReporteEstados($rcReqEstado,$rcEstadoReq,$rclabels,$objGraph);

	//GESTIÓN DE SOLUCIÓN DE LOS CASOS POR TÉRMINOS DE ATENCIÓN
	$sbCadena .= fncReporteTerminos($rcDatos,$rcTipoReq,$rclabels,$objGraph);

	//RECEPCIÓN DE LOS CASOS (Medio y Tipo)
	$sbCadena .= fncReporteMediosRecepcion($rcDatos,$rcTipoReq,$rcMedios,$rclabels,$objGraph);
	
	print $sbCadena;
}

function fncReporteMediosRecepcion($rcDatos,$rcTipoReq,$rcMedios,$rclabels,$objGraph)
{
	$sbCadena .= "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"titulofila\">".$rclabels["titulo6"]["label"]."</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"piedefoto\">".fncPaintMedioRecepcion($rcDatos,$rcTipoReq,$rcMedios,$rclabels,$rcDatosReporteTipos)."<br></td>";
	
	if(is_array($rcDatosReporteTipos))
	{
		//EXCEL
		if(is_array($rcDatosReporteTipos[2]))
		{
			array_unshift($rcDatosReporteTipos[2],array($rclabels["medio"]["label"],$rclabels["total"]["label"]));
			array_unshift($rcDatosReporteTipos[2],array($rclabels["titulo6"]["label"]));
			$sbCadena .= getExcelBook($rcDatosReporteTipos[2],$rclabels);
		}
		//IMAGEN
		$objGraph->nuWidth=500;
		$objGraph->nuHeight=300;
		$rcAdit["rcSeries"] = $rcDatosReporteTipos[3];
		$blGraph = $objGraph->createExplode3DPieplot($rcDatosReporteTipos[1],$rcDatosReporteTipos[0],'',$rcAdit);
		if($blGraph)
			$sbCadena .= "<td class='piedefoto'><img src='".$objGraph->sbFileName."' align='center'></td>";
	}	
	$sbCadena .= "</tr>";
    $sbCadena .= "</table>";
	return $sbCadena;
}

function fncReporteTerminos($rcDatos,$rcTipoReq,$rclabels,$objGraph)
{
	$sbCadena .= "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"titulofila\">".$rclabels["titulo5"]["label"]."</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"piedefoto\">".fncPaintTerminos($rcDatos,$rcTipoReq,$rclabels,$rcDatosReporteTipos);
	$sbCadena .= "      <br><p>".$rclabels["pieatencion"]["label"]."</td>";
	
	if(is_array($rcDatosReporteTipos))
	{
		//EXCEL
		if(is_array($rcDatosReporteTipos[2]))
		{
			array_unshift($rcDatosReporteTipos[2],array($rclabels["atencion"]["label"],$rclabels["no"]["label"],$rclabels["acumulado"]["label"]));
			array_unshift($rcDatosReporteTipos[2],array($rclabels["titulo5"]["label"]));
			$sbCadena .= getExcelBook($rcDatosReporteTipos[2],$rclabels);
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

function fncReporteTiposReq($rcDatos,$rcTipoReq,$rclabels,$objGraph)
{
	$sbCadena .= "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"titulofila\">".$rclabels["titulo3"]["label"]."</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"piedefoto\">".fncPaintTipoReq($rcDatos,$rcTipoReq,$rclabels,$rcDatosReporteTipos);
	$sbCadena .= "      <br><p>".$rclabels["pietiporeq"]["label"]."</td>";
	
	if(is_array($rcDatosReporteTipos))
	{
		//EXCEL
		if(is_array($rcDatosReporteTipos[2]))
		{
			array_unshift($rcDatosReporteTipos[2],array($rclabels["tiporeq"]["label"],$rclabels["no"]["label"],$rclabels["acumulado"]["label"]));
			array_unshift($rcDatosReporteTipos[2],array($rclabels["titulo3"]["label"]));
			$sbCadena .= getExcelBook($rcDatosReporteTipos[2],$rclabels);
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

function fncReporteEstados($rcReqEstado,$rcEstadoReq,$rclabels,$objGraph)
{
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"titulofila\">".$rclabels["titulo4"]["label"]."</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "  <td class=\"piedefoto\">".fncPaintReqEstado($rcReqEstado,$rcEstadoReq,$rclabels,$rcDatosReporteEstados);
	$sbCadena .= "     <br><p>".$rclabels["pieestado"]["label"]."</td>";
	
	if(is_array($rcDatosReporteEstados))
	{
		//EXCEL
		if(is_array($rcDatosReporteEstados[2]))
		{
			array_unshift($rcDatosReporteEstados[2],array($rclabels["estado"]["label"],$rclabels["no"]["label"],$rclabels["acumulado"]["label"]));
			array_unshift($rcDatosReporteEstados[2],array($rclabels["titulo4"]["label"]));
			$sbCadena .= getExcelBook($rcDatosReporteEstados[2],$rclabels);
		}
		//IMAGEN
		$objGraph->nuWidth=500;
		$objGraph->nuHeight=300;
		$blGraph = $objGraph->createExplode3DPieplot($rcDatosReporteEstados[1],$rcDatosReporteEstados[0],'');
		if($blGraph)
			$sbCadena .= "<td class='piedefoto'><img src='".$objGraph->sbFileName."' align='center'></td>";
	}
	$sbCadena .= "</tr>";
    $sbCadena .= "</table>";
	return $sbCadena;
}

function fncPaintMedioRecepcion($rcDatos,$rcTipoReq,$rcMedios,$rcLabels,&$rcDatosReporteTipos)
{
	//Cuento cuantos req. de un evento llegaron segun un medio de recepcion
	$nuReg =  sizeof($rcDatos);
	for($nuCant=0;$nuCant<$nuReg;$nuCant++)
	{
		$nuTipoordenactual = $rcDatos[$nuCant]["tiorcodigos"];
		$nuMedio = $rcDatos[$nuCant]["merecodigos"];
		
		$rcTipoMedio[$nuMedio][$nuTipoordenactual]++;
		$rcSubTipo[$nuTipoordenactual]++;
	}

	$nuSizeTipoReq = sizeof($rcTipoReq);
	$nuSizeMedios = sizeof($rcMedios);
	
	//Lleno la matriz inicialmente
	for($nuCont=0;$nuCont<$nuSizeMedios;$nuCont++)
	{
		for($nuCant=0;$nuCant<$nuSizeTipoReq;$nuCant++)
		{
			$nuTiorcodigos = $rcTipoReq[$nuCant]["tiorcodigos"];
			$nuMerecodigos = $rcMedios[$nuCont]["merecodigos"];
			if($rcTipoMedio[$nuMerecodigos][$nuTiorcodigos])
			{
				$rcMatriz[$nuMerecodigos][$nuTiorcodigos]=$rcTipoMedio[$nuMerecodigos][$nuTiorcodigos];
			}
			else
			{
				$rcMatriz[$nuMerecodigos][$nuTiorcodigos]=0;
			}
		}
	}
	
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td>&nbsp;</td>";
	$sbCadena .= "<td><b>".$rcLabels["medio"]["label"]."</b></td>";
	$nuCantReg = sizeof($rcTipoReq);

	for($nuCont=0;$nuCont<$nuCantReg;$nuCont++)
	{
		$nuTiorcodigos = $rcTipoReq[$nuCont]["tiorcodigos"];
		$sbTipoOrdennom = $rcTipoReq[$nuCont]["tiornombres"];
		$sbCadena .= "<td align=left>".$sbTipoOrdennom."</td>";
		
	}
	$sbCadena .= "<td align=left>".$rcLabels["total"]["label"]."</td>";
	$sbCadena .= "</tr>";
	
	$nuTamano = sizeof($rcMedios);
	for($nuCont=0;$nuCont<$nuTamano;$nuCont++)
	{
		$nusubTotalMedio =0;
		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=left>".($nuCont+1)."</td>";
		$sbCadena .= "<td align=left>".$rcMedios[$nuCont]["merenombres"]."</td>";
		
		$nuMedioActual = $rcMedios[$nuCont]["merecodigos"];
		if($rcTipoMedio[$nuMedioActual]){
			$rcTipoReqMedioActual = array_keys($rcMatriz[$nuMedioActual]);
		}
		
		$nuSize = sizeof($rcTipoReqMedioActual);
		for($nuConta=0;$nuConta<$nuSize;$nuConta++)
		{
			$nuValorReq  = $rcMatriz[$nuMedioActual][$rcTipoReqMedioActual[$nuConta]];
			if($nuValorReq == "" || is_null($nuValorReq)){
				$nuValorReq = 0;
			}
			$sbCadena .= "<td align=center>".$nuValorReq."</td>";
			$nusubTotalMedio += $nuValorReq;
		}
		if($nuSize==0){
			for($nuContador=0;$nuContador<$nuSizeTipoReq;$nuContador++){
				$sbCadena .="<td align=center>0</td>";
			}
			$sbCadena .= "<td align=right>".$nusubTotalMedio."</td>";
		}
		else{
			$sbCadena .= "<td align=right>".$nusubTotalMedio."</td>";
		}
		$sbCadena .= "</tr>";

		//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
		$rcDatosReporteTipos[0][$nuCont] = $nuCont+1;
		$rcDatosReporteTipos[1][$nuCont] = $nusubTotalMedio;
		$rcDatosReporteTipos[2][$nuCont] = array($rcMedios[$nuCont]["merenombres"],$nusubTotalMedio);
	}

	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=right>&nbsp;</td>";
	$sbCadena .= "<td align=right>".$rcLabels["total"]["label"]."</td>";
	$nuCantReg = sizeof($rcTipoReq);
	for($nuConta=0;$nuConta<$nuCantReg;$nuConta++)
	{
		$nuTiorcodigos = $rcTipoReq[$nuConta]["tiorcodigos"];
		$nuSubValor = $rcSubTipo[$nuTiorcodigos];
		if(!$nuSubValor){
			$nuSubValor = 0;
		}
		$sbCadena .= "<td align=center>".$nuSubValor."</td>";
	}
	$rcDatosReporteTipos[2][] = array($rcLabels["total"]["label"],$nuReg);
	$sbCadena .= "<td align=right>".$nuReg."</td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";
	
	return $sbCadena;
}

function fncPaintTerminos($rcDatos,$rcTipoReq,$rcLabels,&$rcDatosReporteEstados)
{
	//Inicializo el servicio
	$serviceDate = Application :: loadServices("DateController");
    
	//$nuDia = $serviceDate->fncintdate() + 86399;
	$nuDia = $serviceDate->fncintdatehour();
	$nuReg =  sizeof($rcDatos);
	
	$nuNoFechatermino = 0;
	$nuSiFechatermino = 0;
	$nuPendiente = 0;
    $nuPendienteFuera = 0;
    if(is_array($rcDatos)){
        foreach($rcDatos as $rcOrden){
            //Verifica si esta finalizada
            if($rcOrden['ordefecfinad']){
                //Verifica si esta finalizada fuera del termino
                //Ver si es con horas
                $hour = $serviceDate ->getHour2DateInSecs($rcOrden['ordefecvend']);
                if(!$hour)
                    $rcOrden['ordefecvend'] += 86399;
                if($rcOrden['ordefecfinad'] > $rcOrden['ordefecvend'])
                    $nuNoFechatermino ++;
                else
                    $nuSiFechatermino ++;
            }else{
                //Ver si es con horas
                $hour = $serviceDate ->getHour2DateInSecs($rcOrden['ordefecvend']);
                if(!$hour)
                    $rcOrden['ordefecvend'] += 86399;
                //Verifica si es pendiente vencida
                if($nuDia < $rcOrden['ordefecvend'])
                    $nuPendiente ++;
                else
                    $nuPendienteFuera ++;
            }
        }
    }
	$nuCont=0;
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td rowspan=2><b>".$rcLabels["atencion"]["label"]."</b></td>";
	$sbCadena .= "<td colspan=2><b>".$rcLabels["acumulado"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td><b>".$rcLabels["no"]["label"]."</b></td>";
	$sbCadena .= "<td><b>".$rcLabels["porcentaje"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=center>".(++$nuCont)."</td>";
	$sbCadena .= "<td align=left>".$rcLabels["dentro"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuSiFechatermino."</td>";
	$nuPorcentaje = fnuPorcentaje($nuSiFechatermino,$nuReg);
	$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
	$sbCadena .= "</tr>";
	
	$rcDatosReporteEstados[0][$nuCont] = $nuCont;
	$rcDatosReporteEstados[1][$nuCont] = $nuSiFechatermino;
	$rcDatosReporteEstados[2][$nuCont] = array($rcLabels["dentro"]["label"],$nuSiFechatermino,$nuPorcentaje);
		
	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=center>".(++$nuCont)."</td>";
	$sbCadena .= "<td align=left>".$rcLabels["fuera"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuNoFechatermino."</td>";
	$nuPorcentaje = fnuPorcentaje($nuNoFechatermino,$nuReg);
	$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
	$sbCadena .= "</tr>";
	
	$rcDatosReporteEstados[0][$nuCont] = $nuCont;
	$rcDatosReporteEstados[1][$nuCont] = $nuNoFechatermino;
	$rcDatosReporteEstados[2][$nuCont] = array($rcLabels["fuera"]["label"],$nuNoFechatermino,$nuPorcentaje);
	
	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=center>".(++$nuCont)."</td>";
	$sbCadena .= "<td align=left>".$rcLabels["pendnovenci"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuPendiente."</td>";
	$nuPorcentaje = fnuPorcentaje($nuPendiente,$nuReg);
	$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
	$sbCadena .= "</tr>";
	
	$rcDatosReporteEstados[0][$nuCont] = $nuCont;
	$rcDatosReporteEstados[1][$nuCont] = $nuPendiente;
	$rcDatosReporteEstados[2][$nuCont] = array($rcLabels["pendnovenci"]["label"],$nuPendiente,$nuPorcentaje);
	
	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=center>".(++$nuCont)."</td>";
	$sbCadena .= "<td align=left>".$rcLabels["pendvenci"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuPendienteFuera."</td>";
	$nuPorcentaje = fnuPorcentaje($nuPendienteFuera,$nuReg);
	$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
	$sbCadena .= "</tr>";
	
	$rcDatosReporteEstados[0][$nuCont] = $nuCont;
	$rcDatosReporteEstados[1][$nuCont] = $nuPendienteFuera;
	$rcDatosReporteEstados[2][$nuCont] = array($rcLabels["pendvenci"]["label"],$nuPendienteFuera,$nuPorcentaje);
	
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td align=right>".$rcLabels["total"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuReg."</td>";
	$rcDatosReporteEstados[2][] = array($rcLabels["total"]["label"],$nuReg,100);
	
	if($nuReg>0){
		$sbCadena .= "<td align=center>".TOTALREQ."</td>";
	}
	else{
		$sbCadena .= "<td align=center>".$nuReg."</td>";
	}
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";
	return $sbCadena;	
}

function fncPaintClasificacion($rcDatos,$rcClasifica,$rcSubClasificacion,$rcLabels)
{
	//Obtiene la compuerta
	$gateway = Application :: getDataGateway("consolidado");

	//Para la consulta 1 se realiza sobre el evento = Denuncia
	//$rcParameEvento = fncapiParametro('denuncia',$rcValConexion,$rcValConexion["sbMotorBd"],'parameorden');
	$sbDenuncias = 2;//$rcParameEvento["paorvalors"];
	
	$nuReg =  sizeof($rcDatos);
	//Contabilizo la cantidad de requerimientos por clasificacion
	$nuDenuncias = 0;
	$nuClasificacion = 0;
	for($nuCant=0;$nuCant<$nuReg;$nuCant++)
	{
		$nuEventoactual = $rcDatos[$nuCant]["evencodigos"];
		$nuSubclaactual = $rcDatos[$nuCant]["causcodigos"];
		
		$rcCausa[$nuEventoactual]++;
		//Contabilizo la cantidad de requerimientos por subclasificacion
		if(!is_null($nuSubclaactual) || $nuSubclaactual != ""){
			$rcSubClasi[$nuEventoactual][$nuSubclaactual]++;
		}
		
		$sbTipoReqactual = $rcDatos[$nuCant]["tiorcodigos"];
		if($sbTipoReqactual==$sbDenuncias)
		{
			$nuDenuncias++;
		}
	}
    
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2 colspan=2><b>Tipos de caso".$rcLabels["darn"]["label"]."</b></td>";
	$sbCadena .= "<td colspan=4><b>".$rcLabels["acumulado"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td><b>".$rcLabels["no"]["label"]."</b></td><td><b>".$rcLabels["porcentaje"]["label"]."</b></td>";
	$sbCadena .= "<td><b>".$rcLabels["suma"]["label"]."</b></td><td><b>".$rcLabels["sumapor"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$nuSubTotal = 0;
	$nuSubSubTotal = 0;	//Variable que almacenara el subtotal de requerimientos con subclasificacion
	$nuCantReg = sizeof($rcClasifica);
	for($nuCont=0;$nuCont<$nuCantReg;$nuCont++)
	{
		$sbCadena .= "<tr>";
		$nuCols=1;
		//Codigo de la clasificacion actual
		$nuCauscodigos = $rcClasifica[$nuCont]["evencodigos"];
		//Cantidad de subclasificaciones que tiene la actual clasificacion
		$nuTamSubcodigos = sizeof($rcSubClasi[$nuCauscodigos]);
		//Para darle la cantidad de columnas que ocupara en el cuadro la clasificacion respectiva
		if($nuTamSubcodigos == 0){
			//Si no tiene subclasificaciones
			$nuCols = 2;
		}
		else{
			//Si tiene clasificaciones
			$nuCols=1;
		}
		//Saco las llaves donde estan los codigos de las subclasificaciones de la clasificacion actual
		if($rcSubClasi[$nuCauscodigos]){
			$rcLlaves = array_keys($rcSubClasi[$nuCauscodigos]);
			$nuSize = sizeof($rcLlaves);
		}
		//Consulto los descriptores en la tabla subclasificacion para el evento y la causa actual
		unset($rcSubclasifica);
		for($nuConta=0;$nuConta<$nuSize;$nuConta++)
		{
			$rcParametros["campo"][0]="tiorcodigos";
			$rcParametros["valor"][0]= $rcClasifica[$nuCont]["tiorcodigos"];
			$rcParametros["campo"][1]="evencodigos";
			$rcParametros["valor"][1]= $rcClasifica[$nuCont]["evencodigos"];
			$rcParametros["campo"][2]="causcodigos";
			$rcParametros["valor"][2]= $rcLlaves[$nuConta];
			$rcSubTempo = $gateway->fncConsultar(5,null,null,null,$rcParametros);

			if($rcSubTempo){
				$rcSubclasifica[] = $rcSubTempo;
			}
			else{
				$nuTamSubcodigos--;
			}
		}
		//Validacion adicional para la incongruencia de data
		if(!is_array($rcSubclasifica[0])){
			$nuCols = 2;
			unset($rcSubClasi[$rcClasifica[$nuCont]["evencodigos"]]);
		}
		$sbCadena .= "<td align=left colspan=".$nuCols." rowspan=".$nuTamSubcodigos.">".$rcClasifica[$nuCont]["evennombres"]."</td>";
		if($nuTamSubcodigos > 0)
		{
			//Pinto las subclasificaciones de esta clasificacion
			$sbFlag = 0;
			for($nuContador=0;$nuContador<$nuTamSubcodigos;$nuContador++)
			{
				//Complemento de la validacion adicional por incongruencia de data
				if($nuCols == 1){
					$nuSubcodigos = $rcSubclasifica[$nuContador][0]["causcodigos"];
					$sbSubnombres = $rcSubclasifica[$nuContador][0]["causnombres"];
					//$sbCadena .= "<td>".$nuSubcodigos.$sbSubnombres."</td>";
					$sbCadena .= "<td>".$sbSubnombres."</td>";
				}
				//Cuando tiene subclasificaciones se saca el subtotal
				$nuValorReq  = $rcSubClasi[$nuCauscodigos][$nuSubcodigos]; 
				//Cuando no las tiene se saca de las clasificaciones
				$nuValorSum = $rcCausa[$nuCauscodigos];
				//Valido que el tipo
				if($nuValorSum == "" || is_null($nuValorSum)){
					$nuValorSum = 0;
				}				
				if($nuValorReq == "" || is_null($nuValorReq)){
					$nuValorReq = 0;
				}
				$sbCadena .= "<td align=center>".$nuValorReq."</td>";
				$nuPorcentaje = fnuPorcentaje($nuValorReq,$nuDenuncias);
				$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
				//Para las sumatorias
				if($sbFlag==0){
					$sbCadena .= "<td align=center rowspan=".$nuTamSubcodigos.">".$nuValorSum."</td>";
					$nuPorcentaje = fnuPorcentaje($nuValorSum,$nuDenuncias);
					$sbCadena .= "<td align=center rowspan=".$nuTamSubcodigos.">".$nuPorcentaje."</td>";
					$sbFlag =1;
				}
				$sbCadena .= "</tr>";
				$nuSubSubTotal += $nuValorReq;
				//print "<br>Con subclasificacion: ".$nuSubSubTotal."<br>";
			}
		}
		else{
				//Cuando no las tiene se saca de las clasificaciones
				$nuValorSum = $rcCausa[$nuCauscodigos];
				//Valido que el tipo
				if($nuValorSum == "" || is_null($nuValorSum)){
					$nuValorSum = 0;
				}				
				$sbCadena .= "<td align=center>".$nuValorSum."</td>";
				$nuPorcentaje = fnuPorcentaje($nuValorSum,$nuDenuncias);
				$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
				$sbCadena .= "<td align=center>".$nuValorSum."</td>";
				$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
				$sbCadena .= "</tr>";
				$nuSubTemp += $nuValorSum;
				$nuSubSubTotal += $nuValorSum;
				//print "<br>Sin subclasificacion: ".$nuSubSubTotal."<br>";
		}
		//Subtotal de lo que digito sin subclasificacion
		$nuSubTotalReq += $nuValorReq;
		//Subtotal de la sumatoria
		$nuSubTotal += $nuValorSum;
	}
	$sbCadena .= "<tr>";
	$sbCadena .= "<td align=right colspan=2>".$rcLabels["total"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuSubSubTotal."</td>";
	//$sbCadena .= "<td align=center>".$nuSubTotalReq."</td>";
	if($nuDenuncias>0){
		$sbCadena .= "<td align=center>".TOTALREQ."</td>";
		$sbCadena .= "<td align=center>".$nuSubTotal."</td>";
		$sbCadena .= "<td align=center>".TOTALREQ."</td>";
	}
	else{
		$sbCadena .= "<td align=center>0</td>";
		$sbCadena .= "<td align=center>0</td>";
		$sbCadena .= "<td align=center>0</td>";
	}
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";
	return $sbCadena;	
}

function fncPaintReqEstado($rcReqEstado,$rcEstadoReq,$rcLabels,&$rcDatosReporteEstados)
{
	$nuReg =  sizeof($rcReqEstado);
	for($nuCant=0;$nuCant<$nuReg;$nuCant++) {
		$nuEstadoactual = $rcReqEstado[$nuCant]["actaestacts"];
		$rcEstado[$nuEstadoactual]++;
	}
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td rowspan=2><b>".$rcLabels["estado"]["label"]."</b></td>";
	$sbCadena .= "<td colspan=2><b>".$rcLabels["acumulado"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td><b>".$rcLabels["no"]["label"]."</b></td>";
	$sbCadena .= "<td><b>".$rcLabels["porcentaje"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$nuCantReg = sizeof($rcEstadoReq);
	for($nuCont=0;$nuCont<$nuCantReg;$nuCont++) {
		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>".($nuCont+1)."</td>";
		$sbCadena .= "<td align=left>".$rcEstadoReq[$nuCont]["esacnombres"]."</td>";
		$nuValorReq  = $rcEstado[$rcEstadoReq[$nuCont]["esaccodigos"]];
		if($nuValorReq == "" || is_null($nuValorReq)){
			$nuValorReq = 0;
		}
		$sbCadena .= "<td align=center>".$nuValorReq."</td>";
		$nuPorcentaje = fnuPorcentaje($nuValorReq,$nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";
		
		//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
		$rcDatosReporteEstados[0][$nuCont] = $nuCont+1;
		$rcDatosReporteEstados[1][$nuCont] = $nuValorReq;
		$rcDatosReporteEstados[2][$nuCont] = array($rcEstadoReq[$nuCont]["esacnombres"],$nuValorReq,$nuPorcentaje);
	}
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td align=right>".$rcLabels["total"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuReg."</td>";
	if($nuReg>0){
		$sbCadena .= "<td align=center>".TOTALREQ."</td>";
	}
	else{
		$sbCadena .= "<td align=center>".$nuReg."</td>";
	}
	$rcDatosReporteEstados[2][] = array($rcLabels["total"]["label"],$nuReg,100);
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";

	return $sbCadena;	
}

function fncPaintTipoReq($rcDatos,$rcTipoReq,$rcLabels,&$rcDatosReporteTipos)
{
	$nuReg =  sizeof($rcDatos);
	for($nuCant=0;$nuCant<$nuReg;$nuCant++)
	{
		$nuTipoordenactual = $rcDatos[$nuCant]["tiorcodigos"];
		$rcTipoorden[$nuTipoordenactual]++;
	}
	$sbCadena = "<table border=0>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td rowspan=2><b>".$rcLabels["tiporeq"]["label"]."</b></td>";
	$sbCadena .= "<td colspan=2><b>".$rcLabels["acumulado"]["label"]."<b></td>";
	$sbCadena .= "</tr>";
	$sbCadena .= "<tr>";
	$sbCadena .= "<td><b>".$rcLabels["no"]["label"]."</b></td>";
	$sbCadena .= "<td><b>".$rcLabels["porcentaje"]["label"]."</b></td>";
	$sbCadena .= "</tr>";
	$nuCantReg = sizeof($rcTipoReq);
	for($nuCont=0;$nuCont<$nuCantReg;$nuCont++)
	{
		$sbCadena .= "<tr>";
		$sbCadena .= "<td align=center>".($nuCont+1)."</td>";
		$sbCadena .= "<td align=left>".$rcTipoReq[$nuCont]["tiornombres"]."</td>";
		$nuValorReq  = $rcTipoorden[$rcTipoReq[$nuCont]["tiorcodigos"]];
		if($nuValorReq == "" || is_null($nuValorReq)){
			$nuValorReq = 0;
		}
		$sbCadena .= "<td align=center>".$nuValorReq."</td>";
		$nuPorcentaje = fnuPorcentaje($nuValorReq,$nuReg);
		$sbCadena .= "<td align=center>".$nuPorcentaje."</td>";
		$sbCadena .= "</tr>";
		
		//ACUMULEMOS LOS DATOS PARA EL EXCEL Y EL GRÁFICO
		$rcDatosReporteTipos[0][$nuCont] = $nuCont+1;
		$rcDatosReporteTipos[1][$nuCont] = $nuValorReq;
		$rcDatosReporteTipos[2][$nuCont] = array($rcTipoReq[$nuCont]["tiornombres"],$nuValorReq,$nuPorcentaje);
	}
	
	$sbCadena .= "<tr>";
	$sbCadena .= "<td rowspan=2><b>&nbsp;</b></td>";
	$sbCadena .= "<td align=right>".$rcLabels["total"]["label"]."</td>";
	$sbCadena .= "<td align=center>".$nuReg."</td>";
	if($nuReg>0){
		$sbCadena .= "<td align=center>".TOTALREQ."</td>";
	}
	else{
		$sbCadena .= "<td align=center>".$nuReg."</td>";
	}
	$rcDatosReporteTipos[2][] = array($rcLabels["total"]["label"],$nuReg,100);
	$sbCadena .= "</tr>";
	$sbCadena .= "</table>";
	return $sbCadena;	
}

function fnuPorcentaje($nuCantReq,$nuTotal)
{
    $nuPorcentaje = 0;
	if($nuTotal > 0)
		$nuPorcentaje = (($nuCantReq * TOTALREQ) / $nuTotal);
    return number_format($nuPorcentaje,2,',','.');
}

function getExcelBook($rcDatos,$rclabels)
{
	$sbTmp = "tmp/";
	$nameExcel = $name.rand(0,1000).".xls";
	$sbPath = $sbTmp.$nameExcel;
	
	$objLib = Application::loadLib("excel");
	$sbResult = $objLib->execute($rcDatos,$sbPath);
	
	return "<td class='piedefoto'><a href=javascript:abrirPdf('".$sbPath."');><img border=0 src='web/images/generar_excel.gif' title='".$rclabels['excel']['label']."'></a></td>";
}
?>