<?php // friends.php
include_once 'header.php';
if(!isset($_SESSION['user'])){
    
    redirect('login.php',0,0);

}
$count=0;
if (!$loggedin) die();
$view = $user;
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

if (sizeof($followers))
{

 foreach($followers as $friend)
 {$count+=1;

}

}
?>
