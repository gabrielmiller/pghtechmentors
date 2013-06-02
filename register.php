<?php

$days = array("Select","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$times = array("Select","Morning (before 12 PM)","Afternoon (12 PM - 5 PM)","Evening (After 5PM)");
$errors = array();
$non_required_fields = array('phone_primary','phone_secondary','availability_time2','availability_day2','availiability_day3','availability_time3','about');
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

if($_POST != array()){
    foreach($_POST as $key => $value){
        # Validate fields

        $is_value_blank = (strlen($value) == 0);
        $is_not_required = in_array($non_required_fields, $key);

        if(!$is_not_required && $is_value_blank){
            array_push($errors, "$key is a required field");
        }

        //$_POST[$key] = htmlspecialchars($value); // Strip html tags to send to db.
        $defaults[$key] = htmlspecialchars($value); // Strip html tags to print them back to form if it failed.
    }

    if($_POST['availability_time1'] == 0 || $_POST['availability_day1'] == 0){
        array_push($errors, "Primary availability is required.");
    }

    if($_POST['password'] != $_POST['password_confirm']){
        array_push($errors, "Your password and password confirmation do not match.");
    }

    if(count($errors) == 0){
        # Post the values to the database
        # Start a session
        # Redirect the user to the profile page
        $salt = substr(md5(microtime()),rand(0,26),10);
        $i = $_POST;
        $i['password'] = sha1($salt.$i['password']);
        $i['skill'] = "Web Development";
        require_once("../../credentials.php");
        $db = new mysqli($credentials['hostname'],$credentials['username'],$credentials['password'],$credentials['dbname']);
        $sql = "
            INSERT INTO `pghtechmentors`.`user` (`user_id`, `account_type`, `email_id`, `name_last`, `name_first`, `contact_home`, `contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`, `passwd`, `salt`) VALUES ('', 'M', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
        ";
        $insert = $db->prepare($sql);
        $insert->bind_param('ssssssissss', $i['email'], $i['name_last'], $i['name_first'], $i['phone_primary'], $i['phone_secondary'], $i['skill'], $i['is_available'], $i['zip_code'], $i['about'], $i['password'], $salt);
        $insert->execute();
        echo $insert->affected_rows." rows affected.";
        echo "<br>error ".$insert->errno;
        echo "<br>Your data was sent.";
        $sql2 = "SELECT user_id FROM `user` WHERE email_id = ?"
        $id = 0;
        $select = $db->prepare($sql2);
        $select->bind_param('s', $i['email']);
        $select->execute();
        $select->bind_result($id);
        echo "id is ".$id;
    }
}
?>

<!doctype HTML>
<html>
<head>
    <title>UMentor: Mentor Registration</title>
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
    <form id="register_form" method="post" action="register.php">
        <div>
            <label for="firstname">First Name: </label>
            <input required id="firstname" type="text" placeholder="First Name" name="name_first" value="<?php echo $defaults['name_first'];?>" maxlength="255">
        </div>
        <div>
            <label for="lastname">Last Name: </label>
            <input required id="lastname" type="text" placeholder="Last Name" name="name_last" value="<?php echo $defaults['name_last'];?>" maxlength="255">
        </div>
        <div>
            <label for="email">Email Address: </label>
            <input required id="email" type="text" placeholder="name@website.com" name="email" value="<?php echo $defaults['email'];?>" maxlength="255">
        </div>
        <div>
            <label for="password">Password: </label>
            <input required id="password" type="password" name="password">
        </div>
        <div>
            <label for="passwordconfirm">Confirm Password: </label>
            <input required id="passwordconfirm" type="password" name="password_confirm">
        </div>
        <div>
            <label for="phoneprimary">Primary Phone Number: </label>
            <input id="phoneprimary" type="text" placeholder="(123) 456 - 7890" name="phone_primary" value="<?php echo $defaults['phone_primary'];?>" maxlength="30">
        </div>
        <div>
            <label for="phonesecondary">Secondary Phone Number: </label>
            <input id="phonesecondary" type="text" placeholder="(123) 456 - 7890" name="phone_secondary" value="<?php echo $defaults['phone_secondary'];?>" maxlength="30">
        </div>
        <div>
            <label for="zip">Zip Code: </label>
            <input required id="zip" type="text" placeholder="12345" name="zip_code" value="<?php echo $defaults['zip_code'];?>" maxlength="10">
        </div>
        <div>
            <label for="isavailable">Are you available: </label>
            <input id="isavailable" type="checkbox" name="is_available" <?php if($defaults['is_available'] == "on"){echo "checked";}?>>
        </div>
        <div>
            <label for="availabilityday1">Primary Availability: </label>
            <select id="availabilityday1" name="availability_day1">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $defaults['availability_day1']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime1" name="availability_time1">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $defaults['availability_time1']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="availabilityday2">Secondary Availability: </label>
            <select id="availabilityday2" name="availability_day2">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $defaults['availability_day2']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime2" name="availability_time2">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $defaults['availability_time2']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="availabilityday3">Tertiary Availability: </label>
            <select id="availabilityday3" name="availability_day3">
                <?php foreach($days as $key => $value){?>
                    <option<?php if($key == $defaults['availability_day3']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="availabilitytime3" name="availability_time3">
                <?php foreach($times as $key => $value){?>
                    <option<?php if($key == $defaults['availability_time3']){echo " selected";} ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="about">About you: </label>
            <textarea id="about" name="about" placeholder="Tell us a little bit about yourself."><?php echo $defaults['about'];?></textarea>
        </div>
        <div>
            <button type="submit">Sign Up</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>
</html>
