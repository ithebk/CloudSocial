<?php // signup.php

include_once 'header.php';
if(isset($_SESSION['user'])){
    
    redirect('members.php',0,0);

}
echo <<<_END
<script>
function checkUser(user)
{
 if (user.value == '')
 {
 O('info').innerHTML = ''
 return
 }
 params = "user=" + user.value
 request = new ajaxRequest()
 request.open("POST", "checkuser.php", true)
 request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
 request.setRequestHeader("Content-length", params.length)
 request.setRequestHeader("Connection", "close")
 request.onreadystatechange = function()
 {
 if (this.readyState == 4)
 if (this.status == 200)
 if (this.responseText != null)
 O('info').innerHTML = this.responseText
 }
 request.send(params)
}
function ajaxRequest()
{
 try { var request = new XMLHttpRequest() }
 catch(e1) {
 try { request = new ActiveXObject("Msxml2.XMLHTTP") }
 catch(e2) {
 try { request = new ActiveXObject("Microsoft.XMLHTTP") }
 catch(e3) {
 request = false
 } } }
 return request
}
</script>
_END;
$error = $user = $pass = "";
if (isset($_SESSION['user'])) destroySession();
if (isset($_POST['user']))
{
 $user = sanitizeString($_POST['user']);
 $pass = sanitizeString($_POST['pass']);
 if ($user == "" || $pass == "")
 $error = "Not all fields were entered<br /><br />";
 else
 {
 if (mysql_num_rows(queryMysql("SELECT * FROM members WHERE user='$user'")))
 $error = "That username already exists<br /><br />";
 else
 {
 queryMysql("INSERT INTO members VALUES('$user', '$pass')");
 echo"<script>alert('Login Success');</script>";
 }
 }
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
          <script src="OSC.js"></script>
        <script>
        function check_password()
        {
        	// checking whether the password length are equal or not

        	var pass = document.getElementById("register-password").value;
        	var pass1 = document.getElementById("register-password2").value;
        	//alert(pass);
        	if(pass != pass1)
        	{
        		document.getElementById("display_error").innerHTML = "Password Mismatch";
        		return false;
        	}
            else{
                document.getElementById("display_error").innerHTML = "";
                return true;
            }
        }
        </script>
    </head>
 <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

    


        <!-- Page Title -->
		<div class="section section-breadcrumbs" style="background-color:#007FFF">
			<div class="container">
				<div class="row">
					<div class="col-md-10" >
						<h1>Register</h1>
					</div>
				</div>
			</div>
		</div>
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" method="post" action="signup.php" onsubmit="return check_password()">
								<div class="form-group">
                                    <h4><?php echo $error;?></h4>
                                        <div id="display_error" style="color:red;"></div>
		        				 	<label for="register-username"> <b>Email</b></label>
									<input class="form-control" id="login-username" name='user' value="<?php echo $user?>"  placeholder="" required
                                    onblur="checkUser(user);"/>    
                                 
								<span id='info'></span><br>
                                </div>
								<div class="form-group">
		        				 	<label for="login-password"><b>Password</b></label>
									<input class="form-control" id="register-password" name='pass' class='form-control' value="<?php echo $pass?>" type="password" 
									placeholder="" required/>
									
								</div>
								<div class="form-group">
		        				 	<label for="register-password2"><i class="icon-lock"></i> <b>Re-enter Password</b></label>
									<input class="form-control" id="register-password2" name="register-password2" 
									type="password" placeholder="" pattern=".{6,}" title="minimum length of 6 charecters" required
                                        onblur="check_password();"   >
                               
								</div>
								<div class="form-group">
									<button type="submit" class="btn pull-right" style="background-color:#007FFF">Register</button>
									
									
									<h3>Have an account? <a href="login.php">Login</a></h3>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				
				</div>
			</div>
		</div>

	   <div class="footer">
	    	<div class="container">
		    	<div class="row">

		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">Home</a></li>
		    				<li><a href="#">Friends</a></li>
		    				
		    				
		    			</ul>
		    		</div>
		    		
		    		<div class="col-footer col-md-4 col-xs-6">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> Pesit,BSK stage 3,Bangalore,Karnataka,India<br/>
	        				<b>Phone:</b> +91 1234567890<br/>
	        				<b>Email:</b> <a href="mailto:help@coredump.com">help@coredump.com </a>
	        			</p>
		    		</div>
		    		<div class="col-footer col-md-2 col-xs-6">
		    			<h3>Stay Connected</h3>
		    			<ul class="footer-stay-connected no-list-style">
		    				<li><a href="#" class="facebook"></a></li>
		    				<li><a href="#" class="twitter"></a></li>
		    				<li><a href="#" class="googleplus"></a></li>
		    			</ul>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2015 CoreDUMP. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>

    </body>
</html>