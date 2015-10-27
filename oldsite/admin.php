<?php

/*******************************************************************************

admin.php
This is the main page for tournament management.

*******************************************************************************/

require('startup.php');
global $pageTitle;
$pageTitle = 'Tournament Administration';
require('header.php');

/*******************************************************************************
 Functions ********************************************************************/

function getMenu($id){
  $returnText = '';
  $returnText .= '<dl>'.
    '<dt><a href="settings.php?id='.$id.'">Settings</a></dt>'.
    '<dt><a href="registration.php?id='.$id.'">Registration</a></dt>'.
    '<dt><a href="round.php?id='.$id.'">Round Management</a></dt>'.
  $returnText .= '</dl>';
  return $returnText;
}

/*******************************************************************************
 Page Content******************************************************************/

if (!$logged_in){
  $errors[] = '<p>You must be logged in to view this page';
  echo getErrors();
  echo getLoginForm();
} else {
  global $tournamentName;
  echo '<h2>Tournament Administration</h2>';
  if(isset($_GET['id'])){
    if(checkPermission()){
      echo '<h3>'.$tournamentName.'</h3>';
      echo getMenu($_GET['id']);
    }
    else{
      $errors[] = 'You do not have permission to access this tournament';
      echo getErrors();
    }
    echo '<p><a href="admin.php">Return to the Main Administration Page</a></p>';
  } else {
    echo getTournamentList($_SESSION['u_id'],'admin');
    echo '<p><a href="settings.php?id=0">Start a New Tournament</a></p>';
  }
}

require("footer.htm");

?>