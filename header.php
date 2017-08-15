<?php
//  ___  ____       _  ______ _ _        _   _           _
//  |  \/  (_)     (_) |  ___(_) |      | | | |         | |
//  | .  . |_ _ __  _  | |_   _| | ___  | |_| | ___  ___| |_
//  | |\/| | | '_ \| | |  _| | | |/ _ \ |  _  |/ _ \/ __| __|
//  | |  | | | | | | | | |   | | |  __/ | | | | (_) \__ \ |_
//  \_|  |_/_|_| |_|_| \_|   |_|_|\___| \_| |_/\___/|___/\__|
//
// by GalaxyScripts.com                version 1.5
// original source code by Jim (j-fx.ws)
////////////////////////////////////////////////////////

require_once("./config.php");

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $compname . " - " . $slogan ;?></title>
<meta name="description" content="Free File Hosting Script">
<meta name="author" content="Inekai">
<meta name="keywords" content="File, Hosting, Script, Free">
<meta name="expire" content="never">
<link rel="stylesheet" type="text/css" href="css/<?php echo $style ?> ">
</head><body>
<center><table style="margin-top:10px;width:790px;height:2;">
<tr><td style="padding-bottom:10px;" height="1">
<a class="headlink" href="index.php">
<p style="margin:0px;">
<span style="font-size:32px;color:#FFFFFF;"><?php echo $compname ?></span></p></a></td>
<td align=right valign=bottom style="padding-bottom:10px;color:#ffffff" height="1">
<a class="toplinks" href="index.php"><?php echo $top_upload;?></a>&nbsp;|&nbsp;
<a class="toplinks" href="index.php?page=img"><?php echo $top_imageup;?></a>&nbsp;|&nbsp;
<a class="toplinks" href="files.php"><?php echo $top_files;?></a>&nbsp;|&nbsp;
<a class="toplinks" href="index.php?page=tos"><?php echo $top_tos;?></a> &nbsp;|&nbsp;
<a class="toplinks" href="index.php?page=faq"><?php echo $top_faq;?></a>&nbsp;|&nbsp;
<a class="toplinks" href="top.php"><?php echo $top_top;?></a> &nbsp;|&nbsp;
<a class="toplinks" href="admin.php"><?php echo $top_admin;?></a>
</td></td></tr></center>