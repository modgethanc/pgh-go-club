<?php

global $pageTitle;
$pageTitle = 'Members';
require("header.php");

dbConnect();

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
    $aga_rank = abs($aga_rank).'d';
  else
    $aga_rank = abs($aga_rank).'k';
  
  curl_close($ch);
  
  return $aga_rank;
}

function getKgsRank($nick){
  $url = "http://www.gokgs.com/gameArchives.jsp?user=$nick";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $page_string = curl_exec($ch);
  $rank = rtrim(substr(stristr($page_string, "$nick ["), strlen($nick)+2, 4), "]</");

  curl_close($ch);
  
  return $rank;
}

if(!isset($_GET['member'])){
  echo '
   <h2>Members</h2>
    <p>This is an partial list the members of the Pittsburgh Go Association. Click on any member\'s name for more information about that member.</p>
    ';
  if ($users = mysql_query("SELECT * FROM users")){
    echo '<table>';
    echo '<tr><th>Name</th>';
    echo '<th>Email</th>';
    while($user = mysql_fetch_array($users)){
      $display_name = $user['display_name'];
      $username = $user['username'];
      $email = formatEmail($user['email']);

      echo "<tr><td><a href='members.php?member=$username'>$display_name</a></td>";
      echo '<td>'.$email.'</td></tr>';
    }
    echo '</table>';
  }
  if(!$logged_in)
    echo '
    <hr>
    <p>To add yourself to this list, <a href="register.php">register</a> now.
    If you are already registered, you may <a href="login.php">login</a>. But, there\'s nothing to do once you\'re logged in right now.</p>
    ';

 } else {
  echo '<h2>Member Profile</h2>';
  $member = $_GET['member'];
  if ($users = mysql_query("SELECT * FROM users WHERE username='$member' ORDER BY display_name")){
    if ($user = mysql_fetch_array($users)){
      $display_name = $user['display_name'];
      $username = $user['username'];
      $aga_num = $user['aga_num'];
      $kgs_nick = $user['kgs_nick'];
      $email = formatEmail($user['email']);
      $aga_rank = getAgaRank($aga_num);
      $kgs_rank = getKgsRank($kgs_nick);
      
      echo "<h3>$display_name</h3>";
      echo "<p>Email: $email<br />";
      echo "KGS Nick: $kgs_nick<br />";
      echo "KGS Rank: $kgs_rank<br />";
      echo "AGA Rank: $aga_rank<br /></p>";
    }
  }
}

require("footer.htm");

?>