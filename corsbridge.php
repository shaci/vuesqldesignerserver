<?php
header('Cache-Control: no-cache, private');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/xml');
$dbParam = $_REQUEST["db"];
$path = "./db/".$dbParam."/datatypes.xml";
$xml = file_get_contents($path);
echo $xml;
//echo "<Logs><Log><id>".$_REQUEST["db"]."</id></Log></Logs>";
?>