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
	settype($rcUser,"array");
	settype($rcParam,"array");
	settype($sbIndex,"string");
	settype($sbHtml,"string");
	settype($nuCont,"integer");

	$rcUser = Application :: getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".actuareq.php");

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
	$rcParams["grupcodigos"] = $grupcodigos;

	//Trae el sql para ejecutar
	$gateWay = Application :: getDataGateway("SqlExtended");

	$rcreq["sql"] = $gateWay->getActuareq($rcParams);
	if(!$rcreq["sql"]){
		
		echo "<script language='javascript'>alert('{$rcmessages[22]}')\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
	}
	
	// se graba el sql a disco
    SaveSql($rcreq["sql"],$rclabels);
	
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
	$sbHtml =  "<table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>";
	$sbHtml .=  "<tr>";
	$sbHtml .=  "<td class='piedefoto'><a onClick=\"getExcel('actuareq');\">";
	$sbHtml .= Application::getConstant('EXCEL_IMAGE0');
	$sbHtml .= "</a>";
	$sbHtml .=  "</td>";
	$sbHtml .=  "</tr>";
	echo $sbHtml;
	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();
	echo $sbHtml =  "</table>";
}
/**
* @Copyright 2010 ullEngine
*
* Se graba el sql a Disco
* @param string Cadena con el sql
* @param array Arreglo con los labels
* @return true, ok, false, error  
* @author freina <freina@parquesoft.com>
* @date 11-dic-2004 10:09:58
* @location Cali - Colombia
*/
function SaveSql($sbSql,$rcLabels) {
	
	settype($objGateway,"object");
	settype($rcData,"array");
	settype($rcTmp,"array");
	settype($sbPath,"string");
	settype($sbFile,"string");
	settype($sbLabels,"string");	
	settype($sbTmp,"string");
	settype($sbUmask,"string");
	
	if(isset($sbSql) && $sbSql ){
		
		//se obtienen los labels a incluir en el excel
		$objGateway = Application :: getDataGateway("SqlExtended");
		
		$objGateway->objdb->fncadoselect($sbSql, FETCH_ASSOC, 1);
		$rcData = $objGateway->objdb->rcresult;
		
		if(is_array($rcData) && $rcData){
			
			$rcData = array_keys($rcData[0]);
			
			foreach($rcData as $sbTmp){
				$rcTmp[] = $rcLabels[$sbTmp]["label"];		
			}
		
			$sbLabels = join("=>",$rcTmp);
			
			$sbPath = Application::getTmpDirectory();
			//Se valida si el directorio existe
			if(!is_dir($sbPath)){
				$sbUmask = umask(0); 
				mkdir($sbPath, 0775);
				umask($sbUmask); 
			}
			
			$sbPath .= Application::getConstant("SLASH")."sql_".$_REQUEST["PHPSESSID"];
			
			if(file_exists($sbPath)){
				unlink($sbPath);
			}
			
			$sbFile = fopen($sbPath,"w");
			fwrite($sbFile,$sbSql);
			fwrite($sbFile,"_____");
			fwrite($sbFile,$sbLabels);
			fclose($sbFile);	
		}else{
			return false;
		}
		
		return true;
	}else{
		return false;
	}
}
?>