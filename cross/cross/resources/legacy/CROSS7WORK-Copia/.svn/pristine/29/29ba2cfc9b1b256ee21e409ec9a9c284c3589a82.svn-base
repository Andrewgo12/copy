<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
*  Consulta y descarga archivos
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-sep-2004 9:05:31
* @location Cali-Colombia
*/
function smarty_function_view_producto_image($params, &$smarty){
    
    extract($_REQUEST);

    $objService = Application::loadServices('General');
    $rcTipos = $objService->getConstant('TIPO_FILE');
    $objService = Application::loadServices('General');
    $gateway = $objService->loadGateway('Archivos');
    $rcFile = $gateway->getByRefArchivos($rcTipos["producto"],$prodcodigos);
    $objService->close();
    if(!$rcFile[0]['archcontens']){
        return null;
    }
    
    header("Content-Type: {$rcFile[0]["archmimetys"]}");
    set_time_limit(0);    
    $dataService = Application::loadServices('Data_type');
    echo trim($dataService->decode($rcFile[0]['archcontens']));
}
?>