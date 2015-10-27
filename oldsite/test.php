<?php

global $pageTitle;
$pageTitle = 'Test';
require("header.php");

dbConnect();

echo '
<p>Please login or <a href="register.php">register</a>.</p>
<form action="login.php" method="post">
 <label for="username">Username: </label>
  <input type="text" id="username" class="field" /> <br>
 <label for="password">Password: </label>
  <input type="password" id="password" class="field" /> <br>
 <input type="submit" value="Login" class="button" />
</form>
';

function getAgaRank($aga_num){
  $url = "http://www.usgo.org/ratings/RatingsResults.asp?Op=individual&Precision=4&RatingC=1&PlayerID=$aga_num";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $page_string = curl_exec($ch);
  $page_string = substr(strstr($page_string, '<td align="right" nowrap class="data">'), 38);
  $page_string = substr(strstr($page_string, '<td align="right" nowrap class="data">'), 38, 5);
  $aga_rank = (int) $page_string;
  if ($aga_rank > 1)
    $aga_rank = abs($aga_rank).' dan';
  else
    $aga_rank = abs($aga_rank).' kyu';
  
  curl_close($ch);
  
  return $aga_rank;
}

function getKgsRank($nick){
  $nick = 'lpjent';
  $url = "http://www.gokgs.com/gameArchives.jsp?user=$nick";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $page_string = curl_exec($ch);
  $rank = substr(stristr($page_string, "$nick ["), strlen($nick)+2, 4);
  echo $rank;
  curl_close($ch);

  return $rank;
}

function formatEmail($email){
  $email_parts = explode('@', $email);
  $email = "$email_parts[0] at $email_parts[1]";
  $email = '<a href="mailto:'.$email.'">'.$email.'</a>';
  return $email;
}

/*
function checkPassword($password, $stored_password){
  if (md5($password) == $stored_password)
    return 1;
  else
    return 0;
}

mysql_connect('mysql.pittsburghgo.com', 'pgamysql', '7SH7SvFq0INk');
mysql_select_db('pga');
*/

$users = mysql_query("SELECT * FROM users");

echo '<table>';

echo '<tr><td>Name</td>';
echo '<td>Password?</td>';
echo '<td>Email</td>';
echo '<td>KGS Nick</td>';
echo '<td>KGS Rank</td>';
echo '<td>AGA Rank</td></tr>';

while($user = mysql_fetch_array($users)){
  $display_name = $user['display_name'];
  $password = $user['password'];
  $passwordcheck = checkPassword('test', $password);
  $aga_num = $user['aga_num'];
  $kgs_nick = $user['kgs_nick'];
  $email = formatEmail($user['email']);
  $aga_rank = getAgaRank($aga_num);
  $kgs_rank = getKgsRank($kgs_nick);
  
  echo '<tr><td>'.$display_name.'</td>';
  echo '<td>'.$passwordcheck.'</td>';
  echo '<td>'.$email.'</td>';
  echo '<td>'.$kgs_nick.'</td>';
  echo '<td>'.$kgs_rank.'</td>';
  echo '<td>'.$aga_rank.'</td></tr>';
}

echo '</table>';

//phpinfo();

require("footer.htm");

?>