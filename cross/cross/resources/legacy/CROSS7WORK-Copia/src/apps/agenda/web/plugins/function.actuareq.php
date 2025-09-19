<?php 
/*** @Copyright 2004 © FullEngine
*
* Smarty plugin: Pinta el listado de consulta
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
*/

function smarty_function_actuareq($params, & $smarty) {
	
	extract($params);
	extract($_REQUEST);
	settype($rcTmp,"array");
	settype($rcParam,"array");
	settype($sbIndex,"string");
	settype($nuCont,"integer");
    
    //Hace la conversion de fechas
    $servceDate = Application :: loadServices("DateController");
    if($acemfeccren)
        $rcParams["acemfeccren"] = $servceDate->fncdatetoint($acemfeccren);
    if($acemfeccren2)
        $rcParams["acemfeccren2"] = $servceDate->fncdatetoint($acemfeccren2) + 86399;
    if($acemfecaten)
        $rcParams["acemfecaten"] = $servceDate->fncdatetoint($acemfecaten);
    if($acemfecaten2)
        $rcParams["acemfecaten2"] = $servceDate->fncdatetoint($acemfecaten2) + 86399;

    $rcParams["ordenumeros"] = $ordenumeros;
    $rcParams["orgacodigos"] = $orgacodigos;

	//Trae el sql para ejecutar
	$gateWay = Application :: getDataGateway("SqlExtended");

	$rcreq["sql"] = $gateWay->getActuareq($rcParams);
    if(!$rcreq["sql"]){
        $rcuser = Application :: getUserParam();
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        echo "<script language='javascript'>alert('{$rcmessages[22]}')\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
    }
	$rcreq["service"] = $service;
	$rcreq["datefields"] = "acemfecaten,acemfeccren";
	$rcreq["action"] = "FeCrCmdDefaultBodyActuareq";
	$rcreq["table"] = "";
	$rcreq["view_fields"] = "*";
	$rcreq["key_return"] = $llaves;
	$rcreq["order_by"] = $_REQUEST["order_by"];
	$rcreq["command"] = "FeCrCmdDefaultBodyActuareq";
	$rcreq["form"] = "frmActuareq"; // add by Diego Ramirez Software House
	//$rcreq["jsfunction"] = "loadConsult";
	if($cache == "true")	
		$rcreq["cache"] = true;
	else 
		$rcreq["cache"] = false;
	if($num_rows)
		$rcreq["num_rows"] = $num_rows;
	else
		$rcreq["num_rows"] = 20;
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
		return;
	$rcLlaves = explode(",",$llaves);
	//'&var1='+value0+'&var2='+var3
	foreach($rcLlaves as $key => $value){
		$rcTmpParams[] = "keyValue$key";
		$rcTmpValues[] = "'&".$table_name."__".$value."='+keyValue$key";
	}
	//Pinta la funcion de javascript
	$jsCad = "\n<script language='javascript'>" .
				"\nfunction loadConsult(cmd,".implode(",",$rcTmpParams)."){" .
				"	\n\tlocation.href='index.php?action='+cmd+".implode("+",$rcTmpValues).";
			}\n</script>\n";
	echo $jsCad; 
	//Carga las etiquetas de la tabla en la sesion
	include ($rcuser["lang"]."/".$rcuser["lang"].".actuareq.php");
	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();
}

?>
