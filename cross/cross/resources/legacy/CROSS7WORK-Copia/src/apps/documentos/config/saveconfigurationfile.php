<?php
#!/bin/sh


if($argv[1] == "--help" || $argv[1] == "-h"){
    echo "\n";
    echo "\tDescrpcion\n";
    echo "\tSintaxis:    php SaveConfigurationFile.php [argumentos ......]\n";
    echo "\tLos argumentos pueden ser: \n";
    echo "\tname=DBNAME\n";
    echo "\thost=HOST\n";
    echo "\tport=PORT\n";
    echo "\tuser=USER\n";
    echo "\tpassword=PASSWORD\n";
    echo "\tdriver=DRIVER\n";
    echo "\n";
    die();
}

//Define los valores para los valores de bases de datos
$rcDb["name"] = "XE";
$rcDb["type"] = "Pgsql";
$rcDb["host"] = "69.174.246.163";
$rcDb["port"] = "1521";
$rcDb["user"] = "prueba";
$rcDb["password"] = "prueba";
$rcDb["driver"] = "oci8";

$rcTmpOp = array_slice($argv, 1);
$nuOptions = sizeof($rcTmpOp);
if($nuOptions > 0){

    foreach($rcTmpOp as $key => $value){
        $rcTmp = explode("=", $value);
        $rcOption[$rcTmp[0]] = $rcTmp[1];
    }
    unset($rcTmpOp);

    if($rcOption["name"])
        $rcDb["name"] = $rcOption["name"];
    if($rcOption["host"])
        $rcDb["host"] = $rcOption["host"];
    if($rcOption["port"])
        $rcDb["port"] = $rcOption["port"];
    if($rcOption["user"])
        $rcDb["user"] = $rcOption["user"];
    if($rcOption["password"])
        $rcDb["password"] = $rcOption["password"];
    if($rcOption["driver"])
        $rcDb["driver"] = $rcOption["driver"];
}
$Application_config = array (
    'name' => 'docunet',
    'description' => 'INTEGRACIÓN CON DOCUNET',
    'version' => '3',
    "profiles" => "enabled", //or disabled
    "cache_dir" => dirname(__FILE__)."/../data/cache",
	"cache_life" => 86400,
	"app_id" => "FeDo",
// language
    'language' => 'es',
// library path
    'include_path' => array (
        dirname(__FILE__).'/../.',
        dirname(__FILE__).'/../php/classes',
        dirname(__FILE__).'/../../../lib',
        dirname(__FILE__).'/../../../lib/Smarty-2.6.0/libs',
        dirname(__FILE__).'/../../../lib/adodb',
        dirname(__FILE__).'/../../../lib/databases',
        dirname(__FILE__).'/../../../lib/pear',
        dirname(__FILE__).'/../../../lib/excel/excelwriter-2004-12-30',
        dirname(__FILE__).'/../../../lib/html2pdf',
        dirname(__FILE__).'/../../../lib/word',
        dirname(__FILE__).'/../../../lib/graph',
        dirname(__FILE__).'/language',
        ),
        
// directories
    'commands_dir' => '/web/commands',
    'views_dir' => '/web/views',
    'templates_dir' => '/web/templates',
    'plugins_dir' => '/web/plugins',
    'icons_dir' => '/icons',
    'images_dir' => 'web/images',
    'domain_dir' => '/domain',
    'data_dir' => '/data',
    'tmp_dir' => '/tmp',
    'language_dir' => '/config/language',

// database  type = Mysql,Oracle,Pgsql
    'database' => $rcDb,
    );

$path = dirname(__FILE__)."/application.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_config));
    fclose($fd);
}else{
    die("[DOCUNET] configuration file ERROR\n");
}
//print_r($Application_config);
die("[DOCUNET] configuration file  OK\n");    
?>