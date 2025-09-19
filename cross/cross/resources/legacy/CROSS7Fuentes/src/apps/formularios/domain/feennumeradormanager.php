<?php
class FeEnNumeradorManager
{
	var $gateway;
    /**
    *   Propiedad intelectual del FullEngine.
    *   
    *   Instancia el gateway de la compuerta
    *   @author freina
    *   @date 13-Jul-2004 14:35 
    *   @location Cali-Colombia
    */
    function FeEnNumeradorManager()
    {
        $this->gateway = Application::getDataGateway("NumeradorExtended");
    }
    /**
    *   Propiedad intelectual del FullEngine.
    *   
    *   Obtiene el siguiente indice 
    *   @author freina
    *	@param string $numecodigos(Nombre de indice)
	*	@param  integer $nuincremento(Cantidad en la que se incrementara el indice)
	*	@return integer or null
    *   @date 13-Jul-2004 14:35 
    *   @location Cali-Colombia
    */
    function fncgetByIdNumerador($numecodigos,$nuincremento=0)
    {
    	return $this->gateway->getByIdNumeradorTrans($numecodigos,$nuincremento);
    }
}
?>