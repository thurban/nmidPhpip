<?php
/*
+-------------------------------------------------------------------------+
| Copyright (C) 2006 Michael Earls                                        |
|                                                                         |
| This program is free software; you can redistribute it and/or           |
| modify it under the terms of the GNU General Public License             |
| as published by the Free Software Foundation; either version 2          |
| of the License, or (at your option) any later version.                  |
|                                                                         |
| This program is distributed in the hope that it will be useful,         |
| but WITHOUT ANY WARRANTY; without even the implied warranty of          |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
| GNU General Public License for more details.                            |
+-------------------------------------------------------------------------+
| - phpIP - http://www.phpip.net/                                         |
+-------------------------------------------------------------------------+
*/


session_start();
session_name('phpip_management');
header("Cache-control: private"); // Fix for IE

function login_check(){
    if($_SESSION['login'] != TRUE){
	  header("Location: login.php");
      exit();
   }
}

function admin_check(){
    if($_SESSION['access_level'] != "Administrator"){
      myheader("Access Denied!");
       echo "<center><h2><font color=\"red\">This area is restricted".
            " for Administrators!</font></h2>";
      footer();
      exit();
   }
}
?>
