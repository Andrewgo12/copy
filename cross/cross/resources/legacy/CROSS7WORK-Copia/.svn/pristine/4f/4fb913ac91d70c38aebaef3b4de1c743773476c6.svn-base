<?php 
include ('excelwriter.inc.php');
class excel extends ExcelWriter {
	/**
	*   Propiedad intelectual del FullEngine.
	* 	Crea un excel con la data pasada como parametro
	* 	@param	 array $ircData Arreglo con los datos del excel
		@return boolean True si exito False en caso de fallo
	*  @author freina
	*  @date  04-Abr-2005 10:38s
	*  @location Cali-Colombia
	*/
	function execute($ircData, $sbNameFile) {
		
		settype($objManager,"object");
		settype($rcTmp,"array");
		settype($osbResult,"string");
		
		$osbResult = false;
		$objManager = new ExcelWriter($sbNameFile);

		if (!$objManager){
			$objManager->error;
			return $osbResult;
		}
		
		if($ircData)
		{
			$nuCont = 1;
			foreach ($ircData as $rcTmp)
			{
				if($nuCont==1)
					$objManager->writeLine($rcTmp,"N");
				else
					$objManager->writeLine($rcTmp);
				$nuCont++;
			}
			$osbResult = true;
		}
		$objManager->close();
		return $osbResult;
	}
	
	function executeTxt($ircData,$isbFile)
	{
		settype($objManager,"object");
		settype($rcTmp,"array");
		settype($osbResult,"string");
		
		$osbResult = false;
		$isbFile = str_replace(".xls",".txt",$isbFile);
		
		$objFile = @fopen($isbFile,"w");

		if (!$objFile)
			return $osbResult;
		
		if($ircData)
		{
			foreach ($ircData as $rcRow)
			{
				$nuCont=0;
				foreach ($rcRow as $sbValue)
				{
					$sbValue = str_replace(",","",$sbValue);
					if($nuCont)
						fputs($objFile,",");
					if(is_numeric($sbValue)===false)
						if(strlen($sbValue))
							$sbValue = "'".$sbValue."'";
					fputs($objFile,$sbValue);
					$nuCont++;
				}
				fputs($objFile,"|");
			}
			$osbResult = true;
		}
		
		fclose($objFile);
		return $osbResult;
	}
}
?>