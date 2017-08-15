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

if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
require_once("./config.php");
include("./header.php");

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

if($act=="login"){
if($_POST['passwordx']==$adminpass){
$_SESSION['logged_in'] = md5(md5($adminpass));
}
}
if($act=="logout"){
session_unset();
echo "";
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==md5(md5($adminpass))) {

$filecrctxt = $filecrc . ".txt";
if (file_exists("./dl/" . $filecrctxt)) {
	$fh = fopen("./dl/" . $filecrctxt, "r");
	$filedata= explode('|', fgets($fh));
         }
if(isset($_GET['delete'])) {
unlink("./dl/".$_GET['delete'].".txt");
}
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><? echo $logout;?></a> | <img src="img/blue.gif"> <a href="admin.php"><? echo $index;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><? echo $files;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><? echo $images;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><? echo $master;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><? echo $abuse;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><? echo $delete;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><? echo $bans;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><? echo $check;?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><? echo $info_1;?></a> | <img src="img/blue.gif"> <a href="settings.php"><? echo $settings;?></a> |
</td></tr></table>
</center><br />
<h1>Downloader <font size=2>( <a href="admin.php?act=files"><? echo $dlback;?></a> )</font> </h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>IP</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Remote</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><? echo $dldate;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><? echo $dltime;?></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><? echo $fname;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Referer</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><? echo $adel;?></b></td>
</tr>
<tr><td colspan=8 height=1></td></tr>
<?php
$i = 0;
$entries = 10;
$bl_anzeige = $pps3;
$dirname = "./dl";
$dh = opendir( $dirname ) or die("couldn't open directory");
$start = isset($_GET['start']) ? (intval($_GET['start'])-1)*$bl_anzeige : 0;
while ( $file = readdir( $dh ) ) {
if ($file{0} != '.') {
  $xzal=$i++;
  if($xzal>= $start && $xzal<$start+$pps3) {
  $filecrc = str_replace(".txt","",$file);
  $fh = fopen ("./dl/".$file, "r");
  $filedata= explode('|', fgets($fh));
  echo "<tr><td align=center bgcolor=#F9F9F9>".$i."</td>";
  echo "<td align=left bgcolor=#F9F9F9>".$filedata[0]."</td>";
  echo "<td align=center bgcolor=#F9F9F9>".$filedata[1]."</td>";
  echo "<td align=center bgcolor=#F9F9F9>".$filedata[2]."</td>";
  echo "<td align=center bgcolor=#F9F9F9>".$filedata[3]."</td>";
  echo "<td align=center style=padding-left:5px bgcolor=#F9F9F9><a href=\"".$filedata[4]."\" target=\"_blank\">".$filedata[5]."</a></td>";
  echo "<td align=center style=padding-left:5px bgcolor=#F9F9F9><a href=\"".$filedata[6]."\" target=\"_blank\">Link</a></td>";
  echo "<td align=center style=padding-left:5px bgcolor=#F9F9F9><a href=\"auswerten.php?delete=".$filecrc."\"><img src=\"img/del1.jpg\" border=0></a></td></tr>";
  fclose ($fh);
}
}
$gesamt =+ 1;
}
// Einbinden der Blätterklasse ; evtl. Pfad anpassen
// Include the pagination-class
include("bl2.php");

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
echo $pagination." ".$nav_search . $dltotal . $i++;
?>
 </td></tr></table></center>
<?
} else {
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><center>
<h1><center>Admin Login</center></h1><br />
<?
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
<form action="admin.php?act=login" method="post"><img src="img/enc.gif" border="0" width="16" height="16"> <? echo $adminlogin;?>
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
?></center></td></tr></table><p style="margin:3px;text-align:center"><?
include("./footer.php");
?>