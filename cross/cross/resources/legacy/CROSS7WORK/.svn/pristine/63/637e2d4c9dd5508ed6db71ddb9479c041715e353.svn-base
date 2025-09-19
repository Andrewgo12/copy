<?php       
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Smarty plugin
* Pinta el calendario de la configuracion de dias inhabiles
* @author creyes <cesar.reyes@parquesoft.com>
* @date 02-nov-2004 15:09:10
* @location Cali-Colombia
*/
function smarty_function_print_calendar()
{
	extract($_REQUEST);
	settype($rcResult,"array");
	settype($objDate, "object");
    
	$objDate = Application :: loadServices("DateController");
	
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	
	if (!is_array($rcuser))
	{
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	include ($rcuser["lang"]."/".$rcuser["lang"].".diasinhabiles.php");
	
	//mrestrepo dec-29
	//En el hidden schema guardaré el nombre del esquema actual
	//El nombre de la variable lo saco de una constante
	$sbVbleName = Application::getConstant("SCHEMA_VBLE_NAME");
	$sbSchema = $rcuser[$sbVbleName];
	
	$rcfechas = WebSession :: getProperty('rcfechas');
	
	if (!is_array($rcfechas)) //NO ESTÁ EN LA SESIÓN
	{
		//Busca la configuración de dias inhabiles
		$file_name = Application :: getBaseDirectory().'/config/DiasInhabiles.data';
		if (file_exists($file_name))
		{
			$rcfechas = Serializer :: load($file_name);
			if(!is_array($rcfechas))
				$rcfechas = array();
		}
		else
			$rcfechas = array();
		WebSession :: setProperty("rcfechas", $rcfechas);
	}
	
	//Se recibe la fecha desde la interfaz y se guarda o se saca del vector
	if ($fecha)
	{
		if (is_array($rcfechas) && is_array($rcfechas[$sbSchema]))
		{
			if(in_array($fecha,$rcfechas[$sbSchema]))
			{
				//Se saca del vector
				$rcfechas[$sbSchema] = fncrmfecha($rcfechas[$sbSchema], $fecha);
				WebSession :: setProperty("rcfechas",$rcfechas);
			}
			else
			{ 
				// Se adiciona al vector
				$rcfechas[$sbSchema][] = $fecha;
				WebSession :: setProperty("rcfechas", $rcfechas);
			}
		}
		else
		{ 
			// Se adiciona al vector
			$rcfechas[$sbSchema][] = $fecha;
			WebSession :: setProperty("rcfechas", $rcfechas);
		}
	}

	global $sec, $mi, $hour, $day, $nday, $day_week, $day_week_ext, $month,$nmonth, $month_ext, $year, $nyear, $month_year, $days_week;
	
	// array con los meses del año
	$month_year = array (1 => $rclabels["enero"]["label"], 2 => $rclabels["febrero"]["label"], 3 => $rclabels["marzo"]["label"], 4 => $rclabels["abril"]["label"], 5 => $rclabels["mayo"]["label"], 6 => $rclabels["junio"]["label"], 7 => $rclabels["julio"]["label"], 8 => $rclabels["agosto"]["label"], 9 => $rclabels["septiembre"]["label"], 10 => $rclabels["octubre"]["label"], 11 => $rclabels["noviembre"]["label"], 12 => $rclabels["diciembre"]["label"]);
	
	// array con los dias de la semana
	$days_week = array (0 => $rclabels["domingo"]["label"], 1 => $rclabels["lunes"]["label"], 2 => $rclabels["martes"]["label"], 3 => $rclabels["miercoles"]["label"], 4 => $rclabels["jueves"]["label"], 5 => $rclabels["viernes"]["label"], 6 => $rclabels["sabado"]["label"]);

	//Cadena para hoy
	$today_str = "&nbsp; ";

	// array con la fecha actual
	$arr_day = $objDate->_getDate();
	
	// definicion de variables
	$sec = $arr_day["minutes"];
	$mi = $arr_day["seconds"];
	$hour = $arr_day["hours"];
	$day = $arr_day["mday"];
	$day_week = $arr_day["wday"];
	$day_week_ext = $days_week[$arr_day["wday"]];
	$month = $arr_day["mon"];
	$month_ext = $month_year[$month];
	$year = $arr_day["year"];

	//Muestra el calendario con las fechas, si tiene
	$calendar = new calendar($rcfechas[$sbSchema],$objDate);
	$calendar->show();
}

//Saca un elemento de un vector
function fncrmfecha($rcfechas, $dia) 
{
	if (!is_array($rcfechas))
		return false;
	$nureg = sizeof($rcfechas) - 1;
	foreach ($rcfechas as $key => $fecha) 
	{
		if ($fecha == $dia) 
		{
			for ($cont = $key; $cont < $nureg; $cont ++)
				$rcfechas[$cont] = $rcfechas[$cont +1];
			break;
		}
	}
	array_pop($rcfechas);
	return $rcfechas;
}

// Clase de control del calendario
class calendar {

	var $content; // Contenido HTML formateado
	var $page; // Página para link
	var $month_name; // Nome do mes
	var $day_today_color = "FF9999"; // Color de fondo dias selecionados 
	var $intdate;

	var $date_service;
	function calendar($rcfechas,$objDate) {
		$this->objDate = $objDate;
		$this->fechas = $rcfechas;
		$this->page = $GLOBALS["PHP_SELF"];
		$GLOBALS["nyear"] = $_REQUEST["nyear"];
		if (isset ($GLOBALS["nyear"]))
			$GLOBALS["year"] = $GLOBALS["nyear"];
		else
			$GLOBALS["nyear"] = $GLOBALS["year"];
		$GLOBALS["nmonth"] = $_REQUEST["nmonth"];
		if (isset ($GLOBALS["nmonth"]))
			$GLOBALS["month"] = $GLOBALS["nmonth"];
		else
			$GLOBALS["nmonth"] = $GLOBALS["month"];
			
		$GLOBALS["nday"] = $_REQUEST["nday"];
		if (isset ($GLOBALS["nday"]))
			$GLOBALS["day"] = $GLOBALS["nday"];
		else
			$GLOBALS["nday"] = $GLOBALS["day"];

		if ($GLOBALS["nmonth"] == 0) {
			$GLOBALS["nyear"]--;
			$GLOBALS["nmonth"] = 12;
		}
		elseif ($GLOBALS["nmonth"] == 13) {
			$GLOBALS["nyear"]++;
			$GLOBALS["nmonth"] = 1;
		}
		$this->month_name = $GLOBALS["month_year"];
		$this->month_name = $this->month_name[$GLOBALS["nmonth"]];
		//convierte la fecha a timestamp
		if ($GLOBALS["flag"]) {
			$this->intdate = $this->objDate->_mktime(0, 0, 0, $GLOBALS["nmonth"], $GLOBALS["nday"], $GLOBALS["nyear"]);
		}
	}
	/**Muestra el calendario*/
	function show($year = 1, $month = 1, $today = 1) {
		global $today_str, $days_week;
		
		$this->content = "<table width='70%' align='center'>";
		if ($year == 1) {
			$this->content .= "<tr align='center'>
												                           <td width='20' height='14' class='piedefoto'><b><a href='".$this->page."?action=FeGeCmdDefaultDiasInhabiles&nmonth=".$GLOBALS["nmonth"]."&nyear=". ($GLOBALS["nyear"] - 1)."&nday=".$GLOBALS["nday"]."' >&#139;&#139;</a></b></td>
												                           <td colspan='5' height='14' class='titulofila'><b>".$GLOBALS["nyear"]."</b></td>
												                           <td width='20' height='14' class='piedefoto'><b><a href='".$this->page."?action=FeGeCmdDefaultDiasInhabiles&nmonth=".$GLOBALS["nmonth"]."&nyear=". ($GLOBALS["nyear"] + 1)."&nday=".$GLOBALS["nday"]."' >&#155;&#155;</a></b></td>
												                           </tr>";
		}
		if ($month == 1) {
			$this->content .= "<tr align='center'>
												                           <td width='20' height='18' class='piedefoto'><b><a href='".$this->page."?action=FeGeCmdDefaultDiasInhabiles&nmonth=". ($GLOBALS["nmonth"] - 1)."&nyear=".$GLOBALS["nyear"]."&nday=".$GLOBALS["nday"]."' >&#139;</a></b></td>
												                           <td colspan='5'  height='18' class='piedefoto'><b>".$this->month_name."</b></td>
												                           <td width='20' height='18' class='piedefoto'><b><a href='".$this->page."?action=FeGeCmdDefaultDiasInhabiles&nmonth=". ($GLOBALS["nmonth"] + 1)."&nyear=".$GLOBALS["nyear"]."&nday=".$GLOBALS["nday"]."' >&#155;</a></b></td>
												                           </tr>
																		   <tr align='center'>
												                           <td width='20' height='1' class='piedefoto'></td>
												                           <td colspan='5' height='1' class='piedefoto'></td>
												                           <td width='20' height='1' class='piedefoto'></td>
												                           </tr>";
		}

		$this->content .= "<tr align='center'>";
		for ($l = 0; $l <= 6; $l ++) {
			$this->content .= "<td width='20' height='14'><b>".$days_week[$l][0]."</b></td>";
		}
		$this->content .= "</tr>";

		$cont_day = 1;
		$event_number = 0;
		for ($l = 1; $l <= 6; $l ++) {
			$this->content .= "<tr>";
			for ($c = 0; $c <= 6; $c ++) {
				$xday = $this->objDate->_date("w", $this->objDate->_mktime(0, 0, 0, $GLOBALS["nmonth"], $cont_day, $GLOBALS["nyear"]));
				//Arma la fecha en entero
				$fecinteger = $this->objDate->_mktime(0, 0, 0, $GLOBALS["nmonth"], $cont_day, $GLOBALS["nyear"]);
				if (is_array($this->fechas)) {
					if (!in_array($fecinteger, $this->fechas))
						$bg = ""; //$this->day_color;
					else
						$bg = "style=\"background-color: #".$this->day_today_color.";\"";
				}
				if (checkdate($GLOBALS["nmonth"], $cont_day, $GLOBALS["nyear"]) & $xday == $c) {
					$this->content .= "<td align='center' width='20' $bg><a href='".$this->page."?action=FeGeCmdDefaultDiasInhabiles&nmonth=".$GLOBALS["nmonth"]."&nyear=".$GLOBALS["nyear"]."&nday=".$cont_day."&flag=1&fecha=$fecinteger' >".$cont_day."</a></td>\n";
					$cont_day ++;
				} else {
					$this->content .= "<td align='center' width='20'>&nbsp;</td>";
				}
			}
			$this->content .= "</tr>";
			if (!checkdate($GLOBALS["nmonth"], $cont_day, $GLOBALS["nyear"]))
				break;
		}
		$this->content .= "</table>";
		echo $this->content;
	}
}
?>