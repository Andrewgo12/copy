<?php 
/*
* Smarty plugin
* -------------------------------------------------------------
* Type:     function
* Name:     viewSchedule_day
* Version:  1.0
* Date:     Apr 04, 2007
* Author:	 Muñe <mrestrepo@parquesoft.com>
* Purpose:  vista diaria del schedule del funcionario logueado (auth -> personal)
* Input:		non ha nessuna intrata
*
* Examples: {viewSchedule_day}
* -------------------------------------------------------------
*/

function smarty_function_viewSchedule_day_avail($params, & $smarty)
{
	//extraer parámetros y datos de entorno
	extract($params);
	extract($_REQUEST);

	settype($html_result,"string");
	
	//extraer datos del usuario de la sesión y cargar el multilanguish
	$rcUser = Application::getUserParam();
    if (!is_array($rcUser)) 
    {
    	//Si no existe usuario en sesion 
        $rcUser["lang"] = Application :: getSingleLang();
    }
	include($rcUser["lang"]."/".$rcUser["lang"].".schedule.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$blShowAvail = true;
		
	$objGeneral = Application::loadServices("General");
	$rcTipoDefensor = $objGeneral->getParam("human_resources", "type_DO",false);
	$rcTipoDespacho = $objGeneral->getParam("human_resources", "type_DDO");
	
	$sbTmp = "&".$field."=".$$field."&field=".$field;
	$rcInput = explode("___",$$field);
	
	//DATOS DEL PERSONAL
	$objService = Application :: loadServices("Human_resources");
	$rcPersonal = $objService->getDataEntesOrg($rcInput[0],true);
	$sbNombres = '<ol>';
	
	if(is_array($rcPersonal))
	{
		$sbNombres .= $rcPersonal["nombre"];
	}
	$sbNombres .= '</ol>';
	if(is_array($rcOrgacodigos))
		$sbUser = $rcOrgacodigos;
	else
		$sbUser = $rcInput;
	
	//Clase manejo fechas
	$objDate = Application::loadServices("DateController");
	$objEntrada = Application::getDomainController("ScheduleManager");

	//cargamos los tipos de sesion o categorías
	$rcCategories = loadCategories();

	//De aquí en adelante pongo la vista diaria que tenía la agenda original
	//sólo para efectos del plugin, el desorden no es mío
	if($date)
		$rcToday = $objDate->_getDate($date);
	else
		$rcToday = $objDate->_getDate();
	$thisday = $rcToday["mday"];
	$thismonth = $rcToday["mon"];
	$thisyear = $rcToday["year"];
	$wday = $objDate->_date ( "w", $objDate->_mktime ( 0, 0, 0, $thismonth, $thisday, $thisyear ) );
	$now = $objDate->_mktime ( 0, 0, 0, $thismonth, $thisday, $thisyear );
	$nowYmd = $objDate->_date ( "Ymd", $now );

	$next = $objDate->_mktime ( 0, 0, 0, $thismonth, $thisday + 1, $thisyear );
	$nextYmd = $objDate->_date ( "Ymd", $next );
	$nextyear = $objDate->_date ( "Y", $next );
	$nextmonth = $objDate->_date ( "m", $next );
	$nextday = $objDate->_date ( "d", $next );

	$prev = $objDate->_mktime ( 0, 0, 0, $thismonth, $thisday - 1, $thisyear );
	$prevYmd = $objDate->_date ( "Ymd", $prev );
	$prevyear = $objDate->_date ( "Y", $prev );
	$prevmonth = $objDate->_date ( "m", $prev );
	$prevday = $objDate->_date ( "d", $prev );

	//days are shown bold into the year?
	$boldDays = true;

	$startdate = sprintf ( "%04d%02d01", $thisyear, $thismonth );
	$enddate = sprintf ( "%04d%02d31", $thisyear, $thismonth );

	$sbPath = '';
	if(true)
	{
		$sbPath .= $sbTmp;
		$sbPathArr .= $sbTmp;
	}

	$INC = array('js/popups.php');

	/* Pre-load the non-repeating events for quicker access */
	$events = $objEntrada->getDetallesEventosDependencia($sbUser,$now,$next,$sbIdCategory,$sbUserName);
	
	$sbUrlDayViewArr = "index.php?action=".Application::getConstant("DV_URL_AV").$sbPathArr;
	
	$html_result .= '
	<table width="70%" align="center">
	<tr><td style="vertical-align:top; width:82%;">
	<div style="border-width:0px;">
	<a class="next" href="'.$sbUrlDayViewArr.'&date='.$next.'"><img src="web/images/rightarrow.gif" title="'.$rclabels["next"]["label"].'" ></a>
	<a class="prev" href="'.$sbUrlDayViewArr.'&date='.$prev.'"><img src="web/images/leftarrow.gif" title="'.$rclabels["prev"]["label"].'" ></a>
	<div class="title">
	<span class="date">
	   '.$sbNombres.'
	   <br> 
	   '. date_to_str ( $nowYmd ).'
	</span>';

	$html_result .= "<br >\n<br >\n";
	$html_result .= showCategories($rcCategories, $sbUrlDayViewArr,$sbIdCategory,$rclabels,$now );

	$html_result .= '
	</div>
	</div>
	</td>
	<td style="vertical-align:top;" rowspan="2">
	<!-- START MINICAL -->
	<div class="minicalcontainer">
	'.display_small_month ( $thismonth, $thisyear,$thisday, true,$rclabels,$sbUrlDayViewArr ,$sbUser,$sbIdCategory).'
	</div>
	</td></tr><tr><td>
	<table border=1 width="100%" cellspacing="0" cellpadding="0">';

	if ( empty ( $TIME_SLOTS ) )
	define($TIME_SLOTS,12);
	$nuToday = $objDate->fncintdate();

	$html_result .= print_day_at_a_glance ( $now,$nuToday,$rclabels,$rcMsg,$sbIdCategory,$events,$objDate->nuSecsHour,$close,$blShow,$rcpersonas);
	
	$html_result .= '
	</table>
	</td>
	</tr></table>
	<br >
	<br >
	</body>
	</html>';

	//Finalmente se cierra el plugin regresando el html armado al cliente
	return $html_result;
}

function showCategories($rcCategories, $sbUrl, $sbIdCategory = '' ,$rclabels,$date)
{
	settype($sbResult,"string");

	$sbResult .= "<form action=\"$sbUrl\" method=\"post\" name=\"selectCategory\" class=\"categories\">\n";
	$sbResult .= "<input type=hidden name=date value='".$date."'>\n";
	$sbResult .=  $rclabels["catecodigon"]["label"].": <select name=\"sbIdCategory\" onchange=\"this.form.submit()\">\n";
	$sbResult .= "<option value=\"\"";
	if ( $sbIdCategory == '' )
		$sbResult .= " selected";
	$sbResult .= ">" . $rclabels["allcateg"]["label"] . "</option>\n";
	if (  is_array ( $rcCategories ) )
	{
		foreach ( $rcCategories as $nuCont=>$rcRow ){
			$sbResult .= "<option value='".$rcRow["catecodigon"]."'";
			if ( $sbIdCategory == $rcRow["catecodigon"] )
			$sbResult .= " selected";
			$sbResult .= ">".$rcRow["catenombres"]."</option>\n";
		}
	}
	$sbResult .= "</select>\n";
	$sbResult .= "</form>\n";
	return $sbResult;
}

function loadCategories()
{
	//Cargo y retorno las categorías o tipos de sesion
	$objData = Application::getDataGateway("categoria");
	$rcCategories = $objData->getAllCategoria();
	return $rcCategories;
}

function date_to_str ( $indate, $format="", $show_weekday=true, $short_months=false, $server_time="" ) {
	global $DATE_FORMAT, $TZ_OFFSET;
	
	settype($objDate, "object");
    $objDate = Application :: loadServices("DateController");

	if ( strlen ( $indate ) == 0 ) {
		$indate = $objDate->_date ( "Ymd" );
	}

	$newdate = $indate;
	if ( $server_time != "" && $server_time >= 0 ) {
		$y = substr ( $indate, 0, 4 );
		$m = substr ( $indate, 4, 2 );
		$d = substr ( $indate, 6, 2 );
		if ( $server_time + $TZ_OFFSET * 10000 > 240000 ) {
			$newdate = $objDate->_date ( "Ymd", $objDate->_mktime ( 0, 0, 0, $m, $d + 1, $y ) );
		} else if ( $server_time + $TZ_OFFSET * 10000 < 0 ) {
			$newdate = $objDate->_date ( "Ymd", $objDate->_mktime ( 0, 0, 0, $m, $d - 1, $y ) );
		}
	}

	// if they have not set a preference yet...
	if ( $DATE_FORMAT == "" )
	$DATE_FORMAT = "__month__ __dd__, __yyyy__";

	if ( empty ( $format ) )
	$format = $DATE_FORMAT;

	$y = (int) ( $newdate / 10000 );
	$m = (int) ( $newdate / 100 ) % 100;
	$d = $newdate % 100;
	$date = $objDate->_mktime ( 0, 0, 0, $m, $d, $y );
	$wday = $objDate->_date ( "w", $date );

	if ( $short_months ) {
		$weekday = weekday_short_name ( $wday );
		$month = month_short_name ( $m - 1 );
	} else {
		$weekday = weekday_name ( $wday );
		$month = month_name ( $m - 1 );
	}
	$yyyy = $y;
	$yy = sprintf ( "%02d", $y %= 100 );

	$ret = $format;
	$ret = str_replace ( "__yyyy__", $yyyy, $ret );
	$ret = str_replace ( "__yy__", $yy, $ret );
	$ret = str_replace ( "__month__", $month, $ret );
	$ret = str_replace ( "__mon__", $month, $ret );
	$ret = str_replace ( "__dd__", $d, $ret );
	$ret = str_replace ( "__mm__", $m, $ret );

	if ( $show_weekday )
		return "$weekday, $ret";
	else
		return $ret;
}

function weekday_name ( $w ) 
{
	$rcUser = Application::getUserParam();
	include_once($rcUser["lang"]."/".$rcUser["lang"].".calendar.php");
	switch ( $w ) {
		case 0: return ($rcDaysofWeek["Sunday"]);
		case 1: return ($rcDaysofWeek["Monday"]);
		case 2: return ($rcDaysofWeek["Tuesday"]);
		case 3: return ($rcDaysofWeek["Wednesday"]);
		case 4: return ($rcDaysofWeek["Thursday"]);
		case 5: return ($rcDaysofWeek["Friday"]);
		case 6: return ($rcDaysofWeek["Saturday"]);
	}
	return "unknown-weekday($w)";
}

function month_name ( $m ) 
{
	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".calendar.php");
	
	switch ( $m ) {
		case 0: return ($rcMonths["January"]);
		case 1: return ($rcMonths["February"]);
		case 2: return ($rcMonths["March"]);
		case 3: return ($rcMonths["April"]);
		case 4: return ($rcMonths["May_"]);
		case 5: return ($rcMonths["June"]);
		case 6: return ($rcMonths["July"]);
		case 7: return ($rcMonths["August"]);
		case 8: return ($rcMonths["September"]);
		case 9: return ($rcMonths["October"]);
		case 10: return ($rcMonths["November"]);
		case 11: return ($rcMonths["December"]);
	}
	return "unknown-month($m)";
}

function display_small_month ( $thismonth, $thisyear,$thisday, $showyear,$rclabels,$sbUrlDayView,$user,$sbIdCategory)
{
	settype($sbHtml,"string");
	settype($objDate, "object");
    $objDate = Application :: loadServices("DateController");
	$boldDays = true;

	//start the minical table for each month
	$sbHtml .= "\n<table class=\"minical\"";
	if ( $minical_id != '' ) {
		$sbHtml .= " id=\"$minical_id\"";
	}
	$sbHtml .= ">\n";

	$monthprev = $objDate->_mktime(0,0,0,$thismonth-1,1,$thisyear);
	$monthstart = $objDate->_mktime(0,0,0,$thismonth,1,$thisyear);
	$monthend = $objDate->_mktime(0,0,0,$thismonth+1,1,$thisyear);

	$objEntrada = Application::getDomainController("ScheduleManager");
	$rcEventos = $objEntrada->getBusyDaysByDep($user,$monthstart,$monthend,$sbIdCategory);

	$sbHtml .= "<thead>\n";
	$sbHtml .= "<tr class=\"monthnav\"><th colspan=\"7\">\n";
	$sbHtml .= "<a class=\"prev\" href=\"".$sbUrlDayView."&date=$monthprev\"><img src=\"web/images/leftarrowsmall.gif\" title=\"".$rclabels["prev"]["label"]."\"></a>\n";
	$sbHtml .= "<a class=\"next\" href=\"".$sbUrlDayView."&date=$monthend\"><img src=\"web/images/rightarrowsmall.gif\" title=\"".$rclabels["next"]["label"]."\"></a>\n";
	$sbHtml .= month_name ( $thismonth - 1 );
	if ( $showyear != '' ) {
		$sbHtml .= " $thisyear";
	}
	$sbHtml .= "</th></tr>\n<tr>\n";

	//determine if the week starts on sunday or monday
	$wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );

	// if we're showing week numbers we need an extra column
	if ( $WEEK_START == 0 )
	$sbHtml .= "<th>".weekday_short_name ( 0 ) . "</th>\n";

	//cycle through each day of the week until gone
	for ( $i = 1; $i < 7; $i++ )
	$sbHtml .= "<th>" .  weekday_short_name ( $i ) .  "</th>\n";

	//end the header row
	$sbHtml .= "</tr>\n</thead>\n<tbody>\n";
	for ($i = $wkstart; $objDate->_date("Ymd",$i) <= $objDate->_date ("Ymd",$monthend);$i += (24 * 3600 * 7) )
	{
		$sbHtml .= "<tr>\n";
		for ($j = 0; $j < 7; $j++) {
			$date = $i + ($j * 24 * 3600);
			$dateYmd = $objDate->_date ( "Ymd", $date );
			$hasEvents = false;
			if ( $boldDays )
			if ( count ( $rcEventos[$date] ) > 0 )
			$hasEvents = true;
			if ( $dateYmd >= $objDate->_date ("Ymd",$monthstart) &&
			$dateYmd <= $objDate->_date ("Ymd",$monthend) ) {
				$sbHtml .= "<td";
				$wday = $objDate->_date ( 'w', $date );
				$class = '';
				//add class="weekend" if it's saturday or sunday
				if ( $wday == 0 || $wday == 6 ) {
					$class = "weekend";
				}
				//if the day being viewed is today's date AND script = day.php
				if ( $dateYmd == $thisyear . $thismonth . $thisday) {
					//if it's also a weekend, add a space between class names to combine styles
					if ( $class != '' ) {
						$class .= ' ';
					}
					$class .= "selectedday";
				}
				if ( $hasEvents ) {
					if ( $class != '' ) {
						$class .= ' ';
					}
					$class .= "hasevents";
				}
				if ( $class != '' ) {
					$sbHtml .= " class=\"$class\"";
				}
				if ( $objDate->_date ( "Ymd", $date  ) == $objDate->_date ( "Ymd", $today ) ){
					$sbHtml .= " id=\"today\"";
				}
				$sbHtml .= "><a href=\"" .$sbUrlDayView  . "&date=" .  $date .
				"\">";
				$sbHtml .= $objDate->_date ( "d", $date ) . "</a></td>\n";
			} else {
				$sbHtml .= "<td class=\"empty\">&nbsp;</td>\n";
			}
		}                 // end for $j
		$sbHtml .= "</tr>\n";
	}                         // end for $i
	$sbHtml .= "</tbody>\n</table>\n";
	return $sbHtml;
}

function get_sunday_before ( $year, $month, $day ) {
	settype($objDate, "object");
    $objDate = Application :: loadServices("DateController");
	$weekday = $objDate->_date ( "w", $objDate->_mktime ( 0, 0, 0, $month, $day, $year ) );
	$newdate = $objDate->_mktime ( 0, 0, 0, $month, $day - $weekday, $year );
	return $newdate;
}

function weekday_short_name ( $w ) 
{
	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".calendar.php");
	
	switch ( $w ) {
		case 0: return ($rcShortWeekday["Sun"]);
		case 1: return ($rcShortWeekday["Mon"]);
		case 2: return ($rcShortWeekday["Tue"]);
		case 3: return ($rcShortWeekday["Wed"]);
		case 4: return ($rcShortWeekday["Thu"]);
		case 5: return ($rcShortWeekday["Fri"]);
		case 6: return ($rcShortWeekday["Sat"]);
	}
	return "unknown-weekday($w)";
}

function print_day_at_a_glance ( $date,$nuToday,$rclabels,$rcMessages,$sbIdCategory,$rcEventos,$nuSecsHour,$close,$blShow,$rcpersonas)
{
	settype($sbHtml,"string");
	settype($rcBusy,"array");
	settype($rcIntervals,"array");
	
	$sbActive = Application::getConstant("REG_ACT");
	$rcUser = Application::getUserParam();
	if(is_array($rcUser))
		$sbUsername = $rcUser["username"];
	
	$TIME_SLOTS = 24;
	$interval = ( 24 * 60 ) / $TIME_SLOTS;
	
	$WORK_DAY_START_HOUR = 8;
	$WORK_DAY_END_HOUR = 18;

	$hour_arr = array ();
	$interval = ( 24 * 60 ) / $TIME_SLOTS;
	$first_slot = (int) ( ( ( $WORK_DAY_START_HOUR ) * 60 ) / $interval );
	$last_slot = (int) ( ( ( $WORK_DAY_END_HOUR ) * 60 ) / $interval);
	$nuSizeEv = count ( $rcEventos );
	
	//calculemos el arreglo de rowspans
	for ( $i = $first_slot; $i <= $last_slot; $i++ )
	{
		if(!$blBusyDay)
			$blBusyDay = array_key_exists((($i*$nuSecsHour)+$date),$rcEventos);
		$nuInterval = ($i*$nuSecsHour)+$date;
		if(array_key_exists($nuInterval,$rcEventos))
			foreach ($rcEventos[$nuInterval] as $nuCont=>$rcRow)
			{
				$rcIntervals[$nuInterval]["rowspan"] = 1;//($rcRow["entrduracion"]-$rcRow["entrfechorun"])/$nuSecsHour;
				for($nuAux=0;$nuAux<(($rcRow["entrduracion"]-$rcRow["entrfechorun"])/$nuSecsHour);$nuAux++)
				{
					$rcBusy[$i+$nuAux] = 1;
				}
				if($rcRow["entractivas"] == $sbActive)
				{
					if($date>=$nuToday)
						$rcIntervals[$nuInterval]["class"] = "activas";
					else
						$rcIntervals[$nuInterval]["class"] = "pasada";
				}
				else
					$rcIntervals[$nuInterval]["class"] = "inactivas";
			}
	}
	
	$sbHtml .= "<tr valign='center'>";
	$sbHtml .= "<td width='10%' class='titulofila' align='center'>".$rclabels["hora"]["label"]."</td>";
	$sbHtml .= "<td width='45%' align='center' class='titulofila'>".$rclabels["even"]["label"]."</td>";
	$sbHtml .= "</Tr>";
	
	reset($rcEventos);
	for ( $i = $first_slot; $i <= $last_slot; $i++ ) 
	{
		$time_h = (int) ( ( $i * $interval ) / 60 );
		$time_m = ( $i * $interval ) % 60;
		$time = display_time ( ( $time_h * 100 + $time_m ) * 100 );
		
		$nuInterval = ($i*$nuSecsHour)+$date;
		if(array_key_exists($nuInterval,$rcEventos))
		{
			$sbHtml .= "<tr valign='center'><td>".$time."</td>";
			$sbHtml .= "<td class='".$rcIntervals[$nuInterval]["class"]."' rowspan='".$rcIntervals[$nuInterval]["rowspan"]."'>";
			$sbHtml .= "<ol>";
			
			//DETALLES DEL EVENTO POR CADA HORA
			foreach ($rcEventos[$nuInterval] as $nuCont=>$rcRow)
			{
				$sbHtml .= "<li>";
				if($rcRow["entractivas"] == $sbActive)
				{
					if($date>=$nuToday)
						$sbHtml .= "<B>";
					else
						$sbHtml .=  "<font color='#FFFFFF'><B>";
				}
				$sbHour = "";
				
				//PONGAMOS EN EL ALT DE ESTE REGISTRO LA INFO DEL EVENTO Y DE CROSS
				$sbHtml .= "<a href='javascript:loadFichaEvento(".$rcRow["entrcodigon"].");' style='text-decoration:none'>";
				
				if(is_array($rcpersonas))
				{
					if(array_key_exists($rcRow["perscodigos"],$rcpersonas))
						$sbHtml .= $sbCateg." - ".strtoupper($rcRow["entrdescris"])." - ".$rcpersonas[$rcRow["perscodigos"]]."</a></b>";
				}
				else
					$sbHtml .= $sbCateg." - ".strtoupper($rcRow["entrdescris"])." - ".$rcpersonas[$rcRow["orgacodigos"]]."</a></b>";
				if($date<$nuToday)
					$sbHtml .= "</font>";
				$sbHtml .= "</li>";
			}
			$sbHtml .= "</ol>";
			$sbHtml .= "</td>";
			reset($rcEventos);
			
			$sbHtml .=  "</tr>\n";
		}
		else
		{
			$sbHtml .= "<tr align='center' valign='center'><td>".$time ."</td>\n";
			
			if(!array_key_exists($i,$rcBusy))
			{
				$sbHtml .=  "<td class='vacia'>";
				$sbHtml .= "&nbsp;";
				$sbHtml .= "</td>";
			}
			else
			{
				if ($date>=$nuToday)
				{
					if($rcRow["entractivas"] == $sbActive)
						$sbHtml .=  "<td class='ocupada'>";
					else
						$sbHtml .=  "<td class='inactivas'>";
				}
				else
				{
					if($rcRow["entractivas"] == $sbActive)
						$sbHtml .=  "<td class='pasada'>";
					else
						$sbHtml .=  "<td class='inactivas'>";
				}
				$sbHtml .= "&nbsp;";
				$sbHtml .= "</td>";
			}
			$sbHtml .=  "</tr>\n";
		}
	}
	return $sbHtml;
}

function display_time ( $time, $ignore_offset=0 ) 
{
	global $TZ_OFFSET;
	$hour = (int) ( $time / 10000 );
	if ( ! $ignore_offset )
	$hour += $TZ_OFFSET;
	$min = abs( ( $time / 100 ) % 100 );
	
	//Prevent goofy times like 8:00 9:30 9:00 10:30 10:00
	if ( $time < 0 && $min > 0 ) $hour = $hour - 1;
	while ( $hour < 0 )
	$hour += 24;
	while ( $hour > 23 )
	$hour -= 24;
	if ( $GLOBALS["TIME_FORMAT"] == "12" ) {
		$ampm = ( $hour >= 12 ) ? ("pm") : ("am");
		$hour %= 12;
		if ( $hour == 0 )
		$hour = 12;
		$ret = sprintf ( "%d:%02d%s", $hour, $min, $ampm );
	} else {
		$ret = sprintf ( "%d:%02d", $hour, $min );
	}
	return $ret;
}
?>