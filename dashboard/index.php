<?php
/*
Include config file
*/
include("../config.php");

/*
If user is not logged in, redirect to login page
*/
if (!isset($_SESSION['email'])) {
	header("Location: ../login");
	exit();
}

/*
Grab general variables about the logged in user
*/
$userdata = ORM::for_table('users')->where('email',$_SESSION['email'])->find_one();
$name = $userdata->name;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Fingertise</title>
<link rel="stylesheet" type="text/css" href="../assets/css/dashstyle.css" />
<!--**********************usermenu*************************-->
<script type='text/javascript' src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/menu.css">
<script>
$(document).ready(function(){
  $(".item").click(function(){
    $(".chackout_items").toggle();
  });
  $("#menu ul li").find(".sub-menu").parent().click(function(){$(this).find(".sub-menu").toggle();});
});
</script>
<link rel="stylesheet" type="text/css" href="../assets/css/chackbox.css">
<!--**********************selector************************-->
<link rel="stylesheet" type="text/css" href="../assets/css/easydropdown.css"/>
<script src="../assets/js/jquery.easydropdown.js"></script>
</head>

<body>
<div id="main">
<!-- header start here -->
<header>
  <div id="header">
    <div class="container"> <a href="#" class="logo"><img src="../assets/images/logo.jpg" alt="logo"></a>
      <select tabindex="4" class="dropdown age">
							<option value="" class="label" value="">Developer</option>
							<option value="1">Developer</option>
							<option value="2">Advertiser</option>
						</select>
      <!-- navigation -->
      <nav>
        <div class="naviagtion">
          <ul>
            <li class="active"><a href="#" class="active dash"><span>Dashboard</span></a></li>
            <li><a href="#" class="payment"><span>Payments</span></a></li>
            <li><a href="#" class="report"><span>Reports</span></a></li>
            <li><a href="#" class="help"><span>Helpdesk</span></a></li>
            <li><a href="#" class="api"><span>API</span></a></li>
          </ul>
        </div>
      </nav>
      <!-- navigation --> 
      
      <!-- user option -->
      <div id="menu">
        <ul>
          <li><a href="#">Welcome : <?php echo $name; ?> <b class="arrow"></b></a>
            <ul class="sub-menu">
              <li> <a href="#">Edit Profile</a> </li>
              <li> <a href="#">Setting</a></li>
              <li><a href="../logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- user option --> 
      
    </div>
  </div>
</header>
<!-- header end here --> 

<!-- head title bar -->
<div id="head_title_bar">
  <div class="container">
    <h2 class="dash_title">Application Dashboard</h2>
    <div class="stats">
      <ul>
        <li>132,510
          <p>Applications</p>
        </li>
        <li>$0.00
          <p>From 0 impressions</p>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- head title bar -->

<div class="clear"></div>

<!-- mid section -->
<section>
  <div id="mid_section">
  <div class="container">
    <div class="dash_table"> 
      <!-- sorting -->
      <div class="table_sorting"> <a href="addapp/" class="app_button"><img src="../assets/images/add_app_button.png" alt="button" /></a> <a href="#" class="sdk_button"><img src="../assets/images/sdk_button.png" alt="button" /></a>
        <div class="search_field_bg">
          <input name="search" type="text" class="search_text_field" placeholder="Search text" />
          <input name="search" type="button" class="search_button" value="" />
        </div>
        <input name="key" type="text" class="key_field" placeholder="API Key:" />
        <select name="jumpMenu2" class="all_drop">
          <option>All</option>
          <option>item1</option>
          <option>item2</option>
        </select>
        <input name="date" type="text" class="date_field" value="June 02, 2014 - June 02, 2014" />
        <a href="#" class="refresh_icon"><img src="../assets/images/refresh_icon.png" alt="refresh" /></a> </div>
      <!-- sorting --> 
      
      <!-- table -->
      <div class="table_div">
        <table width="100%" border="1" bordercolor="#d1d1d1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
          <tr class="table_title" height="35">
            <td width="5%" bgcolor="#f0f0f0"><img src="../assets/images/chackbox.jpg" alt="chackbox" /></td>
            <td width="5%"><a href="#" class="setting"><img src="../assets/images/setting_icon.jpg" alt="setting" /></a></td>
            <td width="15%" bgcolor="#f0f0f0">Application Name</td>
            <td width="10%">App ID <a href="#" class="id_arrow"><img src="../assets/images/app_id_arrow.jpg" alt="id" /></a></td>
            <td width="12%" bgcolor="#f0f0f0">Ad Type<a href="#" class="info_icon"><img src="../assets/images/info_icon.jpg" alt="info" /></a></td>
            <td width="8%">Status</td>
            <td width="10%" bgcolor="#f0f0f0">Add-On</td>
            <td width="15%">Impressions<a href="#" class="info_icon"><img src="../assets/images/info_icon.jpg" alt="info" /></a></td>
            <td width="10%" bgcolor="#f0f0f0">CPM<a href="#" class="info_icon"><img src="../assets/images/info_icon.jpg" alt="info" /></a></td>
            <td width="10%">Earnings<a href="#" class="id_arrow"><img src="../assets/images/app_id_arrow.jpg" alt="id" /></a></td>
          </tr>
		  
<?php

$user = $_SESSION['email'];
$applist = ORM::for_table('apps')->where('userid', $user)->find_many();
foreach ($applist as $app) {
	$appid = $app->appid;
	$appname = $app->appname;
	$bannerimps = $app->bannerimps;
	$bannerearnings = $app->bannerearnings;
	$adwallimps = $app->adwallimps;
	$adwallearnings = $app->adwallearnings;
	$interstitialimps = $app->interstitialimps;
	$interstitialearnings = $app->interstitialearnings;
	
?>
		<tr height="35" class="table_content">
			<td bgcolor="#e6e6e6" align="center" valign="middle"><input type="checkbox" name="checkbox">
				<label style="font-size:15px;"><span></span></label></td>
			<td align="center"><img src="../assets/images/hash_icon.png" alt="icon"></td>
			<td bgcolor="#e6e6e6"><span><?php echo $appname; ?></span></td>
            <td><?php echo $appid; ?></td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td><?php echo $bannerimps; ?></td>
            <td bgcolor="#e6e6e6">$<?php echo $bannerearnings / $bannerimps / 1000; ?></td>
            <td>$<?php echo $bannerearnings; ?></td>
		</tr>
		
		<tr height="35" class="table_content">
			<td bgcolor="#e6e6e6" align="center" valign="middle"><input type="checkbox" name="checkbox">
				<label style="font-size:15px;"><span></span></label></td>
			<td align="center"><img src="../assets/images/hash_icon.png" alt="icon"></td>
			<td bgcolor="#e6e6e6"><span><?php echo $appname; ?></span></td>
            <td><?php echo $appid; ?></td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td><?php echo $adwallimps; ?></td>
            <td bgcolor="#e6e6e6">$<?php echo $adwallearnings / $adwallimps / 1000; ?></td>
            <td>$<?php echo $adwallearnings; ?></td>
		</tr>
		
		<tr height="35" class="table_content">
			<td bgcolor="#e6e6e6" align="center" valign="middle"><input type="checkbox" name="checkbox">
				<label style="font-size:15px;"><span></span></label></td>
			<td align="center"><img src="../assets/images/hash_icon.png" alt="icon"></td>
			<td bgcolor="#e6e6e6"><span><?php echo $appname; ?></span></td>
            <td><?php echo $appid; ?></td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td><?php echo $interstitialimps; ?></td>
            <td bgcolor="#e6e6e6">$<?php echo $interstitialearnings / $interstitialimps / 1000; ?></td>
            <td>$<?php echo $interstitialearnings; ?></td>
		</tr>
<?php
}

?>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox1" type="checkbox" name="checkbox" value="1">
              <label for="checkbox1" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox2" type="checkbox" name="checkbox" value="2">
              <label for="checkbox2" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox3" type="checkbox" name="checkbox" value="3">
              <label for="checkbox3" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox4" type="checkbox" name="checkbox" value="4">
              <label for="checkbox4" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox5" type="checkbox" name="checkbox" value="5">
              <label for="checkbox5" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_content">
            <td bgcolor="#e6e6e6" align="center" valign="middle"><input id="checkbox6" type="checkbox" name="checkbox" value="6">
              <label for="checkbox6" style="font-size:15px;"><span></span></label></td>
            <td align="center"><img src="../assets/images/hash_icon.png" alt="icon" /></td>
            <td bgcolor="#e6e6e6"><span>thedroidmarket</span></td>
            <td>012456</td>
            <td bgcolor="#e6e6e6" align="center"><img src="../assets/images/add1.jpg" alt="add" /></td>
            <td><span>Enabled</span></td>
            <td bgcolor="#e6e6e6">-</td>
            <td>0</td>
            <td bgcolor="#e6e6e6">$0.00</td>
            <td>$0.00</td>
          </tr>
          <tr height="35" class="table_total" style="border:none; border-color:transparent;" bgcolor="#e6e6e6">
            <td colspan="6" align="right" valign="middle" bgcolor="#e6e6e6">Account Total and Averages:</td>
            <td>0</td>
            <td><span>0</span></td>
            <td><span>$0.00</span></td>
            <td><span>$0.00</span></td>
          </tr>
        </table>
        <div class="time_bar"> <a href="#" class="time_icon"><img src="../assets/images/watch_icon.png" alt="watch" /></a> </div>
        <!-- table --> 
      </div>
    </div>
  </div>
  </div>
</section>
<!-- mid section -->
</div>
</body>
</html>
