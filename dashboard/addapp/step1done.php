<?php

/*
Include config file
*/
include("../../config.php");

/*
Declare app variables
*/
$appname = $_POST['appname'];
$apptype = $_POST['apptype'];
$appurl = stripslashes( strip_tags($_POST['appurl']));
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$categoryname = $_POST['categoryname'];
$subcategoryname = $_POST['subcategoryname'];

if ($category == '1' or $subcategory == '1') {
	echo "Missing category";
	exit();
}

/*
Check if this app url is already being used
*/
$detailscheck = ORM::for_table('apps')->
				where('appurl',$appurl)->find_one();
if ($detailscheck) {
	echo "App url taken";
	exit();
}

/*
Set session variables
*/
$_SESSION['appname'] = $appname;
$_SESSION['apptype'] = $apptype;
$_SESSION['appurl'] = $appurl;
$_SESSION['category'] = $category;
$_SESSION['subcategory'] = $subcategory;
$_SESSION['categoryname'] = $categoryname;
$_SESSION['subcategoryname'] = $subcategoryname;

echo "Success";

?>