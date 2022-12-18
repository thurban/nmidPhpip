<?php

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
include_once("./plugins/nmidPhpip/get_data.php");
$filter = "";
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


ob_start();

$switchVar = 'nothingSet';

if ( isset ($_REQUEST["range"]) )
{
	$switchVar = $_REQUEST["range"];
}
switch ($switchVar) {

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// case statement to edit the ip address
case "default":
{

// Use the myheader function from layout.php
myheader("Set Default Settings");

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }
    if (isset ($mask)) { } else { $mask = '';}
    if (isset ($id)) { } else { $id = '';}
    if (isset ($description)) { } else { $description = '';}

    if (isset ($client)) { } else { $client = '';}
    if (isset ($clientcontact)) { } else { $clientcontact = '';}
    if (isset ($phone)) { } else { $phone = '';}
    if (isset ($email)) { } else { $email = '';}
    if (isset ($notes)) { } else { $notes = '';}
    if (isset ($gateway)) { } else { $gateway = '';}
    if (isset ($deviceType)) { } else { $deviceType = '';}
    if (isset ($deviceLocation)) { } else { $deviceLocation = '';}
    if (isset ($deviceOwner)) { } else { $deviceOwner = '';}
    if (isset ($deviceManufacturer)) { } else { $deviceManufacturer = '';}
    if (isset ($deviceModel)) { } else { $deviceModel = '';}
    if (isset ($deviceCustom1)) { } else { $deviceCustom1 = '';}
    if (isset ($deviceCustom2)) { } else { $deviceCustom2 = '';}
    if (isset ($deviceCustom3)) { } else { $deviceCustom3 = '';}



?>

<form action="display.php?range=defaultupdate&iprange=<?php echo $iprange;?>&netid=<?php echo $netid; ?>" method="post" name="update">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <TR class="listCell">
    <TD colspan="2" class="listCell">DEFAULT IP SETTINGS</TD></TR>
  <TR class="listHeadRow">
    <TD colspan="2" class="listCell">DEFAULT EDIT</TD></TR>
  <TR class="listRow2">
    <TD class="listCell">RANGE</TD>
    <TD class="listCell"><?php echo $iprange;?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">MASK</TD>
    <TD class="listCell">&nbsp;<select type="hidden" size="1" name="mask">
                        <option value="<?php echo $mask; ?>"><?php echo $mask; ?></option>
                        <option value="---------------">---------------</option>
                        <option value="255.255.255.255">255.255.255.255</option>
                        <option value="255.255.255.252">255.255.255.252</option>
                        <option value="255.255.255.248">255.255.255.248</option>
                        <option value="255.255.255.240">255.255.255.240</option>
                        <option value="255.255.255.224">255.255.255.224</option>
                        <option value="255.255.255.192">255.255.252.192</option>
                        <option value="255.255.255.128">255.255.255.128</option>
                        <option value="255.255.255.0">255.255.255.0</option>
                        <option value="255.255.254.0">255.255.254.0</option>
                        <option value="255.255.252.0">255.255.252.0</option>
                        <option value="255.255.248.0">255.255.248.0</option>
                        <option value="255.255.240.0">255.255.240.0</option>
                        <option value="255.255.224.0">255.255.224.0</option>
                        <option value="255.255.192.0">255.255.192.0</option>
                        <option value="255.255.128.0">255.255.128.0</option>
                        <option value="255.255.0.0">255.255.0.0</option>
                        <option value="255.254.0.0">255.255.0.0</option>
                        <option value="255.252.0.0">255.252.0.0</option>
                        <option value="255.248.0.0">255.248.0.0</option>
                        <option value="255.240.0.0">255.240.0.0</option>
                        <option value="255.224.0.0">255.224.0.0</option>
                        <option value="255.192.0.0">255.192.0.0</option>
                        <option value="255.128.0.0">255.128.0.0</option>
                        <option value="255.0.0.0">255.0.0.0</option>
                        </TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DESCRIPTION</TD>
    <TD class="listCell">&nbsp;<input type="text" type="hidden" size=30 name="description" value="<?php echo $description; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">CLIENT</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="client" value="<?php echo $client; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">CLIENT CONTACT</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="clientcontact" value="<?php echo $clientcontact; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">PHONE</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="phone" value="<?php echo $phone; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">EMAIL</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="email" value="<?php echo $email; ?>"></TD>
  </TR>
<?php
    if ( read_config_option('nmidPhpip_showDeviceData') ) {
?>
  <TR class="listRow1">
    <TD class="listCell">DEVICE TYPE</TD>
    <TD class="listCell">&nbsp;<select type="hidden" size="1" name="deviceType">
                        <option value="<?php echo $deviceType; ?>"><?php echo $deviceType; ?></option>
                        <option value="---------------">---------------</option>
                        <option value="Unassigned">Unassigned</option>
                        <option value="Router">Router</option>
                        <option value="Switch">Switch</option>
                        <option value="Access Point">Access Point</option>
                        <option value="RAS">RAS</option>
                        <option value="Firewall">Firewall</option>
                        <option value="VPN">VPN</option>
                        <option value="IDS, IDP">IDS, IDP</option>
                        <option value="Application Server">Application Server</option>
                        <option value="Terminal Server">Terminal Server</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Desktop Phone">Desktop Phone</option>
                        <option value="Printer">Printer</option>
                        <option value="NAS">NAS</option>
                        <option value="Other">Other</option>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE LOCATION</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceLocation" value="<?php echo $deviceLocation; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE OWNER</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceOwner" value="<?php echo $deviceOwner; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE MANUFACTURER</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceManufacturer" value="<?php echo $deviceManufacturer; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE MODEL</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceModel" value="<?php echo $deviceModel; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 1</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom1" value="<?php echo $deviceCustom1; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE CUSTOM 2</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom2" value="<?php echo $deviceCustom2; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 3</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom3" value="<?php echo $deviceCustom3; ?>"></TD>
  </TR>

<?php
}
?>
  <TR class="listRow1">
    <TD class="listCell">NOTES</TD>
    <TD class="listCell">&nbsp;<textarea ROWS=5 COLS=40 name=notes><?php echo $notes; ?></textarea></TD>
  </TR>
  <TR>
  <TD>
  <input type=hidden name="id" value=<?php echo $id; ?> >
  </TD>
</table>
<table>
  <TR>
    <TD>
	<a href="#" onClick="javascript:document.location.href = 
		('display.php?range=list&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&filter=unalloc')">[GO BACK]</a> &nbsp;
  	<a href="javascript:document.update.submit()">[SAVE]</a> &nbsp;
    </TD>
</TR>
</table>
</FORM>

<?php

// Use the footer function from layout.php
footer();

} // end access_level
else
        print "<center><h1><font color=red>ACCESS DENIED</font></h1></center>";
}
break;

//--------------------------------------------------------------------------------------------


case "defaultupdate":
{

// Use the myheader function from layout.php
myheader("Updating Default Settings");

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }
	if (isset ($_POST['ip'])) { $ip = strip_tags($_POST['ip']); }
	if (isset ($_POST['mask'])) { $mask = strip_tags($_POST['mask']); }
	if (isset ($_POST['description'])) { $description = strip_tags($_POST['description']); }
	if (isset ($_POST['client'])) { $client = strip_tags($_POST['client']); }
	if (isset ($_POST['clientcontact'])) { $clientcontact = strip_tags($_POST['clientcontact']); }
	if (isset ($_POST['phone'])) { $phone = strip_tags($_POST['phone']); }
	if (isset ($_POST['email'])) { $email = strip_tags($_POST['email']); }
	if (isset ($_POST['notes'])) { $notes = strip_tags($_POST['notes']); }
	if (isset ($_POST['gateway'])) { $gateway = strip_tags($_POST['gateway']); }
	if (isset ($_POST['deviceType'])) { $deviceType = strip_tags($_POST['deviceType']); }
	if (isset ($_POST['deviceLocation'])) { $deviceLocation = strip_tags($_POST['deviceLocation']); }
	if (isset ($_POST['deviceOwner'])) { $deviceOwner = strip_tags($_POST['deviceOwner']); }
	if (isset ($_POST['deviceManufacturer'])) { $deviceManufacturer = strip_tags($_POST['deviceManufacturer']); }
	if (isset ($_POST['deviceModel'])) { $deviceModel = strip_tags($_POST['deviceModel']); }
	if (isset ($_POST['deviceCustom1'])) { $deviceCustom1 = strip_tags($_POST['deviceCustom1']); }
	if (isset ($_POST['deviceCustom2'])) { $deviceCustom2 = strip_tags($_POST['deviceCustom2']); }
	if (isset ($_POST['deviceCustom3'])) { $deviceCustom3 = strip_tags($_POST['deviceCustom3']); }
    
    if (isset ($client)) { } else { $client = '';}
    if (isset ($clientcontact)) { } else { $clientcontact = '';}
    if (isset ($phone)) { } else { $phone = '';}
    if (isset ($email)) { } else { $email = '';}
    if (isset ($notes)) { } else { $notes = '';}
    if (isset ($gateway)) { } else { $gateway = '';}
    if (isset ($deviceType)) { } else { $deviceType = '';}
    if (isset ($deviceLocation)) { } else { $deviceLocation = '';}
    if (isset ($deviceOwner)) { } else { $deviceOwner = '';}
    if (isset ($deviceManufacturer)) { } else { $deviceManufacturer = '';}
    if (isset ($deviceModel)) { } else { $deviceModel = '';}
    if (isset ($deviceCustom1)) { } else { $deviceCustom1 = '';}
    if (isset ($deviceCustom2)) { } else { $deviceCustom2 = '';}
    if (isset ($deviceCustom3)) { } else { $deviceCustom3 = '';}    

/*
|
| Check for values 
| if no value do not post into sql statement
|
*/

$where = "";
if ( $mask!="" )
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `mask` = '".$mask."' "; }
if ( $description!="" )
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `description` = '".$description."' "; }
if ( $client!="" ) 
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `client` = '".$client."' "; }
if ( $clientcontact!="" ) 
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `clientcontact` = '".$clientcontact."' "; }
if ( $phone!="" ) 
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `phone` = '".$phone."' "; }
if ( $email!="" ) 
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `email` = '".$email."' "; }
if ( $notes!="" ) 
	{ if ( $where!="" ) $where = $where.", "; 
		$where = $where." `notes` = '".$notes."' "; }
if ( $deviceType!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceType` = '".$deviceType."' "; }
if ( $deviceLocation!="" )
        { if ( $where!="" ) $where = $deviceLocation.", ";
                $where = $where." `deviceLocation` = '".$deviceLocation."' "; }
if ( $deviceOwner!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceOwner` = '".$deviceOwner."' "; }
if ( $deviceManufacturer!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceManufacturer` = '".$deviceManufacturer."' "; }
if ( $deviceModel!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceModel` = '".$deviceModel."' "; }
if ( $deviceCustom1!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceCustom1` = '".$deviceCustom1."' "; }
if ( $deviceCustom2!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceCustom2` = '".$deviceCustom2."' "; }
if ( $deviceCustom3!="" )
        { if ( $where!="" ) $where = $where.", ";
                $where = $where." `deviceCustom3` = '".$deviceCustom3."' "; }


$iprangeEx = explode('.', $iprange);
  $update_sql = mysql_query("UPDATE `phpIP_addresses` SET $where 
				WHERE `ip` LIKE '%$iprangeEx[0].$iprangeEx[1].$iprangeEx[2].%' 
				AND `NetID` = '$netid'");
    ?>
    <script type="text/javascript">
        window.location.href = "<?php echo "display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc" ?>";
    </script>
    <?php
  //header("Location: display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc"); 

} // end access_level
else
        print "<center><h1><font color=red>ACCESS DENIED</font></h1></center>"; 

}
break;

case "update":
{

// Use the myheader function from layout.php
myheader("Update Settings");

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }
	if (isset ($_POST['ip'])) { $ip = strip_tags($_POST['ip']); }
	if (isset ($_POST['mask'])) { $mask = strip_tags($_POST['mask']); }
	if (isset ($_POST['description'])) { $description = strip_tags($_POST['description']); }
	if (isset ($_POST['client'])) { $client = strip_tags($_POST['client']); }
	if (isset ($_POST['clientcontact'])) { $clientcontact = strip_tags($_POST['clientcontact']); }
	if (isset ($_POST['phone'])) { $phone = strip_tags($_POST['phone']); }
	if (isset ($_POST['email'])) { $email = strip_tags($_POST['email']); }
	if (isset ($_POST['notes'])) { $notes = strip_tags($_POST['notes']); }
	if (isset ($_POST['deviceType'])) { $deviceType = strip_tags($_POST['deviceType']); }
	if (isset ($_POST['deviceLocation'])) { $deviceLocation = strip_tags($_POST['deviceLocation']); }
	if (isset ($_POST['deviceOwner'])) { $deviceOwner = strip_tags($_POST['deviceOwner']); }
	if (isset ($_POST['deviceManufacturer'])) { $deviceManufacturer = strip_tags($_POST['deviceManufacturer']); }
	if (isset ($_POST['deviceModel'])) { $deviceModel = strip_tags($_POST['deviceModel']); }
	if (isset ($_POST['deviceCustom1'])) { $deviceCustom1 = strip_tags($_POST['deviceCustom1']); }
	if (isset ($_POST['deviceCustom2'])) { $deviceCustom2 = strip_tags($_POST['deviceCustom2']); }
	if (isset ($_POST['deviceCustom3'])) { $deviceCustom3 = strip_tags($_POST['deviceCustom3']); }
    
    if (isset ($client)) { } else { $client = '';}
    if (isset ($clientcontact)) { } else { $clientcontact = '';}
    if (isset ($phone)) { } else { $phone = '';}
    if (isset ($email)) { } else { $email = '';}
    if (isset ($notes)) { } else { $notes = '';}
    if (isset ($gateway)) { } else { $gateway = '';}
    if (isset ($deviceType)) { } else { $deviceType = '';}
    if (isset ($deviceLocation)) { } else { $deviceLocation = '';}
    if (isset ($deviceOwner)) { } else { $deviceOwner = '';}
    if (isset ($deviceManufacturer)) { } else { $deviceManufacturer = '';}
    if (isset ($deviceModel)) { } else { $deviceModel = '';}
    if (isset ($deviceCustom1)) { } else { $deviceCustom1 = '';}
    if (isset ($deviceCustom2)) { } else { $deviceCustom2 = '';}
    if (isset ($deviceCustom3)) { } else { $deviceCustom3 = '';}
    
	$update_sql = mysql_query("UPDATE `phpIP_addresses` SET mask='$mask', 
  			`description`='$description', 
			`client`='$client', 
			`clientcontact`='$clientcontact', 
			`phone`='$phone', 
  			`email`='$email', 
			`deviceType` = '$deviceType',
			`deviceLocation` = '$deviceLocation',
			`deviceOwner` = '$deviceOwner',
			`deviceManufacturer` = '$deviceManufacturer',
			`deviceModel` = '$deviceModel',
			`deviceCustom1` = '$deviceCustom1',
			`deviceCustom2` = '$deviceCustom2',
			`deviceCustom3` = '$deviceCustom3', 
			`notes`='$notes' WHERE `id` = $id");
    $username = db_fetch_cell("select username from user_auth where id=" . $_SESSION["sess_user_id"]);
	$update_history = mysql_query("INSERT INTO `phpIP_history` VALUES (NOW(), '$id', '$ip', '".$username."', '".$_SERVER['REMOTE_ADDR']."')");
    ?>
    <script type="text/javascript">
        window.location.href = "<?php echo "display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc" ?>";
    </script>
    <?php
  //header("Location: display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc"); 
} // end access_level
else
        print "<center><h1><font color=red>ACCESS DENIED</font></h1></center>"; 
}
break;

// case statment to reset the ip address to defaults
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
case "reset":
{

// Use the myheader function from layout.php
myheader("IP Reset");

	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
		mysql_query("UPDATE  `phpIP_addresses`  SET `gateway` =  NULL, 
					`mask` = NULL, `description` = NULL, `client` = NULL, `clientcontact` = NULL, 
                    `phone` = NULL, `email` = NULL, `notes` = NULL WHERE `id` = '$id' ");
		mysql_query("OPTIMIZE TABLE `phpIP_addresses`");
    ?>
    <script type="text/javascript">
        window.location.href = "<?php echo "display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc" ?>";
    </script>
    <?php
  //header("Location: display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc"); 
}
else
        print "<center><h1><font color=red>ACCESS DENIED</font></h1></center>";
}
break;

//-----------------------------------------------------------------------------------------

// case statement to view ip address
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
case "view":
{

// Use the myheader function from layout.php
myheader("IP View");

	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }

	$idview = mysql_query("SELECT * FROM `phpIP_addresses` WHERE `id` = $id");
		while($row = mysql_fetch_array($idview)){
		// make array include sql results
		 $ip 			= $row['ip'];
		 $client 		= $row['client'];
		 $email  		= $row['email'];
		 $notes  		= $row['notes'];
		 $mask   		= $row['mask'];
		 $phone  		= $row['phone'];
		 $gateway       	= $row['gateway'];
		 $description   	= $row['description'];
		 $clientcontact 	= $row['clientcontact'];
		 $deviceType 		= $row['deviceType'];
		 $deviceLocation 	= $row['deviceLocation'];
		 $deviceOwner  		= $row['deviceOwner'];
		 $deviceManufacturer  	= $row['deviceManufacturer'];
		 $deviceModel   	= $row['deviceModel'];
		 $deviceCustom1  	= $row['deviceCustom1'];
		 $deviceCustom2       	= $row['deviceCustom2'];
		 $deviceCustom3   	= $row['deviceCustom3'];
		}
?>

<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <TR class="listCell">
    <TD colspan="2" class="listCell">ADDRESS MANAGEMENT</TD>
  </TR>
  <TR class="listHeadRow">
    <TD colspan="2" class="listCell">IP VIEW</TD>
 </TR>
  <TR class="listRow2">
    <TD class="listCell">IP</TD>
    <TD class="listCell">&nbsp;<b><?php echo $ip; ?></b>
    <?php
    //if ($_SESSION['resolveDNS'] == '1') {
    //    // check dns and echo if true
    //    $hostbyaddr = gethostbyaddr_with_cache($ip);
    //        switch ($hostbyaddr) {
    //            case "$ip":
    //                break;
    //            default:
    //                echo "[$hostbyaddr]";
    //                break;
    //        }
    //}
   ?>
   </TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">MASK</TD>
    <TD class="listCell">&nbsp;<?php echo $mask; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DESCRIPTION</TD>
    <TD class="listCell">&nbsp;<?php echo $description; ?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">CLIENT</TD>
    <TD class="listCell">&nbsp;<?php echo $client; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">CLIENT CONTACT</TD>
    <TD class="listCell">&nbsp;<?php echo $clientcontact; ?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">PHONE</TD>
    <TD class="listCell">&nbsp;<?php echo $phone; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">EMAIL</TD>
    <TD class="listCell">&nbsp;<?php echo $email; ?></TD>
  </TR>

<?php
    if ( read_config_option('nmidPhpip_showDeviceData') ) {
?>
  <TR class="listRow1">
    <TD class="listCell">DEVICE TYPE</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceType; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE LOCATION</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceLocation; ?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE OWNER</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceOwner; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE MANUFACTURER</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceManufacturer; ?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE MODEL</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceModel; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 1</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceCustom1; ?></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE CUSTOM 2</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceCustom2; ?></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 3</TD>
    <TD class="listCell">&nbsp;<?php echo $deviceCustom3; ?></TD>
  </TR>
<?php
 }
?>
  <TR class="listRow1">
    <TD class="listCell">NOTES</TD>
    <TD class="listCell">&nbsp;<?php echo $notes; ?><input type=hidden name="id" value=<?php echo $id; ?>></TD>
  </TR>
</table>
<table>
  <TR>
    <TD>
        <a href="#" onClick="javascript:document.location.href =
                ('display.php?range=list&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&filter=unalloc')">[GO BACK]</a>&nbsp;

<?php 
	if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
		?>
	<a href="display.php?range=edit&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&id=<?php echo $id; ?>">[EDIT]</a>
<?php 
	} 
?>
    </TD>
</TR>
</table>
<table>
<br>
  <br>

<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
<tr class="listCell">
  <td colspan="3" class="listCell">UPDATE HISTORY</td>
</tr>
<tr class="listHeadRow">
  <td class="listCell">USERNAME</span></td>
  <td class="listCell">MODIFICATION TIME/DATE</td>
  <td class="listCell">HOST ADDRESS</td>
</tr>

<?php

$viewhistory = mysql_query("SELECT * FROM `phpIP_history` WHERE `id` = $id ORDER BY `date` DESC");
$RowClass = "";
	while($rowH = mysql_fetch_array($viewhistory)){

	if ($RowClass == "listRow1") { $RowClass = "listRow2";
          }
          else
           { $RowClass = "listRow2";
        }
	  // loop though history table and print arrays,
	  echo "<tr class=\"$RowClass\">";
	  echo "<td class=\"listCell\">$rowH[username]</td>";
	  echo "<td class=\"listCell\">$rowH[date]</td>";
	  echo "<td class=\"listCell\">$rowH[hostaddress]</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

// Use the footer function from layout.php
footer();

//-----------------------------------------------------------------------------------------
break;

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// case statement to edit the ip address
case "edit":
{

// Use the myheader function from layout.php
myheader("IP Edit");

if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }

	$idedit = mysql_query("SELECT * FROM `phpIP_addresses` WHERE `id` = $id");
        $RowClass = "";
		while($row = mysql_fetch_array($idedit)){
		if ($RowClass == "tablerowgrey") { $RowClass = "tablerowltgrey";
	          }
	          else
	           { $RowClass = "tablerowgrey";
	        }
	// make array include sql results
		 $ip 			= $row['ip'];
		 $client 		= $row['client'];
		 $email  		= $row['email'];
		 $notes  		= $row['notes'];
		 $mask   		= $row['mask'];
		 $phone  		= $row['phone'];
		 $gateway       	= $row['gateway'];
		 $description   	= $row['description'];
		 $clientcontact 	= $row['clientcontact'];
		 $deviceType 		= $row['deviceType'];
		 $deviceLocation 	= $row['deviceLocation'];
		 $deviceOwner 		= $row['deviceOwner'];
		 $deviceManufacturer 	= $row['deviceManufacturer'];
		 $deviceModel 		= $row['deviceModel'];
		 $deviceCustom1 	= $row['deviceCustom1'];
		 $deviceCustom2 	= $row['deviceCustom2'];
		 $deviceCustom3 	= $row['deviceCustom3'];

?>

<form action="display.php?range=update&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&id=<?php echo $id; ?>" method="post" name="update">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <TR class="listCell">
    <TD colspan="2" class="listCell">ADDRESS MANAGEMENT</TD></TR>
  <tr class="listHeadRow">
    <TD colspan="2" class="listCell">IP EDIT</TD></TR>
  <TR class="listRow2">
    <TD class="listCell">IP</TD>
    <TD class="listCell">&nbsp;<input type="hidden" name="ip" value="<?php echo $ip;?>"><b><?php echo $ip;?></b></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">MASK</TD>
    <TD class="listCell">&nbsp;<select type="hidden" size="1" name="mask">
                        <option value="<?php echo $mask; ?>"><?php echo $mask; ?></option>
                        <option value="---------------">---------------</option>
                        <option value="255.255.255.255">255.255.255.255</option>
                        <option value="255.255.255.252">255.255.255.252</option>
                        <option value="255.255.255.248">255.255.255.248</option>
                        <option value="255.255.255.240">255.255.255.240</option>
                        <option value="255.255.255.224">255.255.255.224</option>
                        <option value="255.255.255.192">255.255.252.192</option>
                        <option value="255.255.255.128">255.255.255.128</option>
                        <option value="255.255.255.0">255.255.255.0</option>
                        <option value="255.255.254.0">255.255.254.0</option>
                        <option value="255.255.252.0">255.255.252.0</option>
                        <option value="255.255.248.0">255.255.248.0</option>
                        <option value="255.255.240.0">255.255.240.0</option>
                        <option value="255.255.224.0">255.255.224.0</option>
                        <option value="255.255.192.0">255.255.192.0</option>
                        <option value="255.255.128.0">255.255.128.0</option>
                        <option value="255.255.0.0">255.255.0.0</option>
                        <option value="255.254.0.0">255.255.0.0</option>
                        <option value="255.252.0.0">255.252.0.0</option>
                        <option value="255.248.0.0">255.248.0.0</option>
                        <option value="255.240.0.0">255.240.0.0</option>
                        <option value="255.224.0.0">255.224.0.0</option>
                        <option value="255.192.0.0">255.192.0.0</option>
                        <option value="255.128.0.0">255.128.0.0</option>
                        <option value="255.0.0.0">255.0.0.0</option>
                        </TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DESCRIPTION</TD>
    <TD class="listCell">&nbsp;<input type="text" type="hidden" size=30 name="description" value="<?php echo $description; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">CLIENT</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="client" value="<?php echo $client; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">CLIENT CONTACT</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="clientcontact" value="<?php echo $clientcontact; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">PHONE</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="phone" value="<?php echo $phone; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">EMAIL</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="email" value="<?php echo $email; ?>"></TD>
  </TR>
<?php
    if ( read_config_option('nmidPhpip_showDeviceData') ) {
?>
  <TR class="listRow1">
    <TD class="listCell">DEVICE TYPE</TD>
    <TD class="listCell">&nbsp;<select type="hidden" size="1" name="deviceType">
                        <option value="<?php echo $deviceType; ?>"><?php echo $deviceType; ?></option>
                        <option value="---------------">---------------</option>
                        <option value="Unassigned">Unassigned</option>
                        <option value="Router">Router</option>
                        <option value="Switch">Switch</option>
                        <option value="Access Point">Access Point</option>
                        <option value="RAS">RAS</option>
                        <option value="Firewall">Firewall</option>
                        <option value="VPN">VPN</option>
                        <option value="IDS, IDP">IDS, IDP</option>
                        <option value="Application Server">Application Server</option>
                        <option value="Terminal Server">Terminal Server</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Desktop Phone">Desktop Phone</option>
                        <option value="Printer">Printer</option>
                        <option value="NAS">NAS</option>
                        <option value="Other">Other</option>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE LOCATION</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceLocation" value="<?php echo $deviceLocation; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE OWNER</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceOwner" value="<?php echo $deviceOwner; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE MANUFACTURER</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceManufacturer" value="<?php echo $deviceManufacturer; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE MODEL</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceModel" value="<?php echo $deviceModel; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 1</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom1" value="<?php echo $deviceCustom1; ?>"></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DEVICE CUSTOM 2</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom2" value="<?php echo $deviceCustom2; ?>"></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DEVICE CUSTOM 3</TD>
    <TD class="listCell">&nbsp;<input type="text" size=30 name="deviceCustom3" value="<?php echo $deviceCustom3; ?>"></TD>
  </TR>

<?php
}
?>

  <TR class="listRow1">
    <TD class="listCell">NOTES</TD>
    <TD class="listCell">&nbsp;<textarea ROWS=5 COLS=30 name=notes><?php echo $notes; ?></textarea></TD>
  </TR>
  <TR>
  <TD>
  <input type=hidden name="id" value=<?php echo $id; ?> >
  </TD>
</table>
<?php

}
?>
<table>
  <TR>
    <TD>
	<a href="#" onClick="javascript:document.location.href = 
		('display.php?range=list&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&filter=unalloc')">[GO BACK]</a> &nbsp;
  	<a href="javascript:document.update.submit()">[SAVE]</a> &nbsp;
	<a href="display.php?range=reset&iprange=<?php echo $iprange; ?>&netid=<?php echo $netid; ?>&id=<?php echo $id; ?>">[RESET ENTRY]</a> 
    </TD>
</TR>
</table>
</FORM>

<?php

// Use the footer function from layout.php
footer();

} // end access_level
else
        print "<center><h1><font color=red>ACCESS DENIED</font></h1></center>";


}
break;

//--------------------------------------------------------------------------------------------

// case statement to display the list of addresses
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// list view
case "list":
{

	if (isset ($_POST['iprange'])) { $iprange = strip_tags($_POST['iprange']); }
	if (isset ($_GET['iprange'])) { $iprange = strip_tags($_GET['iprange']); }
	if (isset ($_POST['id'])) { $id = strip_tags($_POST['id']); }
	if (isset ($_GET['id'])) { $id = strip_tags($_GET['id']); }
	if (isset ($_POST['filter'])) { $filter = strip_tags($_POST['filter']); }
	if (isset ($_GET['filter'])) { $filter = strip_tags($_GET['filter']); }
	if (isset ($_POST['netid'])) { $netid = strip_tags($_POST['netid']); }
	if (isset ($_GET['netid'])) { $netid = strip_tags($_GET['netid']); }

// Use the myheader function from layout.php
myheader("IP List -- $iprange");

// translate session to name
	$sorder1 = read_config_option('nmidPhpip_sorder1');
	$sorder2 = read_config_option('nmidPhpip_sorder2');
	$sorder3 = read_config_option('nmidPhpip_sorder3');
	$sorder4 = read_config_option('nmidPhpip_sorder4');

// replace merge database name with display name
switch ($sorder1) {
            case "ip":
                $order1="IP";
                break;
            case "mask":
                $order1="Mask";
                break;                
            case "description":
                $order1="Description";
                break;       
            case "client":
                $order1="Client";
                break;                
            case "phone":
                $order1="Phone";
                break;                
            case "email":
                $order1="Email";
                break;                
            case "notes":
                $order1="Notes";
                break;       
            case "clientcontact":
                $order1="Client Contact";
                break;
            case "deviceType":
                $order1="Device Type";
                break;
            case "deviceLocation":
                $order1="Device Location";
                break;
            case "deviceOwner":
                $order1="Device Owner";
                break;
            case "deviceManufacturer":
                $order1="Device Manufacturer";
                break;
            case "deviceModel":
                $order1="Device Model";
                break;
            case "deviceCustom1":
                $order1="Device Custom 1";
                break;
            case "deviceCustom2":
                $order1="Device Custom 2";
                break;
            case "deviceCustom3":
                $order1="Device Custom 3";
                break;
            default: $order1 = $sorder1;
                break;
}
switch ($sorder2) {
            case "ip":
                $order2="IP";
                break;
            case "mask":
                $order2="Mask";
                break;                
            case "description":
                $order2="Description";
                break;       
            case "client":
                $order2="Client";
                break;                
            case "phone":
                $order2="Phone";
                break;                
            case "email":
                $order2="Email";
                break;                
            case "notes":
                $order2="Notes";
                break;       
            case "clientcontact":
                $order2="Client Contact";
                break;
            case "deviceType":
                $order2="Device Type";
                break;
            case "deviceLocation":
                $order2="Device Location";
                break;
            case "deviceOwner":
                $order2="Device Owner";
                break;
            case "deviceManufacturer":
                $order2="Device Manufacturer";
                break;
            case "deviceModel":
                $order2="Device Model";
                break;
            case "deviceCustom1":
                $order2="Device Custom 1";
                break;
            case "deviceCustom2":
                $order2="Device Custom 2";
                break;
            case "deviceCustom3":
                $order2="Device Custom 3";
                break;
            default: $order2 = $sorder2;
                break;
}
switch ($sorder3) {
            case "ip":
                $order3="IP";
                break;
            case "mask":
                $order3="Mask";
                break;                
            case "description":
                $order3="Description";
                break;       
            case "client":
                $order3="Client";
                break;                
            case "phone":
                $order3="Phone";
                break;                
            case "email":
                $order3="Email";
                break;                
            case "notes":
                $order3="Notes";
                break;       
            case "clientcontact":
                $order3="Client Contact";
                break;
            case "deviceType":
                $order3="Device Type";
                break;
            case "deviceLocation":
                $order3="Device Location";
                break;
            case "deviceOwner":
                $order3="Device Owner";
                break;
            case "deviceManufacturer":
                $order3="Device Manufacturer";
                break;
            case "deviceModel":
                $order3="Device Model";
                break;
            case "deviceCustom1":
                $order3="Device Custom 1";
                break;
            case "deviceCustom2":
                $order3="Device Custom 2";
                break;
            case "deviceCustom3":
                $order3="Device Custom 3";
                break;
            default: $order3 = $sorder3;
                break;
}
switch ($sorder4) {
            case "ip":
                $order4="IP";
                break;
            case "mask":
                $order4="Mask";
                break;                
            case "description":
                $order4="Description";
                break;       
            case "client":
                $order4="Client";
                break;                
            case "phone":
                $order4="Phone";
                break;                
            case "email":
                $order4="Email";
                break;                
            case "notes":
                $order4="Notes";
                break;       
            case "clientcontact":
                $order4="Client Contact";
                break;
            case "deviceType":
                $order4="Device Type";
                break;
            case "deviceLocation":
                $order4="Device Location";
                break;
            case "deviceOwner":
                $order4="Device Owner";
                break;
            case "deviceManufacturer":
                $order4="Device Manufacturer";
                break;
            case "deviceModel":
                $order4="Device Model";
                break;
            case "deviceCustom1":
                $order4="Device Custom 1";
                break;
            case "deviceCustom2":
                $order4="Device Custom 2";
                break;
            case "deviceCustom3":
                $order4="Device Custom 3";
                break;
            default: $order4 = $sorder4;
                break;
}


$iprangeEx = explode('.', $iprange);

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

  echo "<table border='0' width='700'>";
    echo "<tr>";
     if (strcmp($filter,"unalloc")!=0) { 
       echo "<td width='100%'><a target='_blank' href='print.php?ip=$iprange&netid=$netid'>[PRINT REPORT]</a>&nbsp;
	<a href='display.php?range=list&iprange=$iprange&netid=$netid&filter=unalloc'>[HIDE UNALLOCATED]</a>&nbsp;
	        <a href='display.php?range=default&iprange=$iprange&netid=$netid'>[SET DEFAULT]</a>&nbsp;&nbsp;";
                //if ($_SESSION['resolveDNS'] == '1') {
                //        echo "<img src=\"i/mark-ok.gif\" ALT=\"Hover over the check mark or X for values\" TITLE=\"Hover over the
                //        Check Mark or X for values\">DNS RESOLVED";
                //}
        echo "</td>";
	} 
        else 
	  { 
	  echo "<td width='100%'><a target='_blank' href='print.php?ip=$iprange&netid=$netid&filter=unalloc'>[PRINT REPORT]</a>&nbsp;
	        <a href='display.php?range=list&iprange=$iprange&netid=$netid'>[SHOW UNALLOCATED]</a>&nbsp;
	        <a href='display.php?range=default&iprange=$iprange&netid=$netid'>[SET DEFAULT]</a>&nbsp;&nbsp;";
                //if ($_SESSION['resolveDNS'] == '1') {
                //        echo "<img src=\"i/mark-ok.gif\" ALT=\"Hover over the check mark or X for values\" TITLE=\"Hover over the
                //        Check Mark or X for values\">DNS RESOLVED";
                //}
        echo "</td>";
    }
     echo "</tr>";
     echo "</table>";
     echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
     echo "<tr class=\"listCell\">";
     echo "<td colspan=\"5\" class=\"listCell\">IP RANGE $iprange</td>";
     echo "</tr>";
     echo "<tr class=\"listHeadRow\">";
     echo "<td align=center>&nbsp;&nbsp;</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order1)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order2)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order3)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order4)."</td>";
     echo "</tr>";
    $RowClass = '';
    while ($row = mysql_fetch_array($results)) {
        if ($RowClass == "listRow2") {
            $RowClass = "listRow1";
        } else {
            $RowClass = "listRow2";
        }
        echo "<tr class=\"$RowClass\">";
        echo "<td class=\"listCell\" width=\"50\"><a href=\"display.php?range=view&id=$row[id]&iprange=$iprange&netid=$netid\">[Details]</a>";

        if ((db_fetch_assoc("select user_auth_realm.realm_id
            from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
            and user_auth_realm.realm_id='1194'")) )
        {
            echo "&nbsp;<a href=\"display.php?range=edit&iprange=$iprange&netid=$netid&id=$row[id]\">[Edit]</a></td>";
        }
    
        $query = "select value from settings where name='nmidPhpip_useDNS'";
        $result = mysql_query($query);
        $dnsOption = mysql_fetch_assoc($result);
      
        $ip = gethostbyname( $row[$sorder1] );
        $dnsWhere = '';
        if ( $dnsOption['value'] ) {
            $dnsName = gethostbyaddr($ip);
            $dnsWhere = " OR hostname like upper('".$dnsName."%')";
        }
    
        $query = "select description,hostname,notes from host where hostname='".$ip."'". $dnsWhere;
        $result = mysql_query($query);
        if ( isset ($result) ) {
            $config_option = mysql_fetch_assoc($result);
        }
    
        echo "<td class=\"listCell\">&nbsp;$row[$sorder1]&nbsp;&nbsp;";
        
        $query = "select value from settings where name='nmidPhpip_resolveDNS'";
        $result = mysql_query($query);
        $dnsOption = mysql_fetch_assoc($result);    

        if ($dnsOption['value']) {
            // Query dns and cache data to speed up queris
            // Compare IP and DNS host name if they are the same
            if ( $row['client'] ) {
                $hostbyaddr = gethostbyaddr($row['ip']);
                switch ($hostbyaddr) {
                    case $row['ip']:
                        echo "<a href=\"javascript:void(0)\" onclick=\"return overlib('No DNS Entry', STICKY, CAPTION,'FQDN');\" onmouseover=\"return overlib('No DNS Entry', STICKY, CAPTION,'FQDN');\" onmouseout=\"return nd();\"><img src=\"i/mark-cancel.gif\"border=\"0\"></a>";
                        break;
                    default:
                        echo "<a href=\"javascript:void(0)\" onclick=\"return overlib('$hostbyaddr', STICKY, CAPTION,'FQDN');\" onmouseover=\"return overlib('$hostbyaddr', STICKY, CAPTION,'FQDN');\" onmouseout=\"return nd();\"><img src=\"i/mark-ok.gif\" border=\"0\"></a>";
                        break;
                }
            }
        }

      echo "</td>";

      if ( isset($config_option['hostname']) ) {
        if ( $row['isCactiDevice'] == '1' ) {
            echo "<td class=\"listCell\">&nbsp;$row[$sorder2]</td>";
            echo "<td class=\"listCell\">&nbsp;$row[$sorder3]</td>";
            echo "<td class=\"listCell\">&nbsp;$row[$sorder4]</td>";
        } else {
            echo "<td class=\"listCell\">&nbsp;".$row[$sorder2]." </td>";

            if ( $sorder3 == 'description' ) {
                echo "<td class=\"listCell\">&nbsp;".$config_option['description']." </td>";
            }
            else {
                echo "<td class=\"listCell\">&nbsp;$row[$sorder3]</td>";
            }

            if ( $sorder4 == 'notes' ) {
                echo "<td class=\"listCell\">&nbsp;".$config_option['notes']." </td>";
            }
            else {
                echo "<td class=\"listCell\">&nbsp;$row[$sorder4]</td>";
            }
            $query = "UPDATE `phpIP_addresses` SET notes = \"".$config_option['notes']."\",".
                    "description = \"".$config_option['description']."\",".
                    "client = \"cacti device\", ".
                    "isCactiDevice = 1 ".
                    "WHERE id = ".$row['id'] . " AND ip = \"".$config_option['hostname']."\"";
                    
            $result = mysql_query($query);
        }
      }
      else
      {
        echo "<td class=\"listCell\">&nbsp;$row[$sorder2]</td>";
        echo "<td class=\"listCell\">&nbsp;$row[$sorder3]</td>";
        echo "<td class=\"listCell\">&nbsp;$row[$sorder4]</td>";
      }
	  echo "</tr>";
    } //end while loop

echo "</table>";

// Use the footer function from layout.php
footer();
}
break;

default:

// Use the myheader function from layout.php
myheader("IP Search");

  echo "<center><h1>Please select a network to search.</center></h1>";

  // Use the footer function from layout.php
footer();

} // end switch
//------------------------------------------------------------------------------------------

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
              <?php print getTree(); ?>
       </td>
    <td valign=top>
    <?php
}
?>
