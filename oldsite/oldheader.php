<?php
echo '
<html>
 <head>
';
if ($pageTitle)
  echo "  <title>Pittsburgh Go Association - $pageTitle</title>";
else
  echo '  <title>Pittsburgh Go Association</title>';

echo'  <link rel="stylesheet" href="style.css">
  <meta name="description" content="The Pittsburgh Go Association is a go club located in Pittsburgh, PA where people of all ages and skill levels meet to play and enjoy the game of go."> 
  <meta name="keywords" content="pittsburgh, go, association, club, weiqi, baduk, game"> 
';

if ($googleMap)
  echo'
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAIoTKcDxb6ES39nZce6i0FxSMqSNCzuvQzDU84XMS8vPpQzlWcxSneIeqLR5JIZ5dduThS8Mo7o4AFA" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    function makeMarker(name, ll1, ll2) {
        var marker = new GMarker(new GLatLng(ll1,ll2));
        GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(name);
        });
        return marker;
    }

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.setCenter(new GLatLng(40.443542,-79.941777), 17, G_HYBRID_MAP);

        map.addOverlay(makeMarker("Caffee Room", 40.443497,-79.942526));
        map.addOverlay(makeMarker("Room 303", 40.443138,-79.942542));
        map.addOverlay(makeMarker("Parking", 40.444032,-79.941051));

      }
    }
    //]]>
    </script>
';

echo'
 </head>
 <body';

if ($googleMap)
  echo ' onload="load()" onunload="GUnload()"';

echo '>

 <div id="backbackground">
  <div id="background">
   <div id="heading">
    <h1>The Pittsburgh Go Association</h1>
   </div>

   <div id="midsection">
    <div id="nav">
     <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="meetings.php">Meetings</a></li>
      <li><a href="events.php">Events</a></li>
      <li><a href="material.php">Materials</a></li>
      <li><a href="history.php">History</a></li>
     </ul>
    </div>
  
    <div id="content">
     <div id="section">
';
?>