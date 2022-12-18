<?php
class Email {
   var $From;
   var $FromName;
   var $ToMail;
   var $ToName;
   var $Subject;
   var $Message;
	
   function SendMail(){
      $Message = stripslashes($this->Message);
      $Message = stripslashes($this->Message);
      $headers .="From: ".$this->FromName.
                 "<".$this->FromMail.">\n";
      $headers .="Reply-To: ".$this->FromName.
                 "<".$this->FromMail.">\n"; 
      //$headers .="X-Priority: 1\n"; 
      //$headers .="X-MSMail-Priority: High\n"; 
      $headers .="X-Mailer: My PHP Mailer\n";
      $headers .="Origin: ".$_SERVER['REMOTE_ADDR']."\n";
      mail($this->ToMail, $this->Subject, $Message, $headers);
   }
}
?>