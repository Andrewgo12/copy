<?php
class Data_type {

	var $email_regular_expression = "^([-!#\$%&'*+./0-9=?A-Z^_`a-z{|}~])+@([-!#\$%&'*+/0-9=?A-Z^_`a-z{|}~]+\\.)+[a-zA-Z]{2,6}\$";
	var $preg;
	var $sbNumberFormat="ISD";
	var $CantDecimal=3;

	function serviceInfo() {
		$rcinfo = array ("formatPrimaryKey" => "Copyright 2004 � FullEngine<br>
			 Valida que la llave primaria no tenga caracteres especiales si es cadena y que no sea negativa si es numerica<br>
			@param string-numeric \$key <br>
			@return boolean <br>
			@author creyes <cesar.reyes@parquesoft.com><br>
			@date 08-sep-2004 15:49:00<br>
			@location Cali - Colombia", "isInteger" => "Copyright 2004 � FullEngine<br>
              Valida que el valor sea entero<br>
			@param mixed \$value <br>
			@return boolean<br>
			@author creyes <cesar.reyes@parquesoft.com><br>
			@date 08-sep-2004 16:23:13<br>
			@location Cali - Colombia", "formatString" => " Copyright 2004 � FullEngine<br>
			Formatea cadenas de caracteres escapando doblemente algunos caracteres comillas, comillas dobles, los contra slash para  ingresarlos a la base de datos escapados<br>
			@param string \$cadena <br>
			@return string<br>
			@author creyes <cesar.reyes@parquesoft.com><br>
			@date 08-sep-2004 16:32:17<br>
			@location Cali - Colombia", "isDouble" => "Copyright 2004 � FullEngine<br>
              Valida que el valor sea double<br>
			@param mixed \$value <br>
			@return boolean<br>
			@author freina <freina@parquesoft.com><br>
			@date 30-sep-2004 13:54<br>
			@location Cali - Colombia", "string_to_bytes" => "Copyright 2004 � FullEngine<br>
            Convierte una cadena que representa una cantidad en bytes a bytes
            @param string $isbvalue (cadena con el valor en bytes)
            @return numeric
            @author freina <freina@parquesoft.com>
            @date 01-Oct-2004 13:54
            @location Cali - Colombia", "IsEmail" => "Copyright 2004 � FullEngine		
	Valida si la cadena pasada como parametro tiene formato de mail
	@param string $isbcadena (Cadena con la direccion de email) 
	@return boolean true o false
	@author freina <freina@parquesoft.com>
	@date 19-Oct-2004 12:24
	@location Cali - Colombia",
	"formatStringHtml"=>"Copyright 2004 � FullEngine
	Convierte un texto a html 
	@param string $isbcadena (Cadena con texto) 
	@return string $osbresult (Cadena con el texto formateado)
	@author freina <freina@parquesoft.com>
	@date 19-Oct-2004 14:09
	@location Cali - Colombia","ValidateEmptyField"=>"Copyright 2005  FullEngine" .
																					"Convierte un texto a html" .
																					"@param string $isbCadena (Cadena con texto)" .
																					"@return boolean true (empty) or false" .
																					"@author freina <freina@parquesoft.com>" .
																					"@date 23-Sep-2005 16:31" .
																					"@location Cali - Colombia"
																					,"strTolower"=>"Copyright 2005 FullEngine" .
							"Pasa una cadena de caracteres a minuscula" .
							"@author freina<freina@parquesoft.com>" .
							"@param string $sbString Cadena a convertir" .
							"@return string" .
							"@date 24-February-2006 10:47:00" .
							"@location Cali-Colombia",
							"my_md5"=>'Calcula y devuelve el hash (resumen) MD5 de una cadena
							@param string $sbString
							@param boolean $modo_binario
							@author freina<freina@parquesoft.com>
							@date  17-Mar-2009 16:16
							@location Cali-Colombia',
							"myhash_keygen_s2k"=>'Esta funcion genera una llave deacuerdo a un password y una semilla
							@param string $sbPass Cadena con el password
							@param string $sbSalt Cadena con la semilla
							@param integer $nuBytes Numero de Bbytes
							@author freina<freina@parquesoft.com>
							@date  17-Mar-2009 16:45
							@location Cali-Colombia',
							"my_html_entity_decode"=>'Esta funcion permite que la funcion html_entity_decode funcione 
							de forma correcta en el charset UTF-8 
							@param string $sbString Cadena a decodificar 
							@return string $sbReturn Cadena resultado 
							@author freina<freina@parquesoft.com> 
							@date  02-Feb-2012 17:54 
							@location Cali-Colombia');
				echo "<table border=1>";
				foreach ($rcinfo as $key => $data) echo "<tr><td>$key</td><td>$data</td></td>";
				echo "</table>";
	}

	/**
	 Copyright 2004 � FullEngine

	 Formatea cadenas de caracteres escapando doblemente algunos caracteres (') (") () (caracter null), para
	 ingresarlos a la base de datos escapados
	 @param string $cadena
	 @return string
	 @author creyes <cesar.reyes@parquesoft.com>
	 @date 08-sep-2004 16:32:17
	 @location Cali - Colombia
	 */
	function formatString($cadena) {

		settype($nuIni,"integer");

		if (!is_string($cadena)){
			return $cadena;
		}else{
			if(!$cadena){
				$cadena = Application :: getConstant("DB_NULL");
				return $cadena;
			}
		}

		//se controlan los saltos de linea
		$cadena = str_replace("\r","",$cadena);

		//se obtiene la configuracion de magic_quotes
		$nuIni = get_magic_quotes_gpc();

		if($nuIni){
			//Quita las posibles marcas
			$cadena = stripslashes($cadena);
		}

		switch (Application :: getDatabaseDriver()){
			case "pgsql":
       			$cadena = preg_replace("#(\\\)#", "\\1"."\\1", $cadena);
				$cadena = preg_replace('#(")#', "\\1", $cadena);
				$cadena = preg_replace("#(')#", "\\1"."\\1", $cadena);
				break;
			case "oci8":
				$cadena = preg_replace("#(')#", "\\1"."\\1", $cadena);
				break;
		}

		return $cadena;
	}
	/**
	 Copyright 2004 � FullEngine

	 Valida que el valor sea entero
	 @param mixed $value
	 @return boolean
	 @author creyes <cesar.reyes@parquesoft.com>
	 @date 08-sep-2004 16:23:13
	 @location Cali - Colombia
	 */
	function isInteger($value) {
		if ($value == "NULL") {
			return true;
		}
		if (is_numeric($value)) {
			$value = $value * 1;
			if (is_integer($value))
			return true;
		}
		return false;
	}
	/**
	 Copyright 2004 � FullEngine

	 Valida que la llave primaria no tenga caracteres especiales si es cadena y que no sea negativa si es numerica
	 @param string-numeric $key
	 @return boolean true or false
	 @author creyes <cesar.reyes@parquesoft.com>
	 @date 08-sep-2004 15:49:00
	 @location Cali - Colombia
	 */
	function formatPrimaryKey($key) {
		if (!$key)
		return false;
		//Verifica primero el tipo de dato
		$dataType = gettype($key);
		switch ($dataType) {
			case "integer" :
			case "double" :
				if ($key <= 0)
				return false;
				return true;
			case "string" :
				return $this->basePrimary($key);
			default :
				return false;
		}
	}

	/**
	 Copyright 2004 � FullEngine

	 descripcion
	 @param datatype paramname description
	 @return datatype description
	 @author creyes <cesar.reyes@parquesoft.com>
	 @date 08-sep-2004 16:05:04
	 @location Cali - Colombia
	 */
	function basePrimary($cadena) {
		$base = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890.-_";
		$nureg = strlen($cadena);
		for ($nucont = 0; $nucont < $nureg; $nucont ++) {
			if (strstr($base, $cadena[$nucont]) === false)
			return false;
		}
		return true;
	}
	/**
		Copyright 2004 � FullEngine

		Valida que el valor sea Double
		@param mixed $value
		@return boolean
		@author freina <freina@parquesoft.com>
		@date 30-sep-2004 13:54
		@location Cali - Colombia
		*/
	function isDouble($value) {
		if ($value == "NULL") {
			return true;
		}
		if (is_numeric($value)) {
			$value = $value * 1;
			if (is_integer($value))
			return true;
			if (is_double($value))
			return true;
		}
		return false;
	}
	/**
	 Copyright 2004 � FullEngine

	 Convierte una cadena que representa una cantidad en bytes a bytes
	 @param string $isbvalue (cadena con el valor en bytes)
	 @return numeric
	 @author freina <freina@parquesoft.com>
	 @date 01-Oct-2004 13:54
	 @location Cali - Colombia
	 */
	function string_to_bytes($isbvalue) {

		settype($sbmeasurement, "string");
		settype($sbvalue, "string");

		$isbvalue = trim($isbvalue);
		if ($isbvalue) {
			$sbvalue = $isbvalue * 1;
			$sbmeasurement = substr($isbvalue, strpos($isbvalue, $sbvalue) + 1);
			switch ($sbmeasurement) {
				case 'k' :
				case 'K' :
					return (int) $sbvalue * 1024;
				case 'm' :
				case 'M' :
					return (int) $sbvalue * 1048576;
					break;
				default :
					return $sbvalue;
			}
		} else {
			return 0;
		}
	}
	/**
	 Copyright 2004 � FullEngine

	 Valida si la cadena pasada como parametro tiene formato de mail
	 @param string $isbcadena (Cadena con la direccion de email)
	 @return boolean true o false
	 @author freina <freina@parquesoft.com>
	 @date 19-Oct-2004 12:24
	 @location Cali - Colombia
	 */
	function IsEmail($isbcadena) {
		if (isset ($this->preg)) {
			if (strlen($this->preg)) {
				return (preg_match($this->preg, $isbcadena));
			}
		} else {
			$this->preg = (function_exists("preg_match") ? "/".str_replace("/", "\\/", $this->email_regular_expression)."/" : "");
			return ($this->IsEmail($isbcadena));
		}
		return (eregi($this->email_regular_expression, $isbcadena) != 0);
	}
	/**
	 Copyright 2004 � FullEngine

	 Convierte un texto a html
	 @param string $isbcadena (Cadena con texto)
	 @return string $osbresult (Cadena con el texto formateado)
	 @author freina <freina@parquesoft.com>
	 @date 19-Oct-2004 14:09
	 @location Cali - Colombia
	 */
	function formatStringHtml($isbcadena) {
		settype($osbcadena, "string");
		$osbcadena = str_replace("\n", "<br>", $isbcadena);
		$osbcadena = str_replace("\r","",$osbcadena);
		if ($osbcadena) {
			$osbcadena = htmlentities($osbcadena);
		}
		return $osbcadena;
	}
	/**
	 Copyright 2005  FullEngine

	 Convierte un texto a html
	 @param string $isbCadena (Cadena con texto)
	 @return boolean true (empty) or false
	 @author freina <freina@parquesoft.com>
	 @date 23-Sep-2005 16:31
	 @location Cali - Colombia
	 */
	function ValidateEmptyField($isbCadena) {

		settype($rcCaracteres, "array");
		settype($nuCant, "integer");
		settype($nuCont, "integer");

		$rcCaracteres[0] = "\n";
		$rcCaracteres[1] = "\t";
		$rcCaracteres[2] = " ";
		$rcCaracteres[3] = "\r";
		if($isbCadena){
			$nuCant = strlen($isbCadena);
			for($nuCont=0;$nuCont<$nuCant;$nuCont++){
				if(!in_array($isbCadena[$nuCont],$rcCaracteres)){
					return false;
				}
			}
		}
		return true;
	}
	/**
	 * Copyright 2005 FullEngine
	 *
	 * Lee un archivo con seguridad binaria y
	 * lo codigfica en base 64
	 * @author creyes
	 * @param string $path
	 * @return string $file
	 * @date 7-December-2005 19:48:42
	 * @location Cali-Colombia
	 */
	function file2encode($path){
		if(!is_readable($path))
		return null;
		$fd = fopen($path,'rb');
		$cadena = fread($fd,filesize($path));
		return $this->encode($cadena);
	}
	/**
	 * Copyright 2005 FullEngine
	 *
	 * Codifica en base 64
	 * @author creyes
	 * @param string $dta
	 * @return string
	 * @date 7-December-2005 19:48:42
	 * @location Cali-Colombia
	 */
	function encode($data){
		return base64_encode($data);
	}
	/**
	 * Copyright 2005 FullEngine
	 *
	 * Decodifica en base 64
	 * @author creyes
	 * @param string $dta
	 * @return string
	 * @date 7-December-2005 19:48:42
	 * @location Cali-Colombia
	 */
	function decode($data){
		return base64_decode($data);
	}
	//====================
	/**
	* Copyright 2005 FullEngine
	*
	* Pasa una cadena de caracteres a minuscula
	* @author freina<freina@parquesoft.com>
	* @param string $sbString Cadena a convertir
	* @return string
	* @date 24-February-2006 10:47:00
	* @location Cali-Colombia
	*/
	function strTolower($sbString){
		return strtolower($sbString);
	}
	/**
	 * Copyright 2004 � FullEngine
	 *
	 *  Da formato a un n�mero como una cadena de moneda
	 * @param string $number
	 * @author creyes <creyes@parquesoft.com>
	 * @date 05-may-2005 16:53
	 * @location Cali - Colombia
	 */
	function moneyFormat($number, $locale = null){
		if(!$locale)
		$locale = $this->locale;
		setlocale(LC_MONETARY, $locale);
		//$formatNumber = money_format('%i', $number);
		setlocale(LC_MONETARY, $this->locale);
		return $number;
	}

	/**
	 *  Propiedad intelectual del FullEngine.
	 * Dar formato a un número con los miles agrupados
	 * @param string $isbNumber Cadena con la cifra
	 * @return string $osbResult Cadena con formato
	 * @author freina
	 *  @date  16-Abr-2005 10:38
	 *  @location Cali-Colombia
	 */
	function NumberFormat($isbNumber){
		settype($osbresult,"string");

		$osbresult = "0";
		if($isbNumber){
			if(is_numeric($isbNumber)){

				switch ($this->sbNumberFormat) {
					case "ISD":
						$osbresult = number_format($isbNumber);
						break;
					case "ICD":
						$osbresult = number_format($isbNumber, $this->CantDecimal, '.', ',');
						break;
					case "FCD":
						$osbresult = number_format($isbNumber, $this->CantDecimal, ',', ' ');
						break;
				}
			}
		}
		return $osbresult;
	}
	/**
	 *  Propiedad intelectual del FullEngine.
	 * Restaura los valores del formato de los numeros
	 * @author creyes
	 *  @date  16-Abr-2005 10:38
	 *  @location Cali-Colombia
	 */
	function resetNumberFormat(){
		$this->sbNumberFormat = 'ISD';
		$this->CantDecimal = 2;
	}
	/**
	 * Calcula y devuelve el hash (resumen) MD5 de una cadena
	 * @param string $sbString
	 * @param boolean $modo_binario
	 * @author freina<freina@parquesoft.com>
	 *  @date  17-Mar-2009 16:16
	 *  @location Cali-Colombia
	 */
	function my_md5 ($sbString,$modo_binario=false){

		if($modo_binario){
			return md5($sbString,$modo_binario);
		}else{
			return md5($sbString);
		}
	}
	/**
	 * Esta funcion genera una llave deacuerdo a un password y una semilla
	 * @param string $sbPass Cadena con el password
	 * @param string $sbSalt Cadena con la semilla
	 * @param integer $nuBytes Numero de Bbytes
	 * @author freina<freina@parquesoft.com>
	 *  @date  17-Mar-2009 16:45
	 *  @location Cali-Colombia
	 */
	function myhash_keygen_s2k($sbPass, $sbSalt, $nuBytes ){
		return substr($this->my_md5($sbSalt ."-". $sbPass), 0, $nuBytes);
	}
	/**
	 * Esta funcion redondea hacia arriba un numero decimal hasta
	 * la cantidad de decimales que se pasan como parametro
	 * @param float $nuValue Valor
	 * @param integer $nuPrecision Cantidad de decimales
	 * @return float $nuReturn Numero resultante
	 * @author freina<freina@parquesoft.com>
	 *  @date  11-Oct-2011 17:36
	 *  @location Cali-Colombia
	 */
	function round_up ( $nuValue, $nuPrecision ) {

		settype($nuPow,"float");
		settype($nuResult,"float");

		if($nuValue && $nuPrecision){
			$nuPow = pow ( 10, $nuPrecision );

			$nuResult = ( ceil ( $nuPow * $nuValue ) + ceil ( $nuPow * $nuValue - ceil ( $nuPow * $nuValue ) ) ) / $nuPow;
		}

		return $nuResult;
			
	}
	
	/**
	* Esta funcion permite que la funcion html_entity_decode funcione
	* de forma correcta en el charset UTF-8
	* @param string $sbString Cadena a decodificar
	* @return string $sbReturn Cadena resultado
	* @author freina<freina@parquesoft.com>
	*  @date  02-Feb-2012 17:54
	*  @location Cali-Colombia
	*/
	function my_html_entity_decode ( $sbString ) {

		settype($sbResult,"string");
		settype($sbCharset,"string");

		if($sbString){
			$sbCharset = strtoupper(ini_get("default_charset")) ;
			$sbResult = html_entity_decode($sbString);
			if($sbCharset == 'UTF-8'){
				$sbResult = $this->_encode($sbResult);
			}
		}

		return $sbResult;
			
	}
	function _code2utf($num){
		if ($num < 128) return chr($num);
		if ($num < 2048) return chr(($num >> 6) + 192) . chr(($num & 63) + 128);
		if ($num < 65536) return chr(($num >> 12) + 224) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
		if ($num < 2097152) return chr(($num >> 18) + 240) . chr((($num >> 12) & 63) + 128) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
		return '';
	}
	function _encode($sbStr){
		return preg_replace('/&#(\\d+);/e', '$this->_code2utf($1)', utf8_encode($sbStr));
	}
}
?>