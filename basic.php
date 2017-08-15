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
include("./config2.php");
include("./header.php");
include("./bmp.php"); ?>

 <center><table style="margin-top:20px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:center;" valign=top>

<?

if (!isset($HTTP_POST_FILES['userfile'])) exit;

if (is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'])) {

if ($HTTP_POST_FILES['userfile']['size']>$max_size) {
        echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">File Size too Big!</font><br>\n"; exit; }
if (($HTTP_POST_FILES['userfile']['type']=="image/gif") || ($HTTP_POST_FILES['userfile']['type']=="image/pjpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/jpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/bmp") || ($HTTP_POST_FILES['userfile']['type']=="image/png")) {

        if (file_exists("./".$path . $HTTP_POST_FILES['userfile']['name'])) {
                echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">A File with that name exists, please rename your file.</font><br>\n"; exit; }

//generate random number
$zufall = rand(123,999999);
$fupl = "$zufall";
$imgtext = $zufall .$HTTP_POST_FILES['userfile']['name'];
$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

        $res = copy($HTTP_POST_FILES['userfile']['tmp_name'], "./".$path .$fupl .$HTTP_POST_FILES['userfile']['name']);

        if (!$res) { echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">Upload Failed, please try again</font><br>\n"; exit; } else {
	$filelist = fopen("./imgfiles/".$imgtext.".txt","w");
	fwrite($filelist, "images/" ."|".$imgtext."|". $zufall ."|". $userip ."|". $time."|\n"); 
        ?>
<br>

<?
//set url variable
$domst = "";
$drecks = "";
$imgf = $fupl.$HTTP_POST_FILES['userfile']['name'];
$thbf = $tpath.$imgf;
$urlf = $domst .$domain .$drecks .$path .$imgf;


//create thumbnails
function createthumb($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg|JPG/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png|PNG/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
	if (preg_match('/bmp|BMP/',$system[1])){
		$src_img=imagecreatefrombmp($name);
	}
	if (preg_match('/gif|GIF/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}

$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
if ($old_x > $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$old_y*($new_h/$old_x);
}
if ($old_x < $old_y) {
	$thumb_w=$old_x*($new_w/$old_y);
	$thumb_h=$new_h;
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}

$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 


if (preg_match("/png/",$system[1]))
{
	imagepng($dst_img,$filename); 
} 
if (preg_match("/gif/",$system[1]))
{
	imagegif($dst_img,$filename);
}
if (preg_match("/bmp/",$system[1]))
{
	imagebmp($dst_img,$filename);
}
else {
	imagejpeg($dst_img,$filename); 
}
imagedestroy($dst_img); 
imagedestroy($src_img); 
}

createthumb($path.$imgf,$tpath.$imgf,$tsize,$tsize);
?>


<center><a href="<? echo $domst .$scripturl .$drecks ?>viewer.php?id=<? echo $imgf; ?>"><img src="<? echo $domst.$scripturl.$drecks.$tpath.$imgf; ?>"></a></center>
<table class="table_decoration" align="center" border="0" cellpadding="1" cellspacing="0" width="100"><tbody><tr><td>
<p><center><a href="<? echo $scripturl; ?>index.php?page=img"><b>Upload</b></a> another image.</center></p><br>
Thumbnail for Websites
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="&lt;a href='<? echo $domst .$scripturl .$drecks; ?>viewer.php?id=<? echo $imgf; ?>'&gt;&lt;img src='<? echo $domst.$scripturl.$drecks.$tpath.$imgf; ?>'&gt;&lt;/a&gt;" size="70">
<br><br>
Thumbnail for Forums (1)
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="[URL='<? echo $domst .$scripturl .$drecks; ?>viewer.php?id=<? echo $imgf; ?>'][IMG]<? echo $domst.$scripturl.$drecks.$tpath.$imgf; ?>[/IMG][/URL]" size="70">
<br><br>
Thumbnail for Forums (2)
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="[url='<?  echo $urlf;  ?>'][img]<? echo $domst.$scripturl.$drecks.$tpath.$imgf; ?>[/img][/url]" size="70">
<br><br>
Hotlink for Forums (1)
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="[URL=<?print("$scripturl");  ?>][IMG]<? echo $urlf; ?>[/IMG][/URL]" size="70">
<br><br>
Hotlink for Forums (2)
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="[url=<?print("$scripturl");  ?>][img]<? echo $urlf; ?>[/img][/url]" size="70">
<br><br>
Hotlink for Websites
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="&lt;a href=&quot;<?print("$scripturl");  ?>&quot;&gt;&lt;img src=&quot;<? echo $urlf; ?>&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;" size="70">
<br><br>
<a href="<? echo $domst .$scripturl .$drecks ?>viewer.php?id=<? echo $imgf; ?>"><b>Viewer Link</b></a>
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="<? echo $domst .$scripturl .$drecks ?>viewer.php?id=<? echo $imgf; ?>" size="70">
<br><br>
Direct Link
<input name="thetext" type="text" id="thetext" style="width: 500px;" onClick="this.select();" value="<? echo $urlf; ?>" size="70">

</td></tr></tbody></table>

<?

}
} else { echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">Sorry we dont allow that file type.!</font><br>\n"; exit; }
}
?>
</table>
</center></td></tr></table><p style="margin:3px;text-align:center">

<?
include("./footer.php");
?>