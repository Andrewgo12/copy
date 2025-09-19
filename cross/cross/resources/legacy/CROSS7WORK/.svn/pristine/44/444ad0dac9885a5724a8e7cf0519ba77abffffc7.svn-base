<?php     
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta unas listas para la asignaci�n de las acciones (Comandos) a un perfil
*	@param array  
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/

function smarty_function_select_multiple($params, & $smarty) {
	
	settype($objService, "object");
	settype($sbResult,"string");
	
	extract($_REQUEST);
	extract($params);
	
	//set memory limit
	$objService = Application :: loadServices("General");
	$sbResult = $objService->setMemoryLimit();
	
	//Traer las vainas por servicio
	$objService = Application :: loadServices(ucfirst($service));
	if(!$method)
	{
		$gateway = $objService->getGateWay($table_name);
		$rcData = call_user_func(array ($gateway, "getAll$table_name"));
	}
	else
		$rcData = $objService->$method();
	$objService->close();
	
	$rcData = frcOrdenar($rcData,$field,$label);
	
	if(!$load)
		$load = $_REQUEST[$name];
	
	//Arma las opciones para todas las acciones
	if($rcData)
	{
		$nuOptions = sizeof($rcData);
		foreach ($rcData as $key => $nombre)
		{
			//Verifica cual opcion debe ser selecionada
			if($load)
			{
				if(is_array($load))
				{
					if(in_array($key,$load))
						$selected = "SELECTED ";
					else
						$selected = "";
				}
				else
					$selected = "";
			}
			else
				$selected = "";
			$rcHtml[] = "<option value='".$key."' ".$selected.">".$nombre."</option>\n";
		}
	}
	if ($rcHtml)
		$sbAll = implode("\n", $rcHtml);
	if($nuOptions > 10)
		$nuOptions = 10;
	$sbCadena = "<select name='".$name."[]' id='".$id."' size='$nuOptions' multiple>".$sbAll."</select>";
	
	unset($rcHtml);
	
	//Restore memory limit
	if($sbResult){
		ini_restore ( "memory_limit");	
	}
	
	return $sbCadena;
}

function frcOrdenar($rcData,$id,$value)
{
	settype($rcReturn,"array");
	if($rcData)
		foreach ($rcData as $rcRow)
			$rcReturn[$rcRow[$id]] = $rcRow[$value];
	return $rcReturn;
}
?>
