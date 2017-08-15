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
include("./header.php");

$line="";
if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}

$rand1 =rand(0,9);
$rand2 =rand(0,9);
$rand3 =rand(0,9);
$rand4 =rand(0,9);
$rand5 =rand(0,9);
$rand6 =rand(0,9);
$secrandcode = $rand1. $rand2. $rand3. $rand4. $rand5. $rand6;

$bans=file("./secure/bans.mfh");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
?>
<center><table style='margin-top:20px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
    echo "$younallow";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
    include("./footer.php");
    die();
  }
}

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
?>

<?php
?>
<center><table style='margin-top:20px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
  echo "$inlink <br />";
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
  include("./footer.php");
  die();
}

$foundfile=0;
if (file_exists("./files/".$filecrc.".mfh")) {
	$fh1=fopen("./files/".$filecrc.".mfh", "r");
	$foundfile= explode('|', fgets($fh1));
	fclose($fh1);
}
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    $foundfile=$thisline;
  }
}

if(isset($_GET['del'])) {

$deleted=0;
$filecrc = $_GET['file'];
$filecrctxt = $filecrc . ".mfh";
$passcode = $_GET['del'];
if (file_exists("./files/".$filecrctxt)) {
	$fh2=fopen ("./files/".$filecrctxt,"r");
	$thisline= explode('|', fgets($fh2));
	if($thisline[2] == $passcode){
$deleted=1;
fclose($fh2);
		unlink("./files/".$filecrctxt);
	}

}

if($deleted==1){
unlink("./storage/".$_GET['file']);
?>
<center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
echo "<center><b>$ufwd</b></center><br />";
?> <META HTTP-EQUIV="Refresh"
      CONTENT="10; URL=index.php"> <?php
include("./squareads.php");?><p><?php

echo "<center><b>$uwbr </center></b><br />";
} else {
?><center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
echo "<center><b>$indlink2 </b></center><br />";
?> <META HTTP-EQUIV="Refresh"
      CONTENT="10; URL=index.php"> <?php
include("./squareads.php");?><p><?php

echo "<center><b>$uwbr </center></b><br />";
}
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();

}

if($foundfile==0) {
?> <center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top><?php
  echo "<center><b>$inlink</center></b><br />";
?> <META HTTP-EQUIV="Refresh"
      CONTENT="10; URL=index.php"> <?php
include("./squareads.php");?><p><?php

echo "<center><b>$uwbr</center></b><br />";
  ?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
  die();
}

if(isset($foundfile[7]) && $foundfile[7]!=md5("") && (!isset($_POST['pass']) || $foundfile[7] != md5($_POST['pass']))){
?>  <center><table style='margin-top:0px;width:790px;height:400px;'><tr><td style='border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;' valign=top>
 <p> <?php
echo "<form action=\"download.php?file=".$foundfile[0]."\" method=\"post\"><center><b>$pw2 : </center></b><p><center><input type=\"password\" name=\"pass\"><p><center><input value=\"Enter\" type=\"submit\" /></form>";
?><p><center><?php echo $petc;?></center><?php
?><p><p><?php
include("./bottomads.php");
?></center></td></tr></table><p style="margin:3px;text-align:center"><?php
include("./footer.php");
die();
}
?>
<center>
<table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
 <?php include("./ads.php");  ?>
 <center><img src="img/pic_download.gif" border=0 width=24 height=24> <font size=5><b><?php echo $dl_a_file;?></b> <img src="img/pic_download_1.gif" border=0 width=24 height=24></font><br>
<?php

$filesize = filesize("./storage/".$foundfile[0]);
//$filesize = $filesize / 1048576;

$userip=$_SERVER['REMOTE_ADDR'];
$time=time();

///////////////////////////////////////////TIMER////////////////////////////////////
$nodolimit=0;
if($filesize > $nodolimit) {
if(file_exists("./downloader/".$userip.".mfh"))
{

$downloaders = fopen("./downloader/".$userip.".mfh","r+");
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
    if ($time < $savedtime + ($downloadtimelimit*60)) {
      $youcantdownload = 1;
	  $downtimer = $time - $savedtime ;
	  $counter = $downloadtimelimit*60 - $downtimer;
    }
  }

  if ($time < $savedtime + ($downloadtimelimit*60)) {
    fputs($downloaders,"$savedip|$savedtime\n");
  }
}


if($youcantdownload==1) {

echo "<h1><center>Download Time Limit</center></h1>";
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
        document.getElementById('SessionTimeCount').innerHTML = 'Please wait ( <font color="#FF0000">' + theTime + '</font> ) Minutes for Download'
        if (running) {
            timerID = setTimeout("showCountDown()",1000)
        }
    }
}

window.onload=startTimer
</script>


<center><span id="SessionTimeCount"></span></center><br />
 <?php

	    include("./bottomads.php");
?><td><tr><table><?php
       include("./footer.php");
      die();

}

}
}
///////////////////////////////////////////TIMER///////////////////////

function HumanSize($Wert){
    if($Wert > 1099511627776){
        $Wert = number_format($Wert/1099511627776, 2, ".", ",")." TB";
    }elseif($Wert > 1073741824){
        $Wert = number_format($Wert/1073741824, 3, ",", ".")." GB";
    }elseif($Wert > 1048576){
        $Wert = number_format($Wert/1048576, 1, ".", ",")." MB";
    }elseif($Wert > 1024){
        $Wert = number_format($Wert/1024, 0, ".", ",")." kB";
    }else{
        $Wert = number_format($Wert, 0, ".", ",")." Bytes";
    }
	
	return "$Wert";
}
?>
<p>
<?php
$quantity= HumanSize($foundfile[5] * $filesize);
$d=$descriptionoption;
switch ($d)
{
case false:
 $test="";
  break;
case true:
  $test= "$fd6";
  break;
default:
  echo ""; }
$f=$foundfile[6];
if ($f=="")
  $test2= "None";
else
  $test2= "$foundfile[6]";
$e=$descriptionoption;
switch ($e)
{
case false:
 $test4="";
  break;
case true:
  $test4= "$test2";
  break;
default:
  echo ""; }

echo '<center>';
echo '<table  border="0" cellpadding="0" cellspacing="0" width="">';
echo '<tr>';
echo '<td width="16"><img src="img/top_lef.gif" width="16" height="16"></td>';
echo '<td height="16" background="img/top_mid.gif"><img src="img/top_mid.gif" width="16" height="16"></td>';
echo '<td width="24"><img src="img/top_rig.gif" width="24" height="16"></td>';
echo '</tr>';
echo '<tr>';
echo '<td width="16" background="img/cen_lef.gif"><img src="img/cen_lef.gif" width="16" height="11"></td>';
echo '<td align="center" valign="middle" bgcolor="#FFFFFF">';

echo "<img src=\"img/warning.gif\" border=0 width=12 height=12> <a href='report.php?file=$foundfile[0]' style=color:#FF0000>".$rtf."</a><br><br>";

echo "<table cellspacing=1 cellpadding=2 border=0 bgcolor=#C0C0C0>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$fn6.":</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>".$foundfile[1] ."</td></tr>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$fbu.":</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>".$quantity ."</td></tr>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$dl_ip.":</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>".$foundfile[3]."</td></tr>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$dl_filesize.":</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>".HumanSize($filesize)."</td></tr>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$dl_file_dl.":</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>". $foundfile[5]." ".$dl_file_dl1."</td></tr>";
echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">".$dl_last_dl.": </td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>".date('Y-m-d G:i', $foundfile[4])."</td></tr>\n";

if(isset($foundfile[6])){ echo "<tr><td align=left bgcolor=#F4F4F4 background=\"img/button03.gif\">$test</td><td bgcolor=#EEF4FB background=\"img/button03.gif\"><font color=#000080>$test4</td></tr>"; }
$randcounter = rand(100,999);
echo "</td></tr></table>";

?>
       </td>
      <td width="24" background="img/cen_rig.gif"><img src="img/cen_rig.gif" width="24" height="11"></td>
    </tr>
    <tr>
      <td width="16" height="16"><img src="img/bot_lef.gif" width="16" height="16"></td>
      <td height="16" background="img/bot_mid.gif"><img src="img/bot_mid.gif" width="16" height="16"></td>
      <td width="24" height="16"><img src="img/bot_rig.gif" width="24" height="16"></td>
    </tr>
  </table>
  <?php

$randcounter = rand(100,999);
?>
   <form id="form">
  <script>
function refreshh() {
window.location='<?php echo $scripturl . "download.php?file=" .$foundfile[0]; ?>';
}

function checksubmit()
{
if (document.getElementById("form").scode.value == <?php echo $secrandcode; ?> )
{
window.location='<?php echo $scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) ?>';
window.setTimeout("refreshh()", 3000);
return false;
}
else
{
alert("ERROR:\n Securitycode was wrong!\n Please input the right Securitycode to download the File!");
window.location='<?php echo $scripturl . "download.php?file=" .$foundfile[0]; ?>';
}

}
</script>
<br>
<table cellspacing=2 cellpadding=2 border=0 height=16 width="250"><tr><td align=center background="img/captcha-a.png"><font color="#C0C0C0" size="5"><b><font face=times new roman><?php echo $secrandcode;?></td><td> Securitycode: <font size=1><strong><input type="text" name="scode" size="4" /></tr></table>
</form>
<p><div id="dl" align="center">

<?php

if($downloadtimer == 0) {
echo "<input type=\"button\" value=\"".$dl_file_now."\" onClick=window.location=\"".$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR'])."\">";
} else { ?>
<?php echo $nenjava;?>

<?php } ?>
</div>
<script language="Javascript">
x<?php echo $randcounter; ?>=<?php echo $downloadtimer; ?>;
function countdown()
{
 if ((0 <= 100) || (0 > 0))
 {
  x<?php echo $randcounter; ?>--;
  if(x<?php echo $randcounter; ?> == 0)
  {
document.getElementById("dl").innerHTML = '<input type="submit" value="<?php echo $dl_file_now;?>" onClick="checksubmit()" onClick="window.location=\'<?php echo $scripturl . "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) ?>\'">';
  }
  if(x<?php echo $randcounter; ?> > 0)
  {
 document.getElementById("dl").innerHTML = '<?php echo $dl_ticket;?><br><?php echo $dl_file_now1;?> <font color=#FF0000><b> '+x<?php echo $randcounter; ?>+'</b></font> <?php echo $dl_file_now2;?>...';
   setTimeout('countdown()',1000);
  }
 }
}
countdown();
</script><p>
<?php
include("./bottomads.php");
?>
 </td></tr></table></center>
<?php
include("./footer.php");
?>
<?php
        $foo = '';

        if (!empty($_GET))
        {
                $foo .= '?';
                foreach ($_GET as $key => $val)
               {
                          $foo .= $key . '=' . $val;
               }
        }
$zufall = rand(10000000,99999999);
$ip=$_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr($ip);
$datum = date("d.m.Y",time());
$uhrzeit = date("H:i",time());
$link = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"] . $foo;
$filename =  $foundfile[1];
$refferer = $_SERVER["HTTP_REFERER"];


$newfile = "./dl/".$zufall.".db";
$f=fopen($newfile, "w");
fwrite ($f,$ip."|".$host."|".$datum."|".$uhrzeit."|".$link."|".$filename."|".$refferer);
fclose($f);
chmod($newfile,0777);

?>