<?php
#!/bin/sh


if($argv[1] == "--help" || $argv[1] == "-h"){
    echo "\n";
    echo "\tDescrpcion:  Crea un archivo serializado con la configuracion de la aplicacion\n";
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
$rcDb["name"] = "db17PRO01";
$rcDb["type"] = "Pgsql";
$rcDb["host"] = "127.0.0.1";
$rcDb["port"] = "5432";
$rcDb["user"] = "crossvossdb";
$rcDb["password"] = "";
$rcDb["driver"] = "pgsql";

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
    'name' => 'Profiles',
    'description' => 'Manejo de Usuarios',
    'version' => '0.1',
    "profiles" => "disabled", //or disabled
    "cache_dir" => dirname(__FILE__)."/../data/cache",
	"cache_life" => 86400,
	"app_id" => "FePr",
// languaje
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
        dirname(__FILE__).'/language',
        ),
// directories
    'commands_dir' => '/web/commands',
    'views_dir' => '/web/views',
    'templates_dir' => '/web/templates',
    'plugins_dir' => '/web/plugins',
    'icons_dir' => '/icons',
    'images_dir' => '/images',
    'domain_dir' => '/domain',
    'data_dir' => '/data',
    'language_dir' => '/config/language',

// database  type = Mysql,Oracle,Pgsql
    'database' => $rcDb,
     'auth_storage' => 'DB',
     'dsn' => array(
     		'dsn'=>"{$rcDb["driver"]}://{$rcDb["user"]}:{$rcDb["password"]}@{$rcDb["host"]}:{$rcDb["port"]}/{$rcDb["name"]}",
     		"table"=>'auth',
     		"usernamecol"=>'authusernams',
     		"passwordcol"=>'authuserpasss',
	        'cryptType'=>'none'
     ),
     'timezone'=>'America/Bogota',
    'charset'=>'iso-8859-1',
    );
/**
     'dsn' => array('host' => 'localhost',
			      'port' => '389',
			      'version' => 3,
			      'basedn' => 'o=fullengine',
			      'userattr' => 'sn',
			      'binddn' => 'cn=manager,o=fullengine',
			      'bindpw' => 'secret',
			      'debug'=>false)
*/
$path = dirname(__FILE__)."/application.conf.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_config));
    fclose($fd);
}else{
    die("[PROFILES] configuration file ERROR\n");
}
die("[PROFILES] configuration file OK\n");
?>