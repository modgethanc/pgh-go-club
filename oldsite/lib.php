<?php

require('config.php');

// Must be called before using the database
function dbConnect(){
  global $dbhost;
  global $dbuser;
  global $dbpassword;
  global $dbname;
  mysql_connect($dbhost, $dbuser, $dbpassword);
  mysql_select_db($dbname);
  echo mysql_error();
}

function toASCII($string){
  $strlen = strlen($string);
  $encoded = '';
  for($strpos=0; $strpos<$strlen; $strpos++)
    $encoded = $encoded . '&#' . ord($string[$strpos]) .';';
  return $encoded;
}

function formatEmail($email, $text=''){
  $email_parts = explode('@', $email);
  $name = toASCII($email_parts[0]);
  $host = toASCII($email_parts[1]);
  $noscript_email = toASCII($email_parts[0].'(AT)'.$email_parts[1]);
  if($text=='')
    $email = '<SCRIPT TYPE="text/javascript">
<!-- 
emailE=("'.$name.'" + "&#64;" + "'.$host.'");
document.write("<a href=\"mailto:" + emailE + "\">" + emailE + "</a>");
//-->
</SCRIPT><NOSCRIPT><a href="mailto:'.$noscript_email.'">'.$noscript_email.'</a></NOSCRIPT>';
  else
    $email = '<SCRIPT TYPE="text/javascript">
<!-- 
emailE=("'.$name.'" + "&#64;" + "'.$host.'");
document.write("<a href=\"mailto:" + emailE + "\">'.$text.'</a>");
//-->
</SCRIPT><NOSCRIPT><a href="mailto:'.$noscript_email.'">'.$text.'</a></NOSCRIPT>';
  return $email;
}

function getCurrentPage(){
  return ltrim(strrchr($_SERVER['PHP_SELF'], '/'),'/');
}

function printErrorList($error){
  echo '<ul class="error">';
    for($i=0; $error[$i]; $i++)
      echo '<li>'.$error[$i].'</li>';
    echo '</ul>';
}

// Displays the login form
function showLogin($msg='', $user=''){
  if (isset($_GET['ref']))
    $ref = '?ref='.$_GET['ref'];
  else
    $ref = '';
  if ($msg)
    echo "<p>$msg</p>";
  echo '
<form action="login.php'.$ref.'" method="POST">
 <label for="username" class="standard">Username: </label>
  <input type="text" name="username" id="username" class="field" value="'.$user.'" maxlength="20" /> <br>
 <label for="password" class="standard">Password: </label>
  <input type="password" id="password" name="password" class="field" maxlength="20" /> <br />
 <input type="submit" value="Login" class="button" />
</form>
';
}

// Checks a user's password against the db
function checkPassword($username, $password){
  $result = mysql_query("SELECT password FROM users WHERE username='$username'");
  $user = mysql_fetch_assoc($result);
  if ($user['password'] == md5($password))
    return true;
  else
    return false;
}

// Formats a checkbox
function formatCheckbox($name,$value,$text,$attributes=''){
  return '<input type="checkbox" name="'.$name.'[]" value="'.$value.'" id="'.$name.$value.'"'.$attributes.'><label for="'.$name.$value.'">'.$text.'</label>';
}

// Formats a form option
function formatFormOption($value,$text){
  return "   <option value=\"$value\">$text</option>\n";
}

// Prints checkboxes for a form from any table
function printCheckboxes($table, $codeName, $valueName, $restrictions=''){
  if($restrictions)
    $restrictions = ' WHERE '.$restrictions;
  $result = mysql_query("SELECT $codeName,$valueName FROM $table$restrictions");
  while($row = mysql_fetch_assoc($result))
    echo formatCheckbox('somthing',$row[$codeName],$row[$valueName]).'<br />';
}

// Prints options for a form from any table
function printOptions($table, $codeName, $valueName, $restrictions=''){
  $result = mysql_query("SELECT $codeName,$valueName FROM $table $restrictions");
  while($row = mysql_fetch_assoc($result))
    echo formatFormOption($row[$codeName],$row[$valueName]);
}

?>