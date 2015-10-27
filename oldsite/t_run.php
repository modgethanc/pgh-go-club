<?php

global $pageTitle;
$pageTitle = 'Tournament';
require('header.php');

//$output = exec('cd.bat AccelRat ARound.bat 1');
//echo $output;

$myFile = 'AccelRat/1.tde';
$fh = fopen($myFile, 'r');
$count=0;
while($line = fgets($fh)){
  if(preg_match('/^[0-9N]+/', $line))
    $lines[$count++] = $line;
}
fclose($fh);

$table = 0;
echo '<form action="t_reg.php" name="t_run" method="post">';
foreach($lines as $line){
  $line = preg_replace('/\s\s+/', ' ', $line);
  $lineArray = explode(' ', $line);
  //print_r($lineArray);
  //  echo $line.'<br>';
  echo '<br>';
  $offset = 0;
  $whiteNum = $lineArray[0];
  $blackNum = $lineArray[1];
  $handicap = $lineArray[3];
  $komi = $lineArray[4];
  $whiteName = $lineArray[6];
  $whiteRank = $lineArray[7];
  $blackName = $lineArray[9];
  $blackRank = $lineArray[10];
  $table++;
  echo "Table $table, Handicap: $handicap, Komi: $komi</label><br>";
  echo "<input type='radio' name='game$table' value='W' id='white$table' class='checkbox'><label for='white$table' class='checkbox'>White: $whiteName ($whiteNum) $whiteRank</label><br>";
  echo "<input type='radio' name='game$table' value='B' id='black$table' class='checkbox'><label for='black$table' class='checkbox'>Black: $blackName ($blackNum) $blackRank</label><br>";
}
echo '<input type="submit" value="Submit" class="button" /></form>';


require("footer.htm");

?>