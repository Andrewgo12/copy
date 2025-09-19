<?php   
class ValidationData {
	
	/**
		Copyright 2004 � FullEngine
		
		Muestra toda la informaci�n del servicio
		@author freina <freinas@parquesoft.com>
		@date 29-Oct-2004 11:07
		@location Cali-Colombia
	*/
	function serviceInfo(){
		$rcinfo = array("fnccompara" => "Propiedad intelectual del FullEngine.
															Compara dos valores segun el operador logico
															Operadores soportados:
															= Igualdad simple
															== Igualdad compuesta Valor y tipo
															> Mayor que
															//< Menor que
															>= Mayor o igual
															<= Menor o igual
															!= Diferencia simplde
															!== Diferencia compuesta Valor y tipo
															IN En (Valores separados por PIPE)
															NOTIN No en (Valores separados por PIPE)
															BETWEEN En el rango incluyendo los limites(Valores separados por PIPE)
															BETWEENL En el rango sin incluir los limites(Valores separados por PIPE)
															BETWEENOUT Fuera del rango incluyendo los limites (Valores separados por PIPE)
															BETWEENOUTL Fuera del rango no incluyendo los limites (Valores separados por PIPE)
															EXIST Si el valor existe, diferente de null o cadana vacia
															@param $sbval1 string   Cadena con el primer valor a comparar
															@param $sbop string  Cadena con el operador logico
															@param $sbval2 string   Cadena con el segundo valor a comparar
															@return boolean  true o false	: Segun el resultado de la comparacion  null	 en caso de ausencia de algun parametro o un operador no soportado
															@author freina
															@date 26-Agol-2004 18:27
															@location Cali-Colombia",
								"fncigualsimple"=>"Propiedad intelectual del FullEngine.
															 Valida igualdad simple
															 @author freina
															 @param string $sbval1 (Cadena con el primer valor a validar)
															 @param string $sbval2 (Cadena con el segundo valor a validar)
															 @return boolean  true o false	: Segun el resultado de la comparacion
															 @date 26-Ago-2004 18:38
															 @location Cali-Colombia",
								"fncigualcomp"=>"Propiedad intelectual del FullEngine.
															Valida igualdad compuesta
															@author freina
															@param string $sbval1 (Cadena con el primer valor a validar)
															@param string $sbval2 (Cadena con el segundo valor a validar)
															 @return boolean  true o false	: Segun el resultado de la comparacion
															 @date 26-Ago-2004 18:38
															 @location Cali-Colombia",
								"fncmayorque"=>"Propiedad intelectual del FullEngine.
															Valida mayor que
															@author freina
															@param string $sbval1 (Cadena con el primer valor a validar)
															@param string $sbval2 (Cadena con el segundo valor a validar)
															@return boolean  true o false	: Segun el resultado de la comparacion
															@date 26-Ago-2004 18:38
															@location Cali-Colombia",
								"fncmenorque"=>"Propiedad intelectual del FullEngine.
															Valida menor que
															@author freina
															@param string $sbval1 (Cadena con el primer valor a validar)
															@param string $sbval2 (Cadena con el segundo valor a validar)
															@return boolean  true o false	: Segun el resultado de la comparacion
															@date 26-Ago-2004 18:38
															@location Cali-Colombia",
								"fncmayoroigualque"=>"Propiedad intelectual del FullEngine.
																	Valida mayor o igual que
																	 @author freina
																	 @param string $sbval1 (Cadena con el primer valor a validar)
																	 @param string $sbval2 (Cadena con el segundo valor a validar)
																	 @return boolean  true o false	: Segun el resultado de la comparacion
																	 @date 26-Ago-2004 18:38
																	 @location Cali-Colombia",
								"fncmenoroigualque"=>"Propiedad intelectual del FullEngine.
																	Valida menor o igual que
																	@author freina
																	@param string $sbval1 (Cadena con el primer valor a validar)
																	@param string $sbval2 (Cadena con el segundo valor a validar)
																	@return boolean  true o false	: Segun el resultado de la comparacion
																	@date 26-Ago-2004 18:38
																	@location Cali-Colombia",
								"fncdifsimple"=>"Propiedad intelectual del FullEngine.
														  Valida diferente simple
														  @author freina
														  @param string $sbval1 (Cadena con el primer valor a validar)
														  @param string $sbval2 (Cadena con el segundo valor a validar)
														  @return boolean  true o false	: Segun el resultado de la comparacion
														  @date 26-Ago-2004 18:38
														  @location Cali-Colombia",
								"fncdifcomp"=>"Propiedad intelectual del FullEngine.
														Valida diferencia compuesta
														@author freina
														@param string $sbval1 (Cadena con el primer valor a validar)
														@param string $sbval2 (Cadena con el segundo valor a validar)
														@return boolean  true o false	: Segun el resultado de la comparacion
														@date 26-Ago-2004 18:38
														@location Cali-Colombia",
								"fncin"=>"Propiedad intelectual del FullEngine.
											   Valida in
											   @author freina
											   @param string $sbval1 (Cadena con el primer valor a validar)
											   @param string $sbval2 (Cadena con el segundo valor a validar)
											   @return boolean  true o false	: Segun el resultado de la comparacion
											   @date 26-Ago-2004 18:38
											   @location Cali-Colombia",
								"fncnotin"=>"Propiedad intelectual del FullEngine.
													Valida no in
													@author freina
													@param string $sbval1 (Cadena con el primer valor a validar)
													@param string $sbval2 (Cadena con el segundo valor a validar)
													@return boolean  true o false	: Segun el resultado de la comparacion
													@date 26-Ago-2004 18:38
													@location Cali-Colombia",
								"fncbetween"=>"Propiedad intelectual del FullEngine.
														Valida between
														@author freina
														@param string $sbval1 (Cadena con el primer valor a validar)
														@param string $sbval2 (Cadena con el segundo valor a validar)
														@return boolean  true o false	: Segun el resultado de la comparacion
														@date 26-Ago-2004 18:38
														@location Cali-Colombia",
								"fncbetweenl"=>"Propiedad intelectual del FullEngine.
														  Valida between limit
														  @author freina
														  @param string $sbval1 (Cadena con el primer valor a validar)
														  	@param string $sbval2 (Cadena con el segundo valor a validar)
														  	@return boolean  true o false	: Segun el resultado de la comparacion
														  	@date 26-Ago-2004 18:38
														  	@location Cali-Colombia",
								"fncbetweenout"=>"Propiedad intelectual del FullEngine.
															 Valida between out
															 @author freina
															 @param string $sbval1 (Cadena con el primer valor a validar)
															 @param string $sbval2 (Cadena con el segundo valor a validar)
															 @return boolean  true o false	: Segun el resultado de la comparacion
															 @date 26-Ago-2004 18:38
															 @location Cali-Colombia",
								"fncbetweenoutl"=>"Propiedad intelectual del FullEngine.
															   Valida between out sin limites
															   @author freina
															   @param string $sbval1 (Cadena con el primer valor a validar)
															   @param string $sbval2 (Cadena con el segundo valor a validar)
															   @return boolean  true o false	: Segun el resultado de la comparacion
															   @date 26-Ago-2004 18:38
															   @location Cali-Colombia",
								"fncExist"=>"Propiedad intelectual del FullEngine.
													Verifica que el valor existe, diferente de null o de cadena vacia, se considera al cero como valor valido
													@param mixed $param valor a evaluar
													@return boolean
													@author creyes <cesar.reyes@parquesoft.com>
													@date 23-sep-2004 13:56:39
													@location Cali-Colombia",);
								
			echo "<table border=1>";
			foreach($rcinfo as $key => $data)
				echo "<tr><td>$key</td><td>$data</td></td>";
			echo "</table>";
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Compara dos valores segun el operador logico
	*   Operadores soportados:
	*	= Igualdad simple
	*	== Igualdad compuesta Valor y tipo
	*	> Mayor que
	*	//< Menor que
	*	>= Mayor o igual
	*	<= Menor o igual
	*	!= Diferencia simplde
	*	!== Diferencia compuesta Valor y tipo 
	*	IN En (Valores separados por PIPE)
	*	NOTIN No en (Valores separados por PIPE)
	*	BETWEEN En el rango incluyendo los limites(Valores separados por PIPE)
	*	BETWEENL En el rango sin incluir los limites(Valores separados por PIPE)
	*	BETWEENOUT Fuera del rango incluyendo los limites (Valores separados por PIPE)
	*	BETWEENOUTL Fuera del rango no incluyendo los limites (Valores separados por PIPE)
	*  EXIST Si el valor existe, diferente de null o cadana vacia
	*
	*   @param $sbval1 string   Cadena con el primer valor a comparar
	*   @param $sbop string  Cadena con el operador logico
	*   @param $sbval2 string   Cadena con el segundo valor a comparar
	*   @return boolean  true o false	: Segun el resultado de la comparacion  null	 en caso de ausencia de algun parametro o un operador no soportado
	*   @author freina
	*   @date 26-Agol-2004 18:27 
	*   @location Cali-Colombia
	*/
	function fnccompara($sbval1, $sbop, $sbval2) {
		if (!$sbop)
			return null;
		/*Pasa a mayusculas el operador*/
		$sbop = strtoupper($sbop);
		switch ($sbop) {
			case '=' :
				return $this->fncigualsimple($sbval1, $sbval2);
			case '==' :
				return $this->fncigualcomp($sbval1, $sbval2);
			case '>' :
				return $this->fncmayorque($sbval1, $sbval2);
			case '<' :
				return $this->fncmenorque($sbval1, $sbval2);
			case '>=' :
				return $this->fncmayoroigualque($sbval1, $sbval2);
			case '<=' :
				return $this->fncmenoroigualque($sbval1, $sbval2);
			case '!=' :
				return $this->fncdifsimple($sbval1, $sbval2);
			case '!==' :
				return $this->fncdifcomp($sbval1, $sbval2);
			case 'IN' :
				return $this->fncin($sbval1, $sbval2);
			case 'NOTIN' :
				return $this->fncnotin($sbval1, $sbval2);
			case 'BETWEEN' :
				return $this->fncbetween($sbval1, $sbval2);
			case 'BETWEENL' :
				return $this->fncbetweenl($sbval1, $sbval2);
			case 'BETWEENOUT' :
				return $this->fncbetweenout($sbval1, $sbval2);
			case 'BETWEENOUTL' :
				return $this->fncbetweenoutl($sbval1, $sbval2);
		}
		return null;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida igualdad simple
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncigualsimple($sbval1, $sbval2) {
		if ($sbval1 == $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida igualdad compuesta
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncigualcomp($sbval1, $sbval2) {
		if ($sbval1 === $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida mayor que
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncmayorque($sbval1, $sbval2) {
		if ($sbval1 > $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida menor que
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncmenorque($sbval1, $sbval2) {
		if ($sbval1 < $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida mayor o igual que
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncmayoroigualque($sbval1, $sbval2) {
		if ($sbval1 >= $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida menor o igual que
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncmenoroigualque($sbval1, $sbval2) {
		if ($sbval1 <= $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida diferente simple
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncdifsimple($sbval1, $sbval2) {
		if ($sbval1 != $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida diferencia compuesta
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncdifcomp($sbval1, $sbval2) {
		if ($sbval1 !== $sbval2)
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida in
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncin($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (in_array($sbval1, $rctmp))
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida no in
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncnotin($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (!in_array($sbval1, $rctmp))
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida between
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncbetween($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (sizeof($rctmp) != 2)
			return false;
		if ($sbval1 >= $rctmp[0] && $sbval1 <= $rctmp[1])
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida between limit
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncbetweenl($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (sizeof($rctmp) != 2)
			return false;
		if ($sbval1 > $rctmp[0] && $sbval1 < $rctmp[1])
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida between out
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncbetweenout($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (sizeof($rctmp) != 2)
			return false;
		if ($sbval1 <= $rctmp[0] && $sbval1 >= $rctmp[1])
			return true;
		return false;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida between out sin limites
	*   @author freina
	*	@param string $sbval1 (Cadena con el primer valor a validar)
	*	@param string $sbval2 (Cadena con el segundo valor a validar)
	*   @return boolean  true o false	: Segun el resultado de la comparacion
	*   @date 26-Ago-2004 18:38
	*   @location Cali-Colombia
	*/
	function fncbetweenoutl($sbval1, $sbval2) {
		settype($sbpipe,"string");
		settype($rctmp,"array");
		$sbpipe = Application :: getConstant("PIPE");
		$rctmp = explode($sbpipe, $sbval2);
		if (sizeof($rctmp) != 2)
			return false;
		if ($sbval1 < $rctmp[0] && $sbval1 > $rctmp[1])
			return true;
		return false;
	}
	/**
	* copyright Copyright 2004 &copy; FullEngine
	*
	*  Verifica que el valor existe, diferente de null o de cadena vacia. 
	* Se considera al cero como valor valido
	* @param mixed $param valor a evaluar
	* @return boolean
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 23-sep-2004 13:56:39
	* @location Cali-Colombia
	*/
	function fncExist($param){
		if($param === 0)
			return true;
		if($param == null || $param == '')
			return false;
		return true;
	}
}
?>