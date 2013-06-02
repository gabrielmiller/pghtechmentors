<?php

require_once('UserDetails.php'); 

$days = array("Select","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$times = array("Select","Morning (before 12 PM)","Afternoon (12 PM - 5 PM)","Evening (After 5PM)");
$errors = array();
$defaults = array(
    'name_first' => '',
    'name_last' => '',
    'email' => '',
    'phone_primary' => '',
    'phone_secondary' => '',
    'zip_code' => '',
    'is_available' => 'off',
    'availability_day1' => '',
    'availability_time1' => '',
    'availability_day2' => '',
    'availability_time2' => '',
    'availability_day3' => '',
    'availability_time3' => '',
    'about' => ''
);
 
 
// Open up a connection to the database.  The sql will populate the data in respective fields
mysql_connect('localhost','root','') or die(mysql_error()); 
mysql_select_db('pghtechmentors') or die(mysql_error()); 

// Instance of UserDetails class
$userDetails = new UserDetails;

if($_POST != array()){
  // If user has entered the password then check 
    if($_POST['password'] != null or $_POST['password'] != '' and 
		($_POST['password'] != $_POST['password_confirm'])){
        array_push($errors, "Your password and password confirmation do not match.");
    }
    else {
	// Update the user data
	$result_upd = $userDetails->update_user($_POST);
	
	}
}

// Get the user details 
$result = $userDetails->get_user_details('email@cc.com');
if ($result == false) echo 'Error: '.$userDetails->last_error;

// Get User TImeslot details
$result_ts= $userDetails->get_timeslot($result['user_id']);


?>

<!doctype HTML>
<html>
<head>
</head>
<body>
    <?php if($errors != array()){?>
    <div id="errors">
        <h4>Error<?php if(count($errors)>1){echo 's';} ?>:</h4>
        <ul>
            <?php foreach($errors as $key => $value){?>
                <li><?php echo $value;?></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <form id="register_form" method="post" action="edit_profile.php">
        <div>
            <label for="firstname">First Name: </label>
            <input required id="firstname" type="text" placeholder="First Name" name="name_first" value="<?php echo $result['name_first'];?>" maxlength="255">
        </div>
        <div>
            <label for="lastname">Last Name: </label>
            <input required id="lastname" type="text" placeholder="Last Name" name="name_last" value="<?php echo $result['name_last'];?>" maxlength="255">
        </div>
        <div>
            <label for="email">Email Address: </label>
            <input disabled id="email" type="text" placeholder="name@website.com" name="email" value="<?php echo $result['email_id'];?>" maxlength="255">
        </div>
		<input hidden name="email_id" value="<?php echo $result['email_id'];?>" >
        <div>
            <label for="password">Password: </label>
            <input id="password" type="password" name="password">
        </div>
        <div>
            <label for="passwordconfirm">Confirm Password: </label>
            <input id="passwordconfirm" type="password" name="password_confirm">
        </div>
        <div>
            <label for="phoneprimary">Home Phone Number: </label>
            <input id="phoneprimary" type="text" placeholder="(123) 456 - 7890" name="contact_home" value="<?php echo $result['contact_home'];?>" maxlength="30">
        </div>
        <div>
            <label for="phonesecondary">Mobile Phone Number: </label>
            <input id="phonesecondary" type="text" placeholder="(123) 456 - 7890" name="contact_mobile" value="<?php echo $result['contact_mobile'];?>" maxlength="30">
        </div>
        <div>
            <label for="zip">Zip Code: </label>
            <input required id="zip" type="text" placeholder="12345" name="zip_code" value="<?php echo $result['zip_code'];?>" maxlength="10">
        </div>
        <div>
            <label for="isavailable">Are you available: </label>
            <input id="isavailable" type="checkbox" name="isavailable" <?php if($result['is_available'] == 1){echo "checked";} ?>>
        </div>
		<input hidden name ="is_available" value="<?php ($result['is_available'] == 1) ? 1: 0;?>>
        <div>
            <label for="availabilityday1">Primary Availability: </label>
            <select id="availabilityday1" name="availability_day1">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $result_ts['day_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime1" name="availability_time1">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $result_ts['timeslot_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
		<div></div>
        <div>
            <label for="availabilityday2">Secondary Availability: </label>
            <select id="availabilityday2" name="availability_day2">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $result_ts['day_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime2" name="availability_time2">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $result_ts['timeslot_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="availabilityday3">Tertiary Availability: </label>
            <select id="availabilityday3" name="availability_day3">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $result_ts['day_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime3" name="availability_time3">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $result_ts['timeslot_id']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="about">About you: </label>
            <textarea id="about" name="about_me" placeholder="Tell us a little bit about yourself."><?php echo $result['about_me'];?></textarea>
        </div>
        <div>
            <button type="submit">Update</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>
</html>
