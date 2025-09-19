<?php                                
class FeGeAdministerCacheManager {
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Actualiza el cache de un archivo
	*   @author freina
	*	@param string $isbpath (Cadena con la ruta del archivo)
	*	@return boolean true o false
	*   @date 21-Dic-2004 10:15
	*   @location Cali-Colombia
	*/
	function ValidateCache($isbpath, $isbnamecache) {

		settype($rcdate, "array");
		settype($osbresult, "string");
		settype($sbpath, "string");
		settype($sbresult, "string");
		settype($nutime, "integer");

		if ($isbpath) {

			if (file_exists($isbpath)) {
				
				//se obtiene la fecha de ultima modificacion del archivo
				clearstatcache();
				$nutime = filemtime ($isbpath);
				
				//se obtiene el serializado
				$sbpath = Application :: getDirCache().'/'.$isbnamecache;
				if (file_exists($sbpath)) {
					$rcdate = Serializer :: load($sbpath);
					if($rcdate){
						if($rcdate[$isbpath] != $nutime){
							$rcdate[$isbpath] = $nutime;
							$sbresult = & Serializer :: save($rcdate, $sbpath);
							$osbresult = true;
						}else{
							$osbresult = false;
						}
					}
				} else {
					$rcdate[$isbpath] = $nutime; 
					$sbresult = & Serializer :: save($rcdate, $sbpath);
					$osbresult = true;
				}
			} else {
				$osbresult = false;
			}
		} else {
			$osbresult = false;
		}

		return $osbresult;
	}
}
?>