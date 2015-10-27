<?php

session_start();
if(isset($_SESSION['userID']))
  unset($_SESSION['userID']);
session_destroy();

global $pageTitle;
$pageTitle = 'Logout';
require("header.php");

echo '<p>You are now logged out.</p>';
echo '<ul><li><a href="login.php">Login again</a></li>';
if (isset($_GET['ref']))
  echo '<li><a href="'.$_GET['ref'].'">Return to previous page</a></li>';
echo '</ul>';

require("footer.htm");

?>