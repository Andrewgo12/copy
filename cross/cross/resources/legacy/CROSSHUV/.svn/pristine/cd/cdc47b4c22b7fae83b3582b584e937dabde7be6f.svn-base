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

function smarty_function_viewSchedule_day($params, & $smarty)
{
	//extraer parámetros y datos de entorno
	extract($params);
	extract($_REQUEST);
	
	settype($html_result,"string");
	
	//extraer datos del usuario de la sesión y cargar el multilanguish
	$rcUser = Application::getUserParam();
	if (!is_array($rcUser)){
		$rcUser["lang"] = Application :: getSingleLang();
	}
    	
	include($rcUser["lang"]."/".$rcUser["lang"].".schedule.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	/*if(strlen($orgacodigos))
		$blShowAvail = true;
	else
		$blShowAvail = false;*/
		
	//DATOS DEL PERSONAL
	$objService = Application :: loadServices("Human_resources");
	$rcPersonal = $objService->getPersonal($perscodigos,false);
	$rcPersonal = $rcPersonal[0];
	$perscodigos = $rcPersonal["perscodigos"];
	$sbUserName = $rcPersonal["persusrnams"];
	$orgacodigos = $objService->getOrgacodigosByPersonal($perscodigos);
	$objService->close();
	
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
	if(strlen($orgacodigos))
	{
		$sbPath .= "&orgacodigos=".$orgacodigos;
		$sbPathArr .= "&orgacodigos=".$orgacodigos;
	}
	if(strlen($perscodigos))
	{
		$sbPath .= "&perscodigos=".$perscodigos;
		$sbPathArr .= "&perscodigos=".$perscodigos;
	}

	$INC = array('js/popups.php');

	/* Pre-load the non-repeating events for quicker access */
	$events = $objEntrada->getDetallesEventosUsuario($orgacodigos,$now,$next,$sbIdCategory,$sbUserName);
	
	$sbUrlEntry = "index.php?action=".Application::getConstant("NEW_URL").$sbPath;
	$sbUrlDayView = "index.php?action=".Application::getConstant("DV_URL").$sbPath;
	$sbUrlDayViewArr = "index.php?action=".Application::getConstant("DV_URL").$sbPathArr;
	
	$html_result .= '
	<table width="100%" align="center" border="0">
	<tr>
	<td style="vertical-align:top; width:70%;">
	
	<table table width="100%" border="0" align="center">
	<tr>
	<td>
	<div style="border-width:0px;">
	<table width="100%" border="0">
	<tr>
	<td align="right">
	 <a class="prev" href="'.$sbUrlDayViewArr.'&date='.$prev.'&perscodigos='.$perscodigos.'"><img src="web/images/leftarrow.gif" title="'.$rclabels["prev"]["label"].'" ></a>
	 </td>
	 <td>
	 <div class="title">
	 <span class="date">
	   '.$rcPersonal["persnombres"].' '.$rcPersonal["persapell1s"].'
	   <br> 
	   '. date_to_str ( $nowYmd ).'
	 </span>';

	 $html_result .= "<br><br>";
	 $html_result .= showCategories($rcCategories, $sbUrlDayViewArr,$sbIdCategory,$rclabels,$now );

	 $html_result .= '
	 </td>
	 <td align="left">
	 <a class="next" href="'.$sbUrlDayViewArr.'&date='.$next.'&perscodigos='.$perscodigos.'"><img src="web/images/rightarrow.gif" title="'.$rclabels["next"]["label"].'" ></a>
	 </td>
	 </tr>
	 </table>
	 </div>
	 
	</div>
	</td>
	</tr>
	</table>
	</td>
	
	<td align="center">
	<!-- START MINICAL -->
	<div class="minicalcontainer">
	'.display_small_month ( $thismonth, $thisyear,$thisday, true,$rclabels,$sbUrlDayViewArr ,$orgacodigos,$sbIdCategory).'
	</div>
	</td>
	</tr>
	<tr>
	<td>
	<table border=1 width="100%" cellspacing="0" cellpadding="0">';

	if ( empty ( $TIME_SLOTS ) )
	define($TIME_SLOTS,12);
	$nuToday = $objDate->fncintdate();

	$html_result .= print_day_at_a_glance ( $now,$nuToday,$rclabels,$rcMsg,$sbIdCategory,$events,$objDate->nuSecsHour,$sbUrlEntry,$close,$rcRRFF,true,$perscodigos,$orgacodigos);
	
	$html_result .= '
	</table>
	</td>
	
	<td>
	<div name="citassp" id="citassp">
	'.showCitasSinProgramar($orgacodigos,$sbIdCategory,$rcCategories).'
	</div>
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

	//$sbResult .= "<form action=\"$sbUrl\" method=\"post\" name=\"selectCategory\" class=\"categories\">\n";
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
	//$sbResult .= "</form>\n";
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
	$rcEventos = $objEntrada->getBusyDaysByUser($user,$monthstart,$monthend,$sbIdCategory);

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

function print_day_at_a_glance ( $date,$nuToday,$rclabels,$rcMessages,$sbIdCategory,$rcEventos,$nuSecsHour ,$sbUrlEntry,$close,$rcRRFF,$blShow,$perscodigos,$orgacodigos)
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
	
	//COMANDOS
	$sbActiveCommand = str_replace("Default","Active",$sbUrlEntry);
	$sbCancelCommand = str_replace("Default","Cancel",$sbUrlEntry);
	$sbUpdateEntry = str_replace("Default","ShowById",$sbUrlEntry);
	$sbDeleteEntry = str_replace("Default","Delete",$sbUrlEntry);
	$sbAtemptComm = Application::getConstant("ATTEMP_URL");
	
	//calculemos el arreglo de rowspans
	for ( $i = $first_slot; $i <= $last_slot; $i++ )
	{
		if(!$blBusyDay)
			$blBusyDay = array_key_exists((($i*$nuSecsHour)+$date),$rcEventos);
		$nuInterval = ($i*$nuSecsHour)+$date;
		if(array_key_exists($nuInterval,$rcEventos))
			foreach ($rcEventos[$nuInterval] as $nuCont=>$rcRow)
			{
				$rcIntervals[$nuInterval]["rowspan"] = 1;//($rcRow["entrdurationn"]-$rcRow["entrfechorun"])/$nuSecsHour;
				for($nuAux=0;$nuAux<(($rcRow["entrdurationn"]-$rcRow["entrfechorun"])/$nuSecsHour);$nuAux++)
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
				if(array_key_exists("ordenumeros",$rcRow))
					if(strlen($rcRow["ordenumeros"]))
						$rcOrdenumeros[] = "'".$rcRow["ordenumeros"]."'";
			}
	}
	//Veamos si el tío que va a atender, realmente puede hacerlo
	if($blShow)
		if(is_array($rcOrdenumeros))
		{
			$rcOrdenumeros = array_unique($rcOrdenumeros);
			$blShow &= validarOrdenempresa($rcOrdenumeros,$orgacodigos);
		}
	
	$sbHtml .= "<tr valign='center'>";
	$sbHtml .= "<td width='10%' class='titulofila' align='center'>".$rclabels["hora"]["label"]."</td>";
	$sbHtml .= "<td width='45%' align='center' class='titulofila'>".$rclabels["even"]["label"]."</td>";
	if(!$close && ($blBusyDay || $date>=$nuToday))
		$sbHtml .= "<td width='45%' align='center' class='titulofila'>".$rclabels["panel"]["label"]."</td>";
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
				
				$sbHtml .= $sbCateg." - ".strtoupper($rcRow["entrdescris"])." ".$sbHour."</a></b>";
				if($date<$nuToday)
					$sbHtml .= "</font>";
				$sbHtml .= "</li>";
			}
			$sbHtml .= "</ol>";
			$sbHtml .= "</td>";
			if(!$close)
				$sbHtml .= "<td align='center' class='".$rcIntervals[$nuInterval]["class"]."panel' rowspan='".$rcIntervals[$nuInterval]["rowspan"]."'>";
			reset($rcEventos);
			foreach ($rcEventos[$nuInterval] as $nuCont=>$rcRow)
			{
				if($nuCont)
					$sbHtml .= "<br><br>";
				if($rcRow["entractivas"] == $sbActive)
				{
					if(!$close)
					{
						if($date>=$nuToday)
						{
							//AQUÍ VA EL PANEL DE ACCIONES 
							//CITAS ACTIVAS (NO SE HAN CUMPLIDO)
							//ATENDER
							if(array_key_exists("ordenumeros",$rcRow) && $blShow)
								if(strlen($rcRow["ordenumeros"])>1)
								{
									$sbHtml .= "<a href=\"".$sbAtemptComm."&acta=".$rcRow["actacodigos"]."&ordenumeros=".$rcRow["ordenumeros"]."&entrcodigon=".$rcRow["entrcodigon"];
									$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/referencia.gif\" border=0 title=\"".$rclabels["attempt"]["label"]."\" ></a>";
								}
							if($rcRow["entrusucreas"] == $sbUsername)
							{
								//CUMPLIMENTAR
								$sbHtml .= "<a href=\"".$sbActiveCommand."&date=".$date."&entrada__entrcodigon=".$rcRow["entrcodigon"];
								$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/probar.gif\" border=0 title=\"".$rclabels["confirm"]["label"]."\" ></a>";
								
								//CANCELAR
								$sbHtml .= "<a href=\"".$sbCancelCommand."&date=".$date."&entrada__entrcodigon=".$rcRow["entrcodigon"];
								$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/cancel.GIF\" border=0 title=\"".$rclabels["cancel"]["label"]."\" ></a>";
							
								//EDITAR
								$sbHtml .= "<a href=\"".$sbUpdateEntry."&date=".$date."&entrada__entrcodigon=".$rcRow["entrcodigon"];
								$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/editar.gif\" border=0 title=\"".$rclabels["edit"]["label"]."\" ></a>";
							
								//ELIMINAR
								$sbJs = "var result = confirm('{$rcMessages["delete"]}'); if(result == true){document.location='".$sbDeleteEntry."&date=".$date."&entrcodigon=".$rcRow["entrcodigon"]."';}";
								$sbHtml .= "<a href=# onclick=\"".$sbJs."\">";
								$sbHtml .= "<img src=web/images/borrar.gif border=0 title='".$rclabels["delete"]["label"]."'></a>";
							}
						}
						else
						{
							//ATENDER
							if(strlen($rcRow["ordenumeros"])>1 && $blShow)
							{
								$sbHtml .= "<a href=\"".$sbAtemptComm."&acta=".$rcRow["actacodigos"]."&ordenumeros=".$rcRow["ordenumeros"]."&entrcodigon=".$rcRow["entrcodigon"];
								$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/referencia.gif\" border=0 title=\"".$rclabels["attempt"]["label"]."\" ></a>";
							}
							if($rcRow["entrusucreas"] == $sbUsername)
							{
								//EDITAR
								$sbHtml .= "<a href=\"".$sbUpdateEntry."&date=".$date."&entrada__entrcodigon=".$rcRow["entrcodigon"];
								$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/editar.gif\" border=0 title=\"".$rclabels["edit"]["label"]."\" ></a>";
							}
							/*
							//ELIMINAR
							$sbJs = "var result = confirm('{$rcMessages["delete"]}'); if(result == true){document.location='".$sbDeleteEntry."&entrcodigon=".$rcRow["entrcodigon"]."';}";
							$sbHtml .= "<a href=# onclick=\"".$sbJs."\">";
							$sbHtml .= "<img src=web/images/borrar.gif border=0 title='".$rclabels["delete"]["label"]."'></a>";
							*/
						}
					}
				}
				else
				{
					if($date>=$nuToday || $blBusyDay)
					{
						//CITAS INACTIVAS(CANCELADAS)
						//EDITAR
						if($rcRow["entrusucreas"] == $sbUsername)
						{
							$sbHtml .= "<a href=\"".$sbUpdateEntry."&date=".$date."&entrada__entrcodigon=".$rcRow["entrcodigon"];
							$sbHtml .= "&perscodigos=$perscodigos\"><img src=\"web/images/editar.gif\" border=0 title=\"".$rclabels["edit"]["label"]."\" ></a>";
						}
						else
							$sbHtml .= "&nbsp";						
					}
				}
			} //FIN FOREACH
			$sbHtml .= "</td>";
			$sbHtml .=  "</tr>\n";
		}
		else
		{
			$sbHtml .= "<tr align='center' valign='center'><td>".$time ."</td>\n";
			
			//AQUÍ VA EL PANEL DE ACCIONES
			//ADICIONAR
			if(!array_key_exists($i,$rcBusy))
			{
				$sbHtml .=  "<td class='vacia'>";
				$sbHtml .= "&nbsp;";
				$sbHtml .= "</td>";
				
				if(!$close)
				{
					if ($date>=$nuToday)
					{
						$sbHtml .= "<td align='center' class='vaciapanel'>&nbsp;";
						$sbHtml .= "<a href=\"".$sbUrlEntry."&date=$date&perscodigos=$perscodigos" . ( isset ( $time_h ) && $time_h != NULL && $time_h >= 0 ? "&amp;hour=$time_h" : ""  ) .
						( $minute > 0 ? "&amp;minute=$time_m" : "" );
						$sbHtml .= "&catecodigon=".$sbIdCategory;
						$sbHtml .= "\"><img src=\"web/images/positivo_002.gif\" border=0 title=\"".$rclabels["new"]["label"]."\"></a>";
						$sbHtml .= "</td>";
					}
					else if($blBusyDay)
					{
						$sbHtml .= "<td class='vacia'>&nbsp;";
						$sbHtml .= "</td>";
					}
				}
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
				
				if(!$close)
				{
					if($rcRow["entractivas"] == $sbActive)
						$sbHtml .=  "<td class='ocupada'>&nbsp;";
					else
						$sbHtml .=  "<td class='inactivas'>&nbsp;";
					$sbHtml .= "</td>";
				}
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

function getTooltip($rcRow,$rcRRFF,$rclabels,$nuSecsHour,&$sbHour,&$sbCateg)
{
	settype($sbRet,"string");
	$objGeneral = Application::loadServices("General");
	$RRFF = $objGeneral->getParam("human_resources","type_RF");
	$objDate = Application::loadServices("DateController");
	
	//DURACIÓN
	$sbRet .= $rclabels["entrfechorunH"]["label"].": ".$objDate->fncformatohora($rcRow["entrfechorun"]);
	$sbHour = $rclabels["entrfechorunH"]["label"].": ".$objDate->fncformatohora($rcRow["entrfechorun"]);
	$sbRet .= "\n";
	$sbHour .= "\n";
	$sbRet .= $rclabels["entrdurationnH"]["label"].": ".$objDate->fncformatohora($rcRow["entrdurationn"]);
	$sbHour .= $rclabels["entrdurationnH"]["label"].": ".$objDate->fncformatohora($rcRow["entrdurationn"]);
	
	$sbRet .= "\n";
	$sbRet .= $rclabels["duration"]["label"].": ";
	$sbRet .= ($rcRow["entrdurationn"] - $rcRow["entrfechorun"])/$nuSecsHour;
	$sbRet .= "H";
	$sbRet .= "\n";
	
	//ESTADO DE LA CITA
	$objEntrada = Application::getDataGateway("entradaExtended");
	$sbStatus = $objEntrada->getStatusEntry($rcRow["entractivas"]);
	$sbCateg = $objEntrada->getCategEntry($rcRow["entrcodigon"]);
	$sbRet .= $rclabels["estado"]["label"].": ";
	$sbRet .= $sbStatus;
	$sbRet .= "\n";
	
	//RECURSOS FÍSICOS
	if(is_array($rcRow["orga"]))
	{
		$nuCont=0;
		$nuContA=0;
		$nuContB=0;
		foreach ($rcRow["orga"] as $key=>$value)
		{
			if(in_array($rcRRFF[$value]["tiorcodigos"],$RRFF))
			{
				if($nuContA)
					$sbRet .= ", ";
				else
					$sbRet .= $rclabels["orgacodigos"]["label"].": ";
				$sbRet .= $rcRRFF[$value]["organombres"];
				$nuContA++;
			}
			else if($value<>$rcRow["orgacodigos"]){
				if($nuContB)
					$sbComed .= ", ";
				$sbComed .= $rcRRFF[$value]["organombres"];
				$nuContB++;
			}
		}
	}
	$sbRet .= "\n";
	
	//DATOS DE CROSS:  EXPED, ORDEN, TAREA, MEDIADOR, COMEDIADORES
	if(strlen($rcRow["ordenumeros"]) || strlen($rcRow["orgacodigos"]))
	{
		$objCross = Application::loadServices("Cross300");
		$sbTarea = $objCross->getNombreTarea($rcRow["actacodigos"]);
		$objCross->close();
		if(strlen($rcRow["ordenumexps"]))
		{
			$sbRet .= "\n";
			$sbRet .= $rclabels["exped"]["label"].": ".$rcRow["ordenumexps"];
		}
		if(strlen($rcRow["ordenumeros"]))
		{
			$sbRet .= "\n";
			$sbRet .= $rclabels["caso"]["label"].": ".$rcRow["ordenumeros"];
			$sbRet .= "\n";
		}
		
		if($sbTarea)
		{
			$sbRet .= $rclabels["acta"]["label"].": ".$sbTarea;
			$sbRet .= "\n";
		}
		$sbRet .= $rclabels["ente"]["label"].": ".$rcRRFF[$rcRow["orgacodigos"]]["organombres"];
		$sbRet .= "\n";
		if(strlen($sbComed))
			$sbRet .= $rclabels["entepart"]["label"].": ".$sbComed;
	}
	return $sbRet;
}

function validarOrdenempresa($rcOrdenumeros,$orgacodigos)
{
	$objCross = Application::loadServices("Cross300");
	$ordenEmpresa = $objCross->getGateWay("ordenempresaExtended");
	$rcOrdenempresa = $ordenEmpresa->getByIdOrdenOrdenempresa($rcOrdenumeros);
	$objCross->close();
	if(!is_array($rcOrdenempresa))
		return false;
		
	foreach ($rcOrdenempresa as $nuCont=>$rcRow)
		if($orgacodigos == $rcRow["orgacodigos"])
			return true;
	return false;
}

function showCitasSinProgramar($orgacodigos,$catecodigon,$rcCategories)
{
	$rcCategories = orderCateg($rcCategories);
	
	$objGeneral = Application::loadServices("General");
	$rcDepProgrCitas = $objGeneral->getParam("human_resources","ASAPPOINTS_DEFAULT");
	if(!in_array($orgacodigos,$rcDepProgrCitas))
		return false;
		
	$gateWay = Application::getDataGateway("sqlExtended");
	$rcCitas = $gateWay->getCitasSinProgramarById(false,false,$catecodigon);
	
	if(!is_array($rcCitas) || !is_array($rcCategories))
		return false;
	
	$rcUser = Application :: getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".citaswebconsult.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	//Pinta la tabla
	$sinProg = $rclabels["SINPROG"]["label"];
	$sbHtml .= "<table border=0 width=100% align='center'><tr>";
	$sbHtml .= "<td class='titulofila'>".$rclabels["preecodigon"]["label"]."</td>\n";
	$sbHtml .= "<td class='titulofila'>".$rclabels["catecodigon"]["label"]."</td>\n";
	$sbHtml .= "<td class='titulofila'>".$rclabels["entractivas"]["label"]."</td>\n";
	$sbHtml .= "<td class='titulofila' align=center colspan=2><strong>".$rclabels_generic['acciones']."</strong></td>\n";
	$sbHtml .= "</tr>\n";

	foreach ($rcCitas as $nuCont => $rcRow)
	{
		if (fmod($nuCount,2)==0)
			$sbEstilo = "celda";
		else
			$sbEstilo = "celda2";
		$sbHtml .= "<tr>\n";

		$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preecodigon"]."</td>"."\n";
		$sbHtml .= "<td class='".$sbEstilo."'>".$rcCategories[$rcRow["catecodigon"]]."</td>"."\n";
		$sbHtml .= "<td class='".$sbEstilo."'>".$sinProg."</td>"."\n";
		$sbRequest = "&preecodigon=".$rcRow["preecodigon"];
		$sbRequest .= "&catecodigon=".$rcRow["catecodigon"];

		//PANEL DE ACCIONES
		$sbHtml .= "<td class='$sbEstilo' align=center>\n<a href='javascript:loadFichaEventoSP(".$rcRow["preecodigon"].");' style='text-decoration:none'>";
		$sbHtml .= "<img src=web/images/consultar_002.gif border=0 title='".$rclabels_generic['view']."'></a></td>\n";
		
		$sbJs = "document.location='index.php?action=FeScCmdDefaultEntrada".$sbRequest."';disableButtons();";
		$sbHtml .= "<td class='$sbEstilo' align=center>\n<a href=# onclick=\"".$sbJs."\">";
		$sbHtml .= "<img src=web/images/referencia.gif border=0 title='".$rclabels_generic['programar']."'></a></td>\n";
		
		$sbHtml .= "</tr>";
		$nuCount++;
	}
	return $sbHtml;
}

function orderCateg($rcCategories)
{
	if(!is_array($rcCategories))
		return false;
	foreach ($rcCategories as $rcRow)
		$rcResult[$rcRow["catecodigon"]] = $rcRow["catenombres"];
	return $rcResult;
}
?>