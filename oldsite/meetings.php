<?php

global $pageTitle, $googleMap;
$pageTitle = 'Meetings';
$googleMap = 1;
require("header.php");

echo'

<h2>Meetings</h2>

<p>The Pittsburgh Go Association meets on <b>Tuesday nights</b> at <b>6:30</b> at <b>Carnegie Mellon University</b>.  Meetings usually last for a few hours and are usually spent playing games, solving problems, and reviewing games. Regular members include a good mix of people from CMU and from outside of the school, and new players of all ages and skill levels are welcome to drop by a meeting.</p> 

<p>We always meet somewhere in University Center.  For the fall of 2015, we will be on the second floor of the University Center, overlooking the pool.</p>

<p>Free parking is available in some of the CMU garages after 5:00. There is one such garage right of off Forbes Ave. that is pretty close to University Center. The map below marks most of our common meeting places.</p>

<div id="map" style="width: 475px; height: 300px"></div><br>

<h4>See also:</h4>

<ul>
 <li><a href="http://lists.pittsburghgo.com/listinfo.cgi/members-pittsburghgo.com">Mailing List</a> - the most accurate source for meeting information</li>
<!-- <li><a href="http://www.google.com/calendar/embed?src=gophantom%40gmail.com">Google Calendar</a> - a detailed view of our schedule</li>-->
 <li><a href="http://maps.google.com/maps/ms?hl=en&ie=UTF8&msa=0&msid=113137908682439837406.000001127bbe4e0a0e30c&ll=40.443542,-79.941777&spn=0.002262,0.004281&t=h&z=18&om=1">Google Map</a> - a more useful version of the map above</li>
 <li><a href="http://www.cmu.edu/conferences/facilities/ucMap.html">University Center Floor Plan</a> - a clear map of the inside of the UC</li>
</ul>

</div>
<div id="section">

<!--<h3>The Sewickley Go Club</h3>

<p>Another good place to play go in Pittsburgh is the Sewickley Go Club.  Sewickley is a quaint town on the Ohio River just 12 miles northwest of Pittsburgh.  The Sewickley Go Club meets at the Crazy Mocha Coffee shop in on Beaver St. in Sewickley.  Please visit <a href="http://www.SewickleyGo.com">their web site</a> for directions, playing times and members contact information.</p>-->

';

require("footer.htm");

?>
