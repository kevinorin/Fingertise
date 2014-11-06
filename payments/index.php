

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fingertise</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/dashstyle.css" />
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
            <div class="left_section" style="min-height:622px;">
              <h3 class="summary"> Application Summary</h3>
              <div class="left_info">
                <h3 class="sidebar_title">Information</h3>
                <div class="application_summry">
                  <ul>
                    <li id="appnametext"><span>App Name:</span></li>
                    <li id="apptypetext"><span>App Type:</span></li>
                    <li id="appurltext"><span>App URL:</span>https://play.google.com/store/
                      apps/details?id=</li>
                    <li id="categorytext"><span>Category:</span></li>
                    <li id="subcategorytext"><span>Sub Category:</span></li>
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
                  <li><a href="#_" class="active step_one"> Step 1 - App Info</a></li>
                  <li><a href="#_" class="step_two"> Step 2 - Ad Formats & Targeting</a></li>
                  <li><a href="#_" class="step_two"> Application Summary</a></li>
                </ul>
              </div>
              <!-- step --> 
              
              <!-- right left -->
              <div class="right_left">
                <div class="app_info_step">
                  <div class="smart_title">
                    <h4>App Information</h4>
                  </div>
                  <!-- app info form -->
                  <div class="st_form">
                    <div class="st_form_group">
                      <label class="st_form_label">App Name: <em>*</em></label>
                      <input name="text" type="text" class="st_text_field" value="KW Test App" id="appnameinput"/>
                      <span class="info">Enter a Unique Name. Only you will be seeing this name. 
                      This will not be visible to app users.</span> </div>
                    <div class="st_form_group">
                      <label class="st_form_label">App Type: <em>*</em></label>
                      <div class="add_type">
                        <input id="radio1" type="radio" name="radio" value="1" checked="checked"">
                        <label for="radio1"><span><span></span></span>Android Market URL</label>
                      </div>
                      <div class="add_type">
                        <input id="radio2" type="radio" name="radio" value="2" checked="checked"">
                        <label for="radio2"><span><span></span></span>Non-Market URL</label>
                        <a href="#_"><img src="../../assets/images/info_icon_new.png" alt="info" /></a> </div>
                    </div>
                    <div class="st_form_group">
                      <label class="st_form_label">App Package ID: <em>*</em></label>
                      <input name="text" type="text" class="st_text_field" placeholder="https://play.google.com/store/apps/details?id=" value="https://play.google.com/store/apps/details?id=04394229" id="appurlinput"/>
                      <span class="info">Please enter the Android Market URL or Off-Market URL</span> </div>
                    <div class="st_form_group">
                      <label class="st_form_label">Category : <em>*</em></label>
                      <select id="appcategoryinput" name="standard-dropdown" class="custom-class1 custom-class2" style="width: 200px;">
                        <option value="1" class="test-class-1" selected="selected">Please Select Category</option>
                        <option value="2" class="test-class-2">Arts and Entertainment</option>
            <option value="3" class="test-class-2">Automotive</option>
            <option value="4" class="test-class-2">Business</option>
            <option value="5" class="test-class-2">Careers</option>
            <option value="6" class="test-class-2">Dating</option>
            <option value="7" class="test-class-2">Education</option>
            <option value="8" class="test-class-2">Family and Parenting</option>
            <option value="9" class="test-class-2">Finance Personal</option>
            <option value="10" class="test-class-2">Food and Drink</option>
            <option value="11" class="test-class-2">Games</option>
            <option value="12" class="test-class-2">Health and Fitness</option>
            <option value="13" class="test-class-2">Hobbies and Interests</option>
            <option value="14" class="test-class-2">Home and Garden</option>
            <option value="15" class="test-class-2">Illegal Content</option>
            <option value="16" class="test-class-2">Law, Government, and Politics</option>
            <option value="17" class="test-class-2">News</option>
            <option value="18" class="test-class-2">Non-Standard Content</option>
            <option value="19" class="test-class-2">Pets</option>
            <option value="20" class="test-class-2">Real Estate</option>
            <option value="21" class="test-class-2">Religion and Spirituality</option>
            <option value="22" class="test-class-2">Science</option>
            <option value="23" class="test-class-2">Shopping</option>
            <option value="24" class="test-class-2">Society</option>
            <option value="25" class="test-class-2">Sports</option>
            <option value="26" class="test-class-2">Style and Fashion</option>
            <option value="27" class="test-class-2">Technology and Computing</option>
            <option value="28" class="test-class-2">Travel</option>
            <option value="29" class="test-class-2">Uncategorized</option>
                      </select>
                      <span class="info">Select the category that best describes your app.</span> </div>
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
              
              <div class="help_info">
                <h3>Helpful Information</h3>
                <p>Complete the information to register your 
                  site or app and retrieve the appropriate 
                  Developer Code on subsequent page. 
                  Each unique site or app has a specific 
                  version of Developer Code required to 
                  integrated with the Fingertize marketplace.</p>
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
