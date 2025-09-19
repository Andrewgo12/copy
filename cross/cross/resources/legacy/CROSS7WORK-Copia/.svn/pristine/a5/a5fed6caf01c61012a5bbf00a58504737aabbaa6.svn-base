<?php
/**Copyright 2004 � FullEngine
Libreria de Centro de Consulta al cliente
final@author cazapata <cazapata@parquesoft.com>finalfinal
@date 29-May-2007 11:47
@location Cali - Colombia
*/
function smarty_function_selecttipos($params, & $smarty) {
	extract($params);
	
	settype($objGateway,"object");
	settype($objService,"object");
	settype($rcTipos,"array");
	settype($rcValues,"array");
	settype($rcUser,"array");
	settype($rcRow, "array");
	settype($rcTmp, "string");
	settype($sbKey, "string");
	settype($sbValue,"string");
	settype($sbTipos, "string");
	settype($sbCadena,"string");
	settype($sbEntes,"string");
	settype($nuReg,"integer");
	settype($nuCont, "integer");

	$objGateway = Application :: getDataGateway('TipoordenExtended');
	
	switch ($opcion) {
		case "1" :
			$rcTipos = $objGateway->getTipoordenPursuit();
			break;
		case "2" :
			$rcTipos = $objGateway->getTipoordenPursuit();
			break;
	}

	
	$nuReg = sizeof($rcTipos);
	if (is_array($rcTipos) && $rcTipos) {
		foreach ($rcTipos as $sbKey => $rcValues) {
			$rcValues['tiornombres'] = htmlspecialchars($rcValues['tiornombres']);
			$rcTipos[] = "listTipos.options[$sbKey] = new Option('{$rcValues['tiornombres']}','{$rcValues['tiorcodigos']}');";
		}
		$rcTipos[] = "listTipos.length = $nuReg";
		$sbTipos = implode("\n", $rcTipos);
	} else {
		$sbTipos = '';
	}
	
	$objService = Application::loadServices("Human_resources");
	$rcEntes = $objService->getAllEntesOrg();
	$nuReg = sizeof($rcEntes);
	if (is_array($rcEntes) && $rcEntes) {
		
		foreach($rcEntes as $rcRow){
			 $rcTmp[$rcRow['orgacodigos']] = $rcRow['organombres']; 
		}
		$nuCont = 0;
		foreach ($rcTmp as $sbKey => $sbValue) {
			$rcList[] = "listEntes.options[".($nuCont++)."] = new Option('{$sbValue}','{$sbKey}');";
		}
		$rcList[] = "listEntes.length = $nuReg;";
		$sbEntes = implode("\n", $rcList);
	} else {
		$sbEntes = '';
	}

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		$rcUser['lang'] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	$sbCadena = "<script language='javascript'>
	        function valDatos(){
	            if(!document.frmDetalle.reporte.value || 
	                !document.frmDetalle.orden__ordefecingdini.value || 
	                !document.frmDetalle.orden__ordefecingdfin.value){
	                    alert('{$rcmessages[0]}');
	                return false
	            }
	            return true;
	        }
	        function selectTipo(list, listTipos,listEntes)
	    	{
	    		if(list.value == 'tipo')
	    		{
	            	for ( var i=0; i < list.options.length; i++ )
	    			{
	                	if(list.options[i].selected == true && list.options[i].value == 'tipo')
	    				{
	                    	$sbTipos
	                	}
	            	}
	            	listEntes.options[0] = new Option('---' ,'');
	        		listEntes.options.length = 0;
	    		}
	            else if(list.value == 'desagregado')
	            {
	            	for ( var i=0; i < list.options.length; i++ )
	    			{
	                	if(list.options[i].selected == true && list.options[i].value == 'desagregado')
	    				{
	                    	$sbEntes
	                	}
	            	}
	            	listTipos.options[0] = new Option('---' ,'');
	        		listTipos.options.length = 0;
	            }
	    		else
	    		{
	        		listTipos.options[0] = new Option('---' ,'');
	        		listTipos.options.length = 0;
	        		listEntes.options[0] = new Option('---' ,'');
	        		listEntes.options.length = 0;
	    		}
	        	return true;
	        }
	    </script>";
	return $sbCadena;
}
?>