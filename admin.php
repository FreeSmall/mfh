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

if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
include("./header.php");
if($act=="login"){
  if (md5(md5($_POST['passwordx']))==$adminpass){
    $_SESSION['logged_in'] = md5(md5($adminpass));
  }
}
if($act=="logout"){
  session_unset();
  echo "";
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==md5(md5($adminpass))) {

if(isset($_GET['download'])){
$filecrc = $_GET['download'];
$filecrctxt = $filecrc . ".mfh";
if (file_exists("./files/" . $filecrctxt)) {
	$fh = fopen("./files/" . $filecrctxt, "r");
	$filedata= explode('|', fgets($fh));
}
echo "<script>window.location='".$scripturl."download2.php?a=".$filecrc."&b=".md5($filedata[1].$_SERVER['REMOTE_ADDR'])."';</script>";
fclose ($fh);
}

if(isset($_GET['act']) && $_GET['act']=="image") {
if(isset($_GET['delete1'])) {
unlink("./imgfiles/".$_GET['delete1'].".txt");
unlink("./images/".$_GET['delete1']);
unlink("./thumbs/".$_GET['delete1']);
}
?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
</center><br />
<h1>Images</h1>
<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
<td align=center><b>#</td>
<td width=52 align=center><b>Thumb</b></td>
<td align=left><b>Image</b></td>
<td align=center><b>Size (MB)</b></td>
<td align=center><b>IP</b></td>
<td align=center><b>Delete</b></td>
</tr>
<?php
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}

$order = array();
$dirname = "./imgfiles";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != '.htaccess') {
	$fh = fopen ("./imgfiles/".$file, "r");
	$list= explode('|', fgets($fh));
	$filecrc = str_replace(".mfh","",$file);
	if (isset($_GET['sortby'])) {
		$order[] = $list[1].','.$filecrc.','.$list[5].",".$list[4];
	} else {
	    $order[] = $list[5].','.$filecrc.','.$list[1].",".$list[4];
	}
	fclose ($fh);
}
}

if (isset($_GET['sortby'])) {
	sort($order, SORT_STRING);
} else {
	sort($order, SORT_NUMERIC);
	$order = array_reverse($order);
}
$thumbnail = ("./thumbs/");

///////////iMage Dir/////////////
$i = 0;
$entries = 5;
$bl_anzeige = $entries;
$dirname2 = "./imgfiles";
$dh = opendir( $dirname ) or die("couldn't open directory");
$start = isset($_GET['start']) ? (intval($_GET['start'])-1)*$bl_anzeige : 0;
while ( $file = readdir( $dh ) ) {
if ($file{0} != '.') {
  $xzal=$i++;
  if($xzal>= $start && $xzal<$start+$entries) {
$filecrc = str_replace(".txt","",$file);
$filesize = filesize("./images/". $filecrc);
$filesize = ($filesize / 1048576);
$fh = fopen ("./imgfiles/".$file, "r");
$filedata= explode('|', fgets($fh));
echo "<tr>";
echo "<td align=center>".$i."</td>";
echo "<td width=52 align=center bgcolor=#F9F9F9><a href=\"$me"."viewer.php?id=".$filedata[1]."\" target=\"_blank\"><img width='50' height='50' src=\"" . $scripturl . "$thumbnail" . $filedata[1] . "\"></a></td>";
echo "<td align=left><a href=\"$me"."viewer.php?id=".$filedata[1]."\" target=\"_blank\">".$filedata[1]."</a></td>";
echo "<td align=center width=100>".round($filesize,2)."</td>";
echo "<td align=center width=120>".$filedata[3]."</td>";
echo "<td align=center><a href=\"admin.php?act=image&delete1=".$filecrc."\" align=center width=50>[x]</a></td>";
echo "</tr>";
  $tsize = $tsize + round($filesize,2);
  $tbandwidth = $tbandwidth + round($filesize*$filedata[5],2);
  $tdownload = $tdownload + round($filedata[5],2);
fclose ($fh);
}
}
$gesamt =+ 1;
}
// Einbinden der Blätterklasse ; evtl. Pfad anpassen
// Include the pagination-class
include("bl.php");

// Dann der Varibalen $begin_for einen Wert zuweisen
// Bei meinem Beispiel wird start  per GET (an die URL angehangen) übergeben.
$begin_for = isset($_GET['start']) ? $_GET['start'] : 1;

// Dann wird $gesamt übergeben.
// Gesamt sind die gesamten Eintrge die vorhanden sind.
// Wie Du gesamt ermittelst hängt von deinem Code ab, ob aus DB oder File
$gesamt = $file;

// Nun wird die Navi-Leiste erzeugt und an $nav_search übergeben
$nav_search = $bl->nav($i, $begin_for);

closedir( $dh );
echo "</table>";
// An der Stelle wo die Ausgabe erfolgen soll
echo "<div align=left>Page: " .$nav_search . " Images: " . $i++ . "</div>";
///////////End Image Dir
?>
</center></td></tr></table><p style="margin:3px;text-align:center">
<?php
include("./footer.php");
die();
}

if(isset($_GET['delete'])) {

unlink("./files/".$_GET['delete'].".mfh");
unlink("./storage/".$_GET['delete']);



if(isset($_GET['banreport'])) {

$bannedfile = $_GET['banreport'];
if (file_exists("./files/$bannedfile".".mfh")) {
	unlink("./files/".$bannedfile.".mfh");
	unlink("./storage/".$bannedfile);
	$deleted=$bannedfile;
}
$fc=file("./secure/reports.mfh");
$f=fopen("./secure/reports.mfh","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['banreport'])
    fputs($f,$line);
}
fclose($f);
$f=fopen("./secure/bans.mfh","a+");
fputs($f,$deleted[3]."\n".$deleted[0]."\n");
unlink("./storage/".$_GET['banreport']);
}
}
if(isset($_GET['ignore'])) {

$fc=file("./secure/reports.mfh");
$f=fopen("./secure/reports.mfh","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['ignore'])
    fputs($f,$line);
}
fclose($f);
}

if(isset($_GET['act']) && $_GET['act']=="bans") {

if(isset($_GET['unban'])) {
$fc=file("./secure/bans.mfh");
$f=fopen("./secure/bans.mfh","w+");
foreach($fc as $line)
{
  if (md5($line) != $_GET['unban'])
    fputs($f,$line);
}
fclose($f);
}

if(isset($_POST['banthis'])) {
$f=fopen("./secure/bans.mfh","a+");
fputs($f,$_POST['banthis']."\n");
}


?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
</center><br />
<h1>Ban-Management</h1><p>
<center><form action="admin.php?act=bans" method="post"><?php echo $ban_text;?><br><br>
<input type="text" name="banthis" size=35>
<input type="submit" value="BAN!">
<br />
</form></center>
<?php

$fc=file("./secure/bans.mfh");
foreach($fc as $line)
{
  echo $line . " - <a href=\"admin.php?act=bans&unban=".md5($line)."\">unban</a><br />";
}
?>
</center></td></tr></table><p style="margin:3px;text-align:center">
<?php
include("./footer.php");
die();
}

if(isset($_GET['act']) && $_GET['act']=="changedlpass") {
?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
<center><br>
<h1><?php echo $master;?></h1>
<p><center>
<form action="admin.php?act=changedlpass" method="post">
  <p align=center><?php echo $set_master;?><br><br><center>
  <table border=0 cellspacing=3 cellpadding=0><tr><td align=left>
  <?php echo $set_master_1;?></td><td>
    <input type="text" name="changedlpass1" size=35></td></tr>
    <tr><td colspan=2 align=center>
    <input type="submit" value="<?php echo $set_master_now;?>">
    </td></tr></table>
  </div>
</form></center>
</center></td></tr></table><p style="margin:3px;text-align:center">
<?php
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != ".htaccess") {
  $fh=fopen("./files/" . $file ,"r");
  $filedata= explode('|', fgets($fh));
  if ($filedata[7])
  {
  $filelist = fopen("./files/$filedata[0].mfh","w");
fwrite($filelist, $filedata[0]."|".$filedata[1]."|".$filedata[2]."|".$filedata[3]."|".$filedata[4]."|".$filedata[5]."|".$filedata[6]."|".md5($_POST['changedlpass1'])."|".$filedata[8]."|");
  }
  fclose($fh);
}
}
closedir( $dh );
?>
</center></td></tr></table><p style="margin:3px;text-align:center">
<?php
include ("./footer.php");
die();
}
if(isset($_GET['act']) && $_GET['act']=="info") {
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
<center><br>
<h1><?php echo $info_11;?></h1>
<center>

<?php
$arr = array(
    array('FTP-Server', 21),
    array('SSH-Server', 22),
    array('SMTP Mail-Server', 25),
    array('DNS-Server', 53),
    array('HTTP Web-Server', 80),
    array('POP3 Mail-Server', 110),
    array('HTTPS Web-Server', 443),
    array('MySQL-Server', 3306)
);

function getStat($_statPath)
{
    if (trim($_statPath) == '') {
        $_statPath = '/proc/stat';
    }

    ob_start();
    passthru('cat '.$_statPath);
    $stat = ob_get_contents();
    ob_end_clean();


    if (substr($stat, 0, 3) == 'cpu') {
        $parts = explode(" ", preg_replace("!cpu +!", "", $stat));
    } else {
        return false;
    }

    $return = array();
    $return['user'] = $parts[0];
    $return['nice'] = $parts[1];
    $return['system'] = $parts[2];
    $return['idle'] = $parts[3];
    return $return;
}

function getCpuUsage($_statPath = '/proc/stat') {
    $time1 = getStat($_statPath) or die("getCpuUsage(): couldn't access STAT path or STAT file invalid\n");
    sleep(1);
    $time2 = getStat($_statPath) or die("getCpuUsage(): couldn't access STAT path or STAT file invalid\n");

    $delta = array();

    foreach ($time1 as $k=>$v) {
        $delta[$k] = $time2[$k] - $v;
    }

    $deltaTotal = array_sum($delta);
    $percentages = array();

    foreach ($delta as $k=>$v) {
        $percentages[$k] = round($v / $deltaTotal * 100, 2);
    }
    return $percentages;
}
?>
<font face="verdana" size=2>
<center><table width=350 border=0 cellspacing=1 cellpadding=3 bgcolor=#C0C0C0>
<tr>
<th colspan=3 bgcolor=#C0C0C0 background="img/button03.gif"><font color=#000000>Server: <?php echo $_SERVER['SERVER_NAME'] ?></th>
</tr>
<tr>
<td bgcolor=#C0C0C0 background="img/button03.gif" align=center><b><?php echo $sd;?></td>
<td bgcolor=#C0C0C0 background="img/button03.gif" align=center><b>Status</td>
<td bgcolor=#C0C0C0 background="img/button03.gif" align=center><b>Port</td>
</tr>
<?php
foreach($arr as $c) {
    if(@fsockopen($_SERVER['SERVER_NAME'], $c[1], $errno, $errstr, 5))  {
        $img = "img/up.png";
    } else {
        $img = "img/down.png";
    }

    echo '<tr>
        <td bgcolor="#EAEAEA" align="left">'.$c[0].'</td>
        <td align="center" bgcolor="#FFFFFF"><img src="'. $img .'" border="0" width="14" height="14" alt="" /></td>
        <td bgcolor="#EAEAEA" align="center">'.$c[1].'</td>
    </tr>';
    flush();
}
echo "</table><br>";

$cpu = getCpuUsage();
$cpulast = 100-$cpu['idle'];
echo '<center><table width=350 border=0 cellspacing=1 cellpadding=3 bgcolor=#C0C0C0>';
echo "<tr><th colspan=3 bgcolor=#000000 background=\"img/button03.gif\">";
echo "<font color=#000000>". $cpu . $_SERVER['SERVER_NAME']."</th></tr>";
echo '<tr><td colspan=3 align=center bgcolor="#EAEAEA"><center><img src="ratingbar.php?rating='.$cpulast.'" border="0"></td></tr>';
echo "<tr><td bgcolor=#EAEAEA>". $ap ."</td><td colspan=2 align=center bgcolor=#EAEAEA>" . $cpulast . "%</td></tr>";
echo '</table><br>';
echo $la.": ".date("d.m.Y - H:i",filemtime(basename($_SERVER["PHP_SELF"])));
?>

<?php
echo "</center></td></tr></table><p style=\"margin:3px;text-align:center\">";
include ("./footer.php");
die();
 }
if(isset($_GET['act']) && $_GET['act']=="check") {
if(isset($_GET['chmod']) && ($_GET['chmod']=="1")){
 chmod('./files', 0777);
 chmod('./storage', 0777);
 chmod('./downloader', 0777);
 chmod('./dl', 0777);
 chmod('./secure', 0777);
 chmod('./uploader', 0777);
 chmod('./secure/bans.mfh', 0777);
 chmod('./secure/reports.mfh', 0777);
 chmod('./secure/settings.mfh', 0777);
}
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
<center><br>
<h1><?php echo $check_1;?></h1>
<center>
<font face=verdana size=2>
<?php echo $check_2;?><br><br>
<table border=0 cellspacing=1 cellpadding=2 bgcolor=#C0C0C0>
<tr><td colspan=3 bgcolor=#C0C0C0 background="img/button03.gif" align=center><font face=verdana size=2>
<b><?php echo $folder;?></td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./files</td><td bgcolor=#F2F2F2>
<?php
$ziel="./files";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./storage</td><td bgcolor=#F2F2F2>
<?php
$ziel="./storage";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./downloader</td><td bgcolor=#F2F2F2>
<?php
$ziel="./downloader";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./dl</td><td bgcolor=#F2F2F2>
<?php
$ziel="./dl";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./secure</td><td bgcolor=#F2F2F2>
<?php
$ziel="./secure";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
./uploader</td><td bgcolor=#F2F2F2>
<?php
$ziel="./uploader";  // oder "/tmp" oder  "." etc.
$ordner=realpath($ziel);
if ($ordner===false)
    {
    echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldern;
    } else
    {
    if (is_writeable($ordner))
        {
        echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$foldere;
        } else
        {
        echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$foldernw;
        }
    }
?>
</td></tr>
<tr><td colspan=3 bgcolor=#C0C0C0 background="img/button03.gif" align=center><font face=verdana size=2>
<b><?php echo $textfiles;?></td></tr>

<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
bans.mfh
</td><td bgcolor=#F2F2F2>
<?php
$datei = "secure/bans.mfh";
if (!is_writeable($datei)) {
echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$few;
}
else {
echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$fe;
}
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
reports.mfh
</td><td bgcolor=#F2F2F2>
<?php
$datei = "secure/reports.mfh";
if (!is_writeable($datei)) {
echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$few;
}
else {
echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$fe;
}
?>
</td></tr>
<tr><td bgcolor=#F2F2F2 align=left><font face=verdana size=2>
settings.mfh
</td><td bgcolor=#F2F2F2>
<?php
$datei = "secure/settings.mfh";
if (!is_writeable($datei)) {
echo "<img src=\"img/down.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2 color=#FF0000>".$few;
}
else {
echo "<img src=\"img/up.png\"></td><td bgcolor=#F2F2F2><font face=verdana size=2>".$fe;
}
?>
</td></tr>
<tr><td colspan=3 bgcolor=#F2F2F2 align=center><font face=verdana size=2>
<form method="get" action="admin.php">
<input type="button" value="<?php echo $rp;?>" onClick="history.go(0)" />
<input type="hidden" name="act" value="check" />
<input type="hidden" name="chmod" value="1" />
<input type="submit" value="Chmod All to 777" />
</td></tr></table>
</form>
<h3><a href="phpinfo.php"><?php echo($check_3); ?></a></h3>
<?php
echo "</center></td></tr></table><p style=\"margin:3px;text-align:center\">";
include ("./footer.php");
die();
 }

if(isset($_GET['act']) && $_GET['act']=="deloldfiles") {
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
<center><br>
<h1><?php echo $delete;?></h1>
<?php
//delete old files
echo "Deleting old files...<BR>";
$deleteseconds = time() - ($deleteafter * 24 * 60 * 60);
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
$deletedfiles=false;
while ( $file = readdir( $dh ) ) {
	if ($file != '.' && $file != '..' && $file != ".htaccess") {
	  $fh=fopen("./files/" . $file ,"r");
	  $filedata= explode('|', fgets($fh));
	  
	  if ($filedata[4] < $deleteseconds) {
		$deletedfiles=true;
		echo "Deleting - " . $filedata[1] . ":<BR>"; 
		fclose($filedata);
		unlink("./files/".$file);
		echo "Deleted /files/" . $file . "<BR>"; 
		unlink("./storage/".str_replace(".txt","",$file));
		echo "Deleted /storage/" . str_replace(".txt","",$file) . "<BR><BR>"; 
	  }
	  
	  fclose($fh);
	}
}
closedir( $dh );
if (!$deletedfiles) echo "No old files to delete!<br /><br />";
echo "Deleting old files...<BR>";
$deleteseconds = time() - ($deleteafter * 24 * 60 * 60);
$dirname = "./imgfiles";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != ".htaccess") {
$fh=fopen("./imgfiles/" . $file ,"r");
$filedata= explode('|', fgets($fh));
if ($filedata[4] < $deleteseconds) {
$deletedfiles=true;
echo "Deleting - " . $filedata[1] . ":<BR>"; 
fclose($filedata);
unlink("./imgfiles/".$file);
echo "Deleted /imgfiles/" . $file . "<BR>"; 
unlink("./images/".str_replace(".txt","",$file));
echo "Deleted /images/" . str_replace(".txt","",$file) . "<BR>"; 
unlink("./thumbs/".str_replace(".txt","",$file));
echo "Deleted /thumbs/" . str_replace(".txt","",$file) . "<BR><BR>";
}
fclose($fh);
}
}
closedir( $dh );
if (!$deletedfiles) echo "No old images to delete!<br /><br />";
//done deleting old files
echo "</center></td></tr></table><p style=\"margin:3px;text-align:center\">";
include ("./footer.php");
die();
 }
if(isset($_GET['act']) && $_GET['act']=="abuse") {
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
<center><br>
<h1><?php echo $abuse_man;?></h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</td>
<td align=left bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $fname;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $pws;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Uploader</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $adel;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $ignore;?></b></td>
</tr>
<tr><td colspan=5 height=1></td></tr>
<?php

$i=1;
$xzal=$i++;
$checkreports=file("./secure/reports.mfh");
foreach($checkreports as $line)
{
  $thisreport = explode('|', $line);
$filecrc = $thisreport[0];
if (file_exists("./files/$filecrc".".mfh")) {
	$fr=fopen("./files/".$filecrc.".mfh","r");
	$foundfile= explode('|', fgets($fr));
	fclose($fr);
}
$me=$shourturl;
if ($me=="true")
  $short= "";
else
  $short= "download.php?file=";
echo "<tr><td align=center bgcolor=#F9F9F9>".$xzal."</td>";
echo "<td align=left bgcolor=#F9F9F9><a href=\"". $short .$foundfile[0]."\" target=\"_blank\">".$foundfile[1]."</td><td bgcolor=#F9F9F9 align=center>".$foundfile[9]."</td>";
echo "<td align=center bgcolor=#F9F9F9>".$foundfile[3]."</td>";
echo "<td align=center bgcolor=#F9F9F9><a href=\"admin.php?act=abuse&delete=".$foundfile[0]."&ignore=".$foundfile[0]."\"><img src=\"img/del1.jpg\" border=0></a></td>";
echo "<td align=center bgcolor=#F9F9F9><a href=\"admin.php?act=abuse&ignore=".$foundfile[0]."\">Ignore report</a></td></tr>";

}

?>
</table>
<br />
</center></td></tr></table><p style="margin:3px;text-align:center">
<?php
include ("./footer.php");
die();
}
if(isset($_GET['act']) && $_GET['act']=="files") {
?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $settings;?></a> |
</td></tr></table>
</center><br />
  <h1><?php echo $files;?> <font size=2>( <a href="auswerten.php">Download-Stats</a> )</font> </h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $fname;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $size10;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Uploader</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $dloads;?></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $bandwith;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $pws;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $adel;?></b></td>
</tr>
<tr><td colspan=7 height=1></td></tr>
<?php
$me=$shourturl;
if ($me=="true")
  $short= "";
else
  $short= "download.php?file=";
$i = 0;
$bl_anzeige = $pps1;
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
$start = isset($_GET['start']) ? (intval($_GET['start'])-1)*$bl_anzeige : 0;
while ( $file = readdir( $dh ) ) {
if ($file{0} != '.') {
  $xzal=$i++;
  if($xzal>= $start && $xzal<$start+$pps1) {
  $filecrc = str_replace(".mfh","",$file);
  $filesize = filesize("./storage/". $filecrc);
  $filesize = ($filesize / 1048576);
  $fh = fopen ("./files/".$file, "r");
  $filedata= explode('|', fgets($fh));
  echo "<tr><td align=center bgcolor=#F9F9F9>".$i."</td><td align=left bgcolor=#F9F9F9><a href=\"". $short .$filedata[0]."\" target=\"_blank\">".$filedata[1]."</a></td><td align=center bgcolor=#F9F9F9>".round($filesize,2)." MB</td>";
  echo "<td align=center bgcolor=#F9F9F9>".$filedata[3]."</td><td align=center bgcolor=#F9F9F9>".$filedata[5]."</td><td align=center style=padding-left:5px bgcolor=#F9F9F9>".round($filesize*$filedata[5],2)." MB</td><td bgcolor=#F9F9F9 align=center>".$filedata[9]."</td><td align=center style=padding-left:5px bgcolor=#F9F9F9><a href=\"admin.php?act=files&delete=".$filecrc."\"><img src=\"img/del1.jpg\" border=0></a></td></tr>";
  $tsize =+ round($filesize,2);
  $tbandwidth =+ round($filesize*$filedata[5],2);
  $tdownload =+ round($filedata[5],2);
  fclose ($fh);
}
}
$gesamt =+ 1;
}
// Include the pagination-class
include("bl.php");

// Dann der Varibalen $begin_for einen Wert zuweisen
// Bei meinem Beispiel wird start  per GET (an die URL angehangen) übergeben.
$begin_for = isset($_GET['start']) ? $_GET['start'] : 1;

// Dann wird $gesamt übergeben.
// Gesamt sind die gesamten Eintrge die vorhanden sind.
// Wie Du gesamt ermittelst hängt von deinem Code ab, ob aus DB oder File
$gesamt = $file;

// Nun wird die Navi-Leiste erzeugt und an $nav_search übergeben
$nav_search = $bl->nav($i, $begin_for);

closedir( $dh );
echo "</td></tr></table>";
// An der Stelle wo die Ausgabe erfolgen soll
echo $pagination." ".$nav_search . $ftotal . $i++;
?>
</center>
</td></tr></table><p style="margin:3px;text-align:center">
<?php
include ("./footer.php");
die();
}
?>

<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<font size=4><b><?php echo $welcome;?> <?php echo $compname ?> <?phpecho $adminpanel ?></b></font><br><br>
<script LANGUAGE="Javascript" SRC="http://galaxyscripts.com/users/call.php?page=<?php echo base64_encode($scripturl);?>"><!--
//--></SCRIPT>
<table  border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="16"><img src="img/top_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/top_mid.gif"><img src="img/top_mid.gif" width="16" height="16"></td>
      <td width="24"><img src="img/top_rig.gif" width="24" height="16"></td>
    </tr>
    <tr>
      <td width="16" background="img/cen_lef.gif"><img src="img/cen_lef.gif" width="16" height="11"></td>
      <td align="center" valign="middle" bgcolor="#FFFFFF">
<table width=700 cellspacing=0 cellpadding=5 border=0>
<tr>
<td width=20% align=center><a href="admin.php"><img src="img/index.gif" width=70 height=70 border=0</a><br><a href="admin.php"><?php echo $index;?></a></td>
<td width=20% align=center><a href="admin.php?act=files"><img src="img/files.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=files"><?php echo $files;?></a></td>
<td width=20% align=center><a href="admin.php?act=image"><img src="img/images.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=image"><?php echo $images;?></a></td>
<td width=20% align=center><a href="admin.php?act=abuse"><img src="img/abuse.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=abuse"><?php echo $abuse;?></a></td>
<td width=20% align=center><a href="admin.php?act=changedlpass"><img src="img/passwort.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=changedlpass"><?php echo $master;?></a></td>
<td width=20% align=center><a href="admin.php?act=info"><img src="img/info.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=info"><?php echo $info_1;?></a></td>
</tr><tr>
<td width=20% align=center><a href="admin.php?act=deloldfiles"><img src="img/delete.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=deloldfiles"><?php echo $delete;?></a></td>
<td width=20% align=center><a href="admin.php?act=bans"><img src="img/ban.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=bans"><?php echo $bans;?></a></td>
<td width=20% align=center><a href="settings.php"><img src="img/settings.gif" width=70 height=70 border=0</a><br><a href="settings.php"><?php echo $settings;?></a></td>
<td width=20% align=center><a href="admin.php?act=check"><img src="img/check.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=check"><?php echo $check;?></a></td>
<td width=20% align=center><a href="admin.php?act=logout"><img src="img/logout.gif" width=70 height=70 border=0</a><br><a href="admin.php?act=logout"><?php echo $logout;?></a></td>
</td></tr></table>
       </td>
      <td width="24" background="img/cen_rig.gif"><img src="img/cen_rig.gif" width="24" height="11"></td>
    </tr>
    <tr>
      <td width="16" height="16"><img src="img/bot_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/bot_mid.gif"><img src="img/bot_mid.gif" width="16" height="16"></td>
      <td width="24" height="16"><img src="img/bot_rig.gif" width="24" height="16"></td>
    </tr>
  </table>
<br>
  <table  border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="16"><img src="img/top_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/top_mid.gif"><img src="img/top_mid.gif" width="16" height="16"></td>
      <td width="24"><img src="img/top_rig.gif" width="24" height="16"></td>
    </tr>
    <tr>
      <td width="16" background="img/cen_lef.gif"><img src="img/cen_lef.gif" width="16" height="11"></td>
      <td align="center" valign="middle" bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing=0 cellpadding=3><tr><td>


<?php
$i = 1;
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != '.htaccess') {
  $filecrc = str_replace(".mfh","",$file);
  $filesize = filesize("./storage/". $filecrc);
  $filesize = ($filesize / 1048576);
  $fh = fopen ("./files/".$file, "r");
  $filedata= explode('|', fgets($fh));
  $tsize =+ round($filesize,2);
  $tbandwidth =+ round($filesize*$filedata[5],2);
  $tdownload =+ round($filedata[5],2);
  $xzal=$i++;
  fclose ($fh);

}

}
?>

<?php
function ZahlenFormatieren($Wert)
{
    if($Wert > 1099511627776){
        $Wert = number_format($Wert/1099511627776, 2, ".", ",")." TB";
    }elseif($Wert > 1073741824){
        $Wert = number_format($Wert/1073741824, 2, ".", ",")." GB";
    }elseif($Wert > 1048576){
        $Wert = number_format($Wert/1048576, 2, ".", ",")." MB";
    }elseif($Wert > 1024){
        $Wert = number_format($Wert/1024, 2, ".", ",")." kB";
    }else{
        $Wert = number_format($Wert, 2, ".", ",")." Bytes";
    }
	
	echo "$Wert";
}

$frei = disk_free_space(".");
$insgesamt = disk_total_space(".");
$belegt = $insgesamt-$frei;
$prozent_belegt = 100*$belegt/$insgesamt;
?>
</td><td>
<center><table width=340 border=0 cellspacing=1 cellpadding=3 bgcolor=#C0C0C0>
<tr><td bgcolor=#F4F4F4><?php echo $diskspace;?></td><td bgcolor=#F4F4F4><?php ZahlenFormatieren($insgesamt);?></td></tr>
<tr><td bgcolor=#F4F4F4><?php echo $in_use;?></td><td bgcolor=#F4F4F4><?php ZahlenFormatieren($belegt);?> (<?php round($prozent_belegt,"2");?>%)</td></tr>
<tr><td colspan=2 bgcolor=#F4F4F4 align=center><center><img src="ratingbar.php?rating=<?php round($prozent_belegt,"2");?>" border="8"></td></tr>
<tr><td bgcolor=#F4F4F4><?php echo $free;?></td><td bgcolor=#F4F4F4><?php ZahlenFormatieren($frei);?>
</td></tr></table></center>

</td></tr></table>
       </td>
      <td width="24" background="img/cen_rig.gif"><img src="img/cen_rig.gif" width="24" height="11"></td>
    </tr>
    <tr>
      <td width="16" height="16"><img src="img/bot_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/bot_mid.gif"><img src="img/bot_mid.gif" width="16" height="16"></td>
      <td width="24" height="16"><img src="img/bot_rig.gif" width="24" height="16"></td>
    </tr>
  </table>

</center>
</td></tr></table><p style="margin:3px;text-align:center">
<?php
} else {
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><center>
<h1><center>Admin Login</center></h1><br />
<?php
$d=$act;
if ($d=="logout")
  echo "<img src=\"img/up.png\"> <b><font color=#008000>".$adminlogout."</b></font> <p>";
else
  echo ""; ?>
  <center>
  <table  border="0" cellpadding="0" cellspacing="0" width="">
    <tr>
      <td width="16"><img src="img/top_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/top_mid.gif"><img src="img/top_mid.gif" width="16" height="16"></td>
      <td width="24"><img src="img/top_rig.gif" width="24" height="16"></td>
    </tr>
    <tr>
      <td width="16" background="img/cen_lef.gif"><img src="img/cen_lef.gif" width="16" height="11"></td>
      <td align="center" valign="middle" bgcolor="#FFFFFF">
<form action="admin.php?act=login" method="post"><img src="img/enc.gif" border="0" width="16" height="16"> <?php echo $adminlogin;?>
<input type="password" name="passwordx">
<input type="submit" value="Login">
       </td>
      <td width="24" background="img/cen_rig.gif"><img src="img/cen_rig.gif" width="24" height="11"></td>
    </tr>
    <tr>
      <td width="16" height="16"><img src="img/bot_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/bot_mid.gif"><img src="img/bot_mid.gif" width="16" height="16"></td>
      <td width="24" height="16"><img src="img/bot_rig.gif" width="24" height="16"></td>
    </tr>
  </table>
<br /><br />
</form></center>
<?php }
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
?>