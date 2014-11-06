<?php

include('../config.php');

$email = stripslashes( strip_tags($_POST['email']));
$password = stripslashes( strip_tags($_POST['password']));

$detailscheck = ORM::for_table('users')->
				where(array(
					'email' => $email,
					'password' => $password
				))->find_one();
				
if ($detailscheck) { //If details are correct
	$_SESSION['email'] = $email;
	echo "Success";
}else{
	echo "Invalid";
}