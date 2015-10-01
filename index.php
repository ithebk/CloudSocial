<?php // index.php
include_once 'header.php';
if(isset($_SESSION['user'])){
    
    redirect('members.php',0,0);

}
else{
    redirect('login.php',0,0);
}
echo "<br /><span class='main'>Welcome to CloudFB,";
if ($loggedin) echo " $user, you are logged in.";
else echo ' please sign up and/or log in to join in.';
?>
</span><br /><br /></body></html>