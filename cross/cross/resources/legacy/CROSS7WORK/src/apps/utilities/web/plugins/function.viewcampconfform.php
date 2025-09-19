<?php              
/**Copyright 2004 � FullEngine
	 Consulta y pinta las el detalle de campos configurados para cada formato de carta
	@author freina <freina@parquesoft.com>
	@date 22-dic-2004 15:55
	@location Cali - Colombia
*/
function smarty_function_viewcampconfform($params, & $smarty) {

	extract($_REQUEST);
	extract($params);

	settype($objgateway, "object");
	settype($rctmp, "array");
	settype($rctmpdet, "array");
	settype($rctmpp, "array");
	settype($rcuser, "array");
	settype($rctmpc, "array");
	settype($rctmpd, "array");
	settype($rctmpval, "array");
	settype($rcvalores, "array");
	settype($rcvaloresasoc, "array");
	settype($rcparams, "array");
	settype($rcdetparams, "array");
	settype($sbtmp, "string");
	settype($sbparams, "string");
	settype($sbarray, "string");
	settype($sbvalue, "string");
	settype($sbvaluedesc, "string");
	settype($sbvaltmp, "string");
	settype($sbval, "string");
	settype($sbhtml_result, "string");
	settype($nucofocodigon, "integer");

	if ($configformat__focacodigos) {

		$objgateway = Application :: getDataGateway("ConfigformatExtended");
		$rctmp = $objgateway->getByIdFocacodigos($configformat__focacodigos);
		if ($rctmp) {
			$objgateway = Application :: getDataGateway("DetaconfformExtended");
			$rctmpd = $objgateway->getByIdCofocodigon($rctmp[0]["cofocodigon"]);
			$nucofocodigon = $rctmp[0]["cofocodigon"];

			if ($rctmpd) {
				//se almacenan los valores de cada campo

				foreach ($rctmpd as $rctmp) {
					$rcvalores[$rctmp["cacocodigon"]] = $rctmp["decovalors"];
				}
				//se arman los parametros que han de ser pasados en las consultas
				if ($dataparams) {
					$rctmp = explode("|", $dataparams);
					foreach ($rctmp as $sbtmp) {
						$rctmpp = explode(":", $sbtmp);
						$rcparams[$rctmpp[0]] = $rctmpp[1];
					}
				}

				//Obtiene los datos del usuario
				$rcuser = Application :: getUserParam();
				if (!is_array($rcuser)) {
					//Si no existe usuario en sesion 
					$rcuser["lang"] = Application :: getSingleLang();
				}

				include ($rcuser["lang"]."/".$rcuser["lang"].".".$table.".php");

				$objgateway = Application :: getDataGateway("Campconfform");
				$sbhtml_result .="<table border='0' align='center' width='100%''>";
				// se inicia el pintado de los input
				foreach ($rctmpd as $nucont => $rctmpdet) {

					$rctmpc = $objgateway->getByIdCampconfform($rctmpdet["cacocodigon"]);
					$rctmp = explode(".", $rctmpc[0]["cacoprocedes"]);
					$rcvaloresasoc[$rctmp[1]] = $rctmpdet["cacocodigon"];

					unset ($sbvalue);
					if ($rctmpdet["decovalors"]) {
						unset($rctmpval);
						$sbvalue = " value =\"".$rctmpdet["decovalors"]."\" ";

						//Se obtiene el descriptor de la data
						if ($rcparams[$rctmp[1]]) {
							
							$rcdetparams = explode(",",$rcparams[$rctmp[1]]);
							foreach($rcdetparams as $sbval){
								$rctmpval[$sbval][0] = $rcvalores[$rcvaloresasoc[$sbval]];
							}
						}
						$rctmpval[$rctmp[1]][0] = $rcvalores[$rctmpdet["cacocodigon"]];
						$sbvaltmp = getDescriptor($rctmp[0], $rctmpval);
						$sbvaluedesc = " value =\"".$sbvaltmp."\" ";
					}

					if ($rcparams[$rctmp[1]]) {
						unset ($sbtmp);
						unset($sbparams);
						unset($sbarray);
						$sbarray .= "Array(";
						$rcdetparams = explode(",",$rcparams[$rctmp[1]]);
						foreach($rcdetparams as $sbval){
							$sbtmp .= "+'&params[".$sbval."]='+document.forms[0].".$table."__".$sbval.".value";
							$sbparams .= $sbval."|";
							$sbarray .= "this.form.".$table."__".$sbval.",";
						}
						$sbarray .= "this)";
						$sbparams .= $rctmp[1];
					} else {
						unset ($sbtmp);
						$sbparams = $rctmp[1];
						$sbarray = "Array(this)";
					}

					$sbhtml_result .= "<tr>"."<td>".$rclabels[$rctmp[1]]["label"]."</td>"."<td><input name='".$table."__".$rctmp[1]."' type='text' id='".$rctmp[1]."'".$sbvalue."onBlur=\"if(this.value)autoReference('".$rctmp[0]."','".$sbparams."',".$sbarray.",this.form.".$table."__".$rctmp[1]."_desc)\">"."<a href='#' onClick=\"javascript:fncopenwindows('FeGeCmdLstHelp','table=".$rctmp[0]."&sqlid=".$rctmp[0]."&return_obj=".$table."__".$rctmp[1]."&return_key=".$rctmp[1]."'".$sbtmp.");\">"
					."<img src='web/images/referencia.gif' border='0' align='middle'></img></a>"."\n"
					."<input type='hidden' name='".$rctmp[1]."' value='".$rcvaloresasoc[$rctmp[1]]."'>"."\n"
					."<input name='".$table."__".$rctmp[1]."_desc' type='text' ".$sbvaluedesc.">"."<B>*</B>"
					."</td><td class=\"piedefoto\"></td>"."</tr>"."\n";
				}
                $sbhtml_result .= "</table>";
                $sbhtml_result .= "<input type='hidden' name='cofocodigon' value='".$nucofocodigon."'>"."\n";
                $sbhtml_result .= "<input type='hidden' name='table' value='".$table."'>"."\n";
                $sbhtml_result .= "<tr>
                    <td colspan=\"2\">&nbsp;</td>
                    <td class=\"piedefoto\"></td>
                </tr>
                <tr>
                    <td colspan=\"2\">
                        <div align=\"center\">
                            <input class=boton name='FeGeCmdUpdateConfigformat' type='button' id='CmdUpdate' value='Modificar' onClick=\"disableButtons();action.value = 'FeGeCmdUpdateConfigformat';frmConfigformat.submit();\">
                            <input class=boton type='button' value='' name='CmdClean' id='CmdClean' onClick=\"disableButtons();action.value='FeGeCmdDefaultConfigformat';clean_table.value='Configformat'; frmConfigformat.submit();\"><input type='hidden' name='clean_table'>
                        </div>
                    </td>
                    <td class=\"piedefoto\"></td>
                </tr>";
            }
		}
		echo $sbhtml_result;
	}
}
function getDescriptor($sbid, $ircparams) {

	settype($objgateway, "object");
	settype($rcresult, "array");
	settype($osbresult, "string");

	$objgateway = Application :: getDataGateway("SqlExtended");
	$rcresult = $objgateway->getAutoReference($sbid, $ircparams);

	if ($rcresult) {
		$osbresult = $rcresult[0][0];
	}
	return $osbresult;
}
?>