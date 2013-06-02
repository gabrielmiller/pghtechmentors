<?php

$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$times = array("Morning","Afternoon","Evening");

if($_POST != array()){
    
    //header('Location: login.php');
    echo var_dump($_POST);
    if($_POST['password'] != $_POST['password_confirm']){
    } 
}

?>
<!doctype HTML>
<html>
<head>
</head>
<body>
    <div id="errors">
    </div>
    <form id="register_form" method="post" action="register.php">
        <div>
            <label for="firstname">First Name: </label>
            <input id="firstname" type="text" placeholder="First Name" name="name_first"></input> 
        </div>
        <div>
            <label for="lastname">Last Name: </label>
            <input id="lastname" type="text" placeholder="Last Name" name="name_last"></input> 
        </div>
        <div>
            <label for="email">Email Address: </label>
            <input id="email" type="text" placeholder="name@website.com" name="email"></input> 
        </div>
        <div>
            <label for="password">Password: </label>
            <input id="password" type="password" name="password"></input> 
        </div>
        <div>
            <label for="passwordconfirm">Confirm Password: </label>
            <input id="passwordconfirm" type="password" name="password_confirm"></input> 
        </div>
        <div>
            <label for="phoneprimary">Primary Phone Number: </label>
            <input id="phoneprimary" type="text" placeholder="(123) 456 - 7890" name="phone_primary"></input> 
        </div>
        <div>
            <label for="phonesecondary">Secondary Phone Number: </label>
            <input id="phonesecondary" type="text" placeholder="(123) 456 - 7890" name="phone_secondary"></input> 
        </div>
        <div>
            <label for="zip">Zip Code: </label>
            <input id="zip" type="text" placeholder="12345" name="zip_code"></input> 
        </div>
        <div>
            <label for="isavailable">Are you available: </label>
            <input id="isavailable" type="checkbox" name="is_available"></input> 
        </div>
        <div>
            <label for="availabilityday1">Primary Availability: </label>
            <select id="availabilityday1" name="availability_day1"></input> 
                <?php foreach($days as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
            <select id="availabilitytime1" name="availability_time1"></input> 
                <?php foreach($times as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="availabilityday2">Secondary Availability: </label>
            <select id="availabilityday2" name="availability_day2"></input> 
                <?php foreach($days as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
            <select id="availabilitytime2" name="availability_time2"></input> 
                <?php foreach($times as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="availabilityday3">Tertiary Availability: </label>
            <select id="availabilityday3" name="availability_day3"></input> 
                <?php foreach($days as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
            <select id="availabilitytime3" name="availability_time3"></input> 
                <?php foreach($times as $key => $value){?>
                    <option value="<?php echo $key;?>"><?php echo $value;?></option> 
                <?php } ?>
            </select>
        </div>
        <div>
            <button type="submit">Sign Up</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>
</html>
