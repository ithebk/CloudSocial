<?php // checkuser.php
include_once 'functions.php';
if (isset($_POST['user']))
{
 $user = sanitizeString($_POST['user']);
 if (mysql_num_rows(queryMysql("SELECT * FROM members
 WHERE user='$user'")))
 echo "<span style='color:red'>&nbsp;&#x2718; " .
 "Sorry, this username is taken</span>";
 else echo "<span style='color:green'>&nbsp;&#x2714; ".
 "This username is available</span>";
}
?>