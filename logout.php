<?php // logout.php
include_once 'header.php';
if (isset($_SESSION['user']))
{
 destroySession();
 echo "<div class='main'>You have been logged out. Please ";
 redirect("login.php",0.0);
}
else 
 redirect("index.php",0.0);

 
 ?>
<br /><br /></div></body></html>