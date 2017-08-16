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
  alert("Cancel Upload now");
    if (confirm("Are you sure to cancel Upload now?")) {
      window.location = "index.php";
    }
    else
      alert("Upload Resumed."); {
    }
}
</script>
<SCRIPT language="JavaScript">
var checkobj
function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return true
else{
alert("Please read and accept terms to submit form")
return false
}
}
}
</script>
<script type="text/javascript"><!--
function agreeTerms()
{
document.getElementById("upload").disabled=false
document.getElementById("checkBox").checked=true
}
function denyTerms()
{
document.getElementById("upload").disabled=true
document.getElementById("checkBox").checked=false
}

var W3CDOM = (document.createElement && document.getElementsByTagName);

function initFileUploads() {
	if (!W3CDOM) return;
	var fakeFileUpload = document.createElement('div');
	fakeFileUpload.className = 'fakefile';
	fakeFileUpload.appendChild(document.createElement('input'));
	var image = document.createElement('img');
	image.src='button_select.gif';
	fakeFileUpload.appendChild(image);
	var x = document.getElementsByTagName('input');
	for (var i=0;i<x.length;i++) {
		if (x[i].type != 'file') continue;
		if (x[i].parentNode.className != 'fileinputs') continue;
		x[i].className = 'file hidden';
		var clone = fakeFileUpload.cloneNode(true);
		x[i].parentNode.appendChild(clone);
		x[i].relatedElement = clone.getElementsByTagName('input')[0];
		x[i].onchange = x[i].onmouseout = function () {
			this.relatedElement.value = this.value;
		}
	}
}

//--></script>

<!-- flooble Expandable Content header start -->
<script language="javascript">
// Expandable content script from flooble.com.
// For more information please visit:
//   http://www.flooble.com/scripts/expand.php
// Copyright 2002 Animus Pactum Consulting Inc.
//----------------------------------------------
var ie4 = false; if(document.all) { ie4 = true; }
function getObject(id) { if (ie4) { return document.all[id]; } else { return document.getElementById(id); } }
function toggle(link, divId) { var lText = link.innerHTML; var d = getObject(divId);
 if (lText == '+') { link.innerHTML = '-'; d.style.display = 'block'; }
 else { link.innerHTML = '+'; d.style.display = 'none'; } }
</script>
<!-- flooble Expandable Content header end   -->
</head>
<body onload="denyTerms()">
<tr><td colspan=2 style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
  	<?php include("./ads.php"); ?>
<p><center><?php echo $info;?></center></p>

<h1><center><?php echo $upload;?></center></h1>
	<br />
	<center>
	<form enctype="multipart/form-data" action="upload.php?do=verify" id="form" method="post" onsubmit="a=document.getElementById('form').style;a.display='none';b=document.getElementById('part2').style;b.display='inline';" style="display: inline;">
	<?php echo $maxsize;?> <b><?php echo $maxfilesize; ?> MB</b><br />
         <table border=0 cellspacing=0 cellpadding=2><tr><td align=center colspan=2>
	<?php echo $filetypes; ?>
	<img src="img/bild.gif"> <input type="file" name="upfile" size="50" /></td></tr>
         <tr><td align=left>
	<?php if($emailoption) { ?><?php echo $emailopt;?>:</td><td align=right><input type="text" name="myemail" size="40" /> <i>(<?php echo $opt;?>)</i></td></tr><?php } ?>
	<tr><td align=left><?php if($descriptionoption) { ?><?php echo $desopt;?>:</td><td align=right><input type="text" name="descr" size="40" /> <i>(<?php echo $opt;?>)</i></td></tr><?php } ?>
	<tr><td align=left><?php if($passwordoption) { ?><?php echo $passopt;?>:</td><td align=right><input type="text" name="pprotect" size="40" /> <i>(<?php echo $opt;?>)</i></td></tr><?php } ?>
         <tr><td align=center colspan=2><?php if(isset($categorylist)) { echo $categorylist; } ?></td></tr></table>
	<input type="checkBox" onclick="if (this.checked) {agreeTerms()} else {denyTerms()}"> <?php echo $sinfo;?> <a href="?page=tos"><?php echo $tos;?></a>. <p><center><input type="submit" value="Upload!" id="upload" /></center>
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