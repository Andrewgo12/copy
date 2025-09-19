<?php 
/*
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* smarty function
	*  Pinta el reporte de movimientos de almacen por bodega, recurso, documento y fechas
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 8:59:21
	* @location Cali-Colombia**/
function smarty_function_repo_balance($params, & $smarty) {
	extract($_REQUEST);
	//Instancia el servicio de formato de fechas
	$dateSevice = Application :: loadServices("DateController");
	if (!$bodecodigos)
		return null;
	//Analiza y convierte las fechas
	if ($fecha){
		$viewDate = $fecha;
		$fecha = $dateSevice->fncdatehourtoint($fecha);
	}
	else{
		$viewDate = $dateSevice->fnctoday();
		$fecha = $dateSevice->fncintdatehour();
	}

	//Carga el manager del reporte
	$manager = Application :: getDomainController('BalanceManager');
	$rcbalance = $manager->getBalance($fecha, $bodecodigos);
	if (!is_array($rcbalance))
		return null;

	//trae los conceptos de movimiento
	$rcconceptos = $manager->getConceptos();
	if (!is_array($rcconceptos))
		return null;

	//Trae la infornaci� de la bodega y el responsable
	$rcinfo = $manager->getInfo($bodecodigos);

	//Obtiene los datos del usuario
	$rcUser = Application::getUserParam();
	if(!is_array($rcUser)){
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application::getSingleLang();
	}
	include($rcUser["lang"]."/".$rcUser["lang"].".balance.php");

	//Pinta el reporte
	$rcetiquetas["fecha"] = $dateSevice->getLongDate($rcUser["lang"]); //fecha del dia
	$rcetiquetas["bodega"] = $rclabels["bodecodigos"]["label"].": ".$rcinfo["bodega"];
	$rcetiquetas["responsable"] = $rclabels["responsable"]["label"].": ".$rcinfo["responsable"];
	$rcetiquetas["identificacion"] = $rclabels["identificacion"]["label"].": ".$rcinfo["id_responsable"];
	$rcetiquetas["elaborado"] = $rclabels["elaborado"]["label"].": ".$rcUser["username"]; 
	$rcetiquetas["periodo"] = $rclabels["periodo"]["label"]." ".$viewDate;  //Fecha Balance
	$rcetiquetas["codigo"] = $rclabels["codigo"]["label"];
	$rcetiquetas["recurso"] = $rclabels["recurso"]["label"];
	$rcetiquetas["entradas"] = $rclabels["entradas"]["label"];
	$rcetiquetas["salidas"] = $rclabels["salidas"]["label"];
	$rcetiquetas["inventario"] = $rclabels["inventario"]["label"];
	fncviewbalance($rcbalance,$rcetiquetas,$rcconceptos);
}

function fncviewbalance($ircbalance, $ircetiquetas,$ircconceptos) {
	/*Determuna el ancho de las matrices de salida y entrada*/
	$nuanchsale = fncancho($ircbalance["salidas"]);
	$nuanchentra = fncancho($ircbalance["entradas"]);
	/*Trae las tablas de recurso, entradas, salidas, y saldo*/
	$rctablas = fncinfornacion($ircbalance, $irctema, $nuanchentra, $nuanchsale);
	/*Trae las cabeceras de los conceptos de movimiento*/
	$sbcabesalida = fnccabeceras($ircbalance["salidas"], $ircconceptos, $irctema);
	$sbcabeentrada = fnccabeceras($ircbalance["entradas"], $ircconceptos, $irctema);

	echo " <table width=\"100%\" border=\"0\" align=\"center\">
	  <tr>
	    <th colspan=\"4\" class='celda2'>".$ircetiquetas["periodo"]."</th>
	  </tr>
	  <tr>
	    <th colspan=\"4\" class='celda2'>".$ircetiquetas["empresa"]."</th>
	  </tr>
	  <tr>
	    <th colspan=\"4\" class='celda2'>".$ircetiquetas["fecha"]."</th>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>&nbsp;</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>".$ircetiquetas["bodega"]."</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>".$ircetiquetas["responsable"]."</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>".$ircetiquetas["identificacion"]."</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>&nbsp;</td>
	  </tr>
	  <tr>
	    <td width=\"25%\" height=\"58\">";
	echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
	        <tr>
	          <th colspan=\"2\">&nbsp;</th>";
	if ($nuanchentra)
		echo "<th colspan=\"".$nuanchentra."\">".$ircetiquetas["entradas"]."</th>";
	if ($nuanchsale)
		echo " <th colspan=\"".$nuanchsale."\">".$ircetiquetas["salidas"]."</th>";

	echo "  <th>&nbsp;</th>
	        </tr>
	        <tr>
	          <th>".$ircetiquetas["codigo"]."</th>
	          <th>".$ircetiquetas["recurso"]."</th>";
	echo $sbcabeentrada;
	echo $sbcabesalida;
	echo "<th >".$ircetiquetas["inventario"]."</th> </tr>";
	if ($rctablas)
		echo implode("", $rctablas);
	echo "</table>
		</td>";
	echo "</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\" class='piedefoto'>&nbsp;</td>
	  </tr>
	  <tr>
	    <td colspan=\"4\"  class='piedefoto'>".$ircetiquetas["elaborado"]."</td>
	  </tr>
	</table>";
}

/*Arma los cuatro vectores para visualizar la informacion */
function fncinfornacion($ircbalance, $irctema, $inuanchentra, $inuanchsale) {
	/*Declaraci� de variables*/
	settype($rcentradas, "array");
	settype($rcrecursos, "array");
	settype($rcinventario, "array");
	settype($rcsalidas, "array");

	$rcentradas = $ircbalance["entradas"];
	$rcsalidas = $ircbalance["salidas"];
	$rcinventario = $ircbalance["inventario"];
	$rcrecursos = $ircbalance["recursos"];

	$nureg = sizeof($rcrecursos);

	for ($nucont = 0; $nucont < $nureg; $nucont ++) {
		if(fmod($nucont,2)  ==  0)
			$estilo = "class='celda'";
		else
			$estilo = "class='celda2'";
		$sbrecurso = $rcrecursos[$nucont][0];
		$sblinerecurso = "<td $estilo><div align=\"center\">".$sbrecurso."</div></td>
								<td $estilo>".$rcrecursos[$nucont][1]."</td>";
		if ($inuanchentra)
			$sblineentradas = fnchtml($rcentradas, $sbrecurso, $irctema, $inuanchentra,$estilo);
		if ($inuanchsale)
			$sblinesalidas = fnchtml($rcsalidas, $sbrecurso, $irctema, $inuanchsale,$estilo);
		$sblineinventario = "<td $estilo><div align=\"center\">".$rcinventario[$sbrecurso]."</div></td>";
		$rcdatos[$nucont] = "<tr>".$sblinerecurso.$sblineentradas.$sblinesalidas.$sblineinventario."</tr>";
	}
	return $rcdatos;
}

/*Genera la linea de html*/
function fnchtml($ircmatriz, $isbrecurso, $irctema, $nutamano,$estilo) {
	/*Declaraci� de variables*/
	settype($rcline, "array");
	settype($rctemp, "array");
	settype($rctmpkey, "array");
	settype($sbline, "string");
	settype($nucont, "integer");
	settype($nureg, "integer");

	$rctemp = $ircmatriz[$isbrecurso];
	if (!$rctemp) {
		for ($nucont = 0; $nucont < $nutamano; $nucont ++) {
			$rcline[$nucont] = "<td $estilo><div align=\"center\">0</div></td>";
		}
		$sbline = implode(" ", $rcline);
		return $sbline;
	}
	$rctmpkey = array_keys($rctemp);
	$nureg = sizeof($rctmpkey);
	for ($nucont = 0; $nucont < $nureg; $nucont ++) {
		$rcline[$nucont] = "<td $estilo><div align=\"center\">".$rctemp[$rctmpkey[$nucont]]."</div></td>";
	}
	$sbline = implode(" ", $rcline);
	return $sbline;
}

/*Retorna el ancho de cada matriz de entradas o salidas*/
function fncancho($ircmatriz) {
	/*Declaracion de variables*/
	if (!$ircmatriz)
		return 0;
	$rctemp = array_pop($ircmatriz);
	if (!$rctemp)
		return 0;
	$rctmpkey = array_keys($rctemp);
	return sizeof($rctmpkey);

}

/*Determina las cabeceras(conceptos de movimiento) de las entradas y las salidas*/
function fnccabeceras($ircmovimientos, $ircconceptos, $irctema) {
	
	/*Declaraci� de variables*/
	if (!$ircmovimientos)
		return "";
	$rctemp = array_shift($ircmovimientos);
	if (!$rctemp)
		return 0;
	$rctmpkey = array_keys($rctemp);
	$nureg = sizeof($rctmpkey);
	for ($nucont = 0; $nucont < $nureg; $nucont ++) {
		if ($ircconceptos[$rctmpkey[$nucont]])
			$rcline[$nucont] = "<th >".$ircconceptos[$rctmpkey[$nucont]]."</th>";
		else
			$rcline[$nucont] = "<th >TOTAL</th>";
	}
	$sbline = implode("", $rcline);
	return $sbline;
}
?>