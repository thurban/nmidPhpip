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
    include_once( $config["library_path"] . "/data_query.php");

    $uploadDir = read_config_option('nmidPhpip_uploadDir');
    $skip = 0;
    if (isset ($_POST['Comment'])) {

        $comment = strip_tags($_POST['Comment']);
    }
    else {
        $skip = 1;
    }
    if (isset ($_POST['NetID'])) {
        $netid = input_validate_input_number(get_request_var_post("NetID"));
        //strip_tags($_POST['NetID']);
    }
    else {
        $skip = 1;
    }
    if (isset ($_POST['UserName'])) { $userName = strip_tags($_POST['UserName']); }
    else {
        $skip = 1;
    }

    if ( $skip == 0) {    
        $netID_data = preg_split("/-/",$netid);
        $netid = $netID_data[0];
        
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
                    echo "{ success: true }";
                }
                else
                {
                    echo "{ success: false }";
                }
        } else {
            echo "{ success: false }";
        }
    } else {
        echo "{ success: false }";
    }
    
?>

