<?php 
class FeStBodegaManager {
	var $gateway;
	function FeStBodegaManager() {
		$this->gateway = Application :: getDataGateway("bodega");
	}
	function addBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados) {
		if ($this->gateway->existBodega($bodecodigos) == 0) {
			$this->gateway->addBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados) {
		if ($this->gateway->existBodega($bodecodigos) == 1) {
			$this->gateway->updateBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteBodega($bodecodigos) {
		if ($this->gateway->existBodega($bodecodigos) == 1) {
			$this->gateway->deleteBodega($bodecodigos);
			//Valida si se elimino el registro
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdBodega($bodecodigos) {
		$data_bodega = $this->gateway->getByIdBodega($bodecodigos);
		return $data_bodega;
	}
	function getAllBodega() {
		//$this->gateway->
	}
	function getByBodega_fkey($tibocodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["bodega__bodecodigos"]);
		unset ($_REQUEST["bodega__tibocodigos"]);
		unset ($_REQUEST["bodega__bodenombres"]);
		unset ($_REQUEST["bodega__bodedescrips"]);
		unset ($_REQUEST["bodega__orgacodigos"]);
		unset ($_REQUEST["bodega__bodefechcred"]);
		unset ($_REQUEST["bodega__bodefechfind"]);
		unset ($_REQUEST["bodega__bodeestados"]);
	}
}
?>	
