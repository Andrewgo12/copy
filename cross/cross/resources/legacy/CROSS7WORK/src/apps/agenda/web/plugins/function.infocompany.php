<?php
/**
* Copyright 2005 FullEngine
*
* Smarty plugin busca y pinta la información de la compañia
* @author creyes
* @return string
* @date 17-August-2005 15:29:0
* @location Cali-Colombia
*/
function smarty_function_infocompany($params,&$smarty){
    
    $service = Application::loadServices('General');
    $rcInfoCompany = $service->getParam('general','empresa');
    $img_path = "../general/web/images/".$rcInfoCompany['emprlogos'];
    $cadena = "<table align='left' >
                    <tr><td class='piedefoto'><img src='$img_path' border='0'/></td></tr>
                    <tr><td class='piedefoto'>".
                    $rcInfoCompany['emprnombres']."<br>".
                    " NIT ".$rcInfoCompany['emprnits']."<br>".
                    $rcInfoCompany['emprdireccs']." Tels:".$rcInfoCompany['emprtelefos'].
                    "</td></tr>
                </table>";
	return $cadena;
}
?> 
