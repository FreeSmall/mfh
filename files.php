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

if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
include("./header.php");

if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

if($enable_filelist==false){
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
<h1><center><?php echo $filelist;?></h1><?php
echo "$fldis";?>
<tr><td colspan=5 height=1></td></tr><?php
echo "$disfiles";
?></table></p></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
<h1><center><?php echo "$filelist";?></h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $fname;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $size10;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $dloads;?></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $ldload;?></b></td>
</tr>
<tr><td colspan=5 height=1></td></tr>
<?php
$me=$shourturl;
if ($me=="true")
  $short= "";
else
  $short= "download.php?file=";
$i = 0;
$bl_anzeige = $pps2;
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
$start = isset($_GET['start']) ? (intval($_GET['start'])-1)*$bl_anzeige : 0;
while ( $file = readdir( $dh ) ) {
if ($file{0} != '.') {
  $xzal=$i++;
  if($xzal>= $start && $xzal<$start+$pps2) {
  $filecrc = str_replace(".mfh","",$file);
  $filesize = filesize("./storage/". $filecrc);
  $filesize = ($filesize / 1048576);
  $fh = fopen ("./files/".$file, "r");
  $filedata= explode('|', fgets($fh));
  echo "<tr><td align=center bgcolor=#F9F9F9>".$i."</td><td align=left bgcolor=#F9F9F9><a href=\"". $short .$filedata[0]."\" target=\"_blank\">".$filedata[1]."</a></td><td align=center bgcolor=#F9F9F9>".round($filesize,2)." MB</td>";
  echo "<td align=center bgcolor=#F9F9F9>".$filedata[5]."</td><td align=center style=padding-left:5px bgcolor=#F9F9F9>".date('Y-m-d G:i', $filedata[4])." </td></tr>";
  $tsize =+ round($filesize,2);
  $tbandwidth =+ round($filesize*$filedata[5],2);
  $tdownload =+ round($filedata[5],2);
  fclose ($fh);
}
}
$gesamt =+ 1;
}
// Einbinden der Bl�tterklasse ; evtl. Pfad anpassen
// Include the pagination-class
include("bl1.php");

// Dann der Varibalen $begin_for einen Wert zuweisen
// Bei meinem Beispiel wird start  per GET (an die URL angehangen) �bergeben.
$begin_for = isset($_GET['start']) ? $_GET['start'] : 1;

// Dann wird $gesamt �bergeben.
// Gesamt sind die gesamten Eintrge die vorhanden sind.
// Wie Du gesamt ermittelst h�ngt von deinem Code ab, ob aus DB oder File
$gesamt = $file;

// Nun wird die Navi-Leiste erzeugt und an $nav_search �bergeben
$nav_search = $bl->nav($i, $begin_for);

closedir( $dh );
echo "</td></tr></table></center>";
// An der Stelle wo die Ausgabe erfolgen soll
echo $pagination." ".$nav_search . $ftotal . $i++;
?>
</center>
</p></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
?>