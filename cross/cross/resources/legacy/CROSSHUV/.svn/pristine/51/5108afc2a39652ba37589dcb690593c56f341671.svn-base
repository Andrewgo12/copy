<?php      
class FeStBalanceManager {
	var $gateway;
	function FeStBalanceManager() {
		$this->gateway = Application :: getDataGateway("balance");
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Reporte de balance de bodegas
	* @param integer $fecha
	* @param string $bodecodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-oct-2004 16:35:05
	* @location Cali-Colombia
	*/
	function getBalance($fecha, $bodecodigos) {
		/*Trae las matrices de los movimientos de salida y de entrada*/
		$rctmp = $this->gateway->getMovimientos($bodecodigos, $fecha, "+");
		$rcentrada = $rctmp["matriz"];
		$rcconceptosentrada = $rctmp["conceptos"];

		$rctmp = $this->gateway->getMovimientos($bodecodigos, $fecha, "-");
		$rcsalida = $rctmp["matriz"];
		$rcconceptossalida = $rctmp["conceptos"];

		//trae un vector con el codigo de los recursos
		$rcrecursos = $this->gateway->getRecursos();
		
		if (!$rcrecursos)
			return null;
		//arma matriz con el inventario final y un vector con los recursos con movimientos
		$rcinventariofinal = $this->getInventarioFinal($rcentrada, $rcsalida, $rcrecursos);
		//$rcinventariofinal = fncinventariofinal($rcentrada, $rcsalida, $rcrecursos);
		$rcrecursos = $rcinventariofinal["recursos"];
		$rcinventario = $rcinventariofinal["inventario"];

		//Formatea las matrices de entrada y salida
		$rcentrada = $this->getFormato($rcentrada, $rcconceptosentrada, $rcrecursos);
		$rcsalida = $this->getFormato($rcsalida, $rcconceptossalida, $rcrecursos);

		$rcretun["entradas"] = $rcentrada;
		$rcretun["salidas"] = $rcsalida;
		$rcretun["recursos"] = $rcrecursos;
		$rcretun["inventario"] = $rcinventario;
		return $rcretun;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Arma la matriz indent al balance
	* @param array $ircoriginal
	* @param array $ircconceptos
	* @param array $ircrecursos
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 11:09:07
	* @location Cali-Colombia
	*/
	function getFormato($ircoriginal, $ircconceptos, $ircrecursos) {
		$nureg = sizeof($ircrecursos);
		for ($nucont = 0; $nucont < $nureg; $nucont ++) {
			if ($ircoriginal[$ircrecursos[$nucont][0]]) {
				$rctmp = $ircoriginal[$ircrecursos[$nucont][0]];
				$rctmp = array_merge($ircconceptos, $rctmp);
				$ircoriginal[$ircrecursos[$nucont][0]] = $rctmp;
			}
		}
		return $ircoriginal;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Arma una matriz con el inventario final
	* @param array $ircentrada
	* @param array $ircsalida
	* @param array $ircrecursos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 11:03:15
	* @location Cali-Colombia
	*/
	function getInventarioFinal($ircentrada, $ircsalida, $ircrecursos) {
		$nureg = sizeof($ircrecursos);
		for ($nucont = 0, $nureal = 0; $nucont < $nureg; $nucont ++) {
			/*Valida que existan entradas y salidas*/
			if ($ircentrada[$ircrecursos[$nucont][0]] || $ircsalida[$ircrecursos[$nucont][0]]) {
				$rcinventario[$ircrecursos[$nucont][0]] = $ircentrada[$ircrecursos[$nucont][0]]["Total"] - $ircsalida[$ircrecursos[$nucont][0]]["Total"];
				$rcrecursos[$nureal] = $ircrecursos[$nucont];
				$nureal ++;
			}
		}
		$rcreturn["inventario"] = $rcinventario;
		$rcreturn["recursos"] = $rcrecursos;
		return $rcreturn;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae los conceptos de movimiento, Usa cache
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 11:15:09
	* @location Cali-Colombia
	*/
	function getConceptos(){
		return $this->gateway->getConceptos();	
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la info de la bodega
	* @param string $bodecodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 12:11:46
	* @location Cali-Colombia*/
	function getInfo($bodecodigos){
		return $this->gateway->getInfo($bodecodigos);
	}
	function UnsetRequest() {
		unset ($_REQUEST["balance__numrows"]);
	}
}
?>