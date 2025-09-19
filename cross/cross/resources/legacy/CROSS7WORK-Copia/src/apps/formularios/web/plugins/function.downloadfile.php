<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
*  Consulta y descarga archivos
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-sep-2004 9:05:31
* @location Cali-Colombia
*/
function smarty_function_downloadfile($params, &$smarty){
    
    extract($_REQUEST);
    if(!$archcodigon){
        echo "<script language='javascript'>window.close();</script>";
        return null;
    }
    $objService = Application::loadServices('General');
    $gateway = $objService->loadGateway('Archivos');
    $rcFile = $gateway->getByIdArchivos($archcodigon);
    $objService->close();
    if(!$rcFile[0]['archcontens']){
        echo "<script language='javascript'>window.close();</script>";
        return null;
    }
    
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=\"".$rcFile[0]['archnombres']."\";");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$rcFile[0]['archtamanon']);
    set_time_limit(0);    
    $dataService = Application::loadServices('Data_type');
    echo trim($dataService->decode($rcFile[0]['archcontens']));
}
?>