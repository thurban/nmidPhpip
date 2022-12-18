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
    include_once($config["library_path"] . "/tree.php");
    include_once($config["library_path"] . "/data_query.php");


function getTree() {
	$i = 0;
	$tree_list = get_graph_tree_array();

    $sql_join = "";
    $sql_where = "";
    $oldTier = 0;
    $text = '<ul id="browser" class="filetree">';
	
	if (sizeof($tree_list) > 0) {
		foreach ($tree_list as $tree) {
			$i++;
			$heirarchy = db_fetch_assoc("select
				graph_tree_items.id,
				graph_tree_items.title,
				graph_tree_items.order_key,
				graph_tree_items.host_id,
				graph_tree_items.host_grouping_type,
				host.description as hostname,
                host.hostname as ipaddress
				from graph_tree_items
				left join host on (host.id=graph_tree_items.host_id)
				$sql_join
				where graph_tree_items.graph_tree_id=" . $tree["id"] . "
				$sql_where
				and graph_tree_items.local_graph_id = 0
				order by graph_tree_items.order_key");

            $text .= '<li><span class="folder">'.$tree["name"]."</span><ul>\n";
			if (sizeof($heirarchy) > 0) {
                $oldTier = 0;
                $cidr_net = "";
				foreach ($heirarchy as $leaf) {
					$i++;
					$tier = tree_tier($leaf["order_key"]);
					if ($leaf["host_id"] > 0) {
                        // host
                        $ip = gethostbyname( $leaf["ipaddress"] );

                        $netID = db_fetch_cell("select NetID from phpIP_addresses where ip='$ip'");
                        $netAddress = db_fetch_cell("select netaddress from phpIP_net_ips where AddressId='$netID'");
                        $netCidr = db_fetch_cell("SELECT NetMenuCidr FROM `phpIP_NetMenu` WHERE `NetMenuId` = '".$netID."'");
                        $netCidrDescr = db_fetch_cell("SELECT NetCidrDescription FROM `phpIP_NetMenu` WHERE `NetMenuId` = '".$netID."'");
                        
                        $pattern = '@'.$netCidr.'@';
                        if ( preg_match($pattern, $cidr_net) == 0) {
                            // CIDR not printed yet
                            $cidr_net .= ','.$netCidr;
                            //print $cidr_net ;
                            $text .= '<li><span class="file"><a href="display.php?range=list&iprange='.$netAddress.'&netid='.$netID.'&filter=unalloc">'.htmlentities($netCidr)."</a></span></li>\n";
                        }
					}else{
                        $cidr_net = "";
                        // no host
                        if ( $oldTier >= $tier)
                        {
                            
                            for ($tierCount = $tier;$tierCount < $oldTier;$tierCount++)
                            {
                                $text .= '</ul></li>'."\n";
                            }
                            $text .= '</ul></li>'."\n";
                        }
                        $text .= '<li><span class="folder">'. htmlentities($leaf["title"])."</span><ul>\n";
                        $oldTier = $tier;   						
					}
				}
                for ($tierCount = 1;$tierCount < $oldTier;$tierCount++)
                {
                    $text .= '</ul>'."\n";
                }
                $text .= '</ul>'."\n";
                
			}
            $text .= '</ul></li>'."\n";
		}
	}

    $netIDs = db_fetch_assoc("select DISTINCT NetID FROM phpIP_addresses ORDER BY ip");
    if (sizeof($netIDs) > 0) {
        $text .= '<li><span class="folder">All CIDRs</span><ul>'."\n";
        foreach ($netIDs as $leaf) {    
            $netAddress = db_fetch_assoc("select AddressId,netaddress from phpIP_net_ips where NetCidr='".$leaf['NetID']."' ORDER BY netaddress");
            $netCidr = db_fetch_cell("SELECT NetMenuCidr FROM `phpIP_NetMenu` WHERE `NetMenuId` = '".$leaf['NetID']."'");
            $netCidrDescr = db_fetch_cell("SELECT NetCidrDescription FROM `phpIP_NetMenu` WHERE `NetMenuId` = '".$leaf['NetID']."'");
            
			if ( sizeof($netAddress) > 0 ) {
		        $text .= '<li><span class="folder">'.htmlentities($netCidr)."</span><ul>\n";
				foreach ($netAddress as $net_leaf) {
					$text .= '<li><span class="file"><a href="display.php?range=list&iprange='.$net_leaf['netaddress'].'&netid='.$leaf['NetID'].'&filter=unalloc">'.htmlentities( $net_leaf['netaddress'] )."</a></span></li>\n";
				}
				$text .= '</ul></li>'."\n";			}
			else {
				$text .= '<li><span class="file"><a href="display.php?range=list&iprange='.$netAddress['netaddress'].'&netid='.$leaf['NetID'].'&filter=unalloc">'.htmlentities( $net_leaf['netaddress'] )."</a></span></li>\n";
			}
        }
        $text .= '</ul></li>'."\n";
    }
	
	$text .= '</ul>';
    return $text;    
}

?>
