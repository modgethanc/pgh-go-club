<?php

global $pageTitle;
$pageTitle = 'Home';
require("header.php");

echo'<h2>Welcome to the online home of the Pittsburgh Go Association!</h2>

<p>The Pittsburgh Go Association is a go club located in Pittsburgh, PA dedicated to promoting the game of go (baduk, igo, weiqi) in the form of tournaments, rankings, and educational opportunities.  If you play go or would like to learn to play go, come join us at one of our <a href="meetings.php">meetings</a>.</p>

<p>Contact our president, '.formatEmail('avi.rudich@gmail.com', 'Avi Rudich').', or our vice president, '.formatEmail('hdzeng@cmu.edu', 'Vincent Zeng').', with any general inquires about the club. Also look for us in our room on <a href="http://www.gokgs.com/">KGS</a>, Pittsburgh Go, listed under clubs.</p>

</div>
<div id="section">

<h3>Fall 2015</h3>

<p>Meetings Tuesdays at 6:30 on the second floor of the University Center, near the pool. Join our <a href="http://lists.pittsburghgo.com/listinfo.cgi/members-pittsburghgo.com">mailing list</a> for most recent announcements.</p>
';

require("footer.htm");

?>
