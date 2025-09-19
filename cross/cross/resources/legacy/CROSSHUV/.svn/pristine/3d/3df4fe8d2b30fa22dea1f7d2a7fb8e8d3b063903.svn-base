<?php     
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta unas listas para la asignación de las acciones (Comandos) a un perfil
*	@param array  
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/

function smarty_function_listas_cargadas($params, & $smarty) {
	
	settype($objService, "object");
	settype($sbResult,"string");
	
	extract($_REQUEST);
	extract($params);
	
	//set memory limit
	$objService = Application :: loadServices("General");
	$sbResult = $objService->setMemoryLimit();
	
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) 
	{
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}

	//Traer las vainas por servicio
	$objService = Application :: loadServices($service);
	$gateway = $objService->getGateWay($table_name);
	echo "<br>".$table_name." ".$id." ".$value;
	$rcCargos = call_user_func(array ($gateway, "getAll$table_name"));
	$objService->close();
	
	$rcCargos = frcOrdenar($rcCargos,$id,$label);
	
	$rcCargosAnteriores = $rcValues;
	$rcCargosAnteriores = explode("_",$rcCargosAnteriores);
	
	//Arma las opciones para todas las acciones
	foreach ($rcCargos as $key => $nombre)
	{
		//Verifica cual opcion debe ser selecionada
		if($rcCargosAnteriores)
		{
			if(in_array($key,$rcCargosAnteriores))
			{
				$selected = "selected";
				$rcSelected[] = "<option value=".$key." ".$selected.">".$nombre."</option>\n";
			}
			else
				$selected = "";
		}
		else
			$selected = "";
		$rcHtml[] = "<option value=".$key." ".$selected.">".$nombre."</option>\n";
	}
	
	if(is_array($rcSelected))
		$sbHidden = implode("\n",$rcSelected);
	else
		$sbHidden = "";
	if ($rcHtml)
		$sbAll = implode("\n", $rcHtml);
		
	$sbCadena = '<select name=multiple1 size=10 multiple="multiple">
					'.$sbAll.'
		 		</select>
		&nbsp;&nbsp;
		<select name=multiple2 size=10 multiple="multiple">
		'.$sbHidden.'
		</select>
		<br>
		<div align="right"><input class="button" value="&gt;" onclick="addGroup()" type="button"></div>
		<div align="left"><input class="button" value="&lt;" onclick="removeGroup()" type="button"></div>
	';
	
	unset($rcHtml);
	
	//Restore memory limit
	if($sbResult){
		ini_restore ( "memory_limit");	
	}
	
	return $sbCadena;
}

function frcOrdenar($rcCargos,$id,$value)
{
	settype($rcReturn,"array");
	if($rcCargos)
		foreach ($rcCargos as $rcRow)
			$rcReturn[$rcRow[$id]] = $rcRow[$value];
	return $rcReturn;
}
?>