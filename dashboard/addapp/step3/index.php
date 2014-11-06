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
$appid = $_SESSION['appid'];

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
<script src="js/easyResponsiveTabs.js" type="../../../assets/text/javascript"></script>
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
      <h2 class="dash_title">Add App</h2>
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
          <div class="left_info">
            <h3 class="sidebar_title">Your API Key</h3>
            <div class="api_detail">
              <p><span>123400000000000000</span> You can generate or deactivate 
                API key from Permissions API 
                page.</p>
            </div>
            <h3 class="sidebar_title">Your Package name:</h3>
            <div class="api_detail">
              <p><span>com.fingertiseSDK</span> This is a dynamically generated 
                package name for your Fingertize 
                SDK and is required while integrat-
                ing the SDK to your apps. Please 
                refer to SDK documentation for 
                more information.</p>
            </div>
          </div>
        </div>
        <!-- left section --> 
        
        <!-- right section -->
        <div class="right_section">
          <div class="note">NOTE: Your AppID "<span><?php echo $appid; ?></span>" is required to integrate the SDK with your application. You can retrieve the AppID from Dashboard</div>
          <!-- sdk -->
          <div class="sdk_info">
            <div class="sdk_title">
              <h3>STANDARDSDK</h3>
            </div>
            <div class="sdk_inner"> <a href="#_" class="downlaod_button"><img src="../../../assets/images/download_sdk_button.jpg" alt="button" /></a> <a href="#_" class="downlaod_button"><img src="../../../assets/images/share_button.jpg" alt="button" /></a>
              <p class="sdk_content">Fingertise Standard SDK allows developers 
                to earn industry-leading CPM revenue with 
                the world's highest global fill rates.</p>
            </div>
            <div class="download_info">
              <p> Download official Fingertize plugins for game engines. <strong>Download Now!</strong> <br />
                <br />
                If your app is child-directed, use our Coppa SDK. <br />
                Download Coppa InApp SDK / Download Coppa OutApp SDK </p>
            </div>
            <div class="download_info">
              <p><strong>The Fingertise Android SDK includes:</strong><img src="../../../assets/images/info_icon.jpg" alt="info" /></p>
              <ul>
                <li>README: Get started with Fingertise Android ads!</li>
                <li>Fingertise Jar file: Required for publishing ads. Follow the documentation in javadoc/index.html and drop the Fingertise Jar file into your 
                  project.</li>
                <li>Sample Projects: Examples of Fingertise Android ads shown in the Airtest application.</li>
              </ul>
            </div>
          </div>
          <!-- sdk --> 
          <a href="#_" class="back_buttton">GO BACK TO DASHBOARD!</a> </div>
        <!-- right section --> 
      </div>
    </div>
  </section>
  <!-- mid section --> 
</div>
</body>
</html>
