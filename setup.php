<?php
/*******************************************************************************

    Author ......... Thomas Urban
    Contact ........ nmid@urban-software.de
    Home Site ...... http://www.urban-software.de
    Program ........ Network Management Inventory Database for Cacti
    Version ........ 0.1
    Purpose ........ Exporting Inventory Information to other
					 network manangement tools.
					 
	NM Tools ....... Smokeping
					 NetFlow Tracker ( Fluke Networks )
					 phpIP
*******************************************************************************/

function plugin_init_nmidPhpip() {
	global $plugin_hooks;
	$plugin_hooks['top_header_tabs']['nmidPhpip'] = 'nmidPhpip_show_tab';
	$plugin_hooks['top_graph_header_tabs']['nmidPhpip'] = 'nmidPhpip_show_tab';
	$plugin_hooks['config_arrays']['nmidPhpip'] = 'nmidPhpip_config_arrays';
	$plugin_hooks['draw_navigation_text']['nmidPhpip'] = 'nmidPhpip_draw_navigation_text';
	$plugin_hooks['config_settings']['nmidPhpip'] = 'nmidPhpip_config_settings';
	$plugin_hooks['console_after']['nmidPhpip'] = 'nmidPhpip_console_after';
	$plugin_hooks['page_head']['nmidPhpip']   = 'nmidPhpip_pageHead';

}

function nmidPhpip_pageHead () {
?>
	<link rel="stylesheet" href="css/jquery.treeview.css" /> 
	<link rel="stylesheet" href="css/screen.css" /> 
	
	<script src="lib/jquery.js" type="text/javascript"></script> 
	<script src="lib/jquery.cookie.js" type="text/javascript"></script> 
	<script src="lib/jquery.treeview.js" type="text/javascript"></script> 
	<script type="text/javascript">
	$(document).ready(function(){
			   // second example
		   $("#browser").treeview({
			persist: "cookie",
			cookieId: "treeview-black"			
		   });
		  });       
	</script>
<?php
}

function nmidPhpip_console_after () {
	global $config, $plugins;
	nmidPhpip_setup_table();
}
	
function nmidPhpip_config_settings () {
	global $tabs, $settings;
	$tabs["nmid"] = "NMID";

	$temp = array(
		"nmidPhpip_generalheader" => array(
			"friendly_name" => "NMID - PHPIP Settings",
			"method" => "spacer",
			),
        "nmidPhpip_useDNS" => array(
			"friendly_name" => "Use DNS as hostname",
			"description" => "Check this box if you're using DNS names instead of IP addresses for polling devices.",
            "method" => "checkbox",
			"max_length" => "255"
			),
        "nmidPhpip_resolveDNS" => array(
			"friendly_name" => "Resolve IP to DNS names",
			"description" => "Check this box if you want to resolve the IPs to DNS names.",
            "method" => "checkbox",
			"max_length" => "255"
			),
        "nmidPhpip_showDeviceData" => array(
			"friendly_name" => "Show Device Data",
			"description" => "Show Device Data.",
            "method" => "checkbox",
			"max_length" => "255"
			),
        "nmidPhpip_uploadDir" => array(
			"friendly_name" => "Import File Upload Tmp Directory",
			"description" => "Set the tmp upload directory for the import files.",
            "method" => "textbox",
			"max_length" => "255"
			),
		"nmidPhpip_sorder1" => array(
            "friendly_name" => "Display Order 1",
            "description" => "What to display in the table.",
            "method" => "drop_array",
            "default" => "ip",
            "array" => array(
                "ip" => "IP",
                "mask" => "Mask",
                "description" => "Description",
                "client" => "Client",
                "phone" => "Phone",
                "email" => "Email",
                "notes" => "Notes",
                "clientcontact" => "Client Contact",
                "deviceType" => "Device Type",
                "deviceLocation" => "Device Location",
                "deviceOwner" => "Device Owner",
                "deviceManufacturer" => "Device Manufacturer",
                "deviceModel" => "Device Model",
                "deviceCustom1" => "Device Custom 1",
                "deviceCustom2" => "Device Custom 2",
                "deviceCustom3" => "Device Custom 3"
            ),
        ),
		"nmidPhpip_sorder2" => array(
            "friendly_name" => "Display Order 2",
            "description" => "What to display in the table.",
            "method" => "drop_array",
            "default" => "client",
            "array" => array(
                "ip" => "IP",
                "mask" => "Mask",
                "description" => "Description",
                "client" => "Client",
                "phone" => "Phone",
                "email" => "Email",
                "notes" => "Notes",
                "clientcontact" => "Client Contact",
                "deviceType" => "Device Type",
                "deviceLocation" => "Device Location",
                "deviceOwner" => "Device Owner",
                "deviceManufacturer" => "Device Manufacturer",
                "deviceModel" => "Device Model",
                "deviceCustom1" => "Device Custom 1",
                "deviceCustom2" => "Device Custom 2",
                "deviceCustom3" => "Device Custom 3"
            ),
        ),
		"nmidPhpip_sorder3" => array(
            "friendly_name" => "Display Order 3",
            "description" => "What to display in the table.",
            "method" => "drop_array",
            "default" => "description",
            "array" => array(
                "ip" => "IP",
                "mask" => "Mask",
                "description" => "Description",
                "client" => "Client",
                "phone" => "Phone",
                "email" => "Email",
                "notes" => "Notes",
                "clientcontact" => "Client Contact",
                "deviceType" => "Device Type",
                "deviceLocation" => "Device Location",
                "deviceOwner" => "Device Owner",
                "deviceManufacturer" => "Device Manufacturer",
                "deviceModel" => "Device Model",
                "deviceCustom1" => "Device Custom 1",
                "deviceCustom2" => "Device Custom 2",
                "deviceCustom3" => "Device Custom 3"
            ),
        ),
		"nmidPhpip_sorder4" => array(
            "friendly_name" => "Display Order 4",
            "description" => "What to display in the table.",
            "method" => "drop_array",
            "default" => "notes",
            "array" => array(
                "ip" => "IP",
                "mask" => "Mask",
                "description" => "Description",
                "client" => "Client",
                "phone" => "Phone",
                "email" => "Email",
                "notes" => "Notes",
                "clientcontact" => "Client Contact",
                "deviceType" => "Device Type",
                "deviceLocation" => "Device Location",
                "deviceOwner" => "Device Owner",
                "deviceManufacturer" => "Device Manufacturer",
                "deviceModel" => "Device Model",
                "deviceCustom1" => "Device Custom 1",
                "deviceCustom2" => "Device Custom 2",
                "deviceCustom3" => "Device Custom 3"
            ),
        ),
        
        
        
		//"nmidPhpip_showtab" => array(
		//	"friendly_name" => "Show nmidPhpip IP Display as Tab",
		//	"description" => "Show nmidPhpip IP Display screen as Tab on top. You need to reload the page before the change is visible.",
		//	"method" => "checkbox",
		//	"max_length" => "255"
		//	),          
    );

	if (isset($settings["nmid"]))
		$settings["nmid"] = array_merge($settings["nmid"], $temp);
	else
		$settings["nmid"] = $temp;
}


function nmidPhpip_show_tab () {
	global $config, $user_auth_realms, $user_auth_realm_filenames, $nmidPhpip_tab;
    include_once($config["base_path"] . "/plugins/nmidPhpip/config.php");
	    
    if ( read_config_option('nmidPhpip_showtab') )
    {
        $ourFileName = $config["base_path"] . "/plugins/nmidPhpip/config.php";
        $fh = fopen($ourFileName, 'w') or die("Can't open file");
        fwrite($fh, '<?php $nmidPhpip_tab = TRUE; ?>');
        fclose($fh);        
    }
    else
    {
        $ourFileName = $config["base_path"] . "/plugins/nmidPhpip/config.php";
        $fh = fopen($ourFileName, 'w') or die("Can't open file");
        fwrite($fh, '<?php $nmidPhpip_tab = FALSE; ?>');
        fclose($fh);        
    }
    
	if (!$nmidPhpip_tab)
		return;

    if ((db_fetch_assoc("select user_auth_realm.realm_id
        from user_auth_realm where user_auth_realm.user_id='" . $_SESSION["sess_user_id"] . "'
        and user_auth_realm.realm_id='1194'")) )
    {
        print '<a href="' . $config['url_path'] . 'plugins/nmidPhpip/display.php"><img src="' . $config['url_path'] . 'plugins/nmidPhpip/images/tab_nmidPhpip.gif" alt="nmid" align="absmiddle" border="0"></a>';
	}    
}

function nmidPhpip_config_arrays () {
	global $user_auth_realms, $user_auth_realm_filenames, $menu, $config, $nmidPhpip_tab;
    
    include_once($config["base_path"] . "/plugins/nmidPhpip/config.php");

	$user_auth_realms[1193]='NMID - View nmidPhpip Admin Console';
	$user_auth_realms[1194]='NMID - View nmidPhpip IP Display';
	$user_auth_realm_filenames['cidr_add.php'] = 1193;
	$user_auth_realm_filenames['cidr_remove.php'] = 1193;
	$user_auth_realm_filenames['cidr_desc.php'] = 1193;
	$user_auth_realm_filenames['prefix_add.php'] = 1193;
	$user_auth_realm_filenames['prefix_remove.php'] = 1193;
	$user_auth_realm_filenames['prefix_desc.php'] = 1193;
	//$user_auth_realm_filenames['group_add.php'] = 1193;
	//$user_auth_realm_filenames['group_remove.php'] = 1193;
	//$user_auth_realm_filenames['group_update.php'] = 1193;
	$user_auth_realm_filenames['subnetSummary.php'] = 1193;
	$user_auth_realm_filenames['display.php'] = 1194;
	$user_auth_realm_filenames['print.php'] = 1194;
	$user_auth_realm_filenames['search.php'] = 1194;
	$user_auth_realm_filenames['import.php'] = 1194;
	$user_auth_realm_filenames['nmidPhpip.php'] = 1194;
    $user_auth_realm_filenames['get_data.php'] = 1194;
    $user_auth_realm_filenames['upload.php'] = 1194;
    
    $strippedUrlPath = ''; //preg_replace("/^\//","",$config['url_path'] );

    $temp = array(
        $strippedUrlPath . "plugins/nmidPhpip/display.php" => array(
            $strippedUrlPath . "plugins/nmidPhpip/display.php" => "NMID phpIP",
            $strippedUrlPath . "plugins/nmidPhpip/cidr_add.php" => "CIDR Add",
            $strippedUrlPath . "plugins/nmidPhpip/cidr_remove.php" => "CIDR Remove",
            $strippedUrlPath . "plugins/nmidPhpip/cidr_desc.php" => "CIDR Description",
            $strippedUrlPath . "plugins/nmidPhpip/prefix_add.php" => "Prefix Add",
            $strippedUrlPath . "plugins/nmidPhpip/prefix_remove.php" => "Prefix Remove",
            $strippedUrlPath . "plugins/nmidPhpip/prefix_desc.php" => "Prefix Description",
            $strippedUrlPath . "plugins/nmidPhpip/search.php" => "Search",
            $strippedUrlPath . "plugins/nmidPhpip/import.php" => "Import",
            $strippedUrlPath . "plugins/nmidPhpip/subnetSummary.php" => "Subnet Summary",
            ),
    );

	if (isset($menu["NMID"]))
		$menu["NMID"] = array_merge($temp, $menu["NMID"]);
	else
		$menu["NMID"] = $temp;
}


function nmidPhpip_draw_navigation_text ($nav) {
   $nav["cidr_add.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "cidr_add.php", "level" => "1");
   $nav["cidr_remove.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "cidr_remove.php", "level" => "1");
   $nav["cidr_desc.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "cidr_desc.php", "level" => "1");
   $nav["prefix_add.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "prefix_add.php", "level" => "1");
   $nav["prefix_remove.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "prefix_remove.php", "level" => "1");
   $nav["prefix_desc.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "prefix_desc.php", "level" => "1");
   //$nav["group_add.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "group_add.php", "level" => "1");
   //$nav["group_remove.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "group_remove.php", "level" => "1");
   //$nav["group_update.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "group_update.php", "level" => "1");
   $nav["subnetSummary.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "subnetSummary.php", "level" => "1");
   $nav["display.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "display.php", "level" => "1");
   $nav["print.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "print.php", "level" => "1");
   $nav["search.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "search.php", "level" => "1");
   $nav["import.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "import.php", "level" => "1");
   $nav["nmidPhpip.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "nmidPhpip.php", "level" => "1");
   $nav["get_data.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "get_data.php", "level" => "1");
   $nav["upload.php:"] = array("title" => "NMID phpIP", "mapping" => "index.php:", "url" => "upload.php", "level" => "1");

   return $nav;
}

function nmidPhpip_version () {
	return array( 'name' 	=> 'nmidPhpip',
			'version' 	=> '0.3.9a',
			'longname'	=> 'NMID phpIP Plugin',
			'author'	=> 'Thomas Urban',
			'homepage'	=> 'http://www.urban-software.de',
			'email'	    => 'support@urban-software.de',
			'url'		=> 'http://urban-software.de/nmidPhpip/versions.php'
			);
}

function nmidPhpip_setup_table () {
	global $config, $database_default;
	include_once($config["library_path"] . "/database.php");
	$sql = "show tables from `" . $database_default . "`";

	$result = db_fetch_assoc($sql) or die (mysql_error());

	$tables = array();
	$sql = array();

	foreach($result as $index => $arr) {
		foreach ($arr as $t) {
			$tables[] = $t;
		}
	}

	if (!in_array('phpIP_NetMenu', $tables)) {
        mysql_query("CREATE TABLE `phpIP_NetMenu` (  `NetMenuId` mediumint(25) NOT NULL auto_increment,  `NetMenuCidr` varchar(36) NOT NULL default '',  `NetCidrDescription` varchar(255) NOT NULL default '',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`NetMenuId`),  KEY `NetMenuCidr` (`NetMenuCidr`)) TYPE=MyISAM;");
    }
	if (!in_array('phpIP_addresses', $tables)) {
        mysql_query("CREATE TABLE `phpIP_addresses` (  `id` mediumint(25) NOT NULL auto_increment,  `groupid` mediumint(25) NOT NULL default '1',  `NetID` mediumint(25) NOT NULL default '0',  `ip` varchar(36) default NULL,  `mask` varchar(16) default NULL,  `gateway` varchar(16) default NULL,  `description` varchar(255) default NULL,  `client` text,  `clientcontact` text,  `phone` varchar(12) default NULL,  `email` varchar(255) default NULL,  `deviceType` varchar(255) NOT NULL default '',  `deviceLocation` varchar(255) NOT NULL default '',  `deviceOwner` varchar(255) NOT NULL default '',  `deviceManufacturer` varchar(255) NOT NULL default '',  `deviceModel` varchar(255) NOT NULL default '',  `deviceCustom1` varchar(255) NOT NULL default '',  `deviceCustom2` varchar(255) NOT NULL default '',  `deviceCustom3` varchar(255) NOT NULL default '',  `notes` mediumtext,  `isCactiDevice` varchar(2) NOT NULL default '0',  PRIMARY KEY  (`id`),  KEY `ip` (`ip`),  KEY `mask` (`mask`),  KEY `gateway` (`gateway`),  KEY `description` (`description`),  KEY `phone` (`phone`),  KEY `email` (`email`),  KEY `deviceType` (`deviceType`),  KEY `deviceLocation` (`deviceLocation`),  KEY `deviceOwner` (`deviceOwner`),  KEY `device Model` (`deviceModel`),  KEY `deviceManufacturer` (`deviceManufacturer`),  KEY `deviceCustom2` (`deviceCustom2`),  KEY `deviceCustom3` (`deviceCustom3`),  KEY `deviceCustom1` (`deviceCustom1`)) TYPE=MyISAM;");
    }
	if (!in_array('phpIP_groups', $tables)) {
        mysql_query("CREATE TABLE `phpIP_groups` (  `id` mediumint(25) NOT NULL auto_increment,  `group` varchar(255) NOT NULL default '',  PRIMARY KEY  (`id`)) TYPE=MyISAM;");
        mysql_query("INSERT INTO `phpIP_groups` (`id`, `group`) VALUES (1, 'Default Group');");
    }
	if (!in_array('phpIP_history', $tables)) {
        mysql_query("CREATE TABLE `phpIP_history` (  `date` datetime default NULL,  `id` mediumint(25) default '0',  `ip` varchar(36) NOT NULL default '',  `username` varchar(16) NOT NULL default '',  `hostaddress` varchar(16) NOT NULL default '',  UNIQUE KEY `date` (`date`),  KEY `id` (`id`,`username`,`date`),  KEY `hostaddress` (`hostaddress`),  KEY `ip` (`ip`)) TYPE=MyISAM;");
    }
	if (!in_array('phpIP_ldap', $tables)) {
        mysql_query("CREATE TABLE `phpIP_ldap` (  `ldapId` mediumint(25) NOT NULL auto_increment,  `ldapConnect` varchar(255) NOT NULL default '',  `ldapPort` varchar(255) NOT NULL default '',  PRIMARY KEY  (`ldapId`)) TYPE=MyISAM COMMENT='Ldap Connect statement' TYPE=MyISAM;");
    }
	if (!in_array('phpIP_net_ips', $tables)) {
        mysql_query("CREATE TABLE `phpIP_net_ips` (  `AddressId` mediumint(25) NOT NULL auto_increment,  `netaddress` varchar(36) NOT NULL default '',  `ip_description` varchar(255) NOT NULL default '',  `view` mediumint(10) NOT NULL default '0',  `NetCidr` mediumint(10) NOT NULL default '0',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`AddressId`),  KEY `ip_description` (`ip_description`)) TYPE=MyISAM;");
    }
	if (!in_array('phpIP_preference', $tables)) {
        mysql_query("CREATE TABLE `phpIP_preference` (  `id` mediumint(25) NOT NULL auto_increment,  `uid` mediumint(25) NOT NULL default '0',  `showCidr` mediumint(25) NOT NULL default '0',  `showPrefix` mediumint(25) NOT NULL default '0',  `style` varchar(255) NOT NULL default '',  `showDeviceData` mediumint(10) NOT NULL default '0',  `sorder1` varchar(255) NOT NULL default 'ip',  `sorder2` varchar(255) NOT NULL default 'mask',  `sorder3` varchar(255) NOT NULL default 'description',  `sorder4` varchar(255) NOT NULL default 'client',  `resolveDNS` mediumint(25) NOT NULL default '0',  PRIMARY KEY  (`id`)) TYPE=MyISAM COMMENT='Preference ' TYPE=MyISAM;");
    }
	if (!in_array('phpIP_style', $tables)) {
        mysql_query("CREATE TABLE `phpIP_style` (  `styleID` mediumint(25) NOT NULL auto_increment,  `styleType` varchar(255) NOT NULL default '',  `styleName` varchar(255) NOT NULL default '',  PRIMARY KEY  (`styleID`)) TYPE=MyISAM COMMENT='css style ' TYPE=MyISAM;");
        mysql_query("INSERT INTO `phpIP_style` (`styleID`, `styleType`, `styleName`) VALUES (1, 'default.css', 'default');");
    }
	if (!in_array('phpIP_users', $tables)) {
        mysql_query("CREATE TABLE `phpIP_users` (  `uid` mediumint(25) NOT NULL auto_increment,  `username` varchar(255) NOT NULL default '',  `access_level` varchar(16) NOT NULL default 'Guest',  `type` varchar(255) NOT NULL default '',  `name` varchar(255) NOT NULL default '',  `email` mediumtext NOT NULL,  `password` varchar(255) NOT NULL default '',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`uid`),  KEY `access_level` (`access_level`),  KEY `type` (`type`)) TYPE=MyISAM;");
    }
	if (!in_array('phpIP_version', $tables)) {
        mysql_query("CREATE TABLE `phpIP_version` (  `phpip` char(20) NOT NULL default '',  KEY `phpip` (`phpip`) ) TYPE=MyISAM;");
        mysql_query("INSERT INTO `phpIP_version` (`phpip`) VALUES ('4.3.2');");
		// Host table does not contain nmid settings entry. Adding it now
		mysql_query("INSERT INTO `user_auth_realm` VALUES (1193, 1);");
		mysql_query("INSERT INTO `user_auth_realm` VALUES (1194, 1);");		
    }

    // update function for > 0.3.8l
    $entires = db_fetch_assoc("describe phpIP_addresses");
    $entry_exists = 0;
    foreach ($entires as $entry)
    {
        if ($entry["Field"] == "isCactiDevice")
        {
                $entry_exists = 1;
        }
    }
    if ($entry_exists == 0)
    {
        // Host table does not contain nmid settings entry. Adding it now
        db_execute("alter table phpIP_addresses add  `isCactiDevice` varchar(2) NOT NULL default '0'");
    }
	
}

?>
