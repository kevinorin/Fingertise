<?php

/*
Include config file
*/
include("../../../config.php");

/*
Declare app variables
*/
$appname = stripslashes( strip_tags($_SESSION['appname']));
$apptype = stripslashes( strip_tags($_SESSION['apptype']));
$appurl = stripslashes( strip_tags($_SESSION['appurl']));
$category = stripslashes( strip_tags($_SESSION['category']));
$subcategory = stripslashes( strip_tags($_SESSION['subcategory']));
$categoryname = stripslashes( strip_tags($_SESSION['categoryname']));
$subcategoryname = stripslashes( strip_tags($_SESSION['subcategoryname']));
$appwallads = stripslashes( strip_tags($_POST['appwallads']));
$dialogads = stripslashes( strip_tags($_POST['dialogads']));
$landingpageads = stripslashes( strip_tags($_POST['landingpageads']));
$richmediafullpageads = stripslashes( strip_tags($_POST['richmediafullpageads']));
$overlayads = stripslashes( strip_tags($_POST['overlayads']));
$videoads = stripslashes( strip_tags($_POST['videoads']));
$bannerads = stripslashes( strip_tags($_POST['bannerads']));

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
Add the app to the database
*/
$app = ORM::for_table('apps')->create();

$app->userid = $_SESSION['email'];
$app->appname = $appname;
$app->apptype = $apptype;
$app->appurl = $appurl;
$app->category = $category;
$app->subcategory = $subcategory;
$app->appwallads = $appwallads;
$app->dialogads = $dialogads;
$app->landingpageads = $landingpageads;
$app->richmediafullpageads = $richmediafullpageads;
$app->overlayads = $overlayads;
$app->videoads = $videoads;
$app->bannerads = $bannerads;
$app->bannerimps = 0;
$app->bannerearnings = 0.00;
$app->adwallimps = 0;
$app->addwallearnings = 0.00;
$app->interstitialimps = 0;
$app->interstitialearnings = 0.00;

$app->save();

$_SESSION['appid'] = $app->id();

$appstats = ORM::for_table('appstats')->create();

$appstats->appid = $_SESSION['appid'];
$appstats->smartwallimps = 0;
$appstats->smartwallearnings = 0.00;
$appstats->bannerimps = 0;
$appstats->bannerearnings = 0.00;

$appstats->save();

echo "Success";

?>