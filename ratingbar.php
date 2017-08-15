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

function drawRating($rating) {

   $width = $_GET['width'];
   $height = $_GET['height'];
   if ($width == 0) {
     $width = 300;
   }
   if ($height == 0) {
     $height = 15;
   }

   $rating = $_GET['rating'];
   $ratingbar = (($rating/100)*$width)-2;

   ob_clean();
   $image = imagecreate($width,$height);
   //colors

   $fill = ImageColorAllocate($image,0,255,0);
   if ($rating > 49) { $fill = ImageColorAllocate($image,255,255,0); } //gelb
   if ($rating > 74) { $fill = ImageColorAllocate($image,255,128,0); } //orange
   if ($rating > 89) { $fill = ImageColorAllocate($image,255,0,0); } //rot

   $back = ImageColorAllocate($image,255,255,255);
   $border = ImageColorAllocate($image,0,0,0);

   ImageFilledRectangle($image,0,0,$width-1,$height-1,$back);
   ImageFilledRectangle($image,1,1,$ratingbar,$height-1,$fill);
   ImageRectangle($image,0,0,$width-1,$height-1,$border);
   imagePNG($image);
   imagedestroy($image);
}

Header("Content-type: image/png");
drawRating($rating);

?>