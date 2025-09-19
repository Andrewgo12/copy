<?php
include_once("pkdatabases.php");
class FeCuPgsqlCentroConsulta{

	var $consult;
	var $objdb;
	function FeCuPgsqlCentroConsulta()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un cliente
	* @param string $clieidentifs 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 05-may-2005 14:24:41
	* @location Cali-Colombia
	*/
    function getCliente($clieidentifs){
        
        $sql = "SELECT ". 
                    "cliente.clieidentifs,". 
                    "cliente.tiidcodigos,". 
                    "cliente.clienombres,". 
                    "tipocliente.ticlnombres,". 
                    "cliente.clielocalizs,". 
                    "localizacion.locanombres,". 
                    "cliente.clietelefons,". 
                    "cliente.cliemails,". 
                    "estadoclient.esclnombres,". 
                    '(COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" '. 
                "FROM ".
                    "cliente, tipocliente, localizacion, estadoclient ".
                "WHERE ".
                    "cliente.clieidentifs = '$clieidentifs' AND ". 
                    "cliente.ticlcodigos  = tipocliente.ticlcodigos AND ". 
                    "cliente.locacodigos  = localizacion.locacodigos AND ".
                    "cliente.esclcodigos  = estadoclient.esclcodigos";
                    
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
    
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los contratos de un cliente
	* @param string $clieidentifs 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 05-may-2005 14:24:41
	* @location Cali-Colombia
	*/
	function getContratoByCliente($clieidentifs)
	{
		$sbSql = "SELECT 
                    contrato.contnics,
                    contrato.contobjetos,
                    contrato.contfchfirmn,
                    contrato.contmonton,
                    tipomoneda.timonombres
				  FROM contrato,tipomoneda
				  WHERE 
                        contrato.clieidentifs='$clieidentifs' AND 
                        contrato.timocodigos=tipomoneda.timocodigos
                    ORDER BY contrato.contfchfirmn";
        $this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un contrato.
	* @param string $contnics 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 11-may-2005 15:40:41
	* @location Cali-Colombia
	*/
    function getContratoByNic($contnics){
    
        $sql = 'SELECT 
                    "contrato"."contnics", 
                    "contrato"."clieidentifs", 
                    "cliente"."clienombres", 
                    "tipocontrato"."ticonombres", 
                    "contrato"."contobjetos", 
                    "contrato"."contmonton", 
                    "tipomoneda"."timonombres", 
                    "contrato"."contfchfirmn", 
                    "formapago"."fopanombres", 
                    "contrato"."contdescrips"
                FROM "contrato","cliente","tipocontrato","tipomoneda","formapago" 
                WHERE 
                    "contrato"."contnics" = \''.$contnics.'\' AND 
                    "contrato"."clieidentifs" = "cliente"."clieidentifs" AND 
                    "contrato"."ticocodigos" = "tipocontrato"."ticocodigos" AND 
                    "contrato"."timocodigos" = "tipomoneda"."timocodigos" AND 
                    "contrato"."fopacodigos" = "formapago"."fopacodigos"';
        $this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los productos de un contrato
	* @param string $contnics 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 12-may-2005 10:24:41
	* @location Cali-Colombia
	*/
    function getProdByContnic($contnics){

        $sql = 'SELECT 
                    "contratoprod"."prodcodigos", 
                    "producto"."prodnombres", 
                    "marca"."marcnombres", 
                    "modelo"."modenombres", 
                    "contratoprod"."coprcantidan", 
                    "contratoprod"."coprvalunidn" 
                FROM "contratoprod","producto","marca","modelo"
                WHERE 
                    "contratoprod"."contnics" = \''.$contnics.'\' AND 
                    "contratoprod"."prodcodigos" = "producto"."prodcodigos" AND 
                    "producto"."marccodigos" = "marca"."marccodigos" AND 
                    "producto"."modecodigos" = "modelo"."modecodigos" 
                ORDER BY 
                    "producto"."prodnombres" ASC';
        $this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
    }

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta un producto de un contrato
	* @param string $contnics 
	* @param string $prodcodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 12-may-2005 10:24:41
	* @location Cali-Colombia
	*/
    function getProdByContnicByProdcodigos($contnics,$prodcodigos){

        $sql = "SELECT 
                    contratoprod.prodcodigos, 
                    producto.prodnombres, 
                    marca.marcnombres, 
                    modelo.modenombres, 
                    contratoprod.coprcantidan, 
                    contratoprod.coprvalunidn, 
                    contratoprod.coprserials
                FROM contratoprod,producto,marca,modelo
                WHERE 
                    contratoprod.contnics  = '$contnics' AND 
                    contratoprod.prodcodigos  = producto.prodcodigos AND
                    producto.prodcodigos = '$prodcodigos' AND 
                    producto.marccodigos = marca.marccodigos AND 
                    producto.modecodigos  = modelo.modecodigos 
                ORDER BY 
                    producto.prodnombres ASC";
        $this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
} //End of class
?>