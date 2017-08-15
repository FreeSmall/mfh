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
<center><table style="margin-top:0px;width:790px;height:400px;"><tr><td style="border:1px #AAAAAA solid;height:100%;background-color:#FFFFFF;padding:20px;text-align:left;" valign=top>

<br>
 <div align="center"><center>
<table border="0" cellpadding="0" cellspacing="0" width="100%"
bgcolor="#004080">
<tr>
<td width="10" valign="top" align="left">
<img src="img/ka_rundtab1.gif" width="10" height="10"></td>
<td width="100%" bgcolor="#004080">
<p align="center"><small><font color="#FFFFFF" face="Arial">
</font></small></td>
<td width="10" valign="top" align="right">
<img src="img/ka_rundtab2.gif" width="10" height="10"></td>
</tr>
<tr>
<td width="10"></td>
<td width="100%" align="left">
<p align="left"><small><font color="#FFFFFF" face="Arial">
<b><? echo $lang[tos_tos];?></b>
<hr noshade size=1 width=100% color=#8080FF>
<? echo $your_name ?><br>
<? echo $your_street ?><br>
<? echo $your_city ?><br>
<? echo $your_phone ?><br><br>
Internet: <? echo $your_url ?><br>
eMail: <? echo $email ?>

<hr noshade size=1 width=100% color=#8080FF>
- <? echo $lang[tos_point1];?>
<p>
- <? echo $lang[tos_point2];?>
<p>
- <? echo $lang[tos_point3];?>
<p>
- <? echo $lang[tos_point4];?>
<hr noshade size=1 width=100% color=#8080FF>
<? echo $lang[tos_send_abuse];?><? echo $your_aemail ?>
         </td>
<td width="10"></td>
</tr>
<tr>
<td width="10" valign="bottom" align="left">
<img src="img/ka_rundtab3.gif" width="10" height="10"></td>
<td width="100%"><p align="center">
<font color="#FFFFFF" face="Arial"><small></small></font></td>
<td width="10" valign="bottom" align="right">
<img src="img/ka_rundtab4.gif" width="10" height="10"></td>
</tr>
</table></center></div>
</center></td></tr></table><p style="margin:3px;text-align:center">