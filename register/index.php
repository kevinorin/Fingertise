<?php
/*
  Include config file
 */
include('../config.php');
//
///*
//Captcha Code
//*/
$_SESSION = array();
$_SESSION['captcha'] = simple_php_captcha();

?>
<!doctype html>
<html class="set_background" id="setBackground">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Fingertise - Register</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <!--************** menu js *********************-->
        <link rel="stylesheet" href="../assets/css/mnav.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://apis.google.com/js/client:platform.js" async defer></script>

        <script type="text/javascript">
            function signinCallback(authResult) {
                if (authResult['status']['signed_in']) {
                    // Update the app to reflect a signed in user
                    gapi.auth.setToken(authResult); //Store the returned token
                    getUserInfo(); //Trigger request to get the email address
                }
            }

            function getUserInfo() {
                // Load the oauth2 libraries to enable the userinfo methods.
                gapi.client.load('oauth2', 'v2', function () {
                    var request = gapi.client.oauth2.userinfo.get();
                    request.execute(getUserInfoCallback);
                });
            }

            function getUserInfoCallback(obj) {
                var email = obj['email'];
                var name = obj['name'];
                if (email == 'undefined') {
                    alert("Something went wrong! Please try again.");
                    return;
                }
                document.getElementById('email').value = obj['email'];
                document.getElementById('name').value = obj['name'];

                $.get("attemptregister.php?method=google&email=" + email + "&name=" + name, function (data) {
                    if (data == 'Success') {
                        $('#main_form').slideUp(2000);
                        $('#GoogleSuccessMessage').show();
                        var delay = 1000;//1 seconds
                        setTimeout(function () {
                            $('#setBackground').removeClass('set_background');
                        }, delay);
                    } else if (data == 'Email taken') {
                        alert('Email taken!');
                        $('#email').addClass('error_css');
                        $('#email_right').hide();
                        $('#email_cross').show();
                        $('#email').val('Email taken!');
                    }
                });
            }
        </script>
        <script type="text/javascript" src="../assets/js/mnav.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#nav-demo').Mnav({
                    mobileButtonPos: 'left',
                    theme: 'mnav-theme'
                });
            });
        </script>
        <style type="text/css">
            pre {
                border: solid 1px #bbb;
                padding: 10px;
                margin: 2em;
            }
            img {
                margin: 0 2em;
            }
        </style>        
        <!--***************chackbox**********************-->
        <link rel="stylesheet" type="text/css" href="../assets/css/chackbox.css">
    </head>


    <script type="text/javascript">
        var flag1 = 0, flag2 = 0, flag3 = 0, flag4 = 0, flag5 = 0, flag6 = 0, flag7 = 0, flag8 = 0;
        function check_validation()
        {
            if ($('#email').val() == '')
            {
                $('#email').addClass('error_css');
                $('#email_right').hide();
                $('#email_cross').show();
            }
            else
            {
                var email = document.getElementById('email');
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(email.value))
                {
                    $('#email').addClass('error_css');
                    $('#email_right').hide();
                    $('#email_cross').show();
                }
                else
                {
                    $('#email').addClass('succes_css');
                    $('#email_cross').hide();
                    $('#email_right').show();
                }
            }

            if ($('#password').val() == '')
            {
                flag2 = 1;
                $('#password').removeClass('succes_css');
                $('#password').addClass('error_css');
                $('#password_right').hide();
                $('#password_cross').show();
            }
            else
            {
                flag2 = 0;
                $('#password').addClass('succes_css');
                $('#password_right').show();
                $('#password_cross').hide();
            }

            if ($('#name').val() == '')
            {
                flag3 = 1;
                $('#name').removeClass('succes_css');
                $('#name').addClass('error_css');
                $('#name_right').hide();
                $('#name_cross').show();
            }
            else
            {
                flag3 = 0;
                $('#name').addClass('succes_css');
                $('#name_right').show();
                $('#name_cross').hide();
            }

            if ($('#country').val() == '')
            {
                flag4 = 1;
                $('#country').removeClass('succes_css');
                $('#country').addClass('error_css');
                $('#country_right').hide();
                $('#country_cross').show();
            }
            else
            {
                flag4 = 0;
                $('#country').addClass('succes_css');
                $('#country_right').show();
                $('#country_cross').hide();
            }

            if ($('#phone').val() == '')
            {
                flag5 = 1;
                $('#phone').removeClass('succes_css');
                $('#phone').addClass('error_css');
                $('#phone_right').hide();
                $('#phone_cross').show();
            }
            else
            {
                var phone = document.getElementById('phone');
                var phoneno = /^\d{10}$/;
                if (isNaN(phone.value))
                {
                    flag5 = 1;
                    $('#phone').addClass('error_css');
                    $('#phone_right').hide();
                    $('#phone_cross').show();
                }
                else
                {
                    flag5 = 0;
                    $('#phone').addClass('succes_css');
                    $('#phone_right').show();
                    $('#phone_cross').hide();
                }
            }

            if ($('#did_you_hear').val() == '')
            {
                flag6 = 1
                $('#did_you_hear').removeClass('succes_css');
                $('#did_you_hear').addClass('error_css');
                $('#did_you_hear_right').hide();
                $('#did_you_hear_cross').show();
            }
            else
            {
                flag6 = 0;
                $('#did_you_hear').addClass('succes_css');
                $('#did_you_hear_right').show();
                $('#did_you_hear_cross').hide();
            }

            var captcha_code_session = '<?php echo $_SESSION['captcha']['code'] ?>';
            var captcha_code_input = $('#captch_code').val();
            if (captcha_code_input == captcha_code_session)
            {
                flag7 = 0;
                $('#captch_code').removeClass('c_error_css');
                $('#captch_code').addClass('c_succes_css');
                $('#captch_code_right').show();
                $('#captch_code_cross').hide();
            }
            else
            {
                flag7 = 1;
                $('#captch_code').removeClass('capcha');
                $('#captch_code').addClass('c_error_css');
                $('#captch_code_right').hide();
                $('#captch_code_cross').show();
            }

            if (document.getElementById("i_agreee").checked == true)
            {
                flag8 = 0;
                $('#i_agreee').addClass('succes_css');
                $('#i_agree_right').show();
                $('#i_agree_cross').hide();
            }
            else
            {
                flag8 = 1;
                $('#i_agreee').addClass('error_css');
                $('#i_agree_right').hide();
                $('#i_agree_cross').show();
            }

            if (flag1 == 0 && flag2 == 0 && flag3 == 0 && flag4 == 0 && flag5 == 0 && flag6 == 0 && flag7 == 0 && flag8 == 0)
            {
                attemptRegister();
            }
            else
            {
                $('#ShowSuccessMessage').hide();
            }
        }

        function checkEmail()
        {
            if ($('#email').val() == '')
            {
                $('#email').addClass('error_css');
                $('#email_right').hide();
                $('#email_cross').show();
            }
            else
            {
                var email = document.getElementById('email');
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(email.value))
                {
                    $('#email').addClass('error_css');
                    $('#email_right').hide();
                    $('#email_cross').show();

                }
                else
                {
                    $('#email').addClass('succes_css');
                    $('#email_cross').hide();
                    $('#email_right').show();
                }
            }
        }
        function checkPass()
        {
            if ($('#password').val() == '')
            {
                $('#password').removeClass('succes_css');
                $('#password').addClass('error_css');
                $('#password_right').hide();
                $('#password_cross').show();
            }
            else
            {
                $('#password').addClass('succes_css');
                $('#password_right').show();
                $('#password_cross').hide();
            }
        }
        function checkName()
        {
            if ($('#name').val() == '')
            {
                $('#name').removeClass('succes_css');
                $('#name').addClass('error_css');
                $('#name_right').hide();
                $('#name_cross').show();
            }
            else
            {
                $('#name').addClass('succes_css');
                $('#name_right').show();
                $('#name_cross').hide();
            }
        }
        function checkCountry()
        {
            if ($('#country').val() == '')
            {
                $('#country').removeClass('succes_css');
                $('#country').addClass('error_css');
                $('#country_right').hide();
                $('#country_cross').show();
            }
            else
            {
                $('#country').addClass('succes_css');
                $('#country_right').show();
                $('#country_cross').hide();
            }
        }
        function checkPhone()
        {
            if ($('#phone').val() == '')
            {
                $('#phone').removeClass('succes_css');
                $('#phone').addClass('error_css');
                $('#phone_right').hide();
                $('#phone_cross').show();
            }
            else
            {
                var phone = document.getElementById('phone');
                var phoneno = /^\d{10}$/;
                if (isNaN(phone.value))
                {
                    $('#phone').addClass('error_css');
                    $('#phone_right').hide();
                    $('#phone_cross').show();
                }
                else
                {
                    $('#phone').addClass('succes_css');
                    $('#phone_right').show();
                    $('#phone_cross').hide();
                }
            }
        }
        function checkDidYouHear()
        {
            if ($('#did_you_hear').val() == '')
            {
                $('#did_you_hear').removeClass('succes_css');
                $('#did_you_hear').addClass('error_css');
                $('#did_you_hear_right').hide();
                $('#did_you_hear_cross').show();
            }
            else
            {
                $('#did_you_hear').addClass('succes_css');
                $('#did_you_hear_right').show();
                $('#did_you_hear_cross').hide();
            }
        }
        function checkCaptchcode()
        {
            var captcha_code_session = '<?php echo $_SESSION['captcha']['code'] ?>';
            var captcha_code_input = $('#captch_code').val();
            if (captcha_code_input == captcha_code_session)
            {
                $('#captch_code').removeClass('c_error_css');
                $('#captch_code').addClass('c_succes_css');
                $('#captch_code_right').show();
                $('#captch_code_cross').hide();
            }
            else
            {
                $('#captch_code').removeClass('capcha');
                $('#captch_code').addClass('c_error_css');
                $('#captch_code_right').hide();
                $('#captch_code_cross').show();
            }
        }
        function checkAgree()
        {
            if (document.getElementById("i_agreee").checked == true)
            {
                $('#i_agreee').addClass('succes_css');
                $('#i_agree_right').show();
                $('#i_agree_cross').hide();
            }
            else
            {
                $('#i_agreee').addClass('error_css');
                $('#i_agree_right').hide();
                $('#i_agree_cross').show();
            }
        }

        function attemptRegister() {
            var formemail = $('#email').val();
            var formpassword = $('#password').val();
            var formname = $('#name').val();
            var formcountry = $('#country').val();
            var formphone = $('#phone').val();
            var formhowdidyouhear = $('#did_you_hear').val();
            $.get("attemptregister.php?email=" + formemail + "&password=" + formpassword + "&name=" + formname + "&country=" + formcountry + "&phone=" + formphone + "&howdidyouhear=" + formhowdidyouhear, function (data) {
                if (data == 'Success') {
                    $('#main_form').slideUp(2000);
                    $('#ShowSuccessMessage').show();
                    var delay = 1000;//1 seconds
                    setTimeout(function () {
                        $('#setBackground').removeClass('set_background');
                    }, delay);
                } else if (data == 'Email taken') {
                    alert('Email taken!');
                    $('#email').addClass('error_css');
                    $('#email_right').hide();
                    $('#email_cross').show();
                    $('#email').val('Email taken!');
                }
            });
        }
    </script>
    <style type="text/css">
        /*html, body{ margin:0px; padding:0px; height:auto;}*/
        .set_background{ margin:0px; padding:0px; height:auto;}


    </style>




    <body>
        <div id="main">
            <!-- header start here -->
            <header>
                <div id="header">
                    <div class="container"><a href="#" class="logo"><img src="../assets/images/logo.jpg" alt="logo"></a>
                        <div class="signup_link">
                            <ul>
                                <li><a href="../register">Signup</a></li>
                                <li>|</li>
                                <li><a href="../login">Login</a></li>
                            </ul>
                        </div>
                        <!-- navigation -->
                        <div class="navigation">
                            <div id="nav-demo">
                                <ul>
                                    <li><a href="#">Developers</a></li>
                                    <li><a href="#">Advertisers</a></li>
                                    <li><a href="#">User Acquisition</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- navigation --> 

                    </div>
                </div>
            </header>
            <!-- header end here --> 

            <!-- mid start here -->
            <section>
                <div id="mid_section">
                    <div class="container">
                        <div class="mid_form_outer">

                            <div class="signup_form" id="">
                                <div class="signup_form_title">
                                    <h2>Signup As a Developer</h2>
                                </div>
                                <div class="already" id="ShowSuccessMessage" style="text-align:center; display:none;">Please confirm your email.</div>
                                <div class="already" id="GoogleSuccessMessage" style="text-align:center; display:none;">Thank you for registering! You can now login <a href="../login">here</a>.</div>
                                <div id="main_form">
                                    <div class="already"><p style="float:left; margin:7px 10px 0 0px ;">Already registered?<a href="../login">Login here</a> | Or, register with Google+:</p><span id="signinButton">
                                            <span
                                                class="g-signin"
                                                data-callback="signinCallback"
                                                data-clientid="<?php echo $client_id; ?>"
                                                data-cookiepolicy="single_host_origin"
                                                data-requestvisibleactions="http://schema.org/AddAction"
                                                data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email">
                                            </span>
                                        </span></div>

                                    <div class="form_group light" id="msg_email">
                                        <label class="form_group_title">Email<em>*</em></label>
                                        <input name="email" type="text" id="email" class="form_text_field" onChange="checkEmail();">
                                        <div id="email_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="email_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group" id="msg_password">
                                        <label class="form_group_title">Password<em>*</em></label>
                                        <input name="password" id="password" type="password" class="form_text_field" onChange="checkPass();">
                                        <div id="password_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="password_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group light" id="msg_name">
                                        <label class="form_group_title">Name<em>*</em></label>
                                        <input name="name" id="name" type="text" class="form_text_field" onChange="checkName();">
                                        <div id="name_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="name_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group" id="msg_country">
                                        <label class="form_group_title">Country<em>*</em></label>
                                        <select name="jumpMenu" id="country" class="form_drop" onChange="checkCountry();">
                                            <option value="">Select Country</option>
                                            <option>item1</option>
                                            <option>item2</option>
                                            <option>item3</option>
                                        </select>
                                        <div id="country_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="country_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group light" id="msg_phone">
                                        <label class="form_group_title">Phone</label>
                                        <input name="phone" id="phone" type="text" class="form_text_field" onChange="checkPhone();">
                                        <div id="phone_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="phone_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group">
                                        <label class="form_group_title">How did you hear about us?<em>*</em></label>
                                        <select name="jumpMenu" id="did_you_hear" class="form_drop" onChange="checkDidYouHear();">
                                            <option value="">Select</option>
                                            <option>item1</option>
                                            <option>item2</option>
                                            <option>item3</option>
                                        </select>
                                        <div id="did_you_hear_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="did_you_hear_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group light"> </div>
                                    <div class="form_group">
                                        <label class="form_group_title">Captcha <em>*</em></label>

                                        <div class="capcha">
                                        <!--<img src="images/capcha.jpg" alt="capcha">-->
                                            <?php 
//                                            echo '<pre>';
//                                            print_r($_SESSION);
                                            echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                                            ?>
                                        </div>
                                        <textarea name="capcha" id="captch_code" cols="" rows="" class="form_text_field capcha" onChange="checkCaptchcode();"></textarea>
                                        <div id="captch_code_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                        <div id="captch_code_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                    </div>
                                    <div class="form_group light">
                                        <div class="chack_option">
                                            <div style="float:left;">
                                                <input id="i_agreee" type="checkbox" name="checkbox" value="1" checked="checked" onChange="checkAgree();">
                                                <label for="i_agreee"><span></span>I agree to Fingertise Terms & Conditions</label>
                                            </div>         <div id="i_agree_cross" style="float:left; display:none;"><img src="../assets/images/cross.png"></div>
                                            <div id="i_agree_right" style="float:left; display:none;"><img src="../assets/images/right.png"></div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="chack_option">
                                            <input id="checkbox2" type="checkbox" name="checkbox" value="2">
                                            <label for="checkbox2"><span></span>Send me useful tips and product notifications</label>
                                        </div>
                                    </div>
                                    <input name="create" type="button" class="create_button" value="Create Account" onClick="check_validation();">  
                                </div>        

                                <div class="form_bottom"></div>
                            </div>
                        </div>
                    </div>
                    <!-- footer start here -->
                    <footer>
                        <div id="footer">
                            <div class="container">
                                <div class="foot_link">
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">App Policy</a></li>
                                        <li><a href="#">Opt Out</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Support</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- footer end here --> 
                </div>
            </section>
            <!-- mid end here -->
        </div>

    </body>
</html>
