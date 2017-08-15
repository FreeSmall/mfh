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

$fop =  fopen('secure/settings.mfh', 'r');
$content = fread($fop, '999');
fclose($fop);
$content = explode("|", $content);

$compname = "$content[0]";
////Your Company Name

$slogan = "$content[1]";
//// Your Company Slogan

$scripturl = "$content[2]";
//// the URL to this script with a trailing slash

$adminpass = $content[16];
//// set this password to something other than default
//// it will be used to access the admin panel

$email = $content[17];
//// your eMail-Adress for abuse/support and user registration page

$maxfilesize = $content[3];
//// the maximum file size allowed to be uploaded (in megabytes)

$downloadtimelimit = $content[4];
//// time users must wait before downloading another file (in minutes)

$uploadtimelimit = $content[5];
//// time users must wait before uploading another file (in minutes)

$nolimitsize = $content[6];
//// if a file is under this many megabytes, there is no time limit

$deleteafter = $content[7];
//// delete files if not downloaded after this many days

$downloadtimer = $content[8];
//// length of the timer on the download page (in seconds)

$LANGUAGE_LIST = Array(
"english",
"german",
"italian"
);
//// list of accectable languages

$language = $content[15];
if ($content[9]=="false")
  $result9 = false;
else
  $result9 = true;

$enable_filelist = $result9;
//// allows users to see a list of uploaded files. set to false to disable

if ($content[10]=="false")
  $result10 = false;
else
  $result10 = true;
$shourturl = $result10;
//// Short url Eg yourdomain.com/13232 needs mod_rewrite enabled. For More Info See Our Froum

if ($content[11]=="false")
  $result11 = false;
else
  $result11 = true;
$emailoption = $result11;
//// set this to true to allow users to email themselves the download links

if ($content[12]=="false")
  $result12 = false;
else
  $result12 = true;
$passwordoption = $result12;
//// set this to true to allow users to password protect their uploads

if ($content[13]=="false")
  $result13 = false;
else
  $result13 = true;
$descriptionoption = $result13;
//// set this to true to disable the description field

if ($content[14]=="false")
  $result14 = false;
else
  $result14 = true;
$topten =  $result14;
//// Make It true if you want to enable Top ten files

$perpage = 15;
//// if $enable_filelist is true (above), how many files to display per page (recommended default is 50);

//$categories = array("Documents","Applications","Audio","Misc");
//// remove the //'s from the above line to enable categories
//// Users will be able to choose from this list of categories

//$allowedtypes = array("txt","gif","jpg","jpeg");
//// remove the //'s from the above line to enable file extention blocking
//// only file extentions that are noted in the above array will be allowed

$pps1 = $content[18];
//// the hits shows on admin's filelist

$pps2 = $content[19];
//// the hits shows on filelist

$pps3 = $content[20];
//// the hits shows on admin's filelist

$style = $content[21];
//// The Style of your MiniFileHost

$your_name = $content[26];
//// Your Name

$your_street = $content[22];
//// Your Street

$your_city = $content[23];
//// Your Name

$your_url = $content[24];
//// Your Internet

$your_phone = $content[25];
//// Your Phone-Number

$your_aemail = $content[27];
//// Your Abuse-EMail

?>