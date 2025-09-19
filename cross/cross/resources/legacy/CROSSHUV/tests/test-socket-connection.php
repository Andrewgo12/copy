<?php

settype($sbhost, "string");
settype($sbport, "string");
settype($sbfp, "string");
settype($sbtimedelay, "string");
settype($sberrno, "string");
settype($sberrstr, "string");

$sbhost= 'www.google.com';
$sbport = 80;
$sbtimedelay = 15;

$sbfpt=fsockopen($sbhost, $sbport, $sberrno, $sberrstr, $sbtimedelay);

var_dump($sbfpt);
echo "***********";
var_dump($sberrno);
echo ">>>>>>>>>>>";
var_dump($sberrstr);
?>
