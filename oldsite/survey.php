<?php

global $pageTitle;
$pageTitle = 'Game Upload';
require('header.php');

dbConnect();

function kgsCheck($nick = ''){
  if(preg_match('/^[a-zA-Z][a-zA-Z0-9]{0,9}$/', $nick))
    return true;
  else
    return false;
}

function emailCheck($email = ''){
  if(preg_match('/^[_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/',
		$email))
    return true;
  else
    return false;
}

function agaCheck($aga_num=''){
  if(!preg_match("/^[0-9]{0,5}$/",$aga_num))
    return false;

  $url = "http://www.usgo.org/ratings/RatingsResults.asp?Op=individual&Precision=4&RatingC=1&PlayerID=$aga_num";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $page_string = curl_exec($ch);
  curl_close($ch);
  
  if(stripod($page_string, 'No records were found matching'))
    return false;
  else
    return true;
}

function showUploadForm($error=''){
  if ($error[0])
    printErrorList($error);

  echo '

<script language="javascript">
function togglePointsBox()
{
  if(document.sgfupload.by.value == "P")
    document.sgfupload.points.disabled=false;
  else
    document.sgfupload.points.disabled=true;
}
 
</script>

<form action="register.php" method="post" enctype="multipart/form-data" name="sgfupload">
 <label for="username">Username: </label>
  <input type="text" name="username" id="username" maxlength="20" /><br />
 <label for="password">Password: </label>
  <input type="password" name="password" id="password" maxlength="20" /><br />
 <label for="email">Email Address: </label>
  <input type="text" name="email" id="email" maxlength="30" /><br />
 <input type="checkbox" name="show_email" value="show_email" class="checkbox">
  <label for="show_email" class="checkbox">Show email address?</label><br />
 <label for="kgs_name">KGS Name: </label>
  <input type="text" name="kgs_name" id="kgs_name" maxlength="10" /><br />
 <label for="aga_num">AGA Number: </label>
  <input type="text" name="aga_num" id="aga_num" maxlength="10" /><br />
 <label for="location">Location: </label>
  <input type="text" name="location" id="location" maxlength="30" /><br />
 <input type="hidden" name="submit" value="1" />
 <input type="submit" value="Submit" class="button" />
</form>
';
}

function processUpload(){
  $errorNum = 0;
  if($_POST['username'] == '')
    $error[$errorNum++] = 'You must enter a username.';
  if($_POST['password'] == '')
    $error[$errorNum++] = 'You must enter a password.';
  if($_POST['email'] == '' || !emailCheck($_POST['email']))
    $error[$errorNum++] = 'You must enter a valid email address.';
  if($_POST['kgs_name'] != '' && !kgsCheck($_POST['kgs_name']))
    $error[$errorNum++] = 'The KGS name that you entered is invalid.';
  if($_POST['aga_num'] != '' && !agaCheck($_POST['aga_num']))
    $error[$errorNum++] = 'The AGA number that you entered is invalid.';
  if(!$errorNum){
    echo '<p>Thank you for registering.  ';
    $email = 'gophantom@gmail.com';
    if (sendConfirmation('Kim', 'kim', $email, 'test'))
      echo "A confirmation email has been sent to $email.<//p>";
    else
      echo "Although your registration was successful, a confirmation email could not be sent to $email.<//p>";
    echo '<p>You may <a href="login.php">Login</a> now.</p>';
  } else
    showUploadForm($error);
}

function displaySurveyForm($id){
  dbConnect();
  $result = mysql_query("select * from survey where id=$id");
  $survey = mysql_fetch_assoc($result);
  $result = mysql_query("select * from survey_questions where id=$id");
  for($i=0; $question = mysql_fetch_assoc($result); $i++){
    $survey['questions'][$i] = $question;
  }
  echo '<h2>'.$survey['name'].'</h2>';
  echo '
<form action="survey.php" method="post" enctype="multipart/form-data" name="sumbitsurvey">';


foreach($survey['questions'] as $question){
echo '<p>'.$question['text'].'</p>';
echo printCheckboxes('question_options','text','value','question_id='.$question['id']);
}


echo '
 <input type="hidden" name="submit" value="1" />
 <input type="submit" value="Submit" class="button" />
</form>
';
}

displaySurveyForm(1);

require("footer.htm");

?>