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
include("./header.php");

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

if(isset($_GET['file'])){
$thisfile=$_GET['file'];
}else{
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
echo "<center>$treport</center>";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}



$foundfile=0;
if (file_exists("./files/".$thisfile.".mfh")) {
	$fh1=fopen("./files/".$thisfile.".mfh","r");
	$foundfile= explode('|', fgets($fh1));
	fclose($fh1);
}


if($foundfile==0){
?><center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
echo "<center>$treport</center>";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}

$bans=file("./secure/bans.mfh");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
?><center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
    echo "<center>$uall</center>";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
  }
}

$reported = 0;
$fc=file("./secure/reports.mfh");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $thisfile)
    $reported = 1;
}

if($reported == 1) {
?> <center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<?php
echo "<center><b>$rthanks<p></b></center>";
?> <META HTTP-EQUIV="Refresh"
      CONTENT="10; URL=index.php"> <?php
include("./squareads.php");?><p><?php

echo "<center><b>$redir</center></b><br />";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}

$filelist = fopen("./secure/reports.mfh","a+");
fwrite($filelist, $thisfile ."|". $_SERVER['REMOTE_ADDR'] ."\n");
?> <center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<?php
echo "<center><b>$rthanks</b><p>";
?> <META HTTP-EQUIV="Refresh"
      CONTENT="10; URL=index.php"> <?php
include("./squareads.php");?><p><?php
echo "<center><b>$redir</center></b><br />";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");

?>