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

include("./config.php");
include("./header.php");

$userip=$_SERVER['REMOTE_ADDR'];
$time=time();

///////////////////////////////////////////TIMER////////////////////////////////////

if(file_exists("./uploader/".$userip.".mfh"))
{

$downloaders = fopen("./uploader/".$userip.".mfh","r+");
flock($downloaders,2);

while (!feof($downloaders)) {
  $user[] = chop(fgets($downloaders,65536));
}

fseek($downloaders,0,SEEK_SET);
ftruncate($downloaders,0);

$youcantdownload = 0;
foreach ($user as $line) {
list($savedip,$savedtime) = explode('|',$line);
 if ($savedip == $userip) {
    if ($time < $savedtime + ($uploadtimelimit*60)) {
      $youcantdownload = 1;
	  $downtimer = $time - $savedtime ;
	  $counter = $uploadtimelimit*60 - $downtimer;
    }
  }

  if ($time < $savedtime + ($uploadtimelimit*60)) {
    fputs($downloaders,"$savedip|$savedtime\n");
  }
}


if($youcantdownload==1) {
?><center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top><?php
echo "<h1><center>Upload Time Limit</center></h1>";
	    ?><script type="text/javascript">

var running = false
var endTime = null
var timerID = null
var totalMinutes = <?php echo $counter;?>;

function startTimer() {
    running = true
    now = new Date()
    now = now.getTime()
    endTime = now + (1000 * totalMinutes);
    showCountDown()
}

function showCountDown() {
    var now = new Date()
    now = now.getTime()
    if (endTime - now <= 0) {
       clearTimeout(timerID)
       window.location.reload()

    } else {
        var delta = new Date(endTime - now)
        var theMin = delta.getMinutes()
        var theSec = delta.getSeconds()
        var theTime = theMin
        theTime += ((theSec < 10) ? ":0" : ":") + theSec
        document.getElementById('SessionTimeCount').innerHTML = 'Please wait ( <font color="#FF0000">' + theTime + '</font> ) Minutes for Upload'
        if (running) {
            timerID = setTimeout("showCountDown()",1000)
        }
    }
}

window.onload=startTimer
</script>


<center><span id="SessionTimeCount"></span></center><br /><br /><br /><br />
 <?php

	    include("./bottomads.php");

?><td><tr><table><?php
 include("./footer.php");
      die();

}

}

///////////////////////////////////////////TIMER///////////////////////


$sizehosted = 0; //get the storage size hosted
$handle = opendir("./storage/");
while($file = readdir($handle)) {
$sizehosted = $sizehosted + filesize ("./storage/".$file);
  if((is_dir("./storage/".$file.'/')) && ($file != '..')&&($file != '.'))
  {
  $sizehosted = $sizehosted + total_size("./storage/".$file.'/');
  }
}
$sizehosted = round($sizehosted/1024/1024,2);

if(isset($allowedtypes)){ //get allowed filetypes.
  $types = implode(", ", $allowedtypes);
  $filetypes = "<b>$allfile</b> ".$types."<br /><br />";
} else { $filetypes = ""; }

if(isset($categories)){ //get categories
  $categorylist = "$cat2: <select name=\"category\">";
  foreach($categories as $category){
    $categorylist .= "<option value=\"".$category."\">".$category."</option>";
  }
  $categorylist .= "</select><br />";
} else { $filetypes = ""; }

if(isset($_GET['page']))
  $p = $_GET['page'];
else
  $p = "0";
include 'total.php';

switch($p) {
case "tos": include("./pages/tos.php"); break;
case "faq": include("./pages/faq.php"); break;
case "img": include("./pages/image.php"); break;
default: include("./pages/upload.php"); break;
}

include("./footer.php");
?>