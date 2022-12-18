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
include_once("./include/top_header.php");
ob_start();

$switchVar = 'nothingSet';

if ( isset ($_REQUEST["mode"]) )
{
	$switchVar = $_REQUEST["mode"];
}
switch ($switchVar) {

case "show":
{
 if (isset ($_POST['filter_address_type'])) { $filter_address_type = strip_tags($_POST['filter_address_type']); }
 if (isset ($_POST['message_filter_type'])) { $message_filter_type = strip_tags($_POST['message_filter_type']); }
 if (isset ($_POST['content'])) { $content = strip_tags($_POST['content']); }

// Use the myheader function from layout.php
myheader("Search Results");


	// translate session to name
	$sorder1 = 'ip';
	$sorder2 = 'client';
	$sorder3 = 'description';
	$sorder4 = 'notes';

    $order1="IP";
    $order2="Client";
    $order3="Description";
    $order4="Notes";
    $not = "";
switch ($message_filter_type) {
          case "casenotoneormorewords":
                $not="NOT";
          case "caseoneormorewords":
                $filter = "$not ( ($filter_address_type LIKE \"%".ereg_replace(" ","%\") OR ($filter_address_type LIKE \"%", $content)."%\") )";
                break;

          case "casenotthestring":
                $not="NOT";
          case "casethestring":
                $filter = "( ($filter_address_type $not LIKE \"%".stripslashes($content)."%\") )";
                break;
        }

	$listSearch = mysql_query("SELECT * FROM `phpIP_addresses` WHERE $filter and `groupid` = '1'");

     echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
     echo "<tr class=\"listCell\">";
     echo "<td colspan=\"5\" class=\"listCell\">RESULTS</td>";
     echo "</tr>";
     echo "<tr class=\"listHeadRow\">";
     echo "<td align=center>&nbsp;&nbsp;</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order1)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order2)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order3)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order4)."</td>";
     echo "</tr>";
    $RowClass = "";
    while ($row = mysql_fetch_array($listSearch))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
	
	// explode netaddress

//echo "SELECT `netaddress` FROM `net_ips` WHERE `netaddress` LIKE ('%$row[ip]%') AND `view` = 1 AND `NetCidr` = $row[NetID]";
//$NetSearch = mysql_query("SELECT `netaddress` FROM `net_ips` WHERE `netaddress` LIKE ('%$row[ip]%') AND `view` = 1 AND `NetCidr` = $row[NetID]");
//    while ($row = mysql_fetch_array($listSearch))
//	{
//	$iprangeEx = explode('.', $row[netaddress]);
//	}
	$iprangeEx = explode('.', $row['ip']);
    $NetID = $row['NetID'];
    echo "<tr class=\"$RowClass\">";
    echo "<td class=\"listCell\" width=\"50\"><a href=\"display.php?range=view&iprange=$iprangeEx[0].$iprangeEx[1].$iprangeEx[2]&netid=".$row['NetID']."&id=".$row['id']."\">[Details]</a>";

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
       echo "&nbsp;<a href=\"display.php?range=edit&iprange=$iprangeEx[0].$iprangeEx[1].$iprangeEx[2]&netid=$NetID&id=".$row['id']."\">[Edit]</a></td>";
    }
	echo "<td class=\"listCell\">&nbsp;$row[$sorder1]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder2]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder3]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder4]</td>";
	echo "</tr>";
    } //end loop

echo "</table>";

// Use the footer function from layout.php
footer();
}
break;

default:

myheader("Search IP Database");

?>
<FORM action="<?php $PHPSELF;?>?mode=show" method=post name="ldapadd"> 
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0"> 
        <TR class="listCell">
           <TD class="listCell">SEARCH IP DATABASE</TD>
        </TR>
        <tr class="listHeadRow">
           <TD class="listCell">SEARCH</TD>
        </TR>
        <tr class="listRow2">
           <TD class="listCell">
       <select class="Controle" name="filter_address_type" id="filter_address_type">
          <option value="ip" >IP</option>
          <option value="mask" >Mask</option>
          <option value="description" >Description</option>
          <option value="client" >Client</option>
          <option value="clientcontact" >Client Contact</option>
          <option value="phone" >Phone</option>
          <option value="email" >Email</option>
          <option value="notes" >Notes</option>
          <option value="deviceType" >Device Type</option>
          <option value="deviceLaction" >Device Location</option>
          <option value="deviceOwner" >Device Owner</option>
          <option value="deviceManufacture" >Device Manufacture</option>
          <option value="deviceModel" >Device Model</option>
          <option value="deviceCustom1" >Device Custom 1</option>
          <option value="deviceCustom2" >Device Custom 2</option>
          <option value="deviceCustom3" >Device Custom 3</option>
      </select>
       <select class="Controle" name="message_filter_type" id="message_filter_type">
          <option value="casethestring" >contains the string</option>
          <option value="caseoneormorewords" selected>contains one or more words</option>
          <option value="casenotthestring" >do not contains the string</option>
          <option value="casenotoneormorewords" >do not contains one or more words</option>
      </select>
        </TD>
        </tr>
    <tr class="listRow1">
     <TD class="listCell">
        Value  &nbsp; <INPUT name="content" value=""></td>
        </tr>
</table>
<table>
<tr>
  <TD align=right><a href="javascript:document.ldapadd.submit()">[SEARCH]</TD>
</TR>
</table>
</FORM>
<?php

  // Use the footer function from layout.php
  footer();
}


function footer()
{
    print "</td></tr></table>\n";
    include_once("./include/bottom_footer.php");
}

function myheader( $title )
{
	print "<font size=+1>NMID phpIP - $title</font><br>\n";
	print "<font size=-2>Network Management Inventory Database (NMID)</font><br>\n";
    print "<hr>";
    ?>
        <script src="classes/xPandMenu.js"></script>
        <script language="JavaScript" src="classes/overlib.js"></script>    
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
    <table width=80%><tr><td valign=top>
      <table width=100%>
      <tr>
        <td><img src="i/ldiv.gif"></td>
      </tr>
      <tr>
        <td valign=top align=left>
        <?php
        //include "./plugins/nmidPhpip/boxes/box_CidrMenu.php";
        ?>
        </td>
      </tr>
      <tr>
        <td><img src="i/ldiv.gif"></td>
    </tr>
      </table>
      </td>
    <td valign=top>
    <?php
}
?>
