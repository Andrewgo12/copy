<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlCompromisoExtended {
	var $consult;
	var $objdb;
	var $rcParams;
	var $rcResult;
	function FeCrPgsqlCompromisoExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	/** 
	 * *Copyright 2007 FullEngine
	Set the params array to build the query
	@author mrestrepo <mrestrepo@parquesoft.com>
	@date 23-Sep-2007 11:55
	@location Cali - Colombia
	*/
	function setData($rcEnvir)
	{
		if(!is_array($rcEnvir))
			$this->rcParams = false;
		else
			foreach ($rcEnvir as $key=>$value)
				$this->rcParams[$key] = $value;
	}
	
	function getResult()
	{
		return $this->rcResult;
	}
	
	/** 
	 * *Copyright 2007 FullEngine
	build a query based in params array
	@author mrestrepo <mrestrepo@parquesoft.com>
	@date 23-Sep-2007 11:55
	@location Cali - Colombia
	*/
	function getListadoSeguimientos()
	{
		settype($rcFrom,"array");
		settype($rcWhere,"array");
		settype($sbSql,"string");

		$objDate = Application :: loadServices("DateController");
		$dbFormatDateConversion =$objDate->dbFormatDateConversion;
		
		//Si no hay data del entorno
		if($this->rcParams == false)
			return false;
			
		$rcUser = Application :: getUserParam();

		foreach ($this->rcParams as $key=>$value)
		{
			if(strlen($value))
			{
				if($key == "ordenumeros")
					$rcWhere[] = '"orden"."ordenumeros" like \'%'.$value.'%\'';
					
				elseif($key == "ordefecregd")
					$rcWhere[] = '"orden"."ordefecregd">='.$value;
					
				elseif($key == "infrcodigos" || $key == "tiorcodigos" || $key == "causcodigos" || $key == "evencodigos" || $key == "locacodigos")
					$rcWhere[] = '"ordenempresa"."'.$key.'"='.$value;
					
				else if($key == "orgacodigos" && !$_REQUEST["children"])
					$rcWhere[] = '"acta"."'.$key.'"='.$value;
					
				elseif($key == "compcodigos" || $key == "accoactivas")
					$rcWhere[] = '"acemcompromi"."'.$key.'"=\''.$value."'";
					
				elseif($key == "accofecrevn")
					$rcWhere[] = '"acemcompromi"."accofecrevn">='.$value;
					
				elseif ($key == "children") 
				{
					//Debe consultar para este ente y todos sus hijos
                    $HrService = Application::loadServices('Human_resources');
                    $rcChildren = $HrService->getEnteSon($_REQUEST["orgacodigos"]);
                    if(is_array($rcChildren)&& $rcChildren){
                        foreach($rcChildren as $rcEnte){
                            $rcTmp[] = $rcEnte['orgacodigos']; 
                        }
                        unset($rcChildren);
                        $stEntes = ",'".implode("','",$rcTmp)."'";
                        
                    }
                    $rcWhere[] = '"acta"."orgacodigos" IN (\''.$_REQUEST["orgacodigos"].'\''.$stEntes.')';
				}
					
			}
		}
		//Una vez barrido el enviroment, y armado los bloques del query, procedamos a ensamblarlo
		$rcFrom = array("orden","ordenempresa","acemcompromi","acta","actaempresa");
		$rcWhere[] = '"ordenempresa"."ordenumeros"="orden"."ordenumeros"';
		$rcWhere[] = ' "acemcompromi"."acemcodigos" = "actaempresa"."acemnumeros"';
		$rcWhere[] = '"acta"."actacodigos"="actaempresa"."actacodigos"';
		$rcWhere[] = '"orden"."ordenumeros"="acta"."ordenumeros"';
		
		$sbFrom = join(",",$rcFrom);
		$rcWhere = array_unique($rcWhere);
		$sbWhere = join(" AND ",$rcWhere);
		
		//Finalmente armamos el query y lo ejecutamos
		if(!strlen($sbWhere))
			return false;
	
		$sbSql = 'SELECT DISTINCT * FROM '.$sbFrom.' WHERE '.$sbWhere;
		$sbSql .= ' ORDER BY "accofecrevn" ASC';
		
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
    	$this->rcResult = $this->objdb->rcresult;
	}
	
	function addArrayCompromisosActa($rcComprActa, $acemnumeros) {
		if(!is_array($rcComprActa))
			return false;
		$active = Application::getConstant("REG_ACT");
		foreach($rcComprActa as $compcodigos=>$fecha)
		{
			$rcSql[] = 'INSERT INTO "acemcompromi" ("compcodigos","acemcodigos","accofecrevn","accoactivas") '.
						'VALUES(\''.$compcodigos.'\',\''.$acemnumeros.'\',\''.$fecha.'\',\''.$active.'\')';
			$nuStart++;
		}
		$this->objdb->fncadoexecutetrans($rcSql);
		return $this->objdb->objresult;
	}
	
	function updateCompromiso($compcodigos,$acemcodigos, $accoactivas,$accoobservas,$acemnumeros) {
		$sql = 'UPDATE "acemcompromi" SET "accoactivas"=\''.$accoactivas.'\',"accoobservas"=\''.$accoobservas.'\', "acemnumeros"=\''.$acemnumeros.'\' WHERE "compcodigos"=\''.$compcodigos.'\' AND "acemcodigos"=\''.$acemcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->objresult;
	}
} //End of Class Actaempresa
?>