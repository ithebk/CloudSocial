<?php // login.php
include_once 'header.php';
$error = $user = $pass = "";
if(isset($_SESSION['user'])){
    
    redirect('profile.php',0,0);

}
if (isset($_POST['user']))
{
 $user = sanitizeString($_POST['user']);
 $pass = sanitizeString($_POST['pass']);
 if ($user == "" || $pass == "")
 {
 $error = "Not all fields were entered<br />";
 }
 else
 {
 $query = "SELECT user,pass FROM members
 WHERE user='$user' AND pass='$pass'";
 if (mysql_num_rows(queryMysql($query)) == 0)
 {
 $error = "Invalid Username/Password";
 }
 else
 {
 $_SESSION['user'] = $user;
 $_SESSION['pass'] = $pass;
 redirect('profile.php',0,0);
 die("");
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
        <title>Login Page</title>
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
						<h1><b>Login</b> </h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" role="form" method= "post" action="login.php">
								<div class="form-group">
                                    <h4 style="color:red"><?php echo $error;?></h4>
		        				 	<label for="login-username"> <b>Email</b></label>
									<input class="form-control" id="login-username" name='user' value="<?php echo $user?>"  placeholder="" required>
								</div>
								<div class="form-group">
		        				 	<label for="login-password"><b>Password</b></label>
									<input class="form-control" id="login-password" name='pass' class='form-control' value="<?php echo $pass?>" type="password" 
									placeholder="" required/>
									
								</div>
								<div class="form-group">
									
									
									<button type="submit" class="btn pull-right" style="background-color:#007FFF" >Login</button>
									<div class="clearfix"></div>
									<div class="not-member">
							<h3>Not a member? <a href="signup.php">Register Here</a></h3>
					
						</div>
								</div>
							</form>
						</div>
					</div>
				
				</div>
			</div>
		</div>

	    	    <!-- Footer -->
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
		    			<div class="footer-copyright">&copy; 2015 TripBook. All rights reserved.</div>
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