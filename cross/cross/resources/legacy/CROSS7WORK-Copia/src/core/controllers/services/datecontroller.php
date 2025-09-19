<?php
//Clase para gestion de fechas
class DateController {

	function __construct() {
		
		$this->nuhorasdia = 24;
		$this->sbformat_date_single = "y-m-d"; //Formato de fecha
		$this->sbformat_date_time = "y-m-d_h-m-s"; //Formato de fecha con horas
		$this->dateSeparator = "/"; //Separador de los elementos anho, mes y dia
		$this->typeSeparator = " "; //Separador de los tipos AAAAMMDD y HHMMSS
		$this->timeSeparator = ":"; //Separador de los elentos horas, minutos y segundos
		$this->nuCentury = 2000; //Siglo
		$this->nuSecsDay = 86400; //Cantidad de segundos de un dia
		$this->nuSecsHour = 3600; //Cantidad de segundos en una hora
		$this->calendarFormat = "YYYY/MM/DD"; //FDormato usado para el calendario, Nota: tener sincronizada con la variable $sbformat_date_single
		$this->sbTimeZone = Application :: getTimezone();
		if(!$this->sbTimeZone){
			$this->sbTimeZone = 'America/Bogota';
		}
		$this->objTZ = new DateTimeZone($this->sbTimeZone);
	}

	/**
		Copyright 2004 FullEngine

		Muestra toda la informacion del servicio
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 13:55:48
		@location Cali-Colombia
		*/
	function serviceInfo() {
		$rcinfo = array ("fnctoday" => " Propiedad intelectual del FullEngine.<br>
		    Genera una cadena con la fecha del dia.<br>
			@author freina<br>
			@param integer \$inuswitch (Opcion de fecha)<br>
			@param string \$isblanguage (Cadena con el lenguaje)<br>
			@return string Cadena con la fecha del dia<br>
			@date 28-Jul-2004 16:08<br>
			@location Cali-Colombia", "fncdatetoint" => " Propiedad intelectual del FullEngine.<br>
		   Convierte un fecha a un entero timestamp<br>
		   @author freina<br>
		   @param string \$isbfecha (Cadena con la fecha)<br>
		   @return integer Entero timestamp de la fecha<br>
		   @date 28-Jul-2004 17:02<br>
		   @location Cali-Colombia", "fncdatehourtoint" => " Propiedad intelectual del FullEngine.<br>
		   Convierte un fecha-hora a un entero timestamp<br>
		   @author freina<br>
		   @param string \$isbfecha (Cadena con la fecha)<br>
		   @return integer Entero timestamp de la fecha<br>
		   @date 28-Jul-2004 17:02<br>
		   @location Cali-Colombia", "fncformatofecha" => "Propiedad intelectual del FullEngine.<br>
		    Formatea un entero timestamp de un dia en el formato especificado<br>
		   @author freina<br>
		   @param integer \$inutimestamp (Entero con el timestamp del dia)<br>
		   @return string Cadena con la fecha formateada<br>
		   @date 28-Jul-2004 16:52<br>
		   @location Cali-Colombia	", "fncformatofechahora" => "Propiedad intelectual del FullEngine.<br>
		    Formatea un entero timestamp de un dia en el formato fecha-hora especificado<br>
		   @author freina<br>
		   @param integer \$inutimestamp (Entero con el timestamp del dia)<br>
		   @return string Cadena con la fecha formateada<br>
		   @date 28-Jul-2004 16:52<br>
		   @location Cali-Colombia	", "fncintdate" => "Propiedad intelectual del FullEngine.<br>
		  extrae el entero timestamp de la fecha actual.<br>
		  @author freina<br>
		  @return integer Entero con el timestamp del dia<br>
		  @date 28-Jul-2004 16:27<br>
		  @location Cali-Colombia", "fncintdatehour" => "Propiedad intelectual del FullEngine.<br>
	    extrae el entero timestamp de la fecha-hora actual.<br>
	    @author freina<br>
		@return integer Entero con el timestamp del dia<br>
	    @date 28-Jul-2004 16:31<br>
	    @location Cali-Colombia", "fncvalidatedate" => " Propiedad intelectual del FullEngine.<br>
		  valida que una fecha dada sea correcta<br>
		  @author freina<br>
		  @param string \$isbfecha (Cadena con la fecha)<br>
		  @param string \$isbformato (Cadena con el formto de la fecha)<br>
		  @return boolean true,false (Fecha ok, Error)<br>
		  @date 28-Jul-2004 17:52<br>
		  @location Cali-Colombia", "hour2secs" => " @copyright Copyright 2004 &copy; FullEngine<br>
  Convierte la hora en la cantidad de segundos<br>
 @param string \$hour<br>
 @return integer Cantidad de segundos o null cuando el formato no corresponde<br>
 @author creyes <cesar.reyes@parquesoft.com><br>
 @date 17-sep-2004 10:51:22<br>
 @location Cali-Colombia", "fncdate_to_int" => "Propiedad intelectual del FullEngine.
						Convierte un fecha a un entero timestamp
						@author freina
						@param string \$isbfecha (Cadena con la fecha)
						@param string \$isbformato (Cadena con el formato a aplicar)
						@return integer \$onuresult (Entero timestamp de la fecha)
						@date 21-Sep-2004 15:08
						@location Cali-Colombia", "secs2hour" => "@copyright Copyright 2004 &copy; FullEngine<br>
		  Recibe una cantidad de segundos y dice a que hora del dia corresponde<br>
		 @param integer \$cantSecs Cantidad de segundos<br>
		 @return string <br>
		 @author creyes <cesar.reyes@parquesoft.com><br>
		 @date 21-sep-2004 12:37:39<br>
		 @location Cali-Colombia", "getLongDate" => " @copyright Copyright 2004 &copy; FullEngine
			 Pinta la fecha larga
			 @param string \$lang identificador del lenguaje por defecto en \"es\"
			 @return string
			 @author creyes <cesar.reyes@parquesoft.com>
			 @date 21-oct-2004 13:11:30
			 @location Cali-Colombia",
		"ValidateGreaterDate_Today"=>"@copyright Copyright 2004 &copy; FullEngine" .
			 												"valida que la fecha no sea mayor a la del dia de hoy" .
			 												"@param integer $inuTimestamp Fecha en formato timestamp" .
			 												"@return true or false" .
			 												"@author freina <freina@parquesoft.com>" .
			 												"@date 22-Sep-2005 17:17" .
			 												"@location Cali-Colombia",
		"_getDate"=>'@copyright Copyright 2004 &copy; FullEngine
		Obtiene la información de la fecha actual o la del timestamp pasado como parametro
		@param integer Entero timestamp
		@return array Arreglo con la infoemación de la fecha
		@author freina <freina@parquesoft.com>
		@date 25-Mar-2009 14:25:00
		@location Cali-Colombia',
		"_mktime"=>'Copyright 2011 FullEngine
		Retorna un numero flotante con el timstamp de la fecha
		@author feina <freina@fullengine.com>
		@param int $nuMonth
		@param int $nuYear
		@param int $nuDay
		@param int $nuHour
		@param int $nuMin
		@param int $nuSeg
		@return float con el timestamp
		@date 05-Sep-2011 18:49
		@location Cali-Colombia',
		"_year_digit_check"=>'Copyright 2011 FullEngine
		Arregla los anhos de dos digitos, Funciona para cualquier siglo.
		@author freina <freina@fullengine.com>
		@param int $nuYear
		@return int con la cifra del anho completa
		@date 07-Sep-2011 18:46
		@location Cali-Colombia',
		"_is_leap_year"=>'Copyright 2011 FullEngine
		chequea si el anho es bisiesto
		@author freina <freina@fullengine.com>
		@param int $nuYear
		@return boolean true si bisiesto false no
		@date 07-Sep-2011 19:22
		@location Cali-Colombia');
		echo "<table border=1>";
		foreach ($rcinfo as $key => $data) echo "<tr><td>$key</td><td>$data</td></td>";
		echo "</table>";
	}

	/**
	 Propiedad intelectual del FullEngine.

	 Genera una cadena con la fecha del dia.
		@author freina
		@return string $osbreturn (Cadena con la fecha del dia)
		@date 28-Jul-2004 16:08
		@location Cali-Colombia
		*/
	function fnctoday() {
		settype($objDate, "object");
		settype($sbReturn, "string");
		$objDate = new DateTime();
		$objDate->setTimezone($this->objTZ); 
		switch ($this->sbformat_date_single) {
			case 'y-m-d' :
				$sbReturn = $objDate->format("Y".$this->dateSeparator."m".$this->dateSeparator."d");
				break;
			case 'd-m-y' :
				$sbReturn = $this->objDate->format("d".$this->dateSeparator."m".$this->dateSeparator."Y");
				break;
		}
		return $sbReturn;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 Genera una cadena con la fecha y hora del dia.
		@author creyes
		@return string $osbreturn (Cadena con la fecha del dia)
		@date 28-Jul-2004 16:08
		@location Cali-Colombia
		*/
	function intToday() {
		settype($objDate, "object");
		settype($sbReturn, "string");
		$objDate = new DateTime();
		$objDate->setTimezone($this->objTZ); 
		switch ($this->sbformat_date_time) {
			case 'y-m-d_h-m-s' :
				$sbReturn = $objDate->format("Y".$this->dateSeparator."m".$this->dateSeparator."d".$this->typeSeparator."H".$this->timeSeparator."i".$this->timeSeparator."s");
				break;
			case 'd-m-y_h-m-s' :
				$sbReturn = $objDate->format("d".$this->dateSeparator."m".$this->dateSeparator."Y".$this->typeSeparator."H".$this->timeSeparator."i".$this->timeSeparator."s");
				break;
		}
		return $sbReturn;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Pinta la fecha larga
	 * @param string $lang identificador del lenguaje por defecto en "es"
	 * @return string
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 21-oct-2004 13:11:30
	 * @location Cali-Colombia
	 */
	function getLongDate($lang = 'es') {
		settype($objDate, "object");
		settype($rcdias, "array");
		settype($rcmeses_largos, "array");
		settype($rcmeses_cortos, "array");
		settype($rcarticulo, "array");
		settype($sbReturn, "string");
		settype($rcTmp, "array");
		settype($sbTmp,"string");
		$objDate = new DateTime();
		$objDate->setTimezone($this->objTZ); 
		switch ($lang) {
			case 'es' :
				$rcdias = array ("", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo");
				$rcmeses_largos = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
				$rcmeses_cortos = array ("", "Ene.", "Feb.", "Mar.", "Abr.", "May.", "Jun.", "Jul.", "Ago.", "Sep.", "Oct.", "Nov.", "Dic.");
				$rcarticulo = array ("de", "de");
				break;
			case 'en' :
				$rcdias = array ("", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
				$rcmeses_largos = array ("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
				$rcmeses_cortos = array ("", "Jan.", "Feb.", "Mar.", "Apr.", "May.", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec.");
				$rcarticulo = array ("", "");
				break;
		}
		
		$sbTmp = $objDate->format("j-n-Y");
		$rcTmp = explode("-",$sbTmp);
		return $sbReturn = $rcTmp[0]." ".$rcarticulo[0]." ".$rcmeses_largos[$rcTmp[1]]." ".$rcarticulo[1]." ".$rcTmp[2];
	}
	/**
	 Propiedad intelectual del FullEngine.

	 extrae el entero timestamp de la fecha actual.
	 @author freina
		@return integer (Entero con el timestamp del dia)
		@date 28-Jul-2004 16:27
		@location Cali-Colombia
		*/
	function fncintdate() {
		settype($objDate, "object");
		settype($objDate1, "object");
		settype($nuResult, "float");
		$objDate = new DateTime();
		$objDate->setTimezone($this->objTZ);
		$objDate1 = new DateTime($objDate->format("Y-n-j"));
		$objDate1->setTimezone($this->objTZ); 
		$nuResult = (float) $objDate1->format("U");
		return $nuResult;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 extrae el entero timestamp de la fecha-hora actual.
	 @author freina
		@return integer (Entero con el timestamp del dia)
		@date 28-Jul-2004 16:31
		@location Cali-Colombia
		*/
	function fncintdatehour() {
		settype($objDate, "object");
		settype($nuResult, "float");
		$objDate = new DateTime();
		$objDate->setTimezone($this->objTZ); 
		$nuResult = (float) $objDate->format("U");
		return $nuResult;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 Formatea un entero timestamp de un dia en el formato especificado
	 @author freina
	 @param integer $inutimestamp (Entero con el timestamp del dia)
	 @return string $osbresult (Cadena con la fecha formateada)
	 @date 28-Jul-2004 16:52
	 @location Cali-Colombia
	 */
	function fncformatofecha($nuTimestamp) {
		settype($objDate, "object");
		settype($sbResult, "string");

		if ($nuTimestamp) {
			$objDate = new DateTime("@$nuTimestamp");
			$objDate->setTimezone($this->objTZ);
			switch ($this->sbformat_date_single) {
				case "m-d-y" :
					$sbResult = $objDate->format("m".$this->dateSeparator."d".$this->dateSeparator."Y");
					break;
				case "y-m-d" :
					$sbResult = $objDate->format("Y".$this->dateSeparator."m".$this->dateSeparator."d");
					break;
				case "d-m-y" :
					$sbResult = $objDate->format("d".$this->dateSeparator."m".$this->dateSeparator."Y");
					break;
			}
			return $sbResult;
		}
		return null;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 Formatea un entero timestamp de un dia en el formato fecha-hora especificado
	 @author freina
	 @param integer $inutimestamp (Entero con el timestamp del dia)
	 @return string $osbresult (Cadena con la fecha formateada)
	 @date 28-Jul-2004 16:52
	 @location Cali-Colombia
	 */
	function fncformatofechahora($nuTimestamp) {
		settype($objDate, "object");
		settype($sbResult, "string");
		if ($nuTimestamp) {
			$objDate = new DateTime("@$nuTimestamp");
			$objDate->setTimezone($this->objTZ);
			switch ($this->sbformat_date_time) {
				case "m-d-y_h-m-s" :
					$sbResult = $objDate->format("m".$this->dateSeparator."d".$this->dateSeparator."Y".$this->typeSeparator."H".$this->timeSeparator."i".$this->timeSeparator."s");
					break;
				case "y-m-d_h-m-s" :
					$sbResult = $objDate->format("Y".$this->dateSeparator."m".$this->dateSeparator."d".$this->typeSeparator."H".$this->timeSeparator."i".$this->timeSeparator."s");
					break;
				case "d-m-y_h-m-s" :
					$sbResult = $objDate->format("d".$this->dateSeparator."m".$this->dateSeparator."Y".$this->typeSeparator."H".$this->timeSeparator."i".$this->timeSeparator."s");
					break;
			}
			return $sbResult;
		}
		return null;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 Convierte un fecha a un entero timestamp
	 @author freina
	 @param string $isbfecha (Cadena con la fecha)
	 @return integer $onuresult (Entero timestamp de la fecha)
	 @date 28-Jul-2004 17:02
	 @location Cali-Colombia
	 */
	function fncdatetoint($sbFecha) {
		settype($objDate,"object");
		settype($rcToday, "array");
		settype($nuResult, "float");
		if ($sbFecha) {
			$rcToday = explode($this->dateSeparator, $sbFecha);
			switch ($this->sbformat_date_single) {
				case "m-d-y" :
					$objDate = new DateTime("$rcToday[2]-$rcToday[0]-$rcToday[1]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
				case "d-m-y" :
					$objDate = new DateTime("$rcToday[2]-$rcToday[1]-$rcToday[0]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
				case "y-m-d" :
					$objDate = new DateTime("$rcToday[0]-$rcToday[1]-$rcToday[2]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
			}
			return $nuResult;
		}
		return 0;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 Convierte un fecha a un entero timestamp
	 @author freina
	 @param string $isbfecha (Cadena con la fecha)
	 @return integer $onuresult (Entero timestamp de la fecha)
	 @date 28-Jul-2004 17:02
	 @location Cali-Colombia
	 */
	function fncdatehourtoint($sbFecha) {
		settype($objDate, "object");
		settype($rcTmp, "array");
		settype($rcDia, "array");
		settype($rcHora, "array");
		settype($nuResult, "integer");
		if ($sbFecha) {
			$rcTmp = explode($this->typeSeparator, $sbFecha);
			$rcDia = explode($this->dateSeparator, $rcTmp[0]);
			$rcHora = explode($this->timeSeparator, $rcTmp[1]);
			
			if(!$rcHora[0]){
				$rcHora[0]=0;
			}
			
			if(!$rcHora[1]){
				$rcHora[1]=0;
			}
			
			if(!$rcHora[2]){
				$rcHora[2]=0;
			}

			switch ($this->sbformat_date_time) {
				case "d-m-y_h-m-s" :
					$objDate = new DateTime("$rcDia[2]-$rcDia[1]-$rcDia[0] $rcHora[0]:$rcHora[1]:$rcHora[2]");
					$objDate->setTimezone($this->objTZ);
					$nuResult =  (float) $objDate->format("U");
					break;
				case "y-m-d_h-m-s" :
					$objDate = new DateTime("$rcDia[0]-$rcDia[1]-$rcDia[2] $rcHora[0]:$rcHora[1]:$rcHora[2]");
					$objDate->setTimezone($this->objTZ);
					$nuResult =  (float) $objDate->format("U");
					break;
			}
			return $nuResult;
		}
		return 0;
	}
	/**
	 Propiedad intelectual del FullEngine.

	 valida que una fecha dada sea correcta
	 @author freina
	 @param string $isbfecha (Cadena con la fecha)
	 @param string $isbformato (Cadena con el formto de la fecha)
	 @return boolean true,false (Fecha ok, Error)
	 @date 28-Jul-2004 17:52
	 @location Cali-Colombia
	 */
	function fncvalidatedate($isbfecha) {
		settype($rctmp, "array");
		settype($rctmpfc, "array");
		settype($numes, "integer");
		settype($nudia, "integer");
		settype($nuano, "integer");
		settype($osbresult, "string");
		$osbresult = false;
		if ($isbfecha) {
			switch ($this->sbformat_date_single) {
				case "d-m-y" :
					$rctmpfc = explode($this->typeSeparator, $isbfecha);
					$rctmp = explode($this->dateSeparator, $rctmpfc[0]);
					if(sizeof($rctmp) != 3)
					break;
					if(!is_numeric($rctmp[0]) || !is_numeric($rctmp[1]) || !is_numeric($rctmp[2]))
					break;
					$numes = $rctmp[1];
					$nudia = $rctmp[0];
					$nuano = $rctmp[2];
					if (checkdate($numes, $nudia, $nuano)) {
						$osbresult = true;
					}
					break;
				case "m-d-y" :
					$rctmpfc = explode($this->typeSeparator, $isbfecha);
					$rctmp = explode($this->dateSeparator, $rctmpfc[0]);
					if(sizeof($rctmp) != 3)
					break;
					if(!is_numeric($rctmp[0]) || !is_numeric($rctmp[1]) || !is_numeric($rctmp[2]))
					break;
					$numes = $rctmp[0];
					$nudia = $rctmp[1];
					$nuano = $rctmp[2];
					if (checkdate($numes, $nudia, $nuano)) {
						$osbresult = true;
					}
					break;
				case "y-m-d" :
					$rctmpfc = explode($this->typeSeparator, $isbfecha);
					$rctmp = explode($this->dateSeparator, $rctmpfc[0]);
					if(sizeof($rctmp) != 3)
					break;
					if(!is_numeric($rctmp[0]) || !is_numeric($rctmp[1]) || !is_numeric($rctmp[2]))
					break;
					$numes = $rctmp[1];
					$nudia = $rctmp[2];
					$nuano = $rctmp[0];
					if (checkdate($numes, $nudia, $nuano)) {
						$osbresult = true;
					}
					break;
			}
		}
		return $osbresult;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 *  Convierte la hora en la cantidad de segundos
	 * @param string $hour en formato HH:MM:SS militar
	 * @return integer Cantidad de segundos o null cuando el formato no corresponde
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 17-sep-2004 10:51:22
	 * @location Cali-Colombia
	 */
	function hour2secs($hour) {
		if (!$hour)
		return null;
		$rcHour = explode($this->timeSeparator, $hour);
		$rcHour[0] = (integer) $rcHour[0];
		$rcHour[1] = (integer) $rcHour[1];
		$rcHour[2] = (integer) $rcHour[2];

		if ($rcHour[0] >= 24 || $rcHour[0] < 0)
		return null;
		if ($rcHour[1] >= 60 || $rcHour[1] < 0)
		return null;
		if ($rcHour[2] >= 60 || $rcHour[2] < 0)
		return null;
		$nuTime = ($rcHour[0] * 3600) + ($rcHour[1] * 60) + $rcHour[2];
		return $nuTime;
	}
	/**
	 Propiedad intelectual del FullEngine.
	 Convierte un fecha a un entero timestamp
	 @author freina
	 @param string $isbfecha (Cadena con la fecha)
	 @param string $isbfecha (Cadena con el formato a aplicar)
	 @return integer $onuresult (Entero timestamp de la fecha)
	 @date 21-Sep-2004 15:08
	 @location Cali-Colombia
	 */
	function fncdate_to_int($sbFecha, $sbFormato) {
		settype($objDate,"object");
		settype($rcToday, "array");
		settype($nuResult, "integer");
		if ($sbFecha && $sbFormato) {
			$rcToday = explode("-", $sbFecha);
			switch ($sbFormato) {
				case "m-d-y" :
					$objDate = new DateTime("$rcToday[2]-$rcToday[0]-$rcToday[1]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
				case "d-m-y" :
					$objDate = new DateTime("$rcToday[2]-$rcToday[1]-$rcToday[0]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
				case "y-m-d" :
					$objDate = new DateTime("$rcToday[0]-$rcToday[1]-$rcToday[2]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
				case "dd-mm-yy" :
					$rcToday[2] += $this->Century;
					$objDate = new DateTime("$rcToday[2]-$rcToday[1]-$rcToday[0]");
					$objDate->setTimezone($this->objTZ);
					$nuResult = (float) $objDate->format("U");
					break;
			}
			return $nuResult;
		}
		return 0;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 *  Recibe una cantidad de segundos y dice a que hora del dia corresponde
	 * @param integer $cantSecs Cantidad de segundos
	 * @return string
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 21-sep-2004 12:37:39
	 * @location Cali-Colombia
	 */
	function secs2hour($cantSecs) {
		if (!$cantSecs)
		return "00".$this->timeSeparator."00".$this->timeSeparator."00";
		$hours = floor($cantSecs / 3600);
		$min = floor(($cantSecs % 3600) / 60);
		$secs = floor(($cantSecs % 3600) % 60);
		if (strlen($hours) < 2)
		$hours = "0$hours";
		if (strlen($min) < 2)
		$min = "0$min";
		if (strlen($secs) < 2)
		$secs = "0$secs";
		return $hours.$this->timeSeparator.$min.$this->timeSeparator.$secs;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Retorna la hora de una fecha dada en formato timestamp
	 * @param integer $intDate Fecha en formato timestamp
	 * @return integer cantidad de horas convertidas a segundos
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 04-nov-2004 12:30:45
	 * @location Cali-Colombia
	 */
	function getHour2DateInSecs($nuTimestamp) {
		
		settype($objDate, "object");
		settype($sbTmp, "string");
		settype($nuResult, "integer");
		
		if (!$nuTimestamp){
			return null;	
		}
		
		$objDate = new DateTime("@$nuTimestamp");
		$objDate->setTimezone($this->objTZ);
		$sbTmp = $objDate->format("H:i:s");
		$nuResult = $this->hour2secs($sbTmp);
		return $nuResult;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * valida que la fecha no sea mayor a la del dia de hoy
	 * @param integer $inuTimestamp Fecha en formato timestamp
	 * @return true or false
	 * @author freina <freina@parquesoft.com>
	 * @date 22-Sep-2005 17:17
	 * @location Cali-Colombia
	 */
	function ValidateGreaterDate_Today($nuTimestamp) {
		if ($nuTimestamp && is_numeric($nuTimestamp)){
			$nuTimestamp = (float)$nuTimestamp;
			if($nuTimestamp > ($this->fncintdate() + ($this->nuSecsDay - 1))){
				return true;
			}
		}
		return false;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Convierte una cantidad de segundos en dias:horas:minutos:segundos
	 * @author creyes
	 * @param int $timestamp cantidad de tiempo expresado en segundos
	 * @return array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
	 * @date 1-February-2006 11:36:55
	 * @location Cali-Colombia
	 */
	function seconds2days($timestamp){
		$rcReturn = array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
		if(!$timestamp)
		return $rcReturn;
		//Define los multiplicadores
		$byDays = 86400;
		$byHours = 3600;
		$byMinutes = 60;
		//determina los dias
		$resDays = $timestamp % $byDays;
		$rcReturn['days'] = floor($timestamp / $byDays);
		//Determina las horas
		$resHours = $resDays % $byHours;
		$rcReturn['hours'] = floor($resDays / $byHours);
		//Determina los minutos
		$resMinutes = $resHours % $byMinutes;
		$rcReturn['minutes'] = floor($resHours / $byMinutes);
		$rcReturn['seconds'] = $resMinutes;
		return $rcReturn;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Retorna un array con las fechas inicial y final en timestamp de las
	 * semanas de un mes
	 * @author creyes <careyes@parquesoft.com>
	 * @param int $month
	 * @param int $year
	 * @return array
	 * @date 12-July-2006 14:42
	 * @location Cali-Colombia
	 */
	function getWeeksByMounth($month, $year){
		if(!$month || !$year)
		return null;
		 
		$i = 0;
		$day = (int) $this->_date("w", $this->_mktime(0, 0, 0, $month, 1, $year));
		$startday = $this->_mktime(0, 0, 0, $month, 1, $year);
		$cont = 0;
		while (checkdate($month, ++$i, $year)) {
			if ($day == 6){
				$rcDates[$cont][0] = $startday;
				$rcDates[$cont][1] = $this->_mktime(0, 0, 0, $month, $i, $year);
				$startday = $this->_mktime(0, 0, 0, $month, $i + 1, $year);
				$cont++;
				$day = -1;
			}
			$day ++;
		}
		$rcDates[$cont][0] = $startday;
		$rcDates[$cont][1] = $this->_mktime(0, 0, 0, $month, $i - 1, $year);
		return $rcDates;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Adiciona meses a la fecha
	 * @param integer $intDate Fecha en formato timestamp
	 * @return integer $intMont cantidad de meses
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 20-may-2005 09:43:45
	 * modified
	 * @autor freina <feina@fullengine.com>
	 * @date 10-Sep-2011 15:41:00
	 * Se modifica para el manejo de fechas superiores al 2038 
	 * @location Cali-Colombia
	 */
	function addMonts($nuTimestamp, $intMont){
		settype($rcDate,"array");
		
		if(!is_numeric($nuTimestamp) || !is_integer($intMont)){
			return null;	
		}
		
		$nuTimestamp = (float) $nuTimestamp;
		$nuTimestamp = $nuTimestamp - fmod($nuTimestamp, 1);
		
		$rcDate = explode("-",$this->_date( "d-m-Y-H-i-s", $nuTimestamp));
		$rcDate[1] = (int) $rcDate[1] + $intMont;
		return $this->_mktime($rcDate[3],$rcDate[4],$rcDate[5],$rcDate[1],$rcDate[0],$rcDate[2]);
	}

	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Calcula la cantidad la edad de una persona
	 * @param string $bornDate Fecha en formato aaaa/mm/dd
	 * @return integer $yearsOld cantidad de años
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 20-may-2005 09:43:45
	 * @location Cali-Colombia
	 */
	function getYearsOld($bornDate){

		//valida la fecha
		if(!$this->fncvalidatedate($bornDate))
		return false;

		//Determina los elementos de la fecha (anio,mes,dia) de nacimiento
		$rcTmp = explode($this->typeSeparator, $bornDate);
		$rcTmp = explode($this->dateSeparator,$rcTmp[0]);
		//Determina los elementos de la fecha (anio,mes,dia) de hoy
		$rcTmpToday = explode($this->dateSeparator,$this->fnctoday());

		switch ($this->sbformat_date_single) {
			case "d-m-y" :
				$rcBornDate[] = (integer)$rcTmp[2];
				$rcBornDate[] = (integer)$rcTmp[1];
				$rcBornDate[] = (integer)$rcTmp[0];
				$rcHoy[] = (integer)$rcTmpToday[2];
				$rcHoy[] = (integer)$rcTmpToday[1];
				$rcHoy[] = (integer)$rcTmpToday[0];
				break;
			case "m-d-y" :
				$rcBornDate[] = (integer)$rcTmp[2];
				$rcBornDate[] = (integer)$rcTmp[0];
				$rcBornDate[] = (integer)$rcTmp[1];
				$rcHoy[] = (integer)$rcTmpToday[2];
				$rcHoy[] = (integer)$rcTmpToday[0];
				$rcHoy[] = (integer)$rcTmpToday[1];
				break;
			case "y-m-d" :
				foreach($rcTmp as $key => $value)
				$rcBornDate[$key] = (integer) $value;
				foreach($rcTmpToday as $key => $value)
				$rcHoy[$key] = (integer) $value;
				break;
		}
		/*
		 * Estructura de los vectores con fechas
		 * array[0] => anio
		 * array[1] => mes
		 * array[2] => dia*/
			
		//Sustrae los anios
		$yearsOld = $rcHoy[0] - ($rcBornDate[0] + 1);

		//Si el mes de nacimiento es menor al mes actual suma el anio actual
		if($rcHoy[1] > $rcBornDate[1]){
			$yearsOld++;
		}else{
			//Sin son iguales verifica contra el dia del mes
			if($rcHoy[1] == $rcBornDate[1]){
				if($rcHoy[2] >= $rcBornDate[2])
				$yearsOld++;
			}
		}
		return $yearsOld;
	}
	//----------------------------------
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Obtiene la información de la fecha actual o la del timestamp pasado como parametro
	 * @param integer Entero timestamp
	 * @return array Arreglo con la infoemación de la fecha
	 * @author freina <freina@parquesoft.com>
	 * @date 25-Mar-2009 14:25:00
	 * @location Cali-Colombia
	 */
	function _getDate(){
		
		settype($objDate,"object");
		settype($rcDate,"array");
		settype($rcArgs,"array");
		settype($nuTimestamp,"float");
		
		$rcArgs = func_get_args();
		
		if(array_key_exists(0,$rcArgs)){
				
			if(is_numeric($rcArgs[0])){
				$nuTimestamp = (float) $rcArgs[0];
				$nuTimestamp = $nuTimestamp - fmod($nuTimestamp, 1);
			}else{
				if($rcArgs[0]===null){
					$nuTimestamp = 0;
				}else{
					if(is_string($rcArgs[0])){
						return false;	
					}
				}
			}
			
			$objDate = new DateTime("@$nuTimestamp");
				
		}else{
			$objDate = new DateTime('now');
		}
		
		$objDate->setTimezone($this->objTZ);
		
		$rcDate["seconds"] = (int) $objDate->format('s');
		$rcDate["minutes"] = (int) $objDate->format('i');
		$rcDate["hours"] = (int) $objDate->format('G');
		$rcDate["mday"] = (int) $objDate->format('j');
		$rcDate["wday"] = (int) $objDate->format('w');
		$rcDate["mon"] = (int) $objDate->format('n');
		$rcDate["year"] = (int) $objDate->format('Y');
		$rcDate["yday"] = (int) $objDate->format('z');
		$rcDate["weekday"] = $objDate->format('l');
		$rcDate["month"] = $objDate->format('F');
		$rcDate[0] = (float) $objDate->format('U');
		
		return $rcDate;
	}
	
	/**
	 * Copyright 2011 FullEngine
	 *
	 * Retorna un numero flotante con el timstamp de la fecha
	 * @author feina <freina@fullengine.com>
	 * @param int $nuMonth
	 * @param int $nuYear
	 * @param int $nuDay
	 * @param int $nuHour
	 * @param int $nuMin
	 * @param int $nuSeg
	 * @return float con el timestamp
	 * @date 05-Sep-2011 18:49
	 * @location Cali-Colombia
	 */
	function _mktime(){
		
		settype($objDate,"object");
		settype($rcMonth_Days_Normal,"array");
		settype($rcMonth_Days_Leap,"array");
		settype($rcMonth_Days,"array");
		settype($rcArgs,"array");
		settype($sbDate,"string");
		settype($sbYear,"string");
		settype($sbFlag, "string");
		settype($nuResult,"float");
		settype($nuCant,"integer");
		settype($nuCant_Days_Month,"integer");
		settype($nuCont,"integer");
		
		//detrmina que argumentos llegan
		$rcArgs = func_get_args();
		
		$rcMonth_Days_Normal = array("",31,28,31,30,31,30,31,31,30,31,30,31);
		$rcMonth_Days_Leap = array("",31,29,31,30,31,30,31,31,30,31,30,31);
		
		$objDate = new DateTime('now');
		$objDate->setTimezone($this->objTZ);
		
		if(!array_key_exists(0,$rcArgs)){
			$nuHour = (int) $objDate->format('H');
		}else{
			if(is_numeric($rcArgs[0])){
				$nuHour = (int) $rcArgs[0];
			}else{
				if($rcArgs[0]===null){
					$nuHour = 0;
				}else{
					if(is_string($rcArgs[0])){
						return false;	
					}
				}
			}
		}
		
		if(!array_key_exists(1,$rcArgs)){
			$nuMin = (int) $objDate->format('i');
		}else{
			if(is_numeric($rcArgs[1])){
				$nuMin = (int) $rcArgs[1];
			}else{
				if($rcArgs[1]===null){
					$nuMin = 0;
				}else{
					if(is_string($rcArgs[1])){
						return false;	
					}
				}
			}
		}
		
		if(!array_key_exists(2,$rcArgs)){
			$nuSeg = (int) $objDate->format('s');
		}else{
			if(is_numeric($rcArgs[2])){
				$nuSeg = (int) $rcArgs[2];
			}else{
				if($rcArgs[2]===null){
					$nuSeg = 0;
				}else{
					if(is_string($rcArgs[2])){
						return false;	
					}
				}
			}
		}
		
		if(!array_key_exists(3,$rcArgs)){
			$nuMonth = (int) $objDate->format('n');
		}else{
			if(is_numeric($rcArgs[3])){
				$nuMonth = (int) $rcArgs[3];
			}else{
				if($rcArgs[3]===null){
					$nuMonth = 0;
				}else{
					if(is_string($rcArgs[3])){
						return false;	
					}
				}
			}
		}
		
		if(!array_key_exists(4,$rcArgs)){
			$nuDay = (int) $objDate->format('j');
		}else{
			if(is_numeric($rcArgs[4])){
				$nuDay = (int) $rcArgs[4];
			}else{
				if($rcArgs[4]===null){
					$nuDay = 0;
				}else{
					if(is_string($rcArgs[4])){
						return false;	
					}
				}
			}
		}
		
		if(!array_key_exists(5,$rcArgs)){
			$nuYear = (int) $objDate->format('Y');
		}else{
			if(is_numeric($rcArgs[5])){
				$nuYear = (int) $rcArgs[5];
			}else{
				if($rcArgs[5]===null){
					$nuYear = 0;
				}else{
					if(is_string($rcArgs[5])){
						return false;	
					}
				}
			}
		}
		
		if($nuYear<0){
			return false;
		}
		
		$sbYear = (string)$nuYear; 
		
		if(strlen($sbYear)<4){
			$nuYear = $this->_year_digit_check($nuYear);
		}
		
		$sbDate = "[Y]-[n]-[j] [H]:[i]:[s]";
		
		if(is_integer($nuMonth) && is_integer($nuYear) && is_integer($nuDay)
		   && is_integer($nuHour) && is_integer($nuMin) && is_integer($nuSeg)){
			
		   //analisis de los segundos
		   	
		   if ($nuSeg > 60) {
				$nuCant = floor(($nuSeg-1)/ 60);
				$nuMin += $nuCant;
				$nuSeg -= $nuCant*60;
			} else{
				if ($nuSeg < 0) {
					$nuCant = ceil((1-$nuSeg) / 60);
					$nuMin -= $nuCant;
					$nuSeg += $nuCant*60;
				}else{
					if($nuSeg==60){
						$nuMin += 1;
						$nuSeg = 0;
					}
				}
			}	
			$nuCant = 0;
			
			//analisis de los minutos
			
		   if ($nuMin > 60) {
				$nuCant = floor(($nuMin-1)/ 60);
				$nuHour += $nuCant;
				$nuMin -= $nuCant*60;
			} else{
			 	if ($nuMin < 0) {
					$nuCant = ceil((1-$nuMin) / 60);
					$nuHour -= $nuCant;
					$nuMin += $nuCant*60;
				}
			}
		   if($nuMin==60){
				$nuHour += 1;
				$nuMin = 0;
			}
			$nuCant = 0;
			
			//analisis de las horas
			
		   if ($nuHour > 24) {
				$nuCant = floor(($nuHour-1)/ 24);
				$nuDay += $nuCant;
				$nuHour -= $nuCant*24;
			} else{
				if ($nuHour < 0) {
					$nuCant = ceil((1-$nuHour) / 24);
					$nuDay -= $nuCant;	
					$nuHour += $nuCant*24;
				}
			}
		   if($nuHour==24){
				$nuDay += 1;
				$nuHour = 0;
			} 
			$nuCant = 0;
			
			//analisis de los meses
			
		   if ($nuMonth > 12) {
				$nuCant = floor(($nuMonth-1)/ 12);
				$nuYear += $nuCant;
				$nuMonth -= $nuCant*12;
			} else if ($nuMonth < 1) {
				$nuCant = ceil((1-$nuMonth) / 12);
				$nuYear -= $nuCant;
				$nuMonth += $nuCant*12;
			}
			$nuCant = 0;
			
			//analisis de los dias
			
			//se determina si el anho es bisiesto
			if($this->_is_leap_year($nuYear)){
				$rcMonth_Days = $rcMonth_Days_Leap;
			}else{
				$rcMonth_Days = $rcMonth_Days_Normal;
			}
			
			$sbflag = true;
			if($nuDay >=  1){
				do{
					$nuCant_Days_Month = $rcMonth_Days[$nuMonth];
					if($nuDay>$nuCant_Days_Month){
						$nuDay -= $nuCant_Days_Month;
						$nuMonth +=1;
					if ($nuMonth > 12) {
						$nuCant = floor(($nuMonth-1)/ 12);
						$nuYear += $nuCant;
						$nuMonth -= $nuCant*12;
					}
					$nuCant = 0;
					}else{
						$sbFlag = false;
					}
				}while($sbFlag==true);
			}else{
				$nuMonth -= 1;
				if ($nuMonth < 1) {
					$nuCant = ceil((1-$nuMonth) / 12);
					$nuYear -= $nuCant;
					$nuMonth += $nuCant*12;
				}
				$nuCant = 0;
				$nuCant_Days_Month = $rcMonth_Days[$nuMonth];
				
				for($nuCont=$nuDay;$nuCont<0;$nuCont++){
					$nuCant_Days_Month --;
					if($nuCant_Days_Month==0){
						$nuMonth -= 1;
						if ($nuMonth < 1) {
							$nuCant = ceil((1-$nuMonth) / 12);
							$nuYear -= $nuCant;
							$nuMonth += $nuCant*12;
						}
						$nuCant_Days_Month = $rcMonth_Days[$nuMonth];
						$nuCant = 0;
					}
				}
				$nuDay = $nuCant_Days_Month;	
			}
			
			//se valida la fecha completa
			if(!checkdate ($nuMonth,$nuDay,$nuYear)){
				return false;
			}
			
			$sbDate = str_replace("[Y]",(string)$nuYear,$sbDate);
			$sbDate = str_replace("[n]",(string)$nuMonth,$sbDate);
			$sbDate = str_replace("[j]",(string)$nuDay,$sbDate);
			$sbDate = str_replace("[H]",(string)$nuHour,$sbDate);
			$sbDate = str_replace("[i]",(string)$nuMin,$sbDate);
			$sbDate = str_replace("[s]",(string)$nuSeg,$sbDate);
			//echo "<pre>";
			//var_dump($sbDate);
			//echo "</pre>";
			$objDate = new DateTime($sbDate);
			$objDate->setTimezone($this->objTZ);
			$nuResult = (float) $objDate->format("U");
		}else{
			return false;
		}
		return $nuResult; 
	}
	
	/**
	 * Copyright 2011 FullEngine
	 *
	 * Arregla los anhos de dos digitos, Funciona para cualquier siglo. 
	 * @author freina <freina@fullengine.com>
	 * @param int $nuYear
	 * @return int con la cifra del anho completa
	 * @date 07-Sep-2011 18:46
	 * @location Cali-Colombia
	 */
	function _year_digit_check($nuYear) {
		
		settype($objDate, "object");
		settype($nuYA, "integer");
		settype($nuCentury,"integer");
		
		$objDate = new DateTime('now');
		$objDate->setTimezone($this->objTZ);
		$nuYA = (int) $objDate->format("Y");
		
		$nuCentury = (int) ($nuYA /100);
		$nuYear = $nuYear + ($nuCentury*100);
		return $nuYear;
	}
	
	/**
	 * Copyright 2011 FullEngine
	 *
	 * chequea si el anho es bisiesto
	 * @author freina <freina@fullengine.com>
	 * @param int $nuYear
	 * @return boolean true si bisiesto false no
	 * @date 07-Sep-2011 19:22
	 * @location Cali-Colombia
	 */
	function _is_leap_year($nuYear) {
		
		if ($nuYear % 4 != 0) return false;
		
		if ($nuYear % 400 == 0) {
			return true;
		// if gregorian calendar (>1582), century not-divisible by 400 is not leap
		} else if ($nuYear > 1582 && $nuYear % 100 == 0 ) {
			return false;
		} 
		
		return true;
	}
	
	/**
	 * Copyright 2011 FullEngine
	 *
	 * Devuelve una cadena formateada según el formato 
	 * dado usando el parámetro de tipo integer timestamp dado o 
	 * el momento actual si no se da una marca de tiempo
	 * @author freina <freina@fullengine.com>
	 *  @param string $sbFormat Cadena con el formato
	 * @param float $nuTimestamp Entero Timestamp
	 * @return string con la fecha en el formato especificado.
	 * @date 09-Sep-2011 18:1
	 * @location Cali-Colombia
	 */
	function _date(){
		
		settype($objDate,"object");
		settype($rcArgs,"array");
		settype($sbResult,"string");
		settype($sbFormat, "string");
		settype($nuTimestamp,"float");
		
		$rcArgs = func_get_args();
		
		if(!array_key_exists(0,$rcArgs)){
			$sbResult = false;
		}else{
			
			$sbFormat = $rcArgs[0];
		
			if(array_key_exists(1,$rcArgs)){
				
				if(is_numeric($rcArgs[1])){
					$nuTimestamp = (float) $rcArgs[1];
					$nuTimestamp = $nuTimestamp - fmod($nuTimestamp, 1);
				}else{
					if($rcArgs[1]===null){
						$nuTimestamp = 0;
					}else{
						if(is_string($rcArgs[1])){
							return false;	
						}
					}
				}
				
				$objDate = new DateTime("@$nuTimestamp");
					
			}else{
				$objDate = new DateTime('now');
			}
			
			$objDate->setTimezone($this->objTZ);
			
			$sbResult = $objDate->format($sbFormat);	
		}
		
		return $sbResult;
	}
	
	/**
	 * Copyright 2013 FullEngine
	 *
	 * Convierte una cantidad de segundos en dias:horas:minutos:segundos
	 * tiene en cuenta los horarios de atencion
	 * @author freina<freina@fullengine.com>
	 * @param int $timestamp cantidad de tiempo expresado en segundos
	 * @return array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
	 * @date 14-Apr-2013 11:35:00
	 * @location Cali-Colombia
	 */
	function seconds2days_ha($timestamp){
		
		settype($objService, "object");
		settype($rcHour, "array");
		settype($rcReturn, "array");
		settype($byDays, "integer");
		settype($byHours, "integer");
		settype($byMinutes, "integer");
		settype($resDays, "integer");
		settype($resHours, "integer");
		settype($resMinutes, "integer");
		settype($nuHourHFin, "integer");
		settype($nuHourHIni, "integer");
		
		$rcReturn = array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
		if(!$timestamp){
			return $rcReturn;	
		}
		
		//se obtienen los horarios de atencion
		$objService = Application::loadServices("General");
		$rcHour = $objService->getParam("general",'horario_atencion');
		if($rcHour && is_array($rcHour)){
			if($rcHour["hora_fin"]){
				$nuHourHFin = $this->hour2secs($rcHour["hora_fin"]);
			}
			if($rcHour["hora_ini"]){
				$nuHourHIni = $this->hour2secs($rcHour["hora_ini"]);
			}
			//cantidad de segundos del turno.
			$byDays = $nuHourHFin - $nuHourHIni;
		}else{
			//si no se ha definido un horario el turno es de todo el dia
			$byDays = $objDate->nuSecsDay;
		}
		
		//Define los multiplicadores
		$byHours = $this->nuSecsHour;
		$byMinutes = 60;
		
		//determina los dias
		$resDays = $timestamp % $byDays;
		$rcReturn['days'] = floor($timestamp / $byDays);
		
		//Determina las horas
		$resHours = $resDays % $byHours;
		$rcReturn['hours'] = floor($resDays / $byHours);
		
		//Determina los minutos
		$resMinutes = $resHours % $byMinutes;
		$rcReturn['minutes'] = floor($resHours / $byMinutes);
		$rcReturn['seconds'] = $resMinutes;
		
		return $rcReturn;
	}
}
?>