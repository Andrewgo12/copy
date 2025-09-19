<?php   
class FeWFArbolManager {
	var $gateway;
	var $sbtabla;
	var $rcAllData;
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Instancia el gateway de la tabla
	*   @param $isbtabla string Nombre de la tabla reflexiva
	*   @author freina
	*   @date 06-Jul-2004 14:35 
	*   @location Cali-Colombia
	*/
	function fncArbolManager($isbtabla) {
		$this->sbtabla = $isbtabla;
		$this->gateway = Application :: getDataGateway($isbtabla);
		$this->rcAllData = $this->getAllData();
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Carga la data de la tabla
	*   @author freina
	*   @date 06-Jul-2004 14:35 
	*   @location Cali-Colombia
	*/
	function getAllData() {
		$sbtmp = "getAll".$this->sbtabla;
		$rctmp = $this->gateway-> $sbtmp ();
		return $rctmp;
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
	*   @author freina
	*   @date 06-Jul-2004 14:35 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $ircdata, & $ircpadre, $isbindpadre, $isbindhijo, & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if ($ircdata[$nucont][$isbindpadre] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont][$isbindhijo], $ircdata, $ircpadre, $isbindpadre, $isbindhijo, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont];
				$inuindice ++;
			}
		}
		return;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Inicia el formateo de la matriz utilizada para pintar el arbol
	*   @param $irctmp array  Data total
	*   @param $isbindpadre string  Indice Padre
	*   @param $isbindhijo string   Indice hijo
	*   @author freina
	*   @date 06-Jul-2004 14:35 
	*   @location Cali-Colombia
	*/
	function fncinicio($isbindpadre, $isbindhijo) {
		//priimero se determinan los padres principales
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nuindice, "integer");
		$nuindice = 0;
		//$this->rcAllData = $this->getAllData();
		$nucant = sizeof($this->rcAllData);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if (!$this->rcAllData[$nucont][$isbindpadre]) {
				$orcresult[$nuindice] = $this->rcAllData[$nucont];
				$nuindice ++;
				$this->fncseleccion($this->rcAllData[$nucont][$isbindhijo], $this->rcAllData, $orcresult, $isbindpadre, $isbindhijo, $nuindice);
			}
		}
		return $orcresult;
	}
	/**Copyright 2004 © FullEngine
		 Recorre progresiva mente una tabla reflexiba buscando los nodos hijo
		@param string $tableName Nombre de la tabla
		@param string $isbindpadre Indice Padre
		@param string $isbindhijo Indice hijo
		@param string $valIni Valor inicial, primer nodo
		@return array Vector con los elementos encontrados
		@author creyes <cesar.reyes@parquesoft.com>
		@date 30-ago-2004 16:23:46
		@location Cali - Colombia
	*/
	function getArbol($isbindpadre, $isbindhijo, $valIni) {
		//Valida los datos de entrada
		if (!$isbindpadre || !$isbindhijo || !$valIni)
			return null;
		//Carga toda la tabla
		$this->rcAllData;
		//Busca el elemnto en la consulta si lo encuentra lo pone el la cola
		foreach ($this->rcAllData as $rcValue) {
			if ($rcValue[$isbindhijo] == $valIni) {
				$rcCola = array ($rcValue);
				break;
			}
		}
		if (!isset ($rcCola))
			return null;
		$nuCont = 0;
		do {
			//busca los hijos del elemento actual
			$eleActual = array_shift($rcCola);
			$rcSons = $this->getSons($this->rcAllData, $eleActual, $isbindpadre, $isbindhijo);
			//Si el elemento tiene hijos los pone en la cola
			if (is_array($rcSons))
				$rcCola = array_merge($rcCola, $rcSons);
			//Pone el elemento en la matriz de salida
			$rcSalida[$nuCont] = $eleActual;
			$nuCont ++;
		} while ($rcCola[0]);
		return $rcSalida;
	}
	/**Copyright 2004 © FullEngine
		Trae todos los hijos un nodo
		@param array $rcData Vector con los datos de la tabla
		@param string $element Valor del nodo
		@param string $isbindpadre Indice Padre
		@param string $isbindhijo Indice hijo
		@return datatype description
		@author creyes <cesar.reyes@parquesoft.com>
		@date 30-ago-2004 16:36:22
		@location Cali - Colombia
	*/
	function getSons($rcData, $element, $isbindpadre, $isbindhijo) {
		$nuCont = 0;
		foreach ($rcData as $rcValue) {
			if ($rcValue[$isbindpadre] == $element[$isbindhijo]) {
				$rcRt[$nuCont] = $rcValue;
				$nuCont ++;
			}
		}
		return $rcRt;
	}
}
?>