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
if(isset($_GET['language'])) {
echo "<center>You do not have permission to do that!</center>";
die;
}
include("./config.php");
include("./config2.php");
include("./header.php");?>

 <center><table style="margin-top:20px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:center;" valign=top>


<?php
$id = $_GET['id'];
?>

</div>
<div id="scalewarning" style="display: none;" align="center">
This image has been scaled down to fit your computer screen. Click on it to show it in the original size.</div>
<p align="center">

<?php

echo "<center>";
echo "<br>";
if ($_GET['id'])
{
	$id = $_GET['id'];
}
else
{
	die ("No ID Selected");
}

echo "<body bgcolor='#F2F2F3'>";
echo "<table border='0' bgcolor='white'>";
echo "<tr><td>";
echo "<img src='./$path" . $id . "'>";
echo "</td></tr>";
echo "</table>";
?>


&nbsp;</p>
<label>
<div align="center">
  <input name="textfield" type="text" value="<?print("". $scripturl ."viewer.php?id=". $id . "");  ?>" size="60" />
</div>
</label>
<br>

</body></html>


</center></td></tr></table><p style="margin:3px;text-align:center">

<?
include("./footer.php");
?>