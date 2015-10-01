<?php // members.php
include_once 'header.php';
include_once 'notification.php';
if (!$loggedin) die();
echo "<br><br><div class='container' align='center'>";
if (isset($_GET['view']))
{
	 if ($view == $user){
     
     //redirect('profile.php',0);
 }


 $view = sanitizeString($_GET['view']);

 $t1 = mysql_num_rows(queryMysql("SELECT * FROM friends
 WHERE user='$view' AND friend='$user'"));
 $t2 = mysql_num_rows(queryMysql("SELECT * FROM friends
 WHERE user='$user' AND friend='$view'"));
 if (($t1 + $t2) > 1){  $actionview="Unfriend"; $url="members.php?remove=$view";}
 elseif ($t1){ $actionview="Cancel"; $url="members.php?remove=$view";}
 else if ($t2) {$actionview="Accept"; $url="members.php?add=$view"; }
 else{
     $actionview="Add Friend"; $url="members.php?add=$view";

 }




 $viewpic=showProfile($view);
 if(empty($viewpic)){
     $viewpic="img/profile_blank1.png";
 }
 $result1 = queryMysql("SELECT * FROM profiles WHERE user='$view'");
 if (mysql_num_rows($result1))
 {
 $row1 = mysql_fetch_row($result1);
 $text1 = stripslashes($row1[1]);
 }
 else $text1 = "";

echo "<div class='container' align='center'>
	<div class='row' >
        <br>
		<div class='ol-lg-3 col-sm-4' >

            <div class='card hovercard'>
                <div class='cardheader'>
                <h2 style='color: #fff ;background-color:#427fed'>$view's Profile</h2>
                </div>
                <div class='avatar'>
                    <img alt='User PIC' src=$viewpic>
                </div>
                <div class='info'>
                    <div class='title'>
                        <a target='_blank'' href=''>$view</a>
                    </div>
                    
            <div class='desc'>

                <h4 >$text1</h4><br />
           </div>
             
           
           
           
         
           
            <a href='$url'  class='btn btn-primary btn-md' >$actionview</a>
                
          
             
                </div>
             
            </div>

        </div>
</div>
	
</div>";


}
if (isset($_GET['add']))
{
 $add = sanitizeString($_GET['add']);
 if (!mysql_num_rows(queryMysql("SELECT * FROM friends
 WHERE user='$add' AND friend='$user'")))
 queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
 redirect("friends.php", $statusCode = 303);
}
elseif (isset($_GET['remove']))
{
 $remove = sanitizeString($_GET['remove']);
 queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
 redirect("friends.php", $statusCode = 303);
}
$result = queryMysql("SELECT user FROM members");
$num = mysql_num_rows($result);
echo "<h3>Other Members</h3>";
for ($j = 0 ; $j < $num ; ++$j)
{
 $row = mysql_fetch_row($result);
 if ($row[0] == $user) continue;
 $picview=showProfile($row[0]);
 if(empty($picview)){$picview="img/profile_blank1.png";}
 echo " 
 <div class='col-md-4'>
  <div style='cursor: default;text-decoration:none; box-shadow:0  0 15px #888888;' class='thumbnail'>
 <div class='card hovercard'>
 <br><br><br>
 <div class='desc'>
   <div class='avatar'>
                    <img alt='User PIC' src='$picview'>
                </div>

                
                <ul class='pager'>
   <li><a href='members.php?view=".$row[0] . "'>$row[0]</a></li>
   </ul>
                
                </div>
                </div></div></div>";

 echo "</ul>";
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
        <title>CoreDUMP</title>
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
	 <li  ><a  href="friends.php" style="color:#fff"   >Friends(<span style="color:#007FFF"><?php echo $count.' New Request' ;?></span>)</a></li>
		  <li ><a style="color:#fff" href="photos.php" >Photos</a></li>
		  <li class="active" ><a  href="#" >Members</a></li>
		
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