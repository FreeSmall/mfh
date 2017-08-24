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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META NAME="revisit-after" CONTENT="2 days">
<link rel="SHORTCUT ICON" href="favicon.ico">
<script type="text/javascript">
function CancelUpload() {
	alert("Cancel Upload Now");
    if (confirm("Are you sure to cancel Upload now?")) {
      window.location = "index.php";
    }else{
		alert("Upload Resumed.");
    }
}
</script>
</head>
<body>
<tr><td colspan=2 style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
  	<?php include("./ads.php"); ?>
<p><center></center></p>

<h1><center><?php echo $upload;?></center></h1>
	<br />
	<center>
	<form enctype="multipart/form-data" action="upload.php?do=verify" id="form" method="post" 
		  onsubmit="a=document.getElementById('form').style;a.display='none';b=document.getElementById('part2').style;b.display='inline';"
		  style="display: inline;">
         <table border=0 cellspacing=0 cellpadding=2><tr><td align=center colspan=2>
	<!--<img src="img/bild.gif"> --><?php echo $file_tip;?><input type="file" name="upfile" size="50" /></td></tr>
         <tr><td align=left>
	<?php if($emailoption) { ?><?php echo $emailopt;?>:</td><td align=right><input type="text" name="myemail" size="40" /></td></tr><?php } ?>
	<tr><td align=left><?php if($descriptionoption) { ?><?php echo $desopt;?>:</td><td align=right><input type="text" name="descr" size="40" /> <i>(<?php echo $opt;?>)</i></td></tr><?php } ?>
	<tr><td align=left><?php if($passwordoption) { ?><?php echo $passopt;?>:</td><td align=right><input type="text" name="pprotect" size="40" /> <i>(<?php echo $opt;?>)</i></td></tr><?php } ?>
         <tr><td align=center colspan=2><?php if(isset($categorylist)) { echo $categorylist; } ?></td></tr></table>
	<p><center><input type="submit" value="<?php echo $upload_btn;?>" id="upload" /></center>
	</form>
         <div id="part2" style="display: none;">
<script language="javascript" src="xp_progress.js"></script>
<?php echo $progress;?>
<BR><BR>
<script type="text/javascript">
var bar1= createBar(300,15,'white',1,'black','blue',85,7,3,"");
</script>
<br>
<div align="center">
<form>
<input type="button" value="Cancel Upload" onclick="CancelUpload()">
</form>
</div>
</div>	<br /><?php echo $hosting;?>  <b><?php echo $totalf; ?></b> <?php echo $files;?> <b><?php echo $sizehosted; ?></b> MB <?php echo $total;?>
<p>	<?php include("./bottomads.php"); ?>
</center></td></tr></table><p style="margin:3px;text-align:center">