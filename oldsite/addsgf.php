<?php

global $pageTitle;
$pageTitle = 'Game Upload';
require('header.php');

dbConnect();

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

<form action="addsgf.php" method="post" enctype="multipart/form-data" name="sgfupload">
 <label for="white">White Player: </label>
  <select name="white" id="white">
   <option></option>
';
  printOptions('users','username','display_name');
  echo formatFormOption('unknown','Someone Else');
  echo '  </select><br />
 <label for="black">Black Player: </label>
  <select name="black" id="black">
   <option></option>
';
  printOptions('users','username','display_name');
  echo formatFormOption('unknown','Someone Else');
  echo '  </select><br />
 <label for="winner">Result: </label>
  <select name="winner" id="winner" class="small">
   <option></option>
';
  printOptions('colors','code','value');
  echo '  </select> <span class="formtext">+</span>
  <select name="by" id="by" class="small" onChange="togglePointsBox();">
   <option></option>
';
  printOptions('results','code','value');
  echo '  </select>
  <input type="text" name="points" id="points" class="tiny" disabled="disabled" maxlength="5" /><br />
 <label for="date_played">Date Played: </label>
  <input type="text" name="date_played" id="date_played" class="small" maxlength="10" /> <span class="formnote">(MM/DD/YYYY)</span><br />
 <label for="sgffile">SGF File: </label>
  <input type="hidden" name="MAX_FILE_SIZE" value="3000" />
  <input type="file" id="sgffile" name="sgffile" class="file" /> <br />
 <input type="hidden" name="submit" value="1" />
 <input type="submit" value="Submit" class="button" />
</form>
';
}

function getNextSgfName($username){
  $result = mysql_query("SELECT sgf_count FROM users WHERE username='$username'");
  $user = mysql_fetch_assoc($result);
  $count = $user['sgf_count'];
  $count++;
  mysql_query("UPDATE users SET sgf_count='$count' WHERE username='$username'");
  return "sgfs/$username$count.sgf";
}

function processUpload(){
  $errorNum = 0;
  if($_POST['white'] == '')
    $error[$errorNum++] = 'You must enter a white player.';
  if($_POST['black'] == '')
    $error[$errorNum++] = 'You must enter a black player.';
  if($_POST['winner'] == '' || $_POST['by'] == '')
    $error[$errorNum++] = 'You must enter the result.';
  if($_POST['by'] == 'P' && $_POST['points'] == '')
    $error[$errorNum++] = 'If the game was won by a number of points, you must enter that number.';
  if($_POST['date_played'] == '')
    $error[$errorNum++] = 'You must enter a date in the form MM/DD/YYYY.';
  else{
    $date = $_POST['date_played'];
    echo 'date: '; 
  }
  if ($_FILES['sgffile']['type'] != 'x-go-sgf')
    $error[$errorNum++] = 'You must enter an sgf file.';
  if(!$errorNum){
    $filename = getNextSgfName($_SESSION['userID']);
    move_uploaded_file ($_FILES['sgffile']['tmp_name'], $filename);
    if (mysql_query("INSERT INTO sgfs (filename) VALUES('$filename')"))
      echo "<p>Your file ({$_FILES['sgffile']['name']}) has been successfully uploaded.</p>";
    return;
  } else
    showUploadForm($error);
}

if ($logged_in){
  if (isset($_POST['submit']))
    processUpload();
  else
    showUploadForm();
} else
  echo '<p>You must <a href="login.php">login</a> to upload a game.</p>';

require("footer.htm");

?>