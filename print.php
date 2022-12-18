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

$dir = dirname(__FILE__);
if ( stristr( PHP_OS, 'WIN' ) ) {
    // Windows
    $mainDir = preg_replace("/plugins\\nmidPhpip/","",$dir);
} else {
    // Other Os
    $mainDir = preg_replace("/plugins\/nmidPhpip/","",$dir);
}
chdir($mainDir);

include_once("./include/auth.php");
include_once($config["library_path"] . "/data_query.php");

ob_start();


// include the layout file
include 'iplayout.php';


if (isset ($_GET['ip'])) { $ip = strip_tags($_GET['ip']); }
if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }
if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }

echo "
<script language='JavaScript'>
<!--
setTimeout('window.print()', 1*1000);
//-->
</script>
";

	echo	"<html>";
	echo	"<head>";
	echo	"<title>";
	echo	"IP Address Report $ip";
	echo	"</title>";
	echo	"</head>";
	echo	"<body>";
	echo	"<center><h3>IP Address Report $ip</h3></center>";

        echo   "<center><table border=1>";
        echo      "<tr>";
        echo      "<td align=center><b>IP</b></td>";
        echo      "<td align=center><b>MASK</b></td>";
        echo      "<td align=center><b>DESCRIPTION</b></td>";
        echo      "<td align=center><B>CLIENT</b></td>";
        echo      "</tr>";

$iprangeEx = explode('.', $ip);

$whereSQL = "";
                if ($netid!="")
                {
                        if($whereSQL!="") $whereSQL = $whereSQL." AND ";
                           $whereSQL = $whereSQL." `NetID` = '".$netid."' ";
                }
                if ($iprange!="")
                {
                        if($whereSQL!="") $whereSQL = $whereSQL." AND ";
                           $whereSQL = $whereSQL." `ip` LIKE '%$iprangeEx[0].$iprangeEx[1].$iprangeEx[2].%' ";
		}	   
	   $query = "SELECT * FROM `phpIP_addresses` WHERE $whereSQL ORDER BY `id`";
           if (strcmp($filter,"unalloc")==0) 
  	   $query = "SELECT * FROM `phpIP_addresses` WHERE $whereSQL AND `client` IS NOT NULL ORDER BY `id`";
           $results = mysql_query($query);
           $num_results = mysql_num_rows($results);

if ($num_results == 0)
{
        $query = "SELECT * FROM `phpIP_addresses` WHERE $whereSQL ORDER BY `id`";
        $results = mysql_query($query);
        $num_results = mysql_num_rows($results);
}

if ($num_results == 0)
        {
		$query = "SELECT * FROM `phpIP_addresses` WHERE $whereSQL ORDER BY `id`";
                $results = mysql_query($query);
                $num_results = mysql_num_rows($results);
 }

  $sql = mysql_query($query);
//					 "SELECT * FROM `phpIP_addresses` WHERE `ip` LIKE '%$iprangeEx[0].$iprangeEx[1].$iprangeEx[2].%' 
//        and `NetID` = '$netid' ORDER BY ID");
        while ($row = mysql_fetch_array($sql))
        {
                echo      "<tr>";
                echo      "<td align='center' width='100'>$row[ip]</td>";
                echo      "<td align='center' width='100'>&nbsp;$row[mask]</td>";
                echo      "<td align='center' width='250'>&nbsp;$row[description]</td>";
                echo      "<td align='center' width='250'>&nbsp;$row[client]</td>";
                echo      "</tr>";
                }
echo      "</table>";
echo       "</center>";
echo       "<br><br>";

?>
