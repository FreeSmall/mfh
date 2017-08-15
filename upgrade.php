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


include("./config.php");
$i = 0;
$bl_anzeige = 15;
$dirname = "./files";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file{0} != '.') {

  if($xzal>= $start && $xzal<$start+15) {
  $filecrc = str_replace(".mfh","",$file);
  $filesize = ($filesize / 1048576);
  $fh = fopen ("./files/".$file, r);
  $filedata= explode('|', fgets($fh));
  $tsize = $tsize + round($filesize,2);
  $tbandwidth = $tbandwidth + round($filesize*$filedata[5],2);
  $tdownload = $tdownload + round($filedata[5],2);
  fclose ($fh);
  $rand2 = $filedata[0];
  $up = $descriptionoption;
  if ($up=="false")
  $d = "";
  else
  $d = "";

  $thisline = explode('|', $line);
$filelist = fopen("./files/". $filedata[0].".mfh","w");
fwrite($filelist, $filedata[0] ."|". $filedata[1] ."|". $filedata[2] ."|". $filedata[3] ."|".$filedata[4]."|".$filedata[5]."|".$filedata[6]."|".$filedata[7]."|".$filedata[8]."|\n");
$datfile = "./files/".$filedata[0].".txt";
unlink($datfile);
}
}
$gesamt++;
}

echo "</table></p>";

?>