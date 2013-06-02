<?php

$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$times = array("Morning","Afternoon","Evening");
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

if($_POST != array()){
    //header('Location: login.php');
    //echo var_dump($_POST);
    foreach($_POST as $key => $value){
        $is_not_required = ($key == "phone_primary" || $key == "phone_secondary" || $key == "about") && ($value == Null);
        if(!$is_not_required){
            array_push($errors, "$key is a required field");
        }
        $defaults[$key] = htmlspecialchars($value); // Strip html tags
    }
    if($_POST['password'] != $_POST['password_confirm']){
        array_push($errors, "Your password and password confirmation do not match.");
    }
}

#echo var_dump($_POST);
#echo var_dump($defaults);
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
    <form id="register_form" method="post" action="register.php">
        <div>
            <label for="firstname">First Name: </label>
            <input id="firstname" type="text" placeholder="First Name" name="name_first" value="<?php echo $defaults['name_first'];?>">
        </div>
        <div>
            <label for="lastname">Last Name: </label>
            <input id="lastname" type="text" placeholder="Last Name" name="name_last" value="<?php echo $defaults['name_last'];?>">
        </div>
        <div>
            <label for="email">Email Address: </label>
            <input id="email" type="text" placeholder="name@website.com" name="email" value="<?php echo $defaults['email'];?>">
        </div>
        <div>
            <label for="password">Password: </label>
            <input id="password" type="password" name="password">
        </div>
        <div>
            <label for="passwordconfirm">Confirm Password: </label>
            <input id="passwordconfirm" type="password" name="password_confirm">
        </div>
        <div>
            <label for="phoneprimary">Primary Phone Number: </label>
            <input id="phoneprimary" type="text" placeholder="(123) 456 - 7890" name="phone_primary" value="<?php echo $defaults['phone_primary'];?>">
        </div>
        <div>
            <label for="phonesecondary">Secondary Phone Number: </label>
            <input id="phonesecondary" type="text" placeholder="(123) 456 - 7890" name="phone_secondary" value="<?php echo $defaults['phone_secondary'];?>">
        </div>
        <div>
            <label for="zip">Zip Code: </label>
            <input id="zip" type="text" placeholder="12345" name="zip_code" value="<?php echo $defaults['zip_code'];?>">
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
