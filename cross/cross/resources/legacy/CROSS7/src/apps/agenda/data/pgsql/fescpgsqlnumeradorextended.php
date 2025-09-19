<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlNumeradorExtended
{
 	var $objdb;
	function FeScPgsqlNumeradorExtended()
  	{
    	$config = &ASAP::getStaticProperty('Application','config');
    	$this->objdb = new databases();
    	$this->objdb->fncadoconn($config['database']);
  	}
  	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Obtiene el proximo consecutivo de la base de datos
	*	@author freina
	*	@param string $numecodigos(Nombre de indice)
	*	@param  integer $nuincremento(Cantidad en la que se incrementara el indice)
	*	@return integer or null
	*	@date 13-Jul-2004 16:03	 
	*	@location Cali-Colombia
	*/
  	function getByIdNumeradorTrans($numecodigos,$nuincremento=0)
  	{
  		if(!$numecodigos || $nuincremento < 0){
  			return null;
  		}
  		// se inicia la transaccion
  		$this->objdb->fncadobegintrans();
  		//Se bloquea la tabla de numerador
		$this->objdb->fncadolock("numerador");
  		//Consulta el registro
    	$sql='SELECT * FROM "numerador" WHERE "numecodigos"=\''.$numecodigos.'\'';
    	$this->objdb->fncadoselect($sql,FETCH_ASSOC);
    	if(!$this->objdb->rcresult){
			//cierra transaccion
			$this->objdb->fncadorollbacktrans();
			return null;
		}
		$nuindact = $this->objdb->rcresult[0]["numeproximon"];
		//Hace el aumento del valor
		if($nuincremento){
			$nuindprox = $nuindact + $nuincremento;
		}
		else{
			$nuindprox = $nuindact + 1;
		}
		//Hace el update del registro
		$sbsql = 'UPDATE "numerador" SET "numeproximon" = '.$nuindprox.' WHERE "numecodigos"=\''.$numecodigos.'\'';
		$this->objdb->fncadoexecute($sbsql);
		if(!$this->objdb->objresult){
			//cierra transaccion
			$this->objdb->fncadorollbacktrans();
			return null;
		}
		//cierra transaccion
		$this->objdb->fncadocommittrans();
		return $nuindact;
  	}
}
?>