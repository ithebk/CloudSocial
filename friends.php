<?php // friends.php
include_once 'header.php';
if(!isset($_SESSION['user'])){
    
    redirect('login.php',0,0);

}
$count=0;
if (!$loggedin) die();
if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else $view = $user;
if ($view == $user)
{
 $name1 = $name2 = "";
 $name3 = "";
}
else
{
 $name1 = "<a href='members.php?view=$view'>$view</a>'s";
 $name2 = "$view's";
 $name3 = "$view is";
}
echo "<br><br><br>";
// Uncomment this line if you wish the user's profile to show here
// showProfile($view);
$followers = array();
$following = array();
$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num = mysql_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j)
{
 $row = mysql_fetch_row($result);
 $followers[$j] = $row[1];
}
$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num = mysql_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j)
{
 $row = mysql_fetch_row($result);
 $following[$j] = $row[0];
}
$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;
if (sizeof($mutual))
{
 echo "$name2  <div class='row' align='center'><h3>Friends</h3><ul class='pager'>";
 foreach($mutual as $friend)
 echo "<li><b>$friend</b><a href='members.php?remove=$friend'>Unfriend</a><br><br>";
 echo "</ul></div>";
 $friends = TRUE;
}
if (sizeof($followers))
{
 echo "$name2 <div class='row' align='center'><h3>Requests</h3><ul class='pager'>";
 foreach($followers as $friend)
 {$count+=1;
 echo "<li><b>$friend</b><a href='members.php?add=$friend'>[Accept]</a><br><br>";}
 echo "</ul></div>";
 $friends = TRUE;
}
if (sizeof($following))
{
 echo "$name3 <div class='row' align='center' ><h3>Sent Friend Request</h3><ul class='pager'>";
 foreach($following as $friend)
 echo "<li><b>$friend </b><a href='members.php?remove=$friend'>[Cancel]</a><br><br>";
 echo "</ul></div>";
 $friends = TRUE;
}
if (!$friends) echo "<br />You don't have any friends yet.<br /><br />";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TripBook</title>
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
          <style>
	      
    @media (min-width: 768px) {
        .navbar .navbar-nav {
            display: inline-block;
            float: none;
        }
        
        .navbar .navbar-collapse {
            text-align: center;
        }
    }
	
	
	  
	  
	  </style>
		
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

        <!-- Navigation & Logo-->

        <div class="mainmenu-wrapper">
	        <div class="container">
				<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#607D8B;">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
	   <ul class="nav navbar-nav"><li >
	   <a href="demo.html" style="color:#fff;background-color:#00C853"  >Welcome to CoreDUMP SocialNetwork</a>
	   </li></ul>
      

        <ul class="nav navbar-nav">
		
         <li  ><a  href="profile.php" style="color:#fff"  >Profile(<?php echo $userstr?>)</a></li>
		  <li class="active" ><a  href="friends.php"   >Friends(<span style="color:#007FFF"><?php echo $count.' New Request' ;?></span>)</a></li>
		  <li ><a style="color:#fff" href="photos.php" >Photos</a></li>
		  <li  ><a  href="members.php" style="color:#fff" >Members</a></li>
		
        <li><a href="logout.php"  style="color:#fff;background-color:#03A9F4">Logout</a></li>
		
         
        </ul>
          </div>
    </nav>
<br>

			</div>
		</div>
 
 		

		
	  
		

		
		
		

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">

		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="index.php">Home</a></li>
		    				<li><a href="profile.php">Profile</a></li>
		    				<li><a href="friends.php">Friends</a></li>
		    				<li><a href="photos.php">Photos</a></li>
		    				
		    			</ul>
		    		</div>
		    		
		    		<div class="col-footer col-md-4 col-xs-6">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> Pesit,BSK stage 3,Bangalore,Karnataka,India<br/>
	        				<b>Phone:</b> +91 1234567890<br/>
	        				<b>Email:</b> <a href="mailto:getintoutch@pes.edu">getintoutch@pes.edu</a>
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