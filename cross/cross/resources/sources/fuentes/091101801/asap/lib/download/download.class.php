<?php   
include ('httpdownload.class.php');
class download {
	/**
	*   Propiedad intelectual del FullEngine.
	* 	Descarga el archivo pasado como parametro
	* @param string $isbNameFile Cadena con la ruta del archivo
	* @param string $isbType Cadena con el tipode descarga
	*  @return  boolean True si exito False en caso de fallo
	*  @author freina
	*  @date  22-Abr-2005 17:07
	*  @location Cali-Colombia
	*/
	function execute($isbNameFile, $isbType = "noresume") {

		settype($objManager, "object");
		settype($osbResult, "string");

		$osbResult = true;

		if (!$isbNameFile || !file_exists($isbNameFile)) {
			$osbResult = false;
			return $osbResult;
		}
		$objManager = new httpdownload();

		switch ($isbType) {
			case 'resume' :
			case 'noresume' :
				$objManager->set_byfile($isbNameFile);
				if ($isbType != 'resume')
					$objManager->use_resume = false;
				$objManager->download();
				break;
			case 'data' :
			case 'dataresume' :
				$data = implode('', file($isbNameFile));
				$objManager->set_bydata($data);
				if ($isbType != 'dataresume')
					$objManager->use_resume = false;
				$objManager->set_filename(basename($isbNameFile));
				$objManager->download();
				break;
			case 'auth' :
				$objManager->set_byfile($isbNameFile);
				$objManager->use_auth = true;
				$objManager->handler['auth'] = "test_auth";
				$objManager->download();
				break;
		}

		return $osbResult;
	}
}
function test_auth($user, $pass) { //test authentication function
	if ($user == 'user' && $pass == 'pass')
		return true;
	return false;
}
?>