<?php // friends.php
include_once 'header.php';
include_once 'notification.php';
if(!isset($_SESSION['user'])){
    
    redirect('login.php',0,0);

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
	   <ul class="nav navbar-nav"><li >
	   <a href="demo.html" style="color:#fff;background-color:#00C853"  >Welcome to CoreDUMP SocialNetwork</a>
	   </li></ul>
      

        <ul class="nav navbar-nav">
		
         <li  ><a  href="profile.php" style="color:#fff"  >Profile(<?php echo $userstr?>)</a></li>
		  <li  ><a  href="friends.php" style="color:#fff"   >Friends(<span style="color:#007FFF"><?php echo $count.' New Request' ;?></span>)</a></li>
		  <li class="active"><a  href="photos.php"  >Photos</a></li>
		  <li  ><a  href="members.php" style="color:#fff" >Members</a></li>
		
        <li><a href="logout.php"  style="color:#fff;background-color:#03A9F4">Logout</a></li>
		
         
        </ul>
          </div>
    </nav>
<br>

			</div>
		</div>
      

        <div class="container" align="center">
			
			<div class="row">

        <br><br>
		<button type="button" class="btn btn-info btn-lg" style="background-color:#007FFF;" data-toggle="modal" data-target="#myModal" >Add Photos<img src="img/add.png" style="margin-left:0.5em"></button>
        
		
		<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Enter Details</h4>
        </div>
        <div class="modal-body">
          <form  action="phppage.php" method="POST" enctype="multipart/form-data">
            <div style="padding:5px;width:90%">
			
			
               <div class="form-group">
                   <input type="hidden" class="form-control" name="sessionuser"  style="width:400px" value="" required/>
                        
					<label for="InputName">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter  Name" style="width:400px" required>
                        
                    </div>
					
                </div>
               
             
				
				<!--File Upload-->
				<div class="form-group">
                    <label for="InputMessage">Choose File</label>
                    <div class="input-group">
				
                        <input type="file" style="width:400px" value="Upload file" name="InputFile" id="InputFile" class="btn btn-default btn-file" required
						style="padding: 10px;-webkit-border-radius:5px;-moz-border-radius: 5px;border: 1px dashed #BBB; text-align: center;background-color: #DDD;cursor:pointer;"></textarea>
						<br>
						<input type="submit" style="padding:10px;width:100px;background-color:#3EB489" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                 
					  </div>
						
						 
                </div>
			</div>	

                
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
		</div>
		</div>
	
		
    
	
				
			
			
			
        


<hr></div>
                	<?php
      
     include_once 'phppage.php';
     include_once 'azure.php';
    
  ?>
<!-- content -->
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