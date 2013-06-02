<?php
class UserDetails {

   var $last_error = "";            // last error message set by this class
               
   /*
  This function pulls the user details from the database for a given email.
   */
   function get_user_details($email) {
       
	  // Get user details like email id to search profile data
	  $sql_fetch_user_details= "SELECT `user_id`, `email_id`, `name_last`, `name_first`, `contact_home`, 
								`contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`
								FROM USER
								WHERE email_id = '$email'";
              
	  $r = mysql_query($sql_fetch_user_details);
	  if (!$r) {
         $this->last_error = mysql_error();
         return false;
      } else {
         $row = mysql_fetch_array($r, MYSQL_ASSOC);
         mysql_free_result($r);
         return $row;       
      }
   }
   
   /*
	This function pulls the user timeslots details.
   */
   function get_timeslot($user) {
    
	  $user_ts= "SELECT day_id, timeslot_id from pghtechmentors.user_timeslot where user_id='$user'";
	   
	  $r = mysql_query($user_ts);
	  if (!$r) {
         $this->last_error = mysql_error();
         return false;
      } else {
         $rows = mysql_fetch_array($r, MYSQL_ASSOC);
         mysql_free_result($r);
         return $rows;       
      }
   }

   /*
	This function updates user data .
   */
   function update_user($userData) {
	  // Convert is_available check box in int value
		
	  $sql_user_upd= "UPDATE pghtechmentors.user set 
				`name_last` = '".$userData['name_last']."',
				`name_first` = '".$userData['name_first']."',
				`contact_home` = '".$userData['contact_home']."',
				`contact_mobile` = '".$userData['contact_mobile']."',
				`is_available` = ". $userData['is_available'].",
				`zip_code` = '".$userData['zip_code']."',
				`about_me` = '".$userData['about_me']."'
				WHERE `email_id`='".$userData['email_id']."'";
	  
	  // For user changes password
	  $sql_user_pwd_upd= "UPDATE pghtechmentors.user set 
				`name_last` = '".$userData['name_last']."',
				`name_first` = '".$userData['name_first']."',
				`contact_home` = '".$userData['contact_home']."',
				`contact_mobile` = '".$userData['contact_mobile']."',
				`is_available` = ".$userData['is_available'].",
				`zip_code` = '".$userData['zip_code']."',
				`about_me` = '".$userData['about_me']."'
				`password` = '".$userData['password']."'
				WHERE `email_id`='".$userData['email_id']."'";
		
      if($userData['password'] == null) {
	  
	  $r = mysql_query($sql_user_upd);
	  }
	  else {
	  $r = mysql_query($sql_user_pwd_upd);
	  }
	  
	  if (!$r) {
         $this->last_error = mysql_error();
         return false;
      } 
   }
   
   
}


?>
