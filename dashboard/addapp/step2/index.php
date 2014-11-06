<?php

/*
Include config file
*/
include("../../../config.php");

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

/*
Get current app variables
*/
$appname = $_SESSION['appname'];
$apptype = $_SESSION['apptype'];
if ($apptype == 'androidmarket') { 
$apptype = 'Android Market URL'; 
}else{ 
$apptype = 'Non-Market URL';
}
$appurl = $_SESSION['appurl'];
$category = $_SESSION['category'];
$subcategory = $_SESSION['subcategory'];
$categoryname = $_SESSION['categoryname'];
$subcategoryname = $_SESSION['subcategoryname'];

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Fingertise</title>
<link rel="stylesheet" type="text/css" href="../../../assets/css/dashstyle.css" />
<link rel="stylesheet" type="text/css" href="../../../assets/css/font-awesome.css" />
<!--**********************usermenu*************************-->
<script type='text/javascript' src="../../../assets/js/jquery-1.8.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../../assets/css/menu.css">
<script>
$(document).ready(function(){
  $(".item").click(function(){
    $(".chackout_items").toggle();
  });
  $("#menu ul li").find(".sub-menu").parent().click(function(){$(this).find(".sub-menu").toggle();});
});
</script>
<link rel="stylesheet" type="text/css" href="../../../assets/css/chackbox.css">
<!--**********************selector************************-->
<link rel="stylesheet" type="text/css" href="../../../assets/css/easydropdown.css"/>
<script src="../../../assets/js/jquery.easydropdown.js"></script>
<!--*************tab*******************-->
<link rel="stylesheet" type="text/css" href="../../../assets/css/tab.css">
<script src="../../../assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
	
	function checkboxCheck() {
		if ($("#checkbox1").is(":checked")) {
			$("#appwallads").html("<span>Appwall Ads:</span> Enabled");
		}else{
			$("#appwallads").html("<span>Appwall Ads:</span> Disabled");
		}
		
		if ($("#checkbox2").is(":checked")) {
			$("#dialogads").html("<span>Dialog Ads:</span> Enabled");
		}else{
			$("#dialogads").html("<span>Dialog Ads:</span> Disabled");
		}
		
		if ($("#checkbox3").is(":checked")) {
			$("#landingpageads").html("<span>Landing Page Ads:</span> Enabled");
		}else{
			$("#landingpageads").html("<span>Landing Page Ads:</span> Disabled");
		}
		
		if ($("#checkbox4").is(":checked")) {
			$("#richmediafullpageads").html("<span>Rich Media Full Page Ads:</span> Enabled");
		}else{
			$("#richmediafullpageads").html("<span>Rich Media Full Page Ads:</span> Disabled");
		}
		
		if ($("#checkbox5").is(":checked")) {
			$("#overlayads").html("<span>Overlay Ads:</span> Enabled");
		}else{
			$("#overlayads").html("<span>Overlay Ads:</span> Disabled");
		}
		
		if ($("#checkbox6").is(":checked")) {
			$("#videoads").html("<span>Video Ads:</span> Enabled");
		}else{
			$("#videoads").html("<span>Video Ads:</span> Disabled");
		}
		
		if ($("#checkbox8").is(":checked")) {
			$("#bannerads").html("<span>Banner Ads:</span> Enabled");
		}else{
			$("#bannerads").html("<span>Banner Ads:</span> Disabled");
		}
	}
	
	function smartwallCheck() {
		if ($("#checkbox7").is(":checked")) {
			$("#checkbox1").prop('checked',true);
			$("#checkbox2").prop('checked',true);
			$("#checkbox3").prop('checked',true);
			$("#checkbox4").prop('checked',true);
			$("#checkbox5").prop('checked',true);
			$("#checkbox6").prop('checked',true);
			$("#appwallads").html("<span>Appwall Ads:</span> Enabled");
			$("#dialogads").html("<span>Dialog Ads:</span> Enabled");
			$("#landingpageads").html("<span>Landing Page Ads:</span> Enabled");
			$("#richmediafullpageads").html("<span>Rich Media Full Page Ads:</span> Enabled");
			$("#overlayads").html("<span>Overlay Ads:</span> Enabled");
			$("#videoads").html("<span>Video Ads:</span> Enabled");
		}else{
			$("#checkbox1").prop('checked',false);
			$("#checkbox2").prop('checked',false);
			$("#checkbox3").prop('checked',false);
			$("#checkbox4").prop('checked',false);
			$("#checkbox5").prop('checked',false);
			$("#checkbox6").prop('checked',false);
			$("#appwallads").html("<span>Appwall Ads:</span> Disabled");
			$("#dialogads").html("<span>Dialog Ads:</span> Disabled");
			$("#landingpageads").html("<span>Landing Page Ads:</span> Disabled");
			$("#richmediafullpageads").html("<span>Rich Media Full Page Ads:</span> Disabled");
			$("#overlayads").html("<span>Overlay Ads:</span> Disabled");
			$("#videoads").html("<span>Video Ads:</span> Disabled");
		}
	}
	
	function submitApp() {
		if ($("#checkbox1").is(":checked")) { var appwallads = 1; }else{ var appwallads = 0; }
		if ($("#checkbox2").is(":checked")) { var dialogads = 1; }else{ var dialogads = 0; }
		if ($("#checkbox3").is(":checked")) { var landingpageads = 1; }else{ var landingpageads = 0; }
		if ($("#checkbox4").is(":checked")) { var richmediafullpageads = 1; }else{ var richmediafullpageads = 0; }
		if ($("#checkbox5").is(":checked")) { var overlayads = 1; }else{ var overlayads = 0; }
		if ($("#checkbox6").is(":checked")) { var videoads = 1; }else{ var videoads = 0; }
		if ($("#checkbox8").is(":checked")) { var bannerads = 1; }else{ var bannerads = 0; }
		
		$.post("step2done.php", {
			appwallads: appwallads,
			dialogads: dialogads,
			landingpageads: landingpageads,
			richmediafullpageads: richmediafullpageads,
			overlayads: overlayads,
			videoads: videoads,
			bannerads: bannerads})
		.done(function(data) {
			if (data == 'App url taken') {
				alert("An app with this url already exists! Make sure you're not creating a duplicate!");
			}else if (data == 'Success') {
				window.location.href = '../step3/';
			}
		});
	}
</script>
</head>

<body>
<div id="main"> 
  <!-- header start here -->
  <header>
    <div id="header">
      <div class="container"> <a href="#" class="logo"><img src="../../../assets/images/logo.jpg" alt="logo"></a>
        <select tabindex="4" class="dropdown age">
          <option value="" class="label" value="">
          
          Developer
          
          </option>
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
                    <li> <a href="#"><i class="fa fa-edit"></i>Edit Profile</a> </li>
                    <li> <a href="#"><i class="fa fa-gear"></i>Setting</a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i>Logout</a></li>
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
      <h2 class="app_title">Add Application</h2>
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
        <!-- left section -->
        <div class="left_section">
        <h3 class="summary"> Application Summary</h3>
          <div class="left_info">
            <h3 class="sidebar_title">Information</h3>
            <div class="application_summry">
            <ul>
            <li><span>App Name:</span> <?php echo $appname; ?></li>
            <li><span>App Type:</span> <?php echo $apptype; ?></li>
            <li><span>App URL:</span> <?php echo $appurl; ?></li>
            <li><span>Category:</span> <?php echo $categoryname; ?></li>
            <li><span>Sub Category:</span> <?php echo $subcategoryname; ?></span></li>
            </ul>
            </div>
          </div>
          <div class="left_info">
            <h3 class="sidebar_title">Smartwall Ads</h3>
            <div class="application_summry">
            <ul>
            <li id="appwallads"><span>Appwall Ads:</span>Enabled</li>
            <li id="dialogads"><span>Dialog Ads:</span>Enabled</li>
            <li id="landingpageads"><span>Landing Page Ads:</span>Enabled</li>
            <li id="richmediafullpageads"><span>Rich Media Full Page Ads:</span>Enabled</li>
            <li id="overlayads"><span>Overlay Ads:</span>Enabled</li>
            <li id="videoads"><span>Video Ads:</span>Enabled</li>
            </ul>
            </div>
          </div>
          <div class="left_info">
            <h3 class="sidebar_title">Banner Ads</h3>
            <div class="application_summry">
            <ul>
            <li id="bannerads"><span>Banner Ads:</span>Enabled</li>
            </ul>
            </div>
          </div>
        </div>
        <!-- left section --> 
        
        <!-- right section -->
        <div class="right_section">
        <!-- step -->
        <div class="step_link">
        <ul>
        <li><a href="#_" class="step_one"> Step 1 - App Info</a></li>
        <li><a href="#_" class="active step_two"> Step 2 - Ad Formats & Targeting</a></li>
        <li><a href="#_" class="step_two">  Application Summary</a></li>
        </ul>
        </div>
        <!-- step -->
        
        <!-- right left -->
        <div class="right_left">
        <div class="smart_add_section">
        <div class="smart_title">
        <h4>SMARTWALL ADS (INTERSTITIAL ADS) <em>*</em><a href="#_"><img src="../../../assets/images/info_icon_new.png" alt="info" /></a></h4>
                <div class="chack_icon">
        <input id="checkbox7" type="checkbox" name="checkbox" value="7" checked="checked" onchange="smartwallCheck();"><label for="checkbox7"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <p class="smart_content">Smartwall is the world's best performing mobile interstitial ad! Our patent-pending 
technology mediates between multiple interstitial formats to generate the highest 
yield, including Rich Media Ads, Video Ads, AppWall, Dialog Ads, Overlay Ads, 
and more!</p>
        </div>
        
        <div class="smart_row">
        <p class="smart_content blue">Enable specific Interstitial Ad types for your Smartwall Ads. We recommend you 
select all of them and allow Smartwall Ads to optimize automatically.</p>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Appwall Ads:</label>
        <div>
        <input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked" onchange="checkboxCheck();"><label for="checkbox1"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Dialog Ads :</label>
        <div>
        <input id="checkbox2" type="checkbox" name="checkbox" value="2" checked="checked" onchange="checkboxCheck();"><label for="checkbox2"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Landing Page Ads :</label>
        <div>
        <input id="checkbox3" type="checkbox" name="checkbox" value="3" checked="checked" onchange="checkboxCheck();"><label for="checkbox3"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Rich Media Full page Ads :</label>
        <div>
        <input id="checkbox4" type="checkbox" name="checkbox" value="4" checked="checked" onchange="checkboxCheck();"><label for="checkbox4"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Overlay Ads:</label>
        <div>
        <input id="checkbox5" type="checkbox" name="checkbox" value="5" checked="checked" onchange="checkboxCheck();"><label for="checkbox5"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <label class="sr_label">Video Ads:</label>
        <div>
        <input id="checkbox6" type="checkbox" name="checkbox" value="6" checked="checked" onchange="checkboxCheck();"><label for="checkbox6"><span></span></label>
        </div>
        <div class="highlight">We would highly recommend keeping all the above interstitial ad types enabled as 
blocking them might adversely impact your earnings.</div>
        </div>
        
        </div>
        
        <div class="smart_add_section">
        <div class="smart_title">
        <h4>BANNER ADS<a href="#_"><img src="../../../assets/images/info_icon_new.png" alt="info" /></a></h4>
        <div class="chack_icon">
        <input id="checkbox8" type="checkbox" name="checkbox" value="8" checked="checked" onchange="checkboxCheck();"><label for="checkbox8"><span></span></label>
        </div>
        </div>
        
        <div class="smart_row">
        <p class="smart_content">Fingertise Banner Ads automatically mediate between rich media banner ads and 
static banner ads based on the best yielding ad inventory.</p>
        </div>
        </div>
        
        <div class="button_row">
          <input name="cancel" type="button" class="cancel_button" value="Back" onclick="window.location.href='../';"/>
          <input name="submit" type="button" class="submit_button" value="Continue" onclick="submitApp();"/>
          <input name="cancel" type="button" class="cancel_button" value="Cancel" onclick="window.location.href='../../';"/>
          </div>
        
        </div>
        <!-- right left -->
        
        </div>
        <!-- right section --> 
      </div>
    </div>
  </section>
  <!-- mid section --> 
</div>
</body>
</html>
