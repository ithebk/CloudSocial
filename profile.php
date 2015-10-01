<?php // profile.php
include_once 'header.php';
include_once 'notification.php';
if(!isset($_SESSION['user'])){
    
    redirect('login.php',0,0);

}

if (!$loggedin) die();



if (isset($_POST['text']))
{
 $text = sanitizeString($_POST['text']);
 $text = preg_replace('/\s\s+/', ' ', $text);
 if (mysql_num_rows(queryMysql("SELECT * FROM profiles WHERE user='$user'")))
 queryMysql("UPDATE profiles SET text='$text' where user='$user'");
 else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
}
else
{
 $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
 if (mysql_num_rows($result))
 {
 $row = mysql_fetch_row($result);
 $text = stripslashes($row[1]);
 }
 else $text = "";
}
$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
if (isset($_FILES['image']['name']))
{
 $saveto = "$user.jpg";
 move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
 $typeok = TRUE;
 switch($_FILES['image']['type'])
 {
 case "image/gif": $src = imagecreatefromgif($saveto); break;
 case "image/jpeg": // Allow both regular and progressive jpegs
 case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
 case "image/png": $src = imagecreatefrompng($saveto); break;
 default: $typeok = FALSE; break;
 }
 if ($typeok)
 {
 list($w, $h) = getimagesize($saveto);
 $max = 100;
 $tw = $w;
 $th = $h;
 if ($w > $h && $max < $w)
 {
 $th = $max / $w * $h;
 $tw = $max;
 }
 elseif ($h > $w && $max < $h)
 {
 $tw = $max / $h * $w;
 $th = $max;
 }
 elseif ($max < $w)
 {
 $tw = $th = $max;
 }
 $tmp = imagecreatetruecolor($tw, $th);
 imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
 imageconvolution($tmp, array(array(-1, -1, -1),
 array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
 imagejpeg($tmp, $saveto);
 imagedestroy($tmp);
 imagedestroy($src);
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
	   <ul class="nav navbar-nav"><li class="active">
	   <a href="index.php" style="color:#fff;background-color:#00C853"  >Welcome to CoreDUMP SocialNetwork</a>
	   </li></ul>
      

        <ul class="nav navbar-nav">
		
         <li class="active" ><a  href="profile.php"   >Profile(<?php echo $userstr?>)</a></li>
		  <li  ><a  href="friends.php" style="color:#fff"   >Friends(<span style="color:#007FFF"><?php echo $count.' New Request' ;?></span>)</a></li>
		  <li ><a style="color:#fff" href="photos.php" >Photos</a></li>
		  <li><a style="color:#fff" href="members.php" >Members</a></li>
		
        <li><a href="logout.php"  style="color:#fff;background-color:#03A9F4">Logout</a></li>
		
         
        </ul>
          </div>
    </nav>
<br>

			</div>
		</div>
 
 		

		

        <div class="container">
	<div class="row">
        <br>
		<div class="col-lg-3 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader">
                <h2 style="color: #fff ;background-color:#427fed">Your Profile</h2>
                </div>
                <div class="avatar">
                    <img alt="User PIC" src="<?php if(showProfile($user)){echo showProfile($user);}else{
     echo "img/profile_blank1.png";}?>">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href=""><?php echo $userstr;?></a>
                    </div>
             
            <form method='post' class="form" action='profile.php' enctype='multipart/form-data'>
           
            <div class="desc">
                <textarea name='text' class="form-control" rows='3' placeholder="Whats on your mind!!"><?php echo $text;?></textarea><br />
           </div>
                <div class="form-group">
      <label for="image">Change Profile Pic:</label>
      <input type='file' name='image' size='14' maxlength='32' class="form-control" />
    </div>
           
            <input type='submit'  class="btn btn-primary btn-md" value='Save Profile' />
                
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
		    				<li><a href="index.php">Home</a></li>
		    				<li><a href="ItenaryPlanner.php">Itinerary Planner</a></li>
		    				<li><a href="TripDiary.php">Trip Diary</a></li>
		    				<li><a href="indexreview.php">Reviews</a></li>
		    				
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