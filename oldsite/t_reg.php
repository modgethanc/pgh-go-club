<?php

global $pageTitle;
$pageTitle = 'Tournament Registration';
require('header.php');

$url = 'http://pittsburghgo.com/WebTD/ext_reg.php?'.$_SERVER['QUERY_STRING'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
echo curl_exec($ch);
curl_close($ch);

require("footer.htm");

?>