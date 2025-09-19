<?php   
class FeGeAdministerPdfManager {

	var $objtmp;

	function FeGeAdministerPdfManager() {
		$this->objtmp = Application :: getDomainController('PdfManager');
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Elimina un conjunto de comunicaciones
	*   @author freina
	*	@param string $$isbcabecera (Cadena con la cabecera del el pdf)
	*	@param string $isblogo (Cadena con la ruta del logo)
	*	@param string $isbtexto (Cadena con el texto del pdf)
	*	@param string $isbcomucodigos (Cadena con el codigo de la comunicacion)
	*	@return string $osbresult (Cadena con el codigo de resultado)
	*   @date 26-Oct-2004 15:25
	*   @location Cali-Colombia
	*/
	function fncCreatePdf($isbcabecera, $isblogo, $isbtexto, $isbcomucodigos, $isbsalida="") {

		settype($osbresult, "string");
		settype($sbPdfSufix, "string");

		if ($isbtexto) {
			
			$sbPdfSufix = Application :: getConstant("PDF_SUFIX");

			$this->objtmp->sbcabecera = $isbcabecera;
			if($isblogo){
				if(file_exists($isblogo)){
					$this->objtmp->sblogo = $isblogo;
				}else{
					$this->objtmp->sblogo = "";
				}
			}

			//Creación del objeto de la clase heredada
			$this->objtmp->AliasNbPages();
			$this->objtmp->AddPage();
			$this->objtmp->SetFont('Times', 'I', 10);
			$this->objtmp->MultiCell(170,5,$isbtexto);
			if($isbsalida){
				$this->objtmp->Output($isbcomucodigos.$sbPdfSufix, $isbsalida);
			}else{
				$this->objtmp->Output();
			}
			$osbresult = true;
		} else {
			$osbresult = false;
		}
		return $osbresult;
	}
}
?>