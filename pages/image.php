<?php
//  ___  ____       _  ______ _ _        _   _           _   
//  |  \/  (_)     (_) |  ___(_) |      | | | |         | |  
//  | .  . |_ _ __  _  | |_   _| | ___  | |_| | ___  ___| |_ 
//  | |\/| | | '_ \| | |  _| | | |/ _ \ |  _  |/ _ \/ __| __|
//  | |  | | | | | | | | |   | | |  __/ | | | | (_) \__ \ |_ 
//  \_|  |_/_|_| |_|_| \_|   |_|_|\___| \_| |_/\___/|___/\__|
//
// by GalaxyScripts.com                  version 1.5
////////////////////////////////////////////////////////

require_once("./config.php");
include("./config2.php");

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META NAME="revisit-after" CONTENT="2 days">
<link rel="SHORTCUT ICON" href="favicon.ico">
</head>
<body>
<tr><td colspan=2 style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
  	<? include("./ads.php"); ?>
<center>
<p><center><? echo $lang[info];?></center></p>
<h1><center>Upload Image</center></h1><br>

<center>
Maximum Filesize: <b><? echo $max_size_mb; ?> MB</b>
</center>
<form method="post" enctype="multipart/form-data" action="basic.php">
    <div align="center">
    <label>
    </label>
    <INPUT NAME="userfile" TYPE="file" class="asd" size="50"><br>
<br>Allowed file types: <b>JPG | JPEG | PNG | GIF | BMP</b>
        <br><br><input name="upload" type="submit" class="asd" value="Upload"><br>
        </p>
  </div></form>
  <p>
    <input name="MAX_FILE_SIZE" value="3145728" type="hidden">
    <input name="refer" value="" type="hidden">
    <input name="brand" value="" type="hidden">

</form>
	<? include("./bottomads.php"); ?>
</center></td></tr></table><p style="margin:0px;text-align:center">