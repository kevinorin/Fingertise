<?php
/*
Include config file
*/
include('../config.php');

//If user is registering with Google
if ($_GET['method'] == 'google') {
	$email = stripslashes( strip_tags($_GET['email']));
	$name = stripslashes( strip_tags($_GET['name']));
	
	$emailcheck = ORM::for_table('users')->where('email',$email)->find_one(); //Check if email is already registered
	if (!$emailcheck) { //Not taken
		$newaccount = ORM::for_table('users')->create();
		$newaccount->email = $email;
		$newaccount->name = $name;
		$newaccount->status = 'Active';
		$newaccount->save();
		mail($email,'Thank you for signing up with Fingertise!','Good luck!');
		echo "Success";
	}else{ //Taken
		echo "Email taken";
	}
	exit();
}

//Declare variables
$email = stripslashes( strip_tags($_GET['email']));
$password = stripslashes( strip_tags($_GET['password']));
$name = stripslashes( strip_tags($_GET['name']));
$country = stripslashes( strip_tags($_GET['country']));
$phone = stripslashes( strip_tags($_GET['phone']));
$howdidyouhear = stripslashes( strip_tags($_GET['howdidyouhear']));

//Check if email is already registered
$emailcheck = ORM::for_table('users')->where('email',$email)->find_one();
if (!$emailcheck) { //Not taken
	$activationcode = md5($email.time());
	$newaccount = ORM::for_table('users')->create();
	$newaccount->email = $email;
	$newaccount->password = $password;
	$newaccount->name = $name;
	$newaccount->country = $country;
	$newaccount->phone = $phone;
	$newaccount->howdidyouhear = $howdidyouhear;
	$newaccount->activationcode = $activationcode;
	$newaccount->status = 'Awaiting Activation';
	$newaccount->save();
	mail($email,'Please confirm your Fingertise account!','Please confirm your Fingertise account by clicking the following link: http://arcticandroidapps.net/fingertise/confirm.php?code=' . $activationcode);
	echo "Success";
}else{ //Taken
	echo "Email taken";
}
?>