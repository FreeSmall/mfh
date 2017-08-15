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

if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
if($act=="login"){
  if (md5(md5($_POST['passwordx']))==$adminpass){
    $_SESSION['logged_in'] = md5(md5($adminpass));
  }
}
if($act=="logout"){
  session_unset();
  echo "";
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==md5(md5($adminpass))) {

include("./header.php");

$passtemp = $_POST['setting16'];
if ($passtemp==null)
 $passnew = $content[16];
else
  $passnew = md5(md5($_POST['setting16']))  ;
If(isset($_POST['changesettings'])){
$fop =  fopen('secure/settings.mfh', 'w');
  $setting0 = $_POST['setting0'];
  $setting1 = $_POST['setting1'];
  $setting2 = $_POST['setting2'];
  $setting3 = $_POST['setting3'];
  $setting4 = $_POST['setting4'];
  $setting5 = $_POST['setting5'];
  $setting6 = $_POST['setting6'];
  $setting7 = $_POST['setting7'];
  $setting8 = $_POST['setting8'];
  $setting9 = $_POST['setting9'];
  $setting10 = $_POST['setting10'];
  $setting11 = $_POST['setting11'];
  $setting12 = $_POST['setting12'];
  $setting13 = $_POST['setting13'];
  $setting14 = $_POST['setting14'];
  $setting15 = $_POST['setting15'];
  $setting16 = $passnew;
  $setting17 = $_POST['setting17'];
  $setting18 = $_POST['setting18'];
  $setting19 = $_POST['setting19'];
  $setting20 = $_POST['setting20'];
  $setting21 = $_POST['setting21'];
  $setting22 = $_POST['setting22'];
  $setting23 = $_POST['setting23'];
  $setting24 = $_POST['setting24'];
  $setting25 = $_POST['setting25'];
  $setting26 = $_POST['setting26'];
  $setting27 = $_POST['setting27'];

$newcontent =  $setting0."|". $setting1."|". $setting2 ."|". $setting3 ."|". $setting4 ."|". $setting5 ."|". $setting6 ."|". $setting7 ."|". $setting8 ."|". $setting9 ."|". $setting10 ."|". $setting11 ."|". $setting12 ."|". $setting13 ."|". $setting14 ."|". $setting15 ."|". $setting16 ."|". $setting17 ."|". $setting18 ."|". $setting19 ."|". $setting20 ."|". $setting21 ."|". $setting22 ."|". $setting23 ."|". $setting24 ."|". $setting25 ."|". $setting26 ."|". $setting27;

if(fwrite($fop,$newcontent)){
$set = "a";
 }else{
$set = "b";
}

fclose($fop);

  }
 $fop =  fopen('secure/settings.mfh', 'r');

 $content = fread($fop, '999');
 fclose($fop);
$content = explode("|", $content);

     ?>
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>
<center>
<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#CBD6F3><tr><td background="img/bg.png" align=absmiddle valign=absmiddle>
<font color=#C0C0C0>| <img src="img/blue.gif"> <a href="admin.php?act=logout"><?php echo $lang[logout];?></a> | <img src="img/blue.gif"> <a href="admin.php"><?php echo $lang[index];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=files"><?php echo $lang[files];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=image"><?php echo $lang[images];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=changedlpass"><?php echo $lang[master];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=abuse"><?php echo $lang[abuse];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=deloldfiles"><?php echo $lang[delete];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=bans"><?php echo $lang[bans];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=check"><?php echo $lang[check];?></a> | <img src="img/blue.gif"> <a href="admin.php?act=info"><?php echo $lang[info_1];?></a> | <img src="img/blue.gif"> <a href="settings.php"><?php echo $lang[settings];?></a> |
</td></tr></table>
</center><br />
 <h3><center><?php echo $compname ?> <?php echo $lang[settings];?></center></h3>

<?php
if ($set=="a")
  echo "<center><table cellspacing=1 cellpadding=4 border=0 bgcolor=#FF0000><tr><td align=center bgcolor=#FFE6E6><img src='img/up.png'> <font color=#008000><b>".$lang[changed_success]."</b></font></td></tr></table></center></br>";
elseif ($d=="b")
  echo "<center><table cellspacing=1 cellpadding=4 border=0 bgcolor=#FF0000><tr><td align=center bgcolor=#FFE6E6><img src='img/down.png'> <font color=#FF0000><b>".$lang[changed_not_success]."</b></font></td></tr></table></center></br>";
else
  echo ""; ?>
<p>

      <form method="post" action="">
<table bgcolor="#DFDFDF" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
 <tr><td colspan=3 bgcolor=#F2F2F2 background="img/bg.png" align=center><b><?php echo $lang[settings_main_config];?></b></td></tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_site_name];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting0" value="<?php echo $content[0];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_site_name1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_slogan];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting1" value="<?php echo $content[1];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_slogan1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_script_url];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting2" value="<?php echo $content[2];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_script_url1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_password];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting16" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_password1];?> <font color=#FF0000><b><?php echo $lang[settings_password2];?></b></font></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_email];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting17" value="<?php echo $content[17];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_email1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_aemail];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting27" value="<?php echo $content[27];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_aemail1];?></td>
  </tr>
  <?php //echo $content[15]; ?>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_language];?></td>
    <td bgcolor=#F2F2F2>&nbsp;English:<input<?php if($content[15] == "english"){echo(" checked=\"checked\"");} ?> type="radio" name="setting15" value="english" />
	<br />German:<input<?php if($content[15] == "german"){echo(" checked=\"checked\"");} ?> type="radio" name="setting15" value="german" />
	<br />Italian:<input<?php if($content[15] == "italian"){echo(" checked=\"checked\"");} ?> type="radio" name="setting15" value="italian" />
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_language1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_style];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting21" value="<?php echo $content[21];?>" size="20" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_style1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_maxfilesize];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting3" value="<?php echo $content[3];?>" size="8" />&nbsp;MB
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_maxfilesize1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_downloadtimelimit];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting4" value="<?php echo $content[4];?>" size="8" />&nbsp;<?php echo $lang[settings_minutes];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_downloadtimelimit1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_uploadtimelimit];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting5" value="<?php echo $content[5];?>" size="8" />&nbsp;<?php echo $lang[settings_minutes];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_uploadtimelimit1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_nolimitsize];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting6" value="<?php echo $content[6];?>" size="8" />&nbsp;MB
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_nolimitsize1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_deleteafter];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting7" value="<?php echo $content[7];?>" size="8" />&nbsp;<?php echo $lang[settings_days];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_deleteafter1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_downloadtimer];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting8" value="<?php echo $content[8];?>" size="8" />&nbsp;<?php echo $lang[settings_seconds];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_downloadtimer1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_pps];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting18" value="<?php echo $content[18];?>" size="8" />&nbsp;<?php echo $lang[settings_pps2];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_pps1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_pps];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting19" value="<?php echo $content[19];?>" size="8" />&nbsp;<?php echo $lang[settings_pps2];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_pps3];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_pps];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="text" name="setting20" value="<?php echo $content[20];?>" size="8" />&nbsp;<?php echo $lang[settings_pps2];?>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_pps4];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_filelist];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting9" value="true" <?php if ($content[9] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting9" value="false" <?php if ($content[9] == 'false') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_off];?></font></b>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_filelist1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_shorturl];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting10" value="true" <?php if ($content[10] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting10" value="false" <?php if ($content[10] == 'false') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_off];?></font></b>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_shorturl1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_email_option];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting11" value="true" <?php if ($content[11] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting11" value="false" <?php if ($content[11] == 'false') echo 'checked' ?>
    <font size="2">&nbsp;<b><?php echo $lang[settings_off];?></b></font>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_email_option1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_password_feature];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting12" value="true" <?php if ($content[12] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting12" value="false" <?php if ($content[12] == 'false') echo 'checked' ?>
    <font size="2"><b>&nbsp;<?php echo $lang[settings_off];?></b></font>
    </td><td bgcolor=#F2F2F2>
   <?php echo $lang[settings_password_feature1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_file_description];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting13" value="true" <?php if ($content[13] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting13" value="false" <?php if ($content[13] == 'false') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_off];?></font></b>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_file_description1];?></td>
  </tr>
 <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_toplist];?></td>
    <td bgcolor=#F2F2F2>&nbsp;<input type="radio" name="setting14" value="true" <?php if ($content[14] == 'true') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_on];?></font></b>&nbsp;&nbsp;
<input type="radio" name="setting14" value="false" <?php if ($content[14] == 'false') echo 'checked' ?>
    <b><font size="2">&nbsp;<?php echo $lang[settings_off];?></font></b>
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_toplist1];?></td>
  </tr>
</table>
<br>
<table bgcolor="#DFDFDF" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr><td colspan=3 bgcolor=#F2F2F2 background="img/bg.png" align=center><b><?php echo $lang[settings_personal_data];?></b> <?php echo $lang[settings_personal_data1];?></td></tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_personal_name];?></td>
    <td bgcolor=#F2F2F2 width=280>&nbsp;<input type="text" name="setting26" value="<?php echo $content[26];?>" size="40" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_personal_name1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_personal_street];?></td>
    <td bgcolor=#F2F2F2 width=280>&nbsp;<input type="text" name="setting22" value="<?php echo $content[22];?>" size="40" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_personal_street1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_personal_city];?></td>
    <td bgcolor=#F2F2F2 width=280>&nbsp;<input type="text" name="setting23" value="<?php echo $content[23];?>" size="40" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_personal_city1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_personal_url];?></td>
    <td bgcolor=#F2F2F2 width=280>&nbsp;<input type="text" name="setting24" value="<?php echo $content[24];?>" size="40" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_personal_url1];?></td>
  </tr>
  <tr>
    <td width=120 bgcolor=#F2F2F2><?php echo $lang[settings_personal_phone];?></td>
    <td bgcolor=#F2F2F2 width=280>&nbsp;<input type="text" name="setting25" value="<?php echo $content[25];?>" size="40" />&nbsp;
    </td><td bgcolor=#F2F2F2>
    <?php echo $lang[settings_personal_phone1];?></td>
  </tr>
</table>
      <p><center><input type="submit" value="<?php echo $lang[settings_change];?>" name="changesettings"></center>

      </form>
 </center></td></tr></table><p style="margin:3px;text-align:center">

<?php
 include("./footer.php");
}
else {
 header("Location: admin.php");
}
?>