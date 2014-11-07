

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fingertise</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/dashstyle.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css" />
    <!--**********************usermenu*************************-->
    <script type='text/javascript' src="../../assets/js/jquery-1.8.2.min.js"></script>
  <script type='text/javascript' src="../../assets/js/appcategories.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/menu.css">
    <script>
$(document).ready(function(){
  $(".item").click(function(){
    $(".chackout_items").toggle();
  });
  $("#menu ul li").find(".sub-menu").parent().click(function(){$(this).find(".sub-menu").toggle();});
});
</script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/chackbox.css">
    <!--**********************selector************************-->
    <link rel="stylesheet" type="text/css" href="../../assets/css/easydropdown.css"/>
    <script src="../../assets/js/jquery.easydropdown.js"></script>
    <!--**********************dropdownselector*************************-->
    <script type="text/javascript" src="../../assets/js/jquery.selectBox.js"></script>
    <link type="text/css" rel="stylesheet" href="../../assets/css/jquery.selectBox.css"/>
    <script type="text/javascript">

        $(document).ready(function () {

            $('select')
                    .selectBox({
                        mobile: true,
            keepInViewport: false
                    })
                    

        });
    
    
    function updateAppInformation() {
      $("#appnametext").html("<span>App Name: </span>" + $("#appnameinput").val());
      
      if ($("#radio1").is(':checked')) {
        $("#apptypetext").html("<span>App Type: </span> Android Market URL");
      }else{
        $("#apptypetext").html("<span>App Type: </span> Non-Market URL");
      }
      
      $("#appurltext").html("<span>App URL: </span> " + $("#appurlinput").val());
      
      $("#categorytext").html("<span>Category: </span>" + $("#appcategoryinput option:selected").text());
      
      $("#subcategorytext").html("<span>Sub Category: </span>" + $("#appsubcategoryinput option:selected").text());
      
      //updateSubCategories();
    }
    
    setInterval(function(){updateAppInformation();},1000);
    
    
    function setStartingValues() {
      var apptype = 'nonmarket';
      var category = '5';
      var subcategory = '2';
      
      if (!apptype=='') {
        if (apptype == 'androidmarket') {
          $("#radio1").prop('checked',true);
          $("#radio2").prop('checked',false);
        }else if (apptype == 'nonmarket') {
          $("#radio2").prop('checked',true);
          $("#radio1").prop('checked',false);
        }
      }
      
      if (!category=='') {
        $('#appcategoryinput option[value="' + category + '"]').prop('selected',true);
      }
      
      if (!subcategory=='') {
        $('#appsubcategoryinput option[value="' + subcategory + '"]').prop('selected',true);
      }
    }
    
    function attemptStep1() {
      var apptype = '';
      if ($("#radio1").is(":checked")) {
        apptype = "androidmarket";
      }else{
        apptype = "nonmarket";
      }
      $.post("step1done.php", {
        appname: $("#appnameinput").val(),
        apptype: apptype,
        appurl: $("#appurlinput").val(),
        category: $("#appcategoryinput option:selected").val(),
        subcategory: $("#appsubcategoryinput option:selected").val(),
        categoryname: $("#appcategoryinput option:selected").text(),
        subcategoryname: $("#appsubcategoryinput option:selected").text()})
      .done(function(data) {
        if (data == 'Missing category') {
          alert("Please make sure you've selected both a category and a subcategory!");
        }else if (data == 'Success'){
          window.location.href = 'step2/';
        }else if (data == 'App url taken'){
          alert("An app with this url already exists! Make sure you're not creating a duplicate!");
        }
      });
    }

    </script>
    </head>

    <body onload="setStartingValues();">
    <div id="main"> 
      <!-- header start here -->
      <header>
        <div id="header">
          <div class="container"> <a href="#" class="logo"><img src="../../assets/images/logo.jpg" alt="logo"></a>
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
                  <li><a href="#" class="dash"><span>Dashboard</span></a></li>
                  <li class="active"><a href="#" class="payment active"><span>Payments</span></a></li>
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
                <li><a href="#">Welcome : Kevin Williams <b class="arrow"></b></a>
                  <ul class="sub-menu">
                    <li> <a href="#"><i class="fa fa-edit"></i>Edit Profile</a> </li>
                    <li> <a href="#"><i class="fa fa-gear"></i>Setting</a></li>
                    <li><a href="logout"><i class="fa fa-sign-out"></i>Logout</a></li>
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
          <h2 class="head_title payments">Payment Details</h2>
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
            <div class="left_section" style="min-height:622px;">
              <div class="left_info">
                <h3 class="sidebar_title">Payment Info</h3>
                <h3 class="sidebar_title">Payment History</h3>
              </div>
            </div>
            <!-- left section --> 
            
            <!-- right section -->
            <div class="right_section">      
              <!-- right left -->
              <div class="right_left">
                <div class="app_info_step">
                  <div class="smart_title">
                    <h4>Tax Information</h4>
                  </div>
                  <!-- app info form -->
                  <div class="st_form">
                    <!-- country -->
                    <div class="st_form_group">
                      <label class="st_form_label">Country : <em>*</em></label>
                      <select id="appcategoryinput" name="standard-dropdown" class="custom-class1 custom-class2" style="width: 200px;">
                        <option value="1" selected="selected">Select Country</option>
                        <option value="2">United States</option>
                        <option value="3">Country</option>
                        <option value="4">Country</option>
                      </select>
                    </div>
                    <!-- account type -->
                    <div class="st_form_group">
                      <label class="st_form_label">Account Type : <em>*</em></label>
                      <select id="appcategoryinput" name="standard-dropdown" class="custom-class1 custom-class2" style="width: 200px;">
                        <option value="1" selected="selected">Select Account Type</option>
                        <option value="2">Account 1</option>
                        <option value="3">Account 2</option>
                        <option value="4">Account 3</option>
                      </select>
                    </div>
                    <div class="st_form_group">
                      <label class="st_form_label">Business Name: <em>*</em></label>
                      <input name="text" type="text" class="st_text_field"/>
                      <span class="info">If you are a legally registered business entity, enter the business name. If you are using it for your personal account, just enter your full name here.</span> 
                    </div>
              
                    <div class="st_form_group">
                      <label class="st_form_label">Sub Category : <em>*</em></label>
                      <select id="appsubcategoryinput" name="standard-dropdown" class="custom-class1 custom-class2" style="width: 200px;">
                        <option value="1" class="test-class-1" selected="selected">Please Select Category</option>
                        <option value="2" class="test-class-2">Item 1</option>
            <option value="3" class="test-class-2">Item 2</option>
                      </select>
                      <span class="info">Select the category that best describes your app.</span> </div>
                    <div class="button_row">
                      <input name="submit" type="button" class="submit_button" value="Continue" onclick="attemptStep1();"/>
                      <input name="cancel" type="button" class="cancel_button" value="Cancel" onclick="window.location.href='../dashboard';" />
                    </div>
                  </div>
                  <!-- app info form --> 
                </div>
              </div>
              <!-- right left -->
              
              <div class="help_info gradient-blue">
                <span class="title_lifesaver"></span>
                <p>Fingertize is required to collect tax information from all its developers - you are responsible for keeping it up to date. You can change your tax information at any time. NOTE: Any changes made in your payment section between 15th till end of month will be not be considered for current pay cycle. For any payment related query please write to us: <a href="mailto:support@fingertize.com">support@fingertize.com</a></p>
              </div>

              <div class="help_info gradient-yellow">
                <span class="title_lifesaver"></span>
                <p>The minimum earnings to qualify for weekly payment is $300/week in case of Bundled SDK and $600/week in case of Standard Pub SDK. The user after reaching the minimum set earnings will be included in an approval period of 30 days, the user has to qualify for the weekly during these 4 weeks, after which the user will be paid on Net 7 basis thereafter. Until such time, the user will be paid on Net 30 basis. Tax Information</p>
              </div>

              <div class="help_info">
                <h3>Helpful Information</h3>
                <p>As a developer, it is your duty to make sure that you have entered your tax-related information correctly. Choose your country of residence and your account type. Account type refers to whether you are registering with Fingertize as an individual or a part of your organisation. Enter your registered business name. Business address details and Depending on your country, respective local TAX ID. Choose the payment details. Currently, Fingertize makes payments via ACH,Wire and Paypal transfer. Enter the respective details and click 'Submit' for the information to be stored.</p>
              </div>
            </div>

            <!-- right section --> 
          </div>
        </div>
      </section>
      <!-- mid section --> 
    </div>
</body>
</html>
