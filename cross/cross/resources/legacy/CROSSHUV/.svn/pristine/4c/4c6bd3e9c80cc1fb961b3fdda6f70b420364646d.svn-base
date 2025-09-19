<?php
	require_once "Web/WebRequest.class.php";
	settype($rcApps,"array");
	settype($rcTmp,"array");
	settype($rcTmp1,"array");
	settype($rcTmp2,"array");
	settype($rcTmp3,"array");
	settype($rcTmp4,"array");
	settype($sbStatusF,"string");
	settype($sbStatusA,"string");
	
	$sbStatusA = Application :: getConstant("REG_ACT");
	$sbStatusF = Application :: getConstant("FAILED_STATUS");
	$rcApps = Application :: getConstant("INTEG_APPS");
	$rcTmp = array(0=>array("label"=>$rcApps["1"],"value"=>"1"));
	$rcTmp1 = array(0=>array("label"=>"Exitoso","value"=>$sbStatusA),1=>array("label"=>"Fallido","value"=>$sbStatusF));
	$rcTmp2 = array(0=>array("label"=>"Tipo de caso","value"=>"tipoorden"),1=>array("label"=>"Clasificaci&oacute;n","value"=>"evento"),2=>array("label"=>"Subclasificaci&oacute;n","value"=>"causa"));
	$rcTmp3 = array(0=>array("label"=>"Serie","value"=>"serie"),1=>array("label"=>"Tipo de Carpeta","value"=>"tipo_carpeta"),2=>array("label"=>"Tipo de Documento","value"=>"tipo_dcto"));
	 
	$rcstate = array(0=>array(0=>array("label"=>"Si","value"=>"S"),1=>array("label"=>"No","value"=>"N")),
	1=>array(0=>array("label"=>"^","value"=>"^"),1=>array("label"=>"TAB","value"=>"TAB")),
	2=>array(0=>array("label"=>"Fecha","value"=>"date"),),
	3=>array(0=>array("label"=>"d-m-y","value"=>"d-m-y"),1=>array("label"=>"dd-mm-yy","value"=>"dd-mm-yy")),
	4=>array(0=>array("label"=>"Enviado","value"=>"S"),1=>array("label"=>"No enviado","value"=>"N")),
	5=>$rcTmp,
	6=>array(0=>array("label"=>"Activo","value"=>"A"),1=>array("label"=>"Inactivo","value"=>"I")),
	7=>array(0=>array("label"=>"Generada","value"=>"G"),1=>array("label"=>"Pendiente","value"=>"P")),
	8=>$rcTmp1,
	9=>$rcTmp2,
	10=>$rcTmp3,);
?>