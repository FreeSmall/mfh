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

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

$bans=file("./secure/bans.mfh");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
?> <center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top> <?php
    echo "$lang[younallow]";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
  }
}

if(!isset($_GET['a']) || !isset($_GET['b']))
{
  echo "<script>window.location = '".$scripturl."';</script>";
}

$validdownload = 0;


$filecrc = $_GET['a'];
$filecrctxt = $filecrc.".mfh";
if (file_exists("./files/".$filecrctxt)) {
	$fh = fopen ("./files/".$filecrctxt, "r");
	$thisline= explode('|', fgets($fh));
	if ($thisline[0]==$_GET['a'] && md5($thisline[2].$_SERVER['REMOTE_ADDR'])==$_GET['b'])
		$validdownload=$thisline;
	fclose($fh);
}
if($validdownload==0) {
?> <center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<?php
    echo "<center>$lang[inlink]</center>";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$filesize = filesize("./storage/".$validdownload[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize)
{
$newfile = "./downloader/".$userip.".mfh";
$f=fopen($newfile, "w");
fwrite ($f,$userip."|".$time."|");
fclose($f);
chmod($newfile,0777);
}


$validdownload[4] = time();

session_start();
printlog("logged_in", $_SESSION['logged_in']);
printlog("\$adminpass", $adminpass);
printlog("md5(md5(\$adminpass))", md5(md5($adminpass)));
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==md5(md5($adminpass))) {
	printlog("Notice:", "This need count the download times!");
}
else {

// begin separate file mod
$newfile = "./files/$filecrc" . ".mfh";
$f=fopen($newfile, "w");
fwrite ($f,$validdownload[0]."|". $validdownload[1]."|". $validdownload[2]."|". $validdownload[3]."|". $validdownload[4]."|".($validdownload[5]+1)."|".$validdownload[6]."|".$validdownload[7]."|".$validdownload[8]."|\n");
fclose($f);
// end separate file mod
}

header('Content-type: application/octetstream');
header('Content-Length: ' . filesize("./storage/".$validdownload[0]));
header('Content-Disposition: attachment; filename="'.$validdownload[1].'"');
readfile("./storage/".$validdownload[0]);

?>