<?php

//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlEntradaExtended
{
	function FeScPgsqlEntradaExtended()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}

	/**
	* @Copyright 2011 Parquesoft
	*
	* Modifica el arreglo de datos
	* @author freina<freina@parquesoft.com>
	*
	* @location Cali - Colombia
	*/
	function setData($rcData){
		$this->rcData = $rcData;
	}
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}

	function getDetallesEventosUsuario($orgacodigos,$startdate,$enddate,$nuCateg,$user)
	{
		$sbCancel = Application::getConstant("ENTRY_CANCEL_STATUS");

		$sql = 'SELECT DISTINCT "entrada".*,"refercross".*';
		$sql .= ' FROM "entrada","refercross","organentrada"';
		$sql .= ' WHERE "refercross"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos"=\''.$orgacodigos.'\'';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;

		$sql = 'SELECT DISTINCT "entrada"."*"';
		$sql .= ' FROM "entrada"';
		$sql .= ' WHERE "entrcodigon" NOT IN (SELECT DISTINCT "entrcodigon" FROM "refercross")';
		$sql .= ' AND "entrusucreas"=\''.$user.'\'';
		$sql .= ' AND "entrfechorun">='.$startdate;
		$sql .= ' AND "entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "catecodigon"='.$nuCateg;
		$sql .= ' UNION SELECT DISTINCT "entrada"."*"';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "entrada"."entrcodigon" NOT IN (SELECT DISTINCT "entrcodigon" FROM "refercross")';
		$sql .= ' AND "entrada"."entrcodigon"="organentrada"."entrcodigon"';
		$sql .= ' AND "orgacodigos"=\''.$orgacodigos.'\'';
		$sql .= ' AND "entrfechorun">='.$startdate;
		$sql .= ' AND "entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "catecodigon"='.$nuCateg;
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
		if(is_array($rcResult) && $rcResult && is_array($rcTmp) && $rcTmp){
			$rcResult = array_merge($rcResult,$rcTmp);	
		}

		$sql = 'SELECT DISTINCT "organentrada".*';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "orgacodigos"=\''.$orgacodigos.'\'';
		$sql .= ' OR "entrusucreas"=\''.$user.'\'';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcOrgan = $this->objdb->rcresult;
		if(is_array($rcOrgan))
		{
			$rcOrgan = $this->getOrganentrada($rcOrgan);
			$rcResult["orga"] = $rcOrgan;
		}
		return $rcResult;
	}

	function getDetallesEventosDependencia($orgacodigos,$startdate,$enddate,$nuCateg,$user)
	{
		$sbCancel = Application::getConstant("ENTRY_CANCEL_STATUS");
		$orgacodigos = $this->orderOrgacodigos($orgacodigos);
		$orgacodigos = join(",",$orgacodigos);

		$sql = 'SELECT DISTINCT "entrada".*,"refercross".*,"perscodigos"';
		$sql .= ' FROM "entrada","refercross","organentrada"';
		$sql .= ' WHERE "refercross"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos" IN('.$orgacodigos.')';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;

		$sql = 'SELECT DISTINCT "entrada"."*",null';
		$sql .= ' FROM "entrada"';
		$sql .= ' WHERE "entrcodigon" NOT IN (SELECT DISTINCT "entrcodigon" FROM "refercross")';
		$sql .= ' AND "entrusucreas"=\''.$user.'\'';
		$sql .= ' AND "entrfechorun">='.$startdate;
		$sql .= ' AND "entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "catecodigon"='.$nuCateg;
		$sql .= ' UNION SELECT DISTINCT "entrada"."*","perscodigos"';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "entrada"."entrcodigon" NOT IN (SELECT DISTINCT "entrcodigon" FROM "refercross")';
		$sql .= ' AND "entrada"."entrcodigon"="organentrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos" IN('.$orgacodigos.')';
		$sql .= ' AND "entrfechorun">='.$startdate;
		$sql .= ' AND "entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "catecodigon"='.$nuCateg;
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		$rcResult = array_merge($rcResult,$rcTmp);

		$sql = 'SELECT DISTINCT "organentrada".*';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos" IN('.$orgacodigos.')';
		$sql .= ' OR "entrusucreas"=\''.$user.'\'';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		$rcOrgan = $this->objdb->rcresult;
		if(is_array($rcOrgan))
		{
			$rcOrgan = $this->getOrganentrada($rcOrgan);
			$rcResult["orga"] = $rcOrgan;
		}
		return $rcResult;
	}

	function getBusyDaysByUser($orgacodigos,$startdate,$enddate,$nuCateg)
	{
		$sbCancel = Application::getConstant("ENTRY_CANCEL_STATUS");
		$orgacodigos = $this->orderOrgacodigos($orgacodigos);
		$orgacodigos = join(",",$orgacodigos);

		$sql = 'SELECT DISTINCT "entrfechorun"';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos" IN ('.$orgacodigos.')';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
		$sql .= " ORDER BY 1 ASC";
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBusyDaysByDep($orgacodigos,$startdate,$enddate,$nuCateg)
	{
		$sbCancel = Application::getConstant("ENTRY_CANCEL_STATUS");
		$orgacodigos = $this->orderOrgacodigos($orgacodigos);
		$orgacodigos = join(",",$orgacodigos);

		$sql = 'SELECT DISTINCT "entrfechorun"';
		$sql .= ' FROM "entrada","organentrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon"="entrada"."entrcodigon"';
		$sql .= ' AND "organentrada"."orgacodigos" IN ('.$orgacodigos.')';
		$sql .= ' AND "entrada"."entrfechorun">='.$startdate;
		$sql .= ' AND "entrada"."entrduracion"<='.$enddate;
		$sql .= ' AND "entrada"."entractivas"!=\''.$sbCancel.'\'';
		if($nuCateg)
		$sql .= ' AND "entrada"."catecodigon"='.$nuCateg;
		$sql .= " ORDER BY 1 ASC";
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getRelatedEvents($entrcodigon)
	{
		$sql = 'SELECT DISTINCT "entrcodigon"';
		$sql .= ' FROM "refercross"';
		$sql .= ' WHERE ("ordenumeros","actacodigos") IN ';
		$sql .= ' (SELECT "ordenumeros","actacodigos" FROM "refercross" WHERE "entrcodigon"='.$entrcodigon.')';
			
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function updateStatusEntrada($entrcodigon,$entractivas)
	{
		$sql='UPDATE "entrada" SET "entractivas"=\''.$entractivas.'\' WHERE "entrcodigon"='.$entrcodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateStatusEventByActa($actacodigos,$entractivas,$nuNow,$sbOperador)
	{
		$sql = 'UPDATE "entrada" SET "entractivas"=\''.$entractivas.'\' WHERE "entrcodigon" IN ';
		$sql .= '(SELECT DISTINCT "entrcodigon" FROM "refercross" WHERE "actacodigos"='.$actacodigos.')';
		$sql .= ' AND "entrfechorun"'.$sbOperador.$nuNow;

		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateEntesEntrada($sbEntradas,$newOrgacodigos,$oldOrgacodigos)
	{
		$sql = 'UPDATE "organentrada" SET "orgacodigos"=\''.$newOrgacodigos.'\'';
		$sql .= ' WHERE "orgacodigos"=\''.$oldOrgacodigos.'\'';
		$sql .= ' AND "entrcodigon" IN ('.$sbEntradas.')';

		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function addOrganentrada($entrcodigon,$orgacodigos,$perscodigos=false)
	{
		if(is_array($tiorcodigos))
		$tiorcodigos = $tiorcodigos[0];
		$sql='INSERT INTO "organentrada" ("entrcodigon","orgacodigos","perscodigos") VALUES ('.$entrcodigon.',\''.$orgacodigos.'\',\''.$perscodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteAllOrganentrada($entrcodigon)
	{
		$sql='DELETE FROM "organentrada" WHERE "entrcodigon"='.$entrcodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function addDetalleEntrada($entrcodigon,$deenprocesas,$deenvictimas,$deenfiscalis,$deendefensas)
	{
		$sql='INSERT INTO "detentrada" ("entrcodigon","deenprocesas","deenvicitmas","deenfiscalis","deendefensas") VALUES ('.$entrcodigon.',\''.$deenprocesas.'\',\''.$deenvictimas.'\',\''.$deenfiscalis.'\',\''.$deendefensas.'\')';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteDetalleEntrada($entrcodigon)
	{
		$sql='DELETE FROM "detentrada" WHERE "entrcodigon"='.$entrcodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdDetentrada($entrcodigon)
	{
		$sql='SELECT * FROM "detentrada" WHERE "entrcodigon"='.$entrcodigon;

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByIdOrganentrada($entrcodigon)
	{
		$sql='SELECT * FROM "organentrada" WHERE "entrcodigon"='.$entrcodigon.' ORDER BY "orgacodigos"';

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByIdOrganentradaAndPreentrada($entrcodigon)
	{
		$sql='SELECT * FROM "organentrada","preentrada" WHERE "organentrada"."entrcodigon"= "preentrada"."entrcodigon" AND "organentrada"."entrcodigon"='.$entrcodigon.' ORDER BY "orgacodigos"';

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function existOrganentrada($entrcodigon,$orgacodigos)
	{
		if(strlen($orgacodigos)==0)
		return true;
		$sql='SELECT * FROM "organentrada" WHERE "entrcodigon"='.$entrcodigon.' AND "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return ($this->objdb->fncadorowcont() == 0);
	}

	function blHasAvailability($nuIni,$nuFin,$orgacodigos)
	{
		$sbActive = Application :: getConstant("ENTRY_ACTIVE_STATUS");

		$sql = 'SELECT DISTINCT "entrcodigon"';
		$sql .= ' FROM "organentrada","entrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon" = "entrada"."entrcodigon"';
		$sql .= ' AND "entrfechorun" between '.$nuIni.' AND '.$nuFin;
		$sql .= ' AND "orgacodigos" = \''.$orgacodigos.'\'';
		$sql .= ' AND "entractivas"=\''.$sbActive.'\'';

		$this->objdb->fncadoexecute($sql);
		return ($this->objdb->fncadorowcont() == 0);
	}

	function getColisionUserHours($orgacodigos,$inuFechaHoraIni,$inuFechaHoraFin,$entrcodigon=false)
	{
		$sbActive = Application :: getConstant("ENTRY_ACTIVE_STATUS");

		$sql = 'SELECT DISTINCT "entrada"."entrcodigon"';
		$sql .= ' FROM "organentrada","entrada"';
		$sql .= ' WHERE "organentrada"."entrcodigon" = "entrada"."entrcodigon"';
		if($entrcodigon)
		$sql .= ' AND "entrada"."entrcodigon" <> '.$entrcodigon;

		$sql .= ' AND';
		$sql .= ' (';
		$sql .= ' ("entrfechorun"<='.$inuFechaHoraIni.' AND "entrduracion">'.$inuFechaHoraIni.')';
		$sql .= ' OR ("entrfechorun"<'.$inuFechaHoraFin.' AND "entrduracion">='.$inuFechaHoraFin.')';
		$sql .= ' OR ( "entrfechorun">='.$inuFechaHoraIni.' AND "entrduracion"<='.$inuFechaHoraFin.')';
		$sql .= ' )';

		$sql .= ' AND "orgacodigos" = \''.$orgacodigos.'\'';
		$sql .= ' AND "entractivas"=\''.$sbActive.'\'';

		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function getOrganentrada($rcOrgan)
	{
		settype($rcResult,"array");
		$rcResult = false;
		foreach ($rcOrgan as $nuCont=>$rcRow)
		$rcResult[$rcRow["entrcodigon"]][] = $rcRow["orgacodigos"];
		return $rcResult;
	}

	function getStatusEntry($entractivas)
	{
		$sql='SELECT * FROM "estadoentrada" WHERE "esencodigos"=\''.$entractivas.'\'';

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult[0]["esennombres"];
	}

	function getCategPreEntry($preecodigon)
	{
		$sql='SELECT "catenombres" FROM "categoria","preentrada" WHERE "categoria"."catecodigon"="preentrada"."catecodigon" AND "preecodigon"='.$preecodigon;

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult[0]["catenombres"];
	}
	function getCategEntry($entrcodigon)
	{
		$sql='SELECT "catenombres" FROM "categoria","entrada" WHERE "categoria"."catecodigon"="entrada"."catecodigon" AND "entrcodigon"='.$entrcodigon;

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult[0]["catenombres"];
	}

	function getDateHourSession($isbOrdenumeros)
	{
		settype($sbEstate,"string");
		settype($sbSql,"string");
		$sbEstate = Application :: getConstant("REG_ACT");

		$sbSql = 'SELECT "entrfechorun"'.
				' FROM "entrada","refercross"'.
				' WHERE "entrada"."entrcodigon"="refercross"."entrcodigon"'.
				' AND "ordenumeros"=\''.$isbOrdenumeros.'\''.
				' AND "entractivas"=\''.$sbEstate.'\'';

		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult[0]["entrfechorun"];
	}

	function orderOrgacodigos($orgacodigos)
	{

		settype($rcResult,"array");
		if(is_array($orgacodigos))
		{
			reset($orgacodigos);
			foreach ($orgacodigos as $key=>$value)
			$rcResult[] = "'".$value."'";
		}
		else
		$rcResult[] = "'".$orgacodigos."'";
			
		return $rcResult;
	}

	function getByPreEntrada($preecodigon) {
		$sql='SELECT * FROM "preentrada" WHERE "preecodigon"='.$preecodigon;

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene los registros de la tabla organentrada
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _getOrganentrada(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($entrcodigon){
			$rcTmp[] = ' "entrcodigon"='.$entrcodigon.' ';
		}
		
		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}
		
		if($perscodigos){
			$rcTmp[] = ' "perscodigos"=\''.$perscodigos.'\' ';
		}
		
		if($perscodigos_isnull){
			$rcTmp[] = ' "perscodigos" IS NULL ';
		}
		
		$sbSql = 'SELECT * FROM "organentrada" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
} //End of Class Entrada
?>