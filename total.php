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

    $files
    = Array();
   
    //specify the directory
    @$handle = opendir("./files/"); while (
   false !== (@$file = readdir($handle))) {     if (
    $file != "." && $file != "..") {         
   $files[] = $file;     }
   }
   @
   closedir($handle);
   $top = count($files);
 
$total=  $top - 1;
      ?> 