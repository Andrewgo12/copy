<?php
class FeGeEnvConfigurationManager{
	function FeGeEnvConfigurationManager(){

	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @copyright Copyright 2011 &copy; FullEngine
	 *
	 *  Actualiza el limite de memoria del php de acuerdo a la constante MEMORY_LIMIT o al
	 *  valor pasado como parametro; Se puede enviar el parametro sbNewSize con la cadena que tendra el  valor al cual se quiere cambiar el limite de memoria
	 *  debe ser un numero seguido de la unidad de bytes ejemplo 8M las unidades son K,M o G
	 * @author freina <freina@parquesoft.com>
	 * @date 27-Mar-2011 13:37
	 * @location Cali-Colombia
	 */
	function setMemoryLimit (){

		settype($rcData,"array");
		settype($sbU,"string");
		settype($sbResult,"string");
		settype($nuByte,"integer");
		settype($nuMaxSize,"float");
		settype($nuByteSize,"float");
		settype($nuSize,"float");
		settype($nuNewSize,"float");
		
		$rcData = $this->rcData;
		
		if(is_array($rcData) && $rcData){
			extract($rcData);	
		}

		$nuByte = 1024;

		$sbSize = trim(ini_get("memory_limit"));
		$sbNewSize = trim($sbNewSize);

		if(!$sbNewSize){
			//constante
			$sbNewSize = Application :: getConstant("MEMORY_LIMIT");
		}

		$nuNewSize = (float) substr ($sbNewSize, 0,-1);
		$sbU = substr ($sbNewSize, -1);

		switch ($sbU){
			case 'M': case 'm': $nuMaxSize =  $nuNewSize * (pow($nuByte, 2)); break;
			case 'K': case 'k': $nuMaxSize = $nuNewSize * $nuByte; break;
			case 'G': case 'g': $nuMaxSize = $nuNewSize * (pow($nuByte, 3)); break;

			default: $nuMaxSize = $nuNewSize;
		}

		if($sbSize){

			unset($sbU);
			$nuSize = (float) substr ($sbSize, 0,-1);
			$sbU = substr ($sbSize, -1);

			switch ($sbU){
				case 'M': case 'm': $nuByteSize =  $nuSize * (pow($nuByte, 2)); break;
				case 'K': case 'k': $nuByteSize = $nuSize * $nuByte; break;
				case 'G': case 'g': $nuByteSize = $nuSize * (pow($nuByte, 3)); break;

				default: $nuByteSize = $nuSize;
			}
		}else{
			$nuByteSize = 0;
		}


		if($nuMaxSize > $nuByteSize){
			ini_set("memory_limit", $sbNewSize);
			$sbResult = true;
		}

		$sbResult = false;

	}
}
?>