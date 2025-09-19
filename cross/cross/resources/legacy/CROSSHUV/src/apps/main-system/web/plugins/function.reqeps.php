<?php 
/*** @Copyright 2012 © FullEngine
*
* Smarty plugin: Pinta el listado de consulta
* @author freina <freina@parquesoft.com>
* @date 07-Apr-2012 16:56
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
*/

function smarty_function_reqeps($params, & $smarty) {
	
	extract($params);
	extract($_REQUEST);
	settype($rcTmp,"array");
	settype($rcParam,"array");
	settype($sbIndex,"string");
	settype($nuCont,"integer");
	
	$rcUser = Application :: getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".reqeps.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	
	//se valida la entrada de las fechas
	if (($ordefecregd==null || $ordefecregd=="") || ($ordefecregd2==null || $ordefecregd2=="")){
        echo "<script language='javascript'>alert('{$rcmessages[0]}');\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
    }

    $objReport = new casosByEps();
    
    //Hace la conversion de fechas
    $servceDate = Application :: loadServices("DateController");
    if($ordefecregd)
        $objReport->setOrdefecregd($servceDate->fncdatetoint($ordefecregd));
    if($ordefecregd2)
        $objReport->setOrdefecregd2($servceDate->fncdatetoint($ordefecregd2) + 86399);

    $objReport->setEpscodigos($ipsecodigos);
    $objReport->setTiorcodigos($tiorcodigos);
	$objReport->setLabels($rclabels);
	
	//subtitulo
	$objReport->setSubtitle($rclabels["subtitle"]." ".$ordefecregd." - ".$ordefecregd2);
	
	//evalua el nivel de profundidad 
	if($causcodigos == 'false' && $evencodigos == 'false'){
		$objReport->getLevel1();
	}else if ($evencodigos == 'true' && $causcodigos == 'false'){
		$objReport->getLevel2();
	}else if ($causcodigos == 'true'){
		$objReport->getLevel3();
	}
	if (!$objReport->strReport){
        echo "<script language='javascript'>alert('{$rcmessages[22]}');\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
    }
	return $objReport->strReport;
}

class casosByEps{
	function casosByEps(){
		$this->gateWay = Application :: getDataGateway("Reqeps");
	}
	function setOrdefecregd($ordefecregd){
		$this->ordefecregd = $ordefecregd;
	}
	function setOrdefecregd2($ordefecregd2){
		$this->ordefecregd2 = $ordefecregd2;
	}
	function setEpscodigos($ipsecodigos){
		$this->ipsecodigos = $ipsecodigos;
	}
	function setTiorcodigos($tiorcodigos){
		$this->tiorcodigos = $tiorcodigos;
	}
	function setLabels($rcLabels){
		$this->rcLabels = $rcLabels;
	}
	function setSubtitle($sbSubtitle){
		$this->sbSubtitle = $sbSubtitle;
	}
	// funcion de nivel 1 
	function getLevel1(){
		
		settype($rcDataReport, "array");
		settype($rcHtml, "array");
		settype($nuTotal, "integer");
		
		$rcDataReport = $this->gateWay->getReqByEpsLevel1($this->ordefecregd,$this->ordefecregd2,$this->ipsecodigos,$this->tiorcodigos);
		if(!is_array($rcDataReport))
			return;
		$rcHtml[] = "<table border='0' align='center' width='80%'>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='3' align='center'><strong>".$this->sbSubtitle."</strong></td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='3' align='center'>&nbsp;</td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['ipsecodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['tiorcodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['total']['label']."</td>";			
		$rcHtml[] = "	<tr>";	
		foreach($rcDataReport as $ipsecodigos => $rcTmp){
			$nuTotal += $rcTmp['totaleps']; 
			$rcHtml[] = "	<tr>";
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['ipsenombres']}</b></td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['totaleps']}</b></td>";			
			$rcHtml[] = "	<tr>";	
			foreach($rcTmp['tipoorden'] as $tiorcodigos => $rcTipos){
				$rcHtml[] = "	<tr>";
				$rcHtml[] = "		<td>&nbsp;</td>";			
				$rcHtml[] = "		<td>{$rcTipos['tiornombres']}</td>";			
				$rcHtml[] = "		<td><b>{$rcTipos['cantidad']}</b></td>";			
				$rcHtml[] = "	<tr>";	
			}		
		}
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='piedefoto'>&nbsp;</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>".$this->rcLabels['total1']['label']."</b></td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>{$nuTotal}</b></td>";			
		$rcHtml[] = "	<tr>";	
		$rcHtml[] = "</table>";
		$this->strReport = implode("\n",$rcHtml);
	}
	// funcion de nivel 2 
	function getLevel2(){
		
		settype($rcDataReport, "array");
		settype($rcHtml, "array");
		settype($nuTotal, "integer");
		
		$rcDataReport = $this->gateWay->getReqByEpsLevel2($this->ordefecregd,$this->ordefecregd2,$this->ipsecodigos,$this->tiorcodigos);
		if(!is_array($rcDataReport))
			return;
		$rcHtml[] = "<table border='0' align='center' width='80%'>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='4' align='center'><strong>".$this->sbSubtitle."</strong></td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='4' align='center'>&nbsp;</td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['ipsecodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['tiorcodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['evencodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['total']['label']."</td>";			
		$rcHtml[] = "	<tr>";	
		foreach($rcDataReport as $ipsecodigos => $rcTmp){
			$nuTotal += $rcTmp['totaleps'];
			$rcHtml[] = "	<tr>";
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['ipsenombres']}</b></td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['totaleps']}</b></td>";			
			$rcHtml[] = "	<tr>";	
			foreach($rcTmp['tipoorden'] as $tiorcodigos => $rcTipos){
				$rcHtml[] = "	<tr>";
				$rcHtml[] = "		<td>&nbsp;</td>";			
				$rcHtml[] = "		<td>{$rcTipos['tiornombres']}</td>";
				$rcHtml[] = "		<td>&nbsp;</td>";		
				$rcHtml[] = "		<td><b>{$rcTipos['cantidad']}</b></td>";			
				$rcHtml[] = "	<tr>";	
				foreach($rcTipos['evento'] as $evencodigos => $rcEventos){
					$rcHtml[] = "	<tr>";
					$rcHtml[] = "		<td>&nbsp;</td>";			
					$rcHtml[] = "		<td>&nbsp;</td>";			
					$rcHtml[] = "		<td>{$rcEventos['evennombres']}</td>";			
					$rcHtml[] = "		<td>{$rcEventos['cantidad']}</td>";			
					$rcHtml[] = "	<tr>";
				}
			}		
		}
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='piedefoto' colspan='2'>&nbsp;</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>".$this->rcLabels['total1']['label']."</b></td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>{$nuTotal}</b></td>";			
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "</table>";
		$this->strReport = implode("\n",$rcHtml);
	}
	// funcion de nivel 3 
	function getLevel3(){
		
		settype($rcDataReport, "array");
		settype($rcHtml, "array");
		settype($nuTotal, "integer");
		
		$rcDataReport = $this->gateWay->getReqByEpsLevel3($this->ordefecregd,$this->ordefecregd2,$this->ipsecodigos,$this->tiorcodigos);
		
		if(!is_array($rcDataReport))
			return;
		$rcHtml[] = "<table border='0' align='center' width='80%'>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='5' align='center'><strong>".$this->sbSubtitle."</strong></td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "	<td colspan='5' align='center'>&nbsp;</td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['ipsecodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['tiorcodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['evencodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['causcodigos']['label']."</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'>".$this->rcLabels['total']['label']."</td>";			
		$rcHtml[] = "	<tr>";	
		
		foreach($rcDataReport as $ipsecodigos => $rcTmp){
			$nuTotal += $rcTmp['totaleps'];
			$rcHtml[] = "	<tr>";
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['ipsenombres']}</b></td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'>&nbsp;</td>";			
			$rcHtml[] = "		<td class='titulofila'><b>{$rcTmp['totaleps']}</b></td>";			
			$rcHtml[] = "	<tr>";	
			foreach($rcTmp['tipoorden'] as $tiorcodigos => $rcTipos){
				$rcHtml[] = "	<tr>";
				$rcHtml[] = "		<td>&nbsp;</td>";
				$rcHtml[] = "		<td>{$rcTipos['tiornombres']}</td>";
				$rcHtml[] = "		<td>&nbsp;</td>";			
				$rcHtml[] = "		<td>&nbsp;</td>";			
				$rcHtml[] = "		<td><b>{$rcTipos['cantidad']}</b></td>";			
				$rcHtml[] = "	<tr>";
				foreach($rcTipos['evento'] as $evencodigos => $rcEventos){
					$rcHtml[] = "	<tr>";
					$rcHtml[] = "		<td>&nbsp;</td>";
					$rcHtml[] = "		<td>&nbsp;</td>";
					$rcHtml[] = "		<td>{$rcEventos['evennombres']}</td>";
					$rcHtml[] = "		<td>&nbsp;</td>";		
					$rcHtml[] = "		<td>{$rcEventos['cantidad']}</td>";	
					$rcHtml[] = "	<tr>";
					if(is_array($rcEventos['causa'])){
						foreach($rcEventos['causa'] as $causcodigos => $rcCausa){
							$rcHtml[] = "	<tr>";
							$rcHtml[] = "		<td>&nbsp;</td>";
							$rcHtml[] = "		<td>&nbsp;</td>";
							$rcHtml[] = "		<td>&nbsp;</td>";
							$rcHtml[] = "		<td>{$rcCausa['causnombres']}</td>";			
							$rcHtml[] = "		<td>{$rcCausa['cantidad']}</td>";			
							$rcHtml[] = "	<tr>";
						}
					}
				}
			}		
		}
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='piedefoto' colspan='3'>&nbsp;</td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>".$this->rcLabels['total1']['label']."</b></td>";			
		$rcHtml[] = "		<td class='titulofila' align='center'><b>{$nuTotal}</b></td>";			
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "</table>";
		$rcHtml[] = "</table>";
		$this->strReport = implode("\n",$rcHtml);
	}
}
?>