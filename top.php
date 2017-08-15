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

if($topten==false){
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
<h1><center><?php echo $topten;?></h1><?php
echo "$fdis10";?>
<tr><td colspan=5 height=1></td></tr><?php
echo "$disabled10";
?></table></p></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
<h1><center><?php echo $topten;?></h1>
<p><table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $fname;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $dloads;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $size10;?></b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b><?php echo $ldload;?></b></td>
</tr>
<tr><td colspan=5 height=1></td></tr>
<?php
$me=$shourturl;
if ($me=="true")
  $short= "";
else
  $short= "download.php?file=";
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
include("./config.php");
if($topten == false){
echo "$fdis10";
die();
}
$order = array();
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != '.htaccess') {
	$fh = fopen ("./files/".$file, r);
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

$i = 1;

foreach($order as $line)
{
  $line = explode(',', $line);

$shourturl==$me;
if ($me=="true")
  $short= "";
else
  $short= "download.php?file=";

  if (isset($_GET['sortby'])) {
  	echo "<tr><td bgcolor=#F7F7F7 align=center>".$i."</td><td bgcolor=#F7F7F7 align=left><a href=\"". $short .$filedata[0] . $line[1] ."\" target=\"_blank\">".$line[0]."</a></td><td bgcolor=#F7F7F7 align=center>".$line[2]."</td>";
  } else {
  	echo "<tr><td bgcolor=#F7F7F7 align=center>".$i."</td><td bgcolor=#F7F7F7 align=left><a href=\"". $short .$filedata[0] . $line[1] ."\" target=\"_blank\">".$line[2]."</a></td><td bgcolor=#F7F7F7 align=center>".$line[0]."</td>";
  }

// Rename PATHTO with the mapname where you keep the "storage" map
 $filesize = filesize("./storage/".$line[1]);
  $filesize = ($filesize / 1048576);

  if ($filesize < 1)
  {
     $filesize = round($filesize*1024,0);
     echo "<td bgcolor=#F7F7F7 align=center>" . $filesize . " KB</td>";

  }
  else
    {
     $filesize = round($filesize,0);
     echo "<td bgcolor=#F7F7F7 align=center>" . $filesize . " MB</td>";

  }
echo "<td bgcolor=#F7F7F7 align=center>".date('Y-m-d G:i', $line[3])."</td></tr>";
if($i == 10) break;
$i++;

}
?>

</table></p></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
?>