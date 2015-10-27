<?php

global $pageTitle;
$pageTitle = 'Fall Tournament';
require("header.php");

function getHeadCount(){
  dbConnect();
  $result = mysql_query("SELECT name FROM tournament");
  return mysql_num_rows($result);
}

echo'
<h2>The Pittsburgh Fall Tournament</h2>

<table>
 <tr>
  <th>Date:</th>
  <td>October 20, 2007</td>
 </tr>
 <tr>
  <th>Time:</th>
  <td>Registration: 9:00
  <br>Start: 9:30</td>
 </tr>
 <tr>
  <th>Place:</th>
  <td><a href=" http://www.cmu.edu/conferences/facilities/ucMap.html">Rangos 3, University Center</a>, <a href="http://maps.google.com/maps/ms?hl=en&ie=UTF8&msa=0&msid=113137908682439837406.000001127bbe4e0a0e30c&ll=40.443542,-79.941777&spn=0.002262,0.004281&t=h&z=18&om=1">CMU</a></td>
 </tr>
 <tr>
  <th>Cost:</th>
  <td>$15 (AGA membership required and available at the door)</td>
 </tr>
 <tr>
  <th>Details:</th>
  <td>4 Rounds
  <br>AGA Rules
  <br>Cash prizes for top two finishers in each division
  <br>Free pizza and drinks for lunch for all
  </td>
 </tr>
</table>

  <p class="centered">Online Registration is now closed.  Please show up for the tournament at 9:00 to register.
  <br>('.getHeadCount().' people registered online)</p>

';

require("footer.htm");

?>