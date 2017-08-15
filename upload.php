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

$junk = array('.' , ',' , '/' , '\\' , '`' , ';' , '[' , ']' , '-', "'", '*', '&', '^', '%', '$', '@', '!', '~', '+', '(', ')', '|', '{', '}', ' ', '?', ':', '"', '=', "<", ">", " &");
$multi = array('__', '___', '____', '_____', '______');

$filename = $_FILES['upfile']['name'];
$filename = str_replace("'",'',"$filename");
$filename = str_replace("&",'',"$filename");
//$filename = str_replace(" ",'%20',"$filename");
$filename = stripslashes("$filename");
$filesize = $_FILES['upfile']['size'];
$fancyurl=rand('1','999');
$rand2=("$fancyurl$filename");

$m=$shourturl;
if ($m=="true")
  $short= "";
else
  $short= "download.php?file=";

$bans=file("./secure/bans.mfh");
foreach($bans as $line)
{
  if ($line==$rand2."\n"){
?> <center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<?php
    echo "$noallow";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
   <?php echo "$nallow";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
  }
}

if(isset($allowedtypes)){
$allowed = 0;
foreach($allowedtypes as $ext) {
  if(substr($filename, (0 - (strlen($ext)+1) )) == ".".$ext)
    $allowed = 1;
}
if($allowed==0) {
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><?php
   echo "$itype";
   ?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
   die();
}
}

if(isset($categorylist)){
$validcat = 0;
foreach($categories as $cat) {
  if($_POST['category']==$cat || $_POST['category'] = ""){ $validcat = 1; }
}
if($validcat==0) {
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><?php
   echo "$icat";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
   include("./footer.php");
   die();
}
$cat = $_POST['category'];
} else { $cat = ""; }

if($filesize==0) {
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><?php
echo "$dpick";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><?php
echo "$tlarge";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

if($filesize > $nolimitsize)
{
$newfile = "./uploader/".$userip.".mfh";
$f=fopen($newfile, "w");
fwrite ($f,$userip."|".$time."|");
fclose($f);
chmod($newfile,0777);
}

$passkey = rand(100000, 999999);

if($emailoption && isset($_POST['myemail']) && $_POST['myemail']!="") {
$rand2 = urlencode($rand2);
$uploadmsg = "$ufile (".$filename.") $wup.\n  ". $udownfile . ":" . $scripturl . "$short" . $rand2 . "\n ". $udeletefile . ":" . $scripturl . "$short" . $rand2 . "&del=" . $passkey . "&ignore=" . "\n $thank";
mail($_POST['myemail'],"Your Uploaded File",$uploadmsg,"From: ". $email ."\n");
$rand2 = urldecode($rand2);
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
} else { $description = ""; }

$filelist = fopen("./files/".$rand2.".mfh","w");
fwrite($filelist, $rand2 ."|". basename($_FILES['upfile']['name']) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|".$_POST['pprotect']."|\n");

$movefile = "./storage/" . $rand2;
move_uploaded_file($_FILES['upfile']['tmp_name'], $movefile);
?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>

<?php
include("./ads.php");
echo "<center><b> $yupfile </b></center><br />";
echo "<center> $udownfile </center> <p><center> <a href=\"" . $scripturl . "$short" . $rand2 . "\">". $scripturl . "$short" . $rand2 . "</a><br />";
echo "<p><center> $udeletefile </center> <p><center> <a href=\"" . $scripturl . "$short" . $rand2 . "&del=" . $passkey . "&ignore=" . " \">". $scripturl . "$short" . $rand2 . "&del=" . $passkey . "&ignore=" . "</a><br />";
echo "<p><center> $uremfile."; ?><p><?php
include("./bottomads.php");
?>
  </td></tr></table></center>
<?php

include("./footer.php");
?>