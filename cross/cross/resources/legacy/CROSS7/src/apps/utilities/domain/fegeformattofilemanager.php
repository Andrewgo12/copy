<?php                      
class FeGeFormattoFileManager {
	var $gatewayconfigarchiv;
	var $gatewaydetaconfarch;
	var $objdate;
	function FeGeFormattoFileManager() {
		$this->gatewayconfigarchiv = Application :: getDataGateway("Configarchiv");
		$this->gatewaydetaconfarch = Application :: getDataGateway("DetaconfarchExtended");
		$this->objdate = Application :: loadServices("DateController");
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Formatea un archivo de acuerdo a un formato especificado
	*   @author freina
	*	@param string $isbcogacodigos (Codigo de la configuracion)
	*	@param array $ircfile (Arreglo con la data del archivo)
	*	@return boolean true o false (true proceso ok, false error en el proceso)
	*   @date 20-Sep-2004 13:23
	*   @location Cali-Colombia
	*/
	function fncformattofile($isbcogacodigos, $ircfile) {
		settype($rctmp, "array");
		settype($rctmpext, "array");
		settype($rcconfigarchiv, "array");
		settype($rcdetaconfarch, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($sbext, "string");
		settype($sbpos, "string");
		settype($sbpath, "string");
		settype($sbextension, "string");
		//se obtiene la configuracion y detalle del archivo
		$rctmp = $this->gatewayconfigarchiv->getByIdConfigarchiv($isbcogacodigos);
		$rcconfigarchiv = $rctmp[0];
		//si se obtuvo la configuracion
		if ($rcconfigarchiv) {
			//se realiza la validacion de extencion del archivo
			if ($rcconfigarchiv["coarextencis"]) {
				$sbresult = $this->fncvalidaext($ircfile["name"], $rcconfigarchiv["coarextencis"]);
				if (!$sbresult) {
					return 7;
				}
			}
			//entonces se obtiene el detalle
			$rcdetaconfarch = $this->gatewaydetaconfarch->getByCogacodigos($rcconfigarchiv["cogacodigos"]);
			//si se obtuvo el detalle
			if ($rcdetaconfarch) {
				// se inicia el analisis
				switch ($rcconfigarchiv["tiarcodigos"]) {
					case "1" :
						//archivos por longitud
						$rctmp = $this->fncformattofilelong($rcconfigarchiv, $rcdetaconfarch, $ircfile["path"]);
						break;
					case "2" :
						//archivos con separador
						$rctmp = $this->fncformattofilesep($rcconfigarchiv, $rcdetaconfarch, $ircfile["path"]);
						break;
				}
				//si se pudo formatear el plano
				if($rctmp){
					//se procede a crear el el nuevo plano
					$sbextension = Application :: getConstant("EXT_FILE_FOR");
					$sbpath = $ircfile["path"].".".$sbextension;
					$sbresult = $this->fncmakefile($sbpath,$rctmp);
					if($sbresult){
						$osbresult = 3;
						$this->UnsetRequestConfigarchiv();
						$this->UnsetRequestDetaconfarch();
					}else{
						$osbresult = 9;
					}
				}else{
					$osbresult = 8;
				}
			}
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea un archivo a partir de un arreglo
	*   @author freina
	*	@param string $isbpath (Cadena con la ruta en donde se creara el plano)
	*	@param array $ircdata (Arreglo con la data)
	*	@return boolean $osbresul  (Si se crea el palno true, en otro caso false)
	*   @date 22-Sep-2004 14:41
	*   @location Cali-Colombia
	*/
	function fncmakefile($isbpath,$ircdata){
		settype($osbresult,"string");
		settype($sbpath,"string");
		settype($nucant,"integer");
		settype($nucont,"integer");
		$sbpath = dirname($isbpath);
		if(is_writeable($sbpath)){
			$file = fopen($isbpath, "w");
			if(!($file===false)){
				$nucant = sizeof($ircdata);
				for($nucont=0;$nucont<$nucant;$nucont++){
					fputs($file,$ircdata[$nucont]."\n");
				}
				fclose($file);
				$osbresult = true;
			}else{
				$osbresult = false;
			}
		}
		else{
			$osbresult = false;
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Formatea un archivo con separador
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return $orcresult (Matriz con los registros formateados o null)
	*   @date 22-Sep-2004 13:25
	*   @location Cali-Colombia
	*/
	function fncformattofilesep($ircconf, $ircdetconf, $isbpathtofile) {
		settype($rctmp, "array");
		settype($orcresult, "array");
		//primero se determina si el archivo es maestro detalle
		if ($ircconf["cogamarmaess"]) {
			$orcresult = $this->fncformatfilesepmd($ircconf, $ircdetconf, $isbpathtofile);
		} else {
			$orcresult = $this->fncformatfilesep($ircconf, $ircdetconf, $isbpathtofile);
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return array $orcresult (Matriz con los registros del plano formateados o null)
	*   @date 22-Sep-2004 13:21
	*   @location Cali-Colombia
	*/
	function fncformatfilesep($ircconf, $ircdetconf, $isbpathtofile) {
		settype($orcresult, "array");
		settype($rctmpfile, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nuinicio, "integer");
		settype($sbtmp, "string");
		settype($sbnewline, "string");
		settype($sbencabezado, "string");
		$rctmpfile = file($isbpathtofile);
		if (is_array($rctmpfile) && $rctmpfile) {
			//analiza separador
			$ircconf["cogasepainis"] = $this->fncanasep($ircconf["cogasepainis"]);
			$ircconf["cogasepafins"] = $this->fncanasep($ircconf["cogasepafins"]);
			$sbencabezado = Application :: getConstant("HEAD");
			if ($ircconf["coarencabezs"] == $sbencabezado) {
				$nuinicio = 1;
			} else {
				$nuinicio = 0;
			}
			$nucant = sizeof($rctmpfile);
			for ($nucont = $nuinicio; $nucont < $nucant; $nucont ++) {
				$sbtmp = $rctmpfile[$nucont];
				$sbtmp = trim(str_replace ( "\n", "", $sbtmp));
				$rctmp = explode($ircconf["cogasepainis"],$sbtmp);
				$sbnewline = $this->fncmodreg_sep($rctmp, $ircdetconf, $ircconf["cogasepafins"]);
				$orcresult[$nucontr] = $sbnewline;
				$nucontr ++;
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return array $orcresult (Matriz con los registros del plano formateados o null)
	*   @date 22-Sep-2004 08:58
	*   @location Cali-Colombia
	*/
	function fncformatfilesepmd($ircconf, $ircdetconf, $isbpathtofile) {
		settype($orcresult, "array");
		settype($rctmpfile, "array");
		settype($rctmpm, "array");
		settype($rctmpd, "array");
		settype($rctmp, "array");
		settype($nupose, "integer");
		settype($nuposd, "integer");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nuinicio, "integer");
		settype($sbtmp, "string");
		settype($sbnewline, "string");
		settype($sbpalabra, "string");
		settype($sbflag, "string");
		settype($sbencabezado, "string");
		$sbflag = false;
		// se separa la configuracion encabezado -detalle
		$rctmp = $this->fncsepencdet($ircconf, $ircdetconf);
		$rctmpm = $rctmp["M"];
		$rctmpd = $rctmp["D"];
		if ($rctmpm && $rctmpd) {
			//se determina la posicion en la cadena en la cual se debe buscar la marca del encabezado o detalle
			$nupose = $ircconf["cogaposmaess"];
			$nuposd = $ircconf["cogaposdetas"];
			$rctmpfile = file($isbpathtofile);
			if (is_array($rctmpfile) && $rctmpfile) {
				//analiza separador
				$ircconf["cogasepainis"] = $this->fncanasep($ircconf["cogasepainis"]);
				$ircconf["cogasepafins"] = $this->fncanasep($ircconf["cogasepafins"]);
				$sbencabezado = Application :: getConstant("HEAD");
				if ($ircconf["coarencabezs"] == $sbencabezado) {
					$nuinicio = 1;
				} else {
					$nuinicio = 0;
				}
				$nucant = sizeof($rctmpfile);
				for ($nucont = $nuinicio; $nucont < $nucant; $nucont ++) {
					$sbtmp = $rctmpfile[$nucont];
					$sbtmp = trim(str_replace ( "\n", "", $sbtmp));
					$rctmp = explode($ircconf["cogasepainis"],$sbtmp);
					$sbpalabra = $rctmp[$nupose];
					if ($sbpalabra == $ircconf["cogamarmaess"]) {
						if ($sbflag) {
							$nucontr ++;
						}
						$sbflag = true;
						$sbnewline = $this->fncmodreg_sep($rctmp, $rctmpm, $ircconf["cogasepafins"]);
						$orcresult[$nucontr] = $sbnewline;
					} else {
						$sbnewline = $this->fncmodreg_sep($rctmp, $rctmpd, $ircconf["cogasepafins"]);
						$orcresult[$nucontr] .= $ircconf["cogasepafins"].$sbnewline;
					}
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param array $ircdata (arreglo con el registro a modificar)
	*	@param array $ircconfig (Arreglo con el detalle de la configuracion)
	*	@param string $isbseparador (Cadena con el separador a utilizar)
	*	@return string $osbresult (Cadena resultante)
	*   @date 22-Sep-2004 08:46
	*   @location Cali-Colombia
	*/
	function fncmodreg_sep($ircdata, $icrconfig, $isbseparador) {
		settype($rctmpc, "array");
		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbpalabra, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = sizeof($icrconfig);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			$rctmp = $icrconfig[$nucont];
			$sbpalabra = $ircdata[$nucont];
			if($rctmp["decovalinis"]){
				if($sbpalabra == $rctmp["decovalinis"]){
					$sbpalabra = $rctmp["decovalfins"];
				}
			}
			if ($rctmp["decotipos"]) {
				$sbpalabra = $this->fncmodcadena($sbpalabra, $rctmp["decotipos"], $rctmp["decoformats"]);
			}
			$rctmpc[$nucont] = $sbpalabra;
		}
		$osbresult = implode($isbseparador, $rctmpc);
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   analiza el separador
	*   @author freina
	*	@param string $isbseparador (Cadena con el separador)
	*	@return string $osbresult (Cadena con el separador a utilizar)
	*   @date 21-Sep-2004 07:52
	*   @location Cali-Colombia
	*/
	function fncanasep($isbseparador) {
		settype($osbresult, "string");
		switch ($isbseparador) {
			case "TAB" :
				$osbresult = "\t";
				break;
			default:
				$osbresult = $isbseparador;
				break;
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Formatea un archivo sin separador (longitud)
	*   @author freina
	*	@param string $isbfilename (Cadena con el nombre del archivo)
	*	@param string $isbextensions (Cadena con las posibles extenciones separadas por coma)
	*	@return boolean true o false (la extencion es valida true, no lo es false)
	*   @date 20-Sep-2004 17:35
	*   @location Cali-Colombia
	*/
	function fncvalidaext($isbfilename, $isbextensions) {
		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbpos, "string");
		$rctmp = explode(",", $isbextensions);
		$sbpos = strpos($isbfilename, ".");
		if (!($sbpos === false)) {
			$sbext = substr($isbfilename, $sbpos +1);
			if (in_array($sbext, $rctmp)) {
				$osbresult = true;
			} else {
				$osbresult = false;
			}
		} else {
			$osbresult = false;
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Formatea un archivo sin separador (longitud)
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return $orcresult (Matriz con los registros formateados o null)
	*   @date 20-Sep-2004 13:25
	*   @location Cali-Colombia
	*/
	function fncformattofilelong($ircconf, $ircdetconf, $isbpathtofile) {
		settype($rctmp, "array");
		settype($orcresult, "array");
		//primero se determina si el archivo es maestro detalle
		if ($ircconf["cogamarmaess"]) {
			$orcresult = $this->fncformatfilelongmd($ircconf, $ircdetconf, $isbpathtofile);
		} else {
			$orcresult = $this->fncformatfilelong($ircconf, $ircdetconf, $isbpathtofile);
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return array $orcresult (Matriz con los registros del plano formateados o null)
	*   @date 22-Sep-2004 06:27
	*   @location Cali-Colombia
	*/
	function fncformatfilelong($ircconf, $ircdetconf, $isbpathtofile) {
		settype($orcresult, "array");
		settype($rctmpfile, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nuinicio, "integer");
		settype($sbtmp, "string");
		settype($sbnewline, "string");
		settype($sbencabezado, "string");
		$rctmpfile = file($isbpathtofile);
		if (is_array($rctmpfile) && $rctmpfile) {
			//analiza separador
			$ircconf["cogasepainis"] = $this->fncanasep($ircconf["cogasepainis"]);
			$ircconf["cogasepafins"] = $this->fncanasep($ircconf["cogasepafins"]);
			$sbencabezado = Application :: getConstant("HEAD");
			if ($ircconf["coarencabezs"] == $sbencabezado) {
				$nuinicio = 1;
			} else {
				$nuinicio = 0;
			}
			$nucant = sizeof($rctmpfile);
			for ($nucont = $nuinicio; $nucont < $nucant; $nucont ++) {
				$sbtmp = $rctmpfile[$nucont];
				$sbnewline = $this->fncmodregsep($sbtmp, $ircdetconf, $ircconf["cogasepafins"]);
				$orcresult[$nucontr] = $sbnewline;
				$nucontr ++;
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return array $orcresult (Matriz con los registros del plano formateados o null)
	*   @date 20-Sep-2004 14:42
	*   @location Cali-Colombia
	*/
	function fncformatfilelongmd($ircconf, $ircdetconf, $isbpathtofile) {
		settype($orcresult, "array");
		settype($rctmpfile, "array");
		settype($rctmpm, "array");
		settype($rctmpd, "array");
		settype($rctmp, "array");
		settype($nupose, "integer");
		settype($nuposd, "integer");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nuinicio, "integer");
		settype($sbtmp, "string");
		settype($sbnewline, "string");
		settype($sbpalabra, "string");
		settype($sbflag, "string");
		settype($sbencabezado, "string");
		$sbflag = false;
		// se separa la configuracion encabezado -detalle
		$rctmp = $this->fncsepencdet($ircconf, $ircdetconf);
		$rctmpm = $rctmp["M"];
		$rctmpd = $rctmp["D"];
		if ($rctmpm && $rctmpd) {
			//se determina la posicion en la cadena en la cual se debe buscar la marca del encabezado o detalle
			$nupose = $this->fncdetposmar($ircconf["cogamarmaess"], $rctmpm);
			$nuposd = $this->fncdetposmar($ircconf["cogamardetas"], $rctmpd);
			$rctmpfile = file($isbpathtofile);
			if (is_array($rctmpfile) && $rctmpfile) {
				//analiza separador
				$ircconf["cogasepainis"] = $this->fncanasep($ircconf["cogasepainis"]);
				$ircconf["cogasepafins"] = $this->fncanasep($ircconf["cogasepafins"]);
				$sbencabezado = Application :: getConstant("HEAD");
				if ($ircconf["coarencabezs"] == $sbencabezado) {
					$nuinicio = 1;
				} else {
					$nuinicio = 0;
				}
				$nucant = sizeof($rctmpfile);
				for ($nucont = $nuinicio; $nucont < $nucant; $nucont ++) {
					$sbtmp = $rctmpfile[$nucont];
					$sbpalabra = substr($sbtmp, $nupose, $ircconf["cogaposmaess"]);
					if ($sbpalabra == $ircconf["cogamarmaess"]) {
						if ($sbflag) {
							$nucontr ++;
						}
						$sbflag = true;
						$sbnewline = $this->fncmodregsep($sbtmp, $rctmpm, $ircconf["cogasepafins"]);
						$orcresult[$nucontr] = $sbnewline;
					} else {
						$sbnewline = $this->fncmodregsep($sbtmp, $rctmpd, $ircconf["cogasepafins"]);
						$orcresult[$nucontr] .= $ircconf["cogasepafins"].$sbnewline;
					}
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param string $isbcadena (Cadena con el registro a modificar)
	*	@param array $ircconfig (Arreglo con el detalle de la configuracion)
	*	@param string $isbseparador (Cadena con el separador a utilizar)
	*	@return string $osbresult (Cadena resultante)
	*   @date 21-Sep-2004 13:24
	*   @location Cali-Colombia
	*/
	function fncmodregsep($isbcadena, $icrconfig, $isbseparador) {
		settype($rctmpc, "array");
		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbpalabra, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nupos, "integer");
		$nucant = sizeof($icrconfig);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			$rctmp = $icrconfig[$nucont];
			$sbpalabra = trim(substr($isbcadena, $nupos, $rctmp["decolon_posn"]));
			if($rctmp["decovalinis"]){
				if($sbpalabra == $rctmp["decovalinis"]){
					$sbpalabra = $rctmp["decovalfins"];
				}
			}
			if ($rctmp["decotipos"]) {
				$sbpalabra = $this->fncmodcadena($sbpalabra, $rctmp["decotipos"], $rctmp["decoformats"]);
			}
			$rctmpc[$nucont] = $sbpalabra;
			$nupos += $rctmp["decolon_posn"];
		}
		$osbresult = implode($isbseparador, $rctmpc);
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma una cadena y le aplica un formato determinado
	*   @author freina
	*	@param string $isbcadena (Cadena a dar formato)
	*	@param string $isbtipo (Cadena con el tipo dato)
	*	@param string $isbformato (Cadena con el tipo de formato)
	*	@return string $osbresult (Cadena formateada)
	*   @date 21-Sep-2004 14:54
	*   @location Cali-Colombia
	*/
	function fncmodcadena($isbcadena, $isbtipo, $isbformato) {
		settype($serviceDate, "object");
		settype($osbcadena, "string");
		switch ($isbtipo) {
			case "date" :
				$serviceDate = Application :: loadServices("DateController");
				$osbcadena = $serviceDate->fncdate_to_int($isbcadena, $isbformato);
				break;
		}
		return $osbcadena;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Toma linea por linea del archivo y la procesa
	*   @author freina
	*	@param string $isbmarca (Cadena con la marca del encabezado)
	*	@param array $ircconfig (Arreglo con el detalle de la configuracion)
	*	@return string $onuresult (Entero con la posicion de la marca en la cadena)
	*   @date 21-Sep-2004 10:11
	*   @location Cali-Colombia
	*/
	function fncdetposmar($isbmarca, $ircconfig) {
		settype($rctmp, "array");
		settype($onuresult, "integer");
		settype($nucont, "integer");
		settype($nucant, "integer");
		$nucant = sizeof($ircconfig);
		for ($nucont = 0; $nucont < $nucant; $nucant) {
			$rctmp = $ircconfig[$nucont];
			if ($isbmarca == $rctmp["decodescris"]) {
				break;
			} else {
				$onuresult += $rctmp["decolon_posn"];
			}
		}
		return $onuresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Separa la configuracion del encabeza de la del detalle
	*   @author freina
	*	@param array $ircconf (Arreglo con el emcabezado de la configuracion)
	*	@param array $ircdetconf (Arreglo con el detalle de la configuracion)
	*	@param string $isbpathtofile (Ruta del archivo en el servidor)
	*	@return boolean true o false (true proceso ok, false error en el proceso)
	*   @date 120-Sep-2004 14:20
	*   @location Cali-Colombia
	*/
	function fncsepencdet($ircconf, $ircdetconf) {
		settype($rctmpe, "array");
		settype($rctmpd, "array");
		settype($rctmp, "array");
		settype($orcresult, "array");
		settype($sbtmpmm, "string");
		settype($sbtmpmd, "string");
		settype($sbflagm, "string");
		settype($sbflagd, "string");
		settype($nucont, "integer");
		settype($nucant, "integer");
		settype($nuconte, "integer");
		settype($nucontd, "integer");
		$sbflagm = false;
		$sbflagd = false;
		$sbtmpmm = $ircconf["cogamarmaess"];
		$sbtmpmd = $ircconf["cogamardetas"];
		//se busca la marca maestro y detalle para determinar las longitudes
		$nucant = sizeof($ircdetconf);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			$rctmp = $ircdetconf[$nucont];
			if ($rctmp["decodescris"] == $sbtmpmm) {
				$sbflagm = true;
				$sbflagd = false;
			}
			if ($rctmp["decodescris"] == $sbtmpmd) {
				$sbflagd = true;
				$sbflagm = false;
			}
			if ($sbflagm) {
				$rctmpe[$nuconte] = $rctmp;
				$nuconte ++;
			}
			if ($sbflagd) {
				$rctmpd[$nucontd] = $rctmp;
				$nucontd ++;
			}
		}
		$orcresult["M"] = $rctmpe;
		$orcresult["D"] = $rctmpd;
		return $orcresult;
	}
	function UnsetRequestConfigarchiv() {
		unset ($_REQUEST["configarchiv__cogacodigos"]);
		unset ($_REQUEST["configarchiv__coganombres"]);
		unset ($_REQUEST["configarchiv__cogaobservas"]);
		unset ($_REQUEST["configarchiv__tiarcodigos"]);
		unset ($_REQUEST["configarchiv__cogamarmaess"]);
		unset ($_REQUEST["configarchiv__cogamardetas"]);
		unset ($_REQUEST["configarchiv__cogaposmaess"]);
		unset ($_REQUEST["configarchiv__cogaposdetas"]);
		unset ($_REQUEST["configarchiv__cogasepainis"]);
		unset ($_REQUEST["configarchiv__cogasepafins"]);
		unset ($_REQUEST["configarchiv__coarencabezs"]);
		unset ($_REQUEST["configarchiv__coarextencis"]);
	}
	function UnsetRequestDetaconfarch() {
		unset ($_REQUEST["detaconfarch__decocodigon"]);
		unset ($_REQUEST["detaconfarch__cogacodigos"]);
		unset ($_REQUEST["detaconfarch__decodescris"]);
		unset ($_REQUEST["detaconfarch__decolon_posn"]);
		unset ($_REQUEST["detaconfarch__decotipos"]);
		unset ($_REQUEST["detaconfarch__decoformats"]);
		unset ($_REQUEST["detaconfarch__decovalinis"]);
		unset ($_REQUEST["detaconfarch__decovalfins"]);
	}
}
?>