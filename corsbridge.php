<?php
header('Cache-Control: no-cache, private');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
//Access-Control-Allow-Headers
//"Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS"
header('Content-Type: application/xml');
//ini_set('display_errors', 0);
if (!empty($_REQUEST["locale"])) {
    $path = "./locale/".$_REQUEST["locale"].".xml";
    $xml = file_get_contents($path);
    echo $xml;    
}
if (!empty($_REQUEST["db"])) {
    $dbParam = $_REQUEST["db"];
    if (!empty($_REQUEST["sql"])) {
        $path = "./db/".$dbParam."/output.xsl";
    } else {
        $path = "./db/".$dbParam."/datatypes.xml";
    }
    $xml = file_get_contents($path);
    echo $xml;
}
if (!empty($_REQUEST["backend"])) {
    //throw new Exception();
    $backend = $_REQUEST["backend"];
    if ($backend == "php-file") {
        $phpstring = file_get_contents("./backend/".$backend."/index.php");
        /* remove <?php and ?> from script */
        $phpstring = preg_replace ( '/\<\?php/' , '' , $phpstring);        
        $phpstring = preg_replace ( '/\?\>/' , '' , $phpstring);
        $phpstring = preg_replace ( '/"data/' , '"backend/php-file/data' , $phpstring);
        eval($phpstring);
    } else {
        include_once("./backend/".$backend."/index.php");
    }
}
?>