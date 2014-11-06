<?php

/*
Start the session globally, so it does not have to be called in each page individually
*/
session_start();

/*
Turn off error reporting for security reasons
*/
error_reporting(E_ALL);

/*
Include/require all dependencies, including Idiorm and the Google API
*/
require_once 'assets/idiorm.php';
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ .'/assets/googleapi/vendor/google/apiclient/src');
require_once 'assets/googleapi/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
include("assets/simple-php-captcha.php");

/*
Require all classes, such as the GoogleAuth class
*/
require_once 'assets/classes/GoogleAuth.php';

/*
Set our database variables, and make a connection via Idiorm
*/
$sqlhost = 'localhost';
$sqldatabase = 'arctican_fingertise';
$sqlusername = 'arctican_user1';
$sqlpassword = 'aquaeeveot1';
//Now, make the connection
ORM::configure('mysql:host=' . $sqlhost . ';dbname=' . $sqldatabase);
ORM::configure('username', $sqlusername);
ORM::configure('password', $sqlpassword);

/*
Declare Google API Variables
*/
$client_id = '326483135824-i0jg5aurko1bb52n6tm48otrbdg6v0g6.apps.googleusercontent.com';
$client_secret = 'hRWGhr3mtsJRQpu0ivfreg4E';

?>