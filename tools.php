<?php
//add for log print
function printlog($name, $value){
$folder = "./logs/";
if(!is_dir($folder)){
	mkdir($folder);
}
$logfile = $folder."php".".log";
$f=fopen($logfile, "a+");
date_default_timezone_set("Asia/Shanghai");
fwrite ($f, date("Y-m-d h:i:s")." ".$_SERVER['PHP_SELF']." ".$name."=".$value."\n");
fclose($f);
}