<?php
class FeCuContactoManager {
	var $gateway;

	function FeCuContactoManager() {
		$this->gateway = Application :: getDataGateway("contacto");
	}

	function addContacto($contindentis, $tiidcodigos, $cliecodigon, $contprinoms,
	$contsegnoms, $contpriapes, $contsegapes, $contfecnacis, $contedadn, $contsexos, $contemail,
	$locacodigos, $contdirecios, $conttelefons, $contobservs,$contnumcels) {

		if ($this->gateway->existContactoByIdentis($contindentis) == 0) {
			//Consulta el codigo del registro en la tabla de numerador
			$objnumerador = Application :: getDomainController('NumeradorManager');
			$contcodigon = $objnumerador->fncgetByIdNumerador("contacto");
			$this->gateway->addContacto($contcodigon, $contindentis, $tiidcodigos,
			$cliecodigon, $contprinoms, $contsegnoms, $contpriapes, $contsegapes,
			$contfecnacis, $contedadn, $contsexos, $contemail, $locacodigos,
			$contdirecios, $conttelefons, $contobservs,$contnumcels);
			if ($this->gateway->consult == false)
			return 100;
			$this->UnsetRequest();
			return 3;
		}else{
			return 15;
		}
	}

	function updateContacto($contcodigon, $contindentis, $tiidcodigos, $cliecodigon,
	$contprinoms, $contsegnoms, $contpriapes, $contsegapes, $contfecnacis, $contedadn, $contsexos,
	$contemail, $locacodigos, $contdirecios, $conttelefons, $contobservs, $contactivas,$contnumcels) {

		settype($rcTmp,"array");

		if ($this->gateway->existContacto($contcodigon) == 1) {
			
			//se valida que la identificacion del contacto no este registrada
			$rcTmp = $this->gateway->getByIdcontindentis($contindentis);
			if($rcTmp){
				if($rcTmp[0]["contcodigon"]!=$contcodigon){
					return 15;
				}
			}
				
			$this->gateway->updateContacto($contcodigon, $contindentis, $tiidcodigos,
			$cliecodigon, $contprinoms, $contsegnoms, $contpriapes, $contsegapes,
			$contfecnacis, $contedadn, $contsexos, $contemail, $locacodigos, $contdirecios,
			$conttelefons, $contobservs, $contactivas,$contnumcels);
			if ($this->gateway->consult == false)
			return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteContacto($contcodigon) {
		
		settype($objGateway, "object");
		settype($rcTmp, "array");
		
		if ($this->gateway->existContacto($contcodigon) == 1) {
			//Valida que el contacto no este registrado en la tabla de solicitantes
			$objGateway = Application :: getDataGateway("solicitante");
			$objGateway->setData(array("contcodigon"=>$contcodigon));
			$objGateway->getSolicitante();
			$rcTmp = $objGateway->getResult();
			if(is_array($rcTmp) && $rcTmp){
				return 100;
			}
			$this->gateway->deleteContacto($contcodigon);
			if ($this->gateway->consult == false)
			return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdContacto($contcodigon) {
		$data_contacto = $this->gateway->getByIdContacto($contcodigon);
		return $data_contacto;
	}

	function getAllContacto() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["contacto__contcodigon"]);
		unset ($_REQUEST["contacto__contindentis"]);
		unset ($_REQUEST["contacto__tiidcodigos"]);
		unset ($_REQUEST["contacto__cliecodigon"]);
		unset ($_REQUEST["contacto__cliecodigos"]);
		unset ($_REQUEST["cliecodigos_desc"]);
		unset ($_REQUEST["contacto__contfecnacis"]);
		unset ($_REQUEST["contacto__contsexos"]);
		unset ($_REQUEST["contacto__contprinoms"]);
		unset ($_REQUEST["contacto__contsegnoms"]);
		unset ($_REQUEST["contacto__contpriapes"]);
		unset ($_REQUEST["contacto__contsegapes"]);
		unset ($_REQUEST["contacto__contemail"]);
		unset ($_REQUEST["contacto__locacodigos"]);
		unset ($_REQUEST["contacto_locacodigos_desc"]);
		unset ($_REQUEST["contacto__contdirecios"]);
		unset ($_REQUEST["contacto__conttelefons"]);
		unset ($_REQUEST["contacto__contobservs"]);
		unset ($_REQUEST["contacto__contactivas"]);
		unset ($_REQUEST["contacto__contnumcels"]);
		unset ($_REQUEST["contacto__contedadn"]);
	}

	function importarContactos($path) {

		$objnumerador = Application :: getDomainController('NumeradorManager');
		$consecutivo = $objnumerador->fncgetByIdNumerador("contacto");

		$objFile = fopen($path,"r");

		while($sbLinea = fgets($objFile)) {
			$rcTmp = explode("	",$sbLinea);
			$telefono = $rcTmp[1];
			$nombre = $rcTmp[0];
			$telefono = str_replace(" ","",$telefono);
			$telefono = str_replace("\n","",$telefono);
			$telefono = str_replace("-","",$telefono);
			$nombre = str_replace("'","",$nombre);
			$rcTrans[] = "INSERT INTO contacto (contcodigon,contindentis,contnombre,tiidcodigos) VALUES (".$consecutivo.",'".$telefono."','".$nombre."','TEL');";
			$consecutivo++;
		}
		fclose($objFile);

		if(is_array($rcTrans)) {
			$rcTrans[] = "UPDATE numerador SET numeproximon=".$consecutivo." WHERE numecodigos='contacto'";
			return $this->gateway->objdb->fncadoexecutetrans($rcTrans);
		}
		else
		return false;
	}
}
?>