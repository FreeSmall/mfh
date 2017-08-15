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
<font size=2 color=#808080><b>&nbsp;&nbsp;<?php echo $faq; ?></b></font>
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
<b><?php echo $faq1; ?></b>
<hr noshade size=1 width=100% color=#8080FF>
<?php echo $faq1a; ?> <?php echo $maxfilesize; ?> MB.</font></small></td>
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
<b><?php echo $faq2; ?></b>
<hr noshade size=1 width=100% color=#8080FF>
<?php echo $faq2a; ?> <?php echo $deleteafter; ?> <?php echo $faq2b; ?></font></small></td>
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
<b><?php echo $faq3; ?></b>
<hr noshade size=1 width=100% color=#8080FF>
<?php echo $faq3a; ?> <?php echo $uploadtimelimit; ?> <?php echo $faq3b; ?> <?php echo $faq3c; ?> <?php echo $uploadtimelimit; ?> <?php echo $faq3d; ?>
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
<b><?php echo $faq4; ?></b>
<hr noshade size=1 width=100% color=#8080FF>
<?php echo $faq4a; ?> <?php echo $nolimitsize; ?> <?php echo $faq4b; ?></font></small></td>
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
<b><?php echo $faq5; ?></b>
<hr noshade size=1 width=100% color=#8080FF>
<?php echo $faq5a; ?> <a href="http://www.freesmall.org" target="_blank" style="color:#B7B7FF;">FreeSmall</a> <?php echo $faq5b; ?></font></small></td>
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