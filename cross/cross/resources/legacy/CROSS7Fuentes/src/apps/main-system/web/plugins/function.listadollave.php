<?php  
/**
* @Copyright 2009 FullEngine
*
* Smarty plugin
* Pinta el listado de ordenes
* @author freina<freina@parquesoft.com>
* @date 19-Mar-2009 10:55:00
* @location Cali - Colombia
*/
function smarty_function_listadollave($params, & $smarty) {
    
	extract($_REQUEST);
	
	settype($objDate,"object");
	settype($objGateway,"object");
	settype($objLib,"object");
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($rcHead,"array");
	settype($rcBody,"array");
	settype($rcExcel,"array");
	settype($rcData,"string");
	settype($sbHtml,"string");
	settype($sbCant,"string");
	settype($sbCantH,"string");
	settype($sbName,"string");
	settype($sbEstilo,"string");
	settype($sbValue,"string");
	settype($sbIndex,"string");
	settype($nuAux,"integer");
	settype($nuCont,"integer");
	settype($nuKey,"integer");
	
	if(!$consult__flag){
		return null;
	}
	
	//Carga el servicio de fechas 
	$objDate = Application :: loadServices("DateController");
	
	//info del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)){
		$rcUser["lang"] = Application :: getSingleLang();
	}
		
	if($llav__llavefecini!=null && $llav__llavefecini!=""
	|| $llav__llavefecfin!=null && $llav__llavefecfin!=""){
		
		//se convierte las fechas a timestamp
		$llavefecini = $objDate->fncdatehourtoint($llav__llavefecini);
		$llavefecfin = $objDate->fncdatehourtoint($llav__llavefecfin);

		//se obtiene la compuerta
		$objGateway = Application::getDataGateway("llave");
		$objGateway->setData(array("fechaini"=>$llavefecini,
								   "fechafin"=>$llavefecfin,
								   "llavusuauts"=>$llave__llavusuauts,
								   "llavususols"=>$llave__llavususols,
								   "total"=>$total,
								   "orderby"=>$orderby,
								   "page"=>$page));
		$objGateway->getListadoLlave();
		$rcData = $objGateway->getResult();
		if(is_array($rcData) && $rcData){
			
			if($rcData["total"]>0 && $rcData["result"]){
				
				//Incluye los  el archivo de lenguaje
				include ($rcUser["lang"]."/".$rcUser["lang"].".listadollave.php");
				include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
				
				$_REQUEST["total"] = $rcData["total"];
				$rcTmp = $rcData["result"];
				//datos para elxcel
				$rcExcel = $rcTmp;
				//Pinta la consulta
			    $sbHtml .= "<table border='0' align='center' width='100%'>"; 
				
				if($rcTmp){
					
					//Pinta la cabecera de la consulta
					$rcHead = array_keys($rcTmp[0]);
					$sbCantH = sizeof($rcHead);
					$sbCant = (string) sizeof($rcTmp);
					
					//AGREGUEMOS LOS LINKS DE PAGINACIÓN
					$objLib = Application::loadServices("Pager");
					$sbHtml .= "<tr><td align='center' colspan='$sbCantH'>";
					 
					$nuCuantos = ($rcData["total"]-$rcData["nuOffset"])<100?($rcData["total"]-$rcData["nuOffset"]):100;
					$sbHtml .= $objLib->paginar($rcTmp,"ListadoLlave",100,true,$rcData["total"]);
					$sbHtml .= "</td></tr>";
					
					//se pinta la cantidad de registros - freina - 20-Mar-2009
					$sbHtml .= "<td colspan='".($sbCantH)."'>".$rclabels["total"]["label"]." ".($rcData["nuOffset"]+1)." ".$rclabels["al"]["label"]." ".($rcData["nuOffset"]+$nuCuantos)." ".$rclabels["de"]["label"]." ".$rcData["total"]."</td></tr>";
					
					$sbHtml .= "<tr>";
					$nuAux = 1;
					foreach($rcHead as $sbName){
						$sbHtml .= "<td class='titulofila' align='center'>
								<a onClick=\"document.frmLlave.orderby.value='$nuAux';
													document.frmLlave.action.value='FeCrCmdDefaultListadoLlave';
													document.frmLlave.consult__flag.value=1;
													document.frmLlave.submit();\"
								 style='text-decoration:none;FONT-SIZE: 11px; BACKGROUND: #1c49bc; COLOR: #ffffff; FONT-FAMILY: Helvetica'>".
						$rclabels[$sbName]["label"]."</a></td>";
						$nuAux++;
					}
				    
					$sbHtml .= "</tr>";
					
					//Pinta el cuerpo de la consulta
					foreach($rcTmp as $nuKey => $rcBody){
						
						$sbHtml .= "<tr>";
						
						//Calcula el interlineado
						if(fmod($nuCont,2)  ==  0)$sbEstilo = "celda"; else $sbEstilo = "celda2";
						foreach($rcBody as $sbIndex=>$sbValue){
				            if(!$sbValue){
				            	$sbValue = "&nbsp;";
				            }else{
				            	if($sbIndex=="llavfecinid" || $sbIndex=="llavfecvend" 
				            	|| $sbIndex=="llavfecusod"){
				            		$sbValue = $objDate->fncformatofechahora($sbValue);
				            	}
				            }
				            
							$sbHtml .= "<td class='$sbEstilo'>$sbValue</td>";
				        }
						$sbHtml .= "</tr>";
						$nuCont++;
					}
					$sbHtml .= getExcel($rclabels,$rcExcel);
					$sbHtml .= "</table>";
				}
			}else{
				include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        		return "<script language='javascript'>alert('".$rcmessages[22]."')</script>";
			}
		}else{
			include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        	return "<script language='javascript'>alert('".$rcmessages[22]."')</script>";
		}
	}else{
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        return "<script language='javascript'>alert('".$rcmessages[0]."')</script>";
	}
	
	return $sbHtml;
}
/**
* @Copyright 2009 FullEngine
*
* Smarty plugin
* genera el excel del listado
* @author freina<freina@parquesoft.com>
* @date 14-Abr-2009 18:50
* @location Cali - Colombia
*/
function getExcel($rcLabels,$rcData){
	
	settype($objDate,"object");
	settype($rcTmp,"array");
	settype($rcParams,"array");
	settype($rcHead,"array");
	settype($rcBody,"string");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbCantH,"string");
	settype($nuKey,"integer");
	
	if(is_array($rcData) && $rcData){
		
		$objDate = Application :: loadServices("DateController");
		
		$rcHead = array_keys($rcData[0]);
		$sbCantH = sizeof($rcHead);
		foreach($rcHead as $sbIndex){
				$rcTmp[] = $rcLabels[$sbIndex]["label"]; 
		}
		foreach($rcData as $nuKey => $rcBody){
			if($rcBody["llavfecinid"]){
				$rcBody["llavfecinid"] = $objDate->fncformatofechahora($rcBody["llavfecinid"]);
			}
			if($rcBody["llavfecvend"]){
				$rcBody["llavfecvend"] = $objDate->fncformatofechahora($rcBody["llavfecvend"]);
			}
			if($rcBody["llavfecusod"]){
				$rcBody["llavfecusod"] = $objDate->fncformatofechahora($rcBody["llavfecusod"]);
			}
			$rcData[$nuKey] = $rcBody;
		}
		array_unshift($rcData,$rcTmp);
		$_REQUEST["rcData"] = array_merge($_REQUEST["rcData"],$rcData);
		include_once("function.closePdfDurCal.php");
		$rcParams["name"]= "listado_llave";
		$sbHtml .= "<tr><td align='center' colspan='$sbCantH' class=\"piedefoto\"><table align='center' width='100%'>";
		$sbHtml .= smarty_function_closePdfDurCal($rcParams,$smarty);
		$sbHtml .= "</table></td></tr>";
	}
	
	return $sbHtml;
	
}
?>