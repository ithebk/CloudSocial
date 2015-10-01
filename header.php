<?php 

session_start();
include 'functions.php';
$userstr = ' (Guest)';
if (isset($_SESSION['user']))
{
 $user = $_SESSION['user'];
 $loggedin = TRUE;
 $userstr = "$user";
}
else $loggedin = FALSE;
echo "<title>$appname-$userstr</title>";
if ($loggedin)
{
	//echo'	
      //    <li  ><a href='.'members.php?'."view=$user".' style="color:#fff">Home</a></li>
  // ';
	
}
else
{
	//echo '	
       // <li><a href="login.php" style="color:#fff">Login-'."$appname$userstr".'</a>';
}
function redirect($url, $statusCode = 303)
			{
			header('Location: ' . $url, true, $statusCode);
			die();
		}
?>