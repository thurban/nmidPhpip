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
| - phpip - http://www.phpip.net/                                         |
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
include_once("./include/top_header.php");
ob_start();

// Use the myheader function from layout.php

$switchVar = 'nothingSet';

if ( isset ($_REQUEST["mode"]) )
{
	$switchVar = $_REQUEST["mode"];
}
switch ($switchVar) {

case "edit":
{
  if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Prefix Description Update");

  echo "<FORM action='prefix_desc.php?mode=update' method='post' name='edit'>";
  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=6 class=\"listCell\">DESCRIPTION UPDATE</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">IP</td>";
  echo "<td class=\"listCell\">DESCRIPTION</td>";
  echo "</tr>";

$pdesc = mysql_query("SELECT * FROM `phpIP_net_ips` WHERE `AddressId` = '$di'");
	$RowClass = "";
    while ($row = mysql_fetch_array($pdesc))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
          }
          else
           { $RowClass = "listRow2";
        }
  echo "<tr class=\"$RowClass\" class=\"listCell\">";
  echo "<td class=\"listCell\">&nbsp;".$row['netaddress']."<input type=\"hidden\" value=\"$di\" name=\"di\"></td>";
  echo "<td class=\"listCell\">&nbsp;<input type=\"text\" name=\"de\" value=\"".$row['ip_description']."\"></td>";
  echo "</tr>";
}
echo "</table>";
echo "<table>";
  echo "<td><a href=\"javascript:document.edit.submit()\">[EDIT]</td>";
echo "</table>";



} //end case
break;

case "update":
{
  if (isset ($_POST['di'])) { $di = strip_tags($_POST['di']); }
  if (isset ($_POST['de'])) { $de = strip_tags($_POST['de']); }

// Use the myheader function from layout.php
myheader("Updating");

$updesc = mysql_query("UPDATE `phpIP_net_ips` SET `ip_description` = '$de' WHERE `AddressId` = '$di'");

// Redirect after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="prefix_desc.php">

<?php
}
break;

default:

// Use the myheader function from layout.php
myheader("Update Prefix Description");

  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=6 class=\"listCell\">DESCRIPTION UPDATE</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">&nbsp;</td>";
  echo "<td class=\"listCell\">IP</td>";
  echo "<td class=\"listCell\">DESCRIPTION</td>";
  echo "</tr>";

$pdesc = mysql_query("SELECT * FROM `phpIP_net_ips` WHERE `view` = '1' ORDER BY `netaddress` + 0");
	$RowClass = "";
    while ($row = mysql_fetch_array($pdesc))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
          }
          else
           { $RowClass = "listRow2";
        }
  echo "<tr class=\"$RowClass\" class=\"listCell\">";
  echo "<td class=\"listCell\" width=\"20\">&nbsp;<a href=\"prefix_desc.php?mode=edit&di=".$row['AddressId']."\">[Edit]</a></td>";
  echo "<td class=\"listCell\">&nbsp;".$row['netaddress']."</td>";
  echo "<td class=\"listCell\">&nbsp;".stripslashes($row['ip_description'])."</td>";
  echo "</tr>";
}
echo "</table>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------

function footer()
{
    print "</style>";
    print "</td></tr></table>\n";
    include_once("./include/bottom_footer.php");    
}

function myheader( $title )
{
	print "<font size=+1>NMID phpIP - $title</font><br>\n";
	print "<font size=-2>Network Management Inventory Database (NMID)</font><br>\n";
    print "<hr>";
    ?>
        <style type="text/css">

        .listHeading 		    { font-family: tahoma,arial,helvetica,sans-serif; font-weight: bold; font-size: 12px; border-right: 1px solid #4B93C1; border-bottom: 1px solid #0A293F; padding:3px; }
        .listHeading a:link         { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:active       { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:visited      { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:hover        { font-weight:bold; color: white; padding-left:4px }
        
        .listHeadingRight           { font-weight: bold; font-size: 12px; border-top: 1px solid #D3E9F7; border-left: 1px solid #D3E9F7; border-right: 1px solid #4B93C1; border-bottom: 1px solid #0A293F; text-align:right; padding-right: 4px; }
        .listHeadRow                { font-weight:bold; font-family: tahoma,arial,helvetica,sans-serif; color: #F5F5F6; background-color: #7BA2D4; margin:0px; padding:3px; }
        .listHeadRow a:link         { font-family: tahoma,arial,helvetica,sans-serif; color: #F5F5F6; background-color: #7BA2D4; margin:0px; padding:3px; }
        
        .listHeadRow2               { font-family: tahoma,arial,helvetica,sans-serif; color: #FFF; background-color: #9EB9DC; margin:0px; padding:3px; }
        .listHeadRow2 a:link        { font-family: tahoma,arial,helvetica,sans-serif; color: #FFF; background-color: #9EB9DC; margin:0px; padding:3px; }
        
        .listRow1                   { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow1Over               { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow1Click              { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow2                   { background-color: #FDFDFD; margin:0px; padding:3px; }
        .listRow2Over               { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow2Click              { background-color: #A0E09F; margin:0px; padding:3px; }
        .listRow1a                  { background-color: #FC7E7E; margin:0px; padding:3px; }
        .listRow1aOver              { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow1aClick             { background-color: #A0E09F; margin:0px; padding:3px; }
        .listRow2a                  { background-color: #FDE4E4; margin:0px; padding:3px; }
        .listRow2aOver              { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow2aClick             { background-color: #A0E09F; margin:0px; padding:3px; }
        
        .listCell                  { padding:3px; font-size:11px;  border-right: 1px solid #3382B4;  border-bottom: 1px solid #3382B4;}
        
        .listCellRight             { font-size:11px; border-right: 1px solid #3382B4; border-bottom: 1px solid #3382B4; text-align:right; padding-right: 4px; }
        .listTable                 { padding:0px; border-top: 1px solid #003B61; border-left: 1px solid #003B61; }
        .listTableInner            { padding:0px; border-top: 1px solid #003B61; }
        
        .listCellI                 { padding:3px; font-size:11px; text-align:left; vertical-align:top; height:30px; }
        .listCellI2                { padding:3px; font-size:11px; text-align:left; vertical-align:top; width:100px; height:30px; }
        
        .admin_bar                 { background-color: #369; color: #FFF; font-weight: bold; text-align: right; padding: 2px; font-size: medium; border: 2px solid #000; }
        .owner_bar                 { background-color: #369; color: #FFF; font-weight: bold; text-align: right; padding: 2px; font-size: medium; border: 2px solid #000; }
        
        .admin_bar a               { color: #FFF; }
        .owner_bar a               { color: #FFF; }

        </style
        <SCRIPT LANGUAGE="JavaScript">

        <!-- 	
        // by Nannette Thacker
        // http://www.shiningstar.net
        // This script checks and unchecks boxes on a form
        // Checks and unchecks unlimited number in the group...
        // Pass the Checkbox group name...
        // call buttons as so:
        // <input type=button name="CheckAll"   value="Check All"
            //onClick="checkAll(document.myform.list)">
        // <input type=button name="UnCheckAll" value="Uncheck All"
            //onClick="uncheckAll(document.myform.list)">
        // -->
        
        <!-- Begin
        function checkAll(field)
        {
        for (i = 0; i < field.length; i++)
            field[i].checked = true ;
        }
        
        function uncheckAll(field)
        {
        for (i = 0; i < field.length; i++)
            field[i].checked = false ;
        }
        //  End -->
        </script>    
    <?php
    print "<table width=600><tr><td>\n";
}
?>

