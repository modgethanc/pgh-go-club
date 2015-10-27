<?php

global $pageTitle;
$pageTitle = 'Login';
require('header.php');

dbConnect();

function printLoginOptions() {
  echo '
   <ul>
    <li><a href="t_view.php">View Tournament List</a></li>
    <li>Update Profile</li>
    <li><a href="addsgf.php">Upload SGF</a></li>
    <li><a href="logout.php">Logout</a></li>';
  if (isset($_GET['ref']))
    echo '
    <li><a href="'.$_GET['ref'].'">Return to previous page</a></li>';
  echo '
   </ul>
   ';
}

function loginHandler() {
    $_SESSION['username'] = '';
    if(isset($_POST['username']))
      $user = $_POST['username'];
    else
      $user = '';
    if(isset($_POST['password']))
      $pwd  = $_POST['password'];
    else
      $pwd = '';
    if ($user == '') {
      showLogin();
      return;
    }
    if (!checkPassword($user,$pwd)) {
      showLogin('Your login information is incorrect. Please try again.', $user);
      return;
    } else {
      $_SESSION['userID'] = $user;
      echo '<p>You are now logged in.</p>';
      printLoginOptions();
    }
}

echo '<h2>Login</h2>';
if ($logged_in){
  echo '<p>You are already logged in.</p>';
  printLoginOptions();
}else {
  loginHandler();
}

require("footer.htm");

?>