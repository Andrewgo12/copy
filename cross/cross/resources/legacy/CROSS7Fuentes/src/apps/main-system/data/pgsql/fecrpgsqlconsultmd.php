<?php       
include_once ("pkdatabases.php");
class FeCrPgsqlconsultMd {
	var $connection;
	var $consult;
	var $objdb;
	function FeCrPgsqlconsultMd() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getDatabyparams($table_nameM, $table_nameD, $llavesM, $llavesD, $fieldsM, $fieldsD, $rcconsult = null) {
		settype($rctmp, "array");
		settype($rctmpd, "array");
		settype($rctmpj, "array");
		settype($rctmpw, "array");
		settype($rctmpc, "array");
		settype($rctmpi, "array");
		settype($orcresult, "array");
		settype($sbsql, "string");
		settype($sbPos, "string");
		settype($sbindex, "string");
		settype($sbvalue, "string");
		settype($sbcampos, "string");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		settype($nucant, "integer");
		if ($table_nameM && $table_nameD && $llavesM && $llavesD) {
			$sbsql = "SELECT ";
			if ($fieldsM) {
				$rctmp = explode(",", $fieldsM);
				foreach ($rctmp as $nucont => $sbvalue) {
					if ($rctmpi) {
						if (!(in_array($sbvalue, $rctmpi))) {
							$rctmpc[$nucontr] = '"'.$table_nameM.'"."'.$sbvalue.'"';
							$rctmpi[$nucontr] = $sbvalue;
							$nucontr ++;
						}
					} else {
						$rctmpc[$nucontr] = '"'.$table_nameM.'"."'.$sbvalue.'"';
						$rctmpi[$nucontr] = $sbvalue;
						$nucontr ++;
					}
				}
				$sbcampos = implode(",", $rctmpc);
			}
			if ($fieldsD) {
				if ($sbcampos) {
					$sbcampos .= ",";
				}
				unset ($rctmpc);
				$rctmp = explode(",", $fieldsD);
				foreach ($rctmp as $nucont => $sbvalue) {
					if ($rctmpi) {
						if (!(in_array($sbvalue, $rctmpi))) {
							$rctmpc[$nucontr] = '"'.$table_nameD.'"."'.$sbvalue.'"';
							$rctmpi[$nucontr] = $sbvalue;
							$nucontr ++;
						}
					} else {
						$rctmpc[$nucontr] = '"'.$table_nameD.'"."'.$sbvalue.'"';
						$rctmpi[$nucontr] = $sbvalue;
						$nucontr ++;
					}
				}
				$sbcampos .= implode(",", $rctmpc);
			}
			//si se escogen campos a mostrar
			if ($sbcampos) {
				$sbsql .= $sbcampos;
			} else {
				$sbsql .= " * ";
			}
			//se arma el FROM
			$sbsql .= ' FROM "'.$table_nameM.'","'.$table_nameD.'"';
			//se arma la parte del where que hace el join
			$rctmp = explode(",", $llavesM);
			$rctmpd = explode(",", $llavesD);
			$nucant = sizeof($rctmp);
			if ($nucant != sizeof($rctmpd)) {
				return null;
			}
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rctmpj[$nucont] = '"'.$table_nameM.'"."'.$rctmp[$nucont].'"'."=".'"'.$table_nameD.'"."'.$rctmpd[$nucont].'"';
			}
			$sbsql .= " WHERE ".implode(" AND ", $rctmpj);
			if ($rcconsult) {
				$sbsql .= " AND ";
				$nucont = 0;
				foreach ($rcconsult as $sbindex => $sbvalue) {
					//analiza si es tabla.campo
					$sbPos = strpos($sbindex, ".");
					if (!($sbPos === false)) {
						$sbindex = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbindex);
					} else {
						$sbindex = '"'.$sbindex.'"';
					}
					$rctmpw[$nucont] = "$sbindex='$sbvalue'";
					$nucont ++;
				}
				$sbsql .= implode(" AND ", $rctmpw);
			}
			//se ejecuta el query		
			$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
			$orcresult = $this->objdb->rcresult;
		}
		return $orcresult;
	}
}
?>