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

include "common.php";

function myheader($ptitle){
$meta = &new Meta;
$meta->company_name = "phpIP Management";
$meta->sitename = "phpIP Management $_SESSION[version]";
$meta->slogan = "phpIP Management";
$meta->generator = "PHP";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php echo $meta->metadata($ptitle); ?>
<link rel=stylesheet type=text/css href='css/<?php echo $_SESSION[style]; ?>'>
<link rel="stylesheet" type="text/css" href="css/xPandMenu.css">
<link REL="shortcut icon" HREF="i/favicon.ico" TYPE="image/x-icon"> 
        <script src="classes/xPandMenu.js"></script>
        <script language="JavaScript" src="classes/overlib.js"></script>
</head>
<body bgcolor="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="xRestoreState();" onunload="xSaveState();">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
        <td width="100%">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                        <td><img src="i/top1.jpg"></td>
                        <td width="100%" background="i/top1bg.jpg"><img src="i/spacer.gif"></td>
                </tr>
                </table>
        </td>
</tr>
<tr>
        <td width="100%" background="i/top2bg.gif">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>

<!-- BEGIN TOP NAV -->
                        <td><img src="i/spacer.gif" width="40" height="24"></td>
                        <td><a href="console.php"><img src="i/l1.jpg" border="0"></a></td>
                        <td><img src="i/vline.gif"></td>
                        <td><a href="preference.php"><img src="i/l2.jpg" border="0"></a></td>
                        <td><img src="i/vline.gif"></td>
                        <td><a href="search.php"><img src="i/l5.jpg" border="0"></a></td>
                        <td><img src="i/vline.gif"></td>
                        <td><a href="help.php"><img src="i/l3.jpg" border="0"></a></td>
                        <td><img src="i/vline.gif"></td>
                        <td><a href="logout.php"><img src="i/l4.jpg" border="0"></a></td>
<!--                    <td><img src="i/vline.gif"></td> -->
                        <td width="100%"><img src="i/spacer.gif"></td>
                </tr>
                </table>
        </td>
</tr>
<tr>

<!-- 

include statement for side link

-->
        <td width="100%">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                        <td><img src="i/top3.gif"></td>
                        <td width="100%" colspan="3" background="i/top3bg.gif"><img src="i/spacer.gif"></td>
                </tr>
                <tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;<span class="Sidelink">Logged in As: <?php echo $_SESSION['username'];?></td>
            <td></td>
        </tr>
        <tr>
            <td><img src="i/ldiv.gif"></td>
        </tr>
                        <td valign="top">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
<?php
        include "boxes/box_CidrMenu.php";
?>
                        </td>
                        <td valign="top"><img src="i/spacer.gif" width="12" height="1"></td>
                        <td valign="top">

                                <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                        <td rowspan="2"><img src="i/spacer.gif"></td>
<!--
        The width of the image below adjusts the overall width of the content area
        (in pixels). Currently, the 470px is there to give the content area a
        fixed width that will work in resolutions 800x600 and up.
-->
                                        <td><img src="i/spacer.gif" width="470px" height="20"></td>
                                </tr>
                                <tr>
                                        <td valign="top" class="carea">
<!-- CONTENT AREA START -->

<?php
}

function footer(){
?>
                                        </td>
                                </tr>
                                </table>
                        </td>
                        <td width="100%"><img src="i/spacer.gif"></td>
                </tr>
                </table>
        </td>
</tr>
</table>
</br>
</br>
</body>
</html>

<?php
}
?>
