<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlLlave {
	
	function FeCrPgsqlLlave() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->sbSql;
	}
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}
	function existLlave($llavvalors) {
		
		settype($sbSql,"string");
		settype($sbEstate,"string");
		$sbEstate = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "llave" WHERE "llavvalors"=\''.$llavvalors.'\' AND "llavactivas"=\''.$sbEstate.'\'';
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	function addLlave() {
		settype($sbSql,"string");
		extract($this->rcData);
		$sbSql = 'INSERT INTO "llave" ("llavcodigos","llavusuauts","llavususols",
										"usuacodigos","llavfecingd","llavfecinid",
										"llavfecvend","llavobservs","llavvalors","llavactivas")'
		.' VALUES(\''.$llavcodigos.'\',\''.$llavusuauts.'\',\''.$llavususols.'\',\''.$usuacodigos.'\','.
		$llavfecingd.','.$llavfecinid.','.$llavfecvend.',\''.$llavobservs.'\',\''.$llavvalors.'\',\''.
		$llavactivas.'\')';
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getListadoLlave(){
		settype($rcResult,"array");
		settype($sbSql,"string");
		//settype($nuLimit,"integer");
		extract($this->rcData);
		
		$sbSql = 'SELECT (COALESCE("a"."persnombres", \'\') || \' \' || COALESCE("a"."persapell1s", \'\') || \' \' || COALESCE("a"."persapell2s", \'\'))  AS "llavusuauts",
		(COALESCE("b"."persnombres", \'\') || \' \' || COALESCE("b"."persapell1s", \'\') || \' \' || COALESCE("b"."persapell2s", \'\')) AS "llavususols",
		"llavfecinid","llavfecvend","llavfecusod","llavobservs","llavvalors",
		"ordenumeros" FROM "llave", "personal" AS "a", "personal" AS "b"  ';
		$sbSql .= 'WHERE "llavfecinid" BETWEEN '.$fechaini." AND ".$fechafin;
		$sbSql .= ' AND "llavusuauts"="a"."perscodigos" AND "llavususols"="b"."perscodigos" ';
		if($llavusuauts){
			$sbSql .= ' AND "llavusuauts" = \''.$llavusuauts.'\' ';
		}
		if($llavususols){
			$sbSql .= ' AND "llavususols" = \''.$llavususols.'\' ';
		}
		if($orderby){
			$sbSql .= ' ORDER BY '.$orderby; 
		}
		
		if(!$total){
			$this->objdb->fncadoexecute($sbSql);
			$rcResult["total"] = $this->objdb->fncadorowcont();	
		}else{
			$rcResult["total"] = $total;	
		}
       
        $this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult["result"] = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;	
	}
	
	function getLlaveByLlavvalors(){
		
		settype($sbSql,"string");
		settype($sbEstate,"string");
		extract($this->rcData);
		$sbEstate = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "llave" WHERE "llavvalors"=\''.$llavvalors.'\' AND "llavactivas"=\''.$sbEstate.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
        $this->rcResult = $this->objdb->rcresult;
	}
	
	function getUpdateLlave(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'UPDATE "llave" SET "ordenumeros"=\''.$ordenumeros.'\',"llavfecusod"='.$llavfecusod.',"llavusuutis"=\''.$llavusuutis.'\' WHERE "llavvalors"=\''.$llavvalors.'\'';
		
		if(!$this->executeSql){
			$this->sbSql = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function getReporteLlave(){
		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'SELECT "a"."perscodigos" as "perscodigos1", (COALESCE("a"."persnombres", \'\') || \' \' || COALESCE("a"."persapell1s", \'\') || \' \' || COALESCE("a"."persapell2s", \'\'))  AS "llavusuauts",
		"b"."perscodigos" as "perscodigos2", (COALESCE("b"."persnombres", \'\') || \' \' || COALESCE("b"."persapell1s", \'\') || \' \' || COALESCE("b"."persapell2s", \'\')) AS "llavususols",
		"llavfecinid","llavfecvend","llavfecusod" FROM "llave", "personal" AS "a", "personal" AS "b"  ';
		$sbSql .= 'WHERE "llavfecinid" BETWEEN '.$fechaini." AND ".$fechafin;
		$sbSql .= ' AND "llavusuauts"="a"."perscodigos" AND "llavususols"="b"."perscodigos" ';
		if($llavusuauts){
			$sbSql .= ' AND "llavusuauts" = \''.$llavusuauts.'\' ';
		}
		if($llavususols){
			$sbSql .= ' AND "llavususols" = \''.$llavususols.'\' ';
		}
		if($orderby){
			$sbSql .= ' ORDER BY "llavusuauts"'; 
		}
       
        $this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;	
	}
} //End of Class Llave
?>