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
$_SESSION['custom']=false;

/* set default action */
if (!isset($_REQUEST["action"])) { $_REQUEST["action"] = ""; }

switch ($_REQUEST["action"]) {
	case 'save':
		form_save();

		break;
	default:
		include_once("./include/top_header.php");

		import();

		include_once("./include/bottom_footer.php");
		break;
}


function form_save() {
	if (isset($_REQUEST["save_component_import"])) {
        $uploadDir = read_config_option('nmidPhpip_uploadDir');
        $skip = 0;
        if (isset ($_REQUEST['Comment'])) {
            $comment = strip_tags($_REQUEST['Comment']);
        }
        else {
            $skip = 1;
        }
        if (isset ($_REQUEST['NetID'])) {
            $netid = $_REQUEST['NetID'];
            //strip_tags($_POST['NetID']);
        }
        else {
            $skip = 1;
        }
        if (isset ($_REQUEST['UserName'])) { $userName = strip_tags($_REQUEST['UserName']); }
        else {
            $skip = 1;
        }
    
        if ( $skip == 0) {    
            $uploadfile = $uploadDir . basename($_FILES['upload_file']['name']);
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) {
                if ( file_exists($uploadfile) )
                {
                    $lines = file($uploadfile);
                    foreach ($lines as $line)
                    {
                        // cycle through the file
                        
                        $line = rtrim ($line);
                        $data = preg_split("/;/",$line);
                        $groupid = 1;
                        $ip = $data[0];
                        
                        if (isset ($data[1] ) ) {
                            if ( strlen($data[1]) == 0 ) {
                                $description = $comment;
                            } else {
                                $description = $data[1];
                            }
                        }
                        else
                        {
                            $description = $comment;
                        }
                        if (isset ($data[2] ) ) {
                            if ( strlen($data[2]) == 0 ) {
                                $client = $comment;
                            } else {
                                $client = $data[2];
                            }
                        }
                        else
                        {
                            $client = $comment;
                        }
                        
                        if (isset ($data[3] ) ) {
                            if ( strlen($data[3]) == 0 ) {
                                $notes = $comment;
                            } else {
                                $notes = $data[3];
                            }
                        }
                        else
                        {
                            $notes = $comment;
                        }
                        mysql_query("UPDATE `phpIP_addresses` SET `groupid` = '$groupid', `NetID` = '$netid', `description`='$description', `client`='$client', `notes`='$notes' WHERE `ip`='$ip'");
                    }                
                }
            }
        }
        header("Location: import.php");
	}
}

function import() {
    global $colors, $hash_type_names;

    $username = db_fetch_cell("select username from user_auth where id=" . $_SESSION["sess_user_id"]);

	?>
	<form method="post" action="import.php" enctype="multipart/form-data">
	<?php

	html_start_box("<strong>Import File</strong>", "100%", $colors["header"], "3", "center", "");

	form_alternate_row_color($colors["form_alternate1"],$colors["form_alternate2"],0); ?>
		<td width="50%">
			<font class="textEditTitle">Import from Local File</font><br>
			If the import file containing phpIP data is located on your local machine, select it here.
		</td>
		<td>
			<input type="file" name="upload_file">
		</td>
	</tr>

	<?php form_alternate_row_color($colors["form_alternate1"],$colors["form_alternate2"],1); ?>
		<td width="50%">
			<font class="textEditTitle">Default comment</font><br>
			The default comment used. This value is overwritten by the import file.
		</td>
		<td>
			<?php form_text_box("Comment","","",255); ?>
		</td>
	</tr>

	<?php form_alternate_row_color($colors["form_alternate1"],$colors["form_alternate2"],0); ?>
		<td width="50%">
			<font class="textEditTitle">NetID</font><br>
			Select the NetID to import the data from the file
		</td>
		<td>
   			<?php
            form_dropdown("NetID",
    			db_fetch_assoc("SELECT NetMenuId as id, CONCAT(NetCidrDescription,' ( ',NetMenuCidr,' ) ') as name  FROM phpIP_NetMenu ORDER BY NetCidrDescription"), "name", "id", "","None","","","");
			?>
		</td>
	</tr>

	<?php

    form_hidden_box("UserName",$username,"");
	form_hidden_box("save_component_import","1","");

	html_end_box();
	form_save_button("import.php", "save");

}

?>
