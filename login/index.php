<?php
/*
Include config file
*/
include("../config.php");

/*
If user is logged in, redirect to dashboard
*/
if (isset($_SESSION['email'])) {
	header("Location: ../dashboard");
}

/*
Interact with Google API, checking if user has attempted to login via Google and logging in accordingly
*/
$redirect_uri = 'http://arcticandroidapps.net/fingertise2/login/index.php';
$scopes = array('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');

$googleClient = new Google_Client;
$auth = new GoogleAuth($googleClient, $client_id, $client_secret, $redirect_uri, $scopes);

if($auth->checkRedirectCode()) { //User is logged in
	$payload = $auth->getPayload();

	$email = $payload['email'];

	$emailcheck = ORM::for_table('users')->where('email',$email)->find_one(); //Check if email is already registered
	if (!$emailcheck) { //Not registered, redirect to register page
		header("Location: ../register");
	}else{ //Registered, redirect to dashboard
		$_SESSION['email'] = $email;
		header("Location: ../dashboard");
	}
}

?>

<!doctype html>
<html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Fingertise - Login</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <!--************** menu js *********************-->
        <link rel="stylesheet" href="../assets/css/mnav.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="../assets/js/mnav.js"></script>
        <script type="text/javascript">
$(function() {
                $('#nav-demo').Mnav({
                    mobileButtonPos: 'left',
					theme:'mnav-theme'
                });
            });
        </script>
<style type="text/css">
.set_background{ margin:0px; padding:0px; height:auto;}
</style>    
		
		<script type="text/javascript">
			function attemptLogin() { //User attempted to login with an email and password rather than Google
				$.post( "attemptlogin.php", { email: $('#email').val(), password: $('#password').val() })
				.done(function( data ) {
					if (data == 'Success') {
						window.location.href = "../dashboard";
					}else{
						$('#ShowSuccessMessage').show();
					}
				});
			}
		</script>
	
<script type="text/javascript">
var flag1=0,flag2=0;
function check_validation()
{
	if($('#email').val() == '')
	{
		flag1=1;
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
			flag1=1;
			$('#email').addClass('error_css');
			$('#email_right').hide();
			$('#email_cross').show();
		}
		else
		{
			flag1=0;
			$('#email').addClass('succes_css');
			$('#email_cross').hide();
			$('#email_right').show();		
		}
	}
	
	if($('#password').val()== '')
	{
		flag2=1;
		$('#password').removeClass('succes_css');
		$('#password').addClass('error_css');	
		$('#password_right').hide();	
		$('#password_cross').show();
	}
	else
	{
		flag2=0;
		$('#password').addClass('succes_css');
		$('#password_right').show();	
		$('#password_cross').hide();
	}
	
	if(flag1==0&&flag2==0)
	{
		attemptLogin();
	}
	else
	{
		$('#ShowSuccessMessage').hide();
	}	
}
function checkEmail()
{
	if($('#email').val() == '')
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
	if($('#password').val()== '')
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
</script>        
        <!--***************chackbox**********************-->
        <link rel="stylesheet" type="text/css" href="../assets/css/chackbox.css">
        </head>

        <body>
        <div id="main">
<!-- header start here -->
<header>
          <div id="header">
    <div class="container"> <a href="#" class="logo"><img src="../assets/images/logo.jpg" alt="logo"></a>
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
        <div class="signup_form">
                  <div class="signup_form_title">
            <h2>Login - Developer</h2>
          </div>
          <div id="ShowSuccessMessage" class="login_fail">Invalid login information</div>
                  <!-- login left -->
                  <div class="login_left">
            <div class="form_group">
                      <label class="form_group_title space">Email<em>*</em></label>
                      <input name="email" id="email" onChange="checkEmail();" type="text" class="form_text_field">
                      <div id="email_cross" style="float:left; display:none;">&nbsp;&nbsp;<img src="../assets/images/cross.png"></div>
            <div id="email_right" style="float:left; display:none;">&nbsp;&nbsp;<img src="../assets/images/right.png"></div>
                    </div>
            <div class="form_group light">
                      <label class="form_group_title space">Password<em>*</em></label>
                      <input name="password" id="password" type="password" class="form_text_field" onChange="checkPass();">
                      <div id="password_cross" style="float:left; display:none;">&nbsp;&nbsp;<img src="../assets/images/cross.png"></div>
            <div id="password_right" style="float:left; display:none;">&nbsp;&nbsp;<img src="../assets/images/right.png"></div>
                    </div>
            <div class="form_group">
                      <div class="forgot_section">
                <div class="chack_option">
                          <input id="checkbox1" type="checkbox" name="checkbox" value="1">
                          <label for="checkbox1" style="font-size:15px;"><span></span>Remember Me</label>
                          <a href="#" class="forgot">Forgot Password?</a> </div>
              </div>
                    </div>
            <div class="form_group light">
                      <div class="login_button_row">
                <input name="login" type="button" class="login_button" value="login" onClick="check_validation();">
				<input name="login" type="button" class="login_button" value="Login with Google" onClick="window.location.href='<?php echo $auth->getAuthUrl(); ?>';"></div>
                    </div>
          </div>
                  <!-- login left --> 
                  <!-- login right -->
                  <div class="create_account"> <img src="../assets/images/create_icon.png" alt="create">
            <p>Don’t have an account?</p>
            <a href="../register" class="get_started">GET STARTED</a> </div>
                  <!-- login right --> 
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
