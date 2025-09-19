<?php 
/*
 * Smarty plugin
 * Type:     function
 * Name:     calendar
 * Version:  1.0
 * Date:     Oct 17, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:  display calendar en other windows.
 * Input:
 *           name = name of the calendar (required)
 *           form_name = name of the form that content calendar (required)
 *           size = wide of textfield (optional)
 *           icon = file (and path) of image (optional)
 *			 id=object id
 *			  format=date- datehour(optional)
 *
 * Examples:  {form name="Frm-fecha" method="post"}
 *                 {calendar name="MyCalendar" form_name ="Frm-fecha" icon="web/images/aplicacion/botoncalendar.gif" }
 *            {/form}
 *
 *
 * Contraint: calendar needs to be within a form
 *            calendar needs library PopupWindow.js,CalendarPopup.js,date.js,AnchorPosition.js
 */

function smarty_function_calendar($params, & $smarty) {
	
	settype($serviceDate,"object");
	settype($sbfecha,"string");
	settype($sbhtml_result,"string");
	settype($sbformato,"string");
	settype($sbformat,"string");
	settype($nufecha,"integer");
	extract($params);
	
	//Carga el servicio de control de fechas 
	$serviceDate = Application :: loadServices("DateController");

	//Deatermina si la fecha es con horas o no
	switch($format){
		case "date":
				$nufecha = $serviceDate->fncintdate();
				$sbformato = $serviceDate->sbformat_date_single;
				$maxlength = 10;
			break;
		default:
			$nufecha = $serviceDate->fncintdatehour();
			$sbformato = $serviceDate->sbformat_date_time;
			$maxlength = 19;
	}
	$sbfecha = $serviceDate->fncformatofechahora($nufecha);
	
	//se realiza un case para determinar el formato en el cual se pintan la salida del calendario
	switch ($sbformato) {
			case "y-m-d_h-m-s" :
				$sbformato="yyyy".$serviceDate->dateSeparator."MM".$serviceDate->dateSeparator."dd".$serviceDate->typeSeparator."HH".$serviceDate->timeSeparator."mm".$serviceDate->timeSeparator."ss";
				break;
				case "y-m-d" :
				$sbformato="yyyy".$serviceDate->dateSeparator."MM".$serviceDate->dateSeparator."dd".$serviceDate->typeSeparator."HH".$serviceDate->timeSeparator."mm".$serviceDate->timeSeparator."ss";
				break;
				case "m-d-y" :
				$sbformato="MM".$serviceDate->dateSeparator."dd".$serviceDate->dateSeparator."yyyy".$serviceDate->typeSeparator."HH".$serviceDate->timeSeparator."mm".$serviceDate->timeSeparator."ss";
				break;
		}
	
	if (!isset ($size)) {
		$size = 17;
	}

	if (isset ($icon)) {
		$icon = "src='".$icon."'";
	}
	
	if(isset($id)){
		$sbid=" id=\".$id.\" ";
	}

	$sbhtml_result = "<input type=text name='".$name."' size=".$size." ".$sbid."  maxlength=\"$maxlength\"";

	if ($_REQUEST[$name] != "") {
		$sbhtml_result .= "value='".$_REQUEST[$name]."'";
	} else {
		$sbhtml_result .= "value='".$sbfecha."'";
	}
	$sbhtml_result .= ">";
	$sbhtml_result .= "<a href=\"#\" onclick=\"javascript:calendar = new CalendarPopup();calendar.showYearNavigation();calendar.select(document.".$form_name.".".$name.",'anchor2','".$sbformato."'); return false;\" name=\"anchor2\" id=\"anchor2\"><img ".$icon."  border=\"0\" align=\"middle\"></a>";
	print $sbhtml_result;
}
?>