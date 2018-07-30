<?php

$curl = curl_init();

// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://www.reddit.com/r/todayilearned/top.json?t=day&limit=1'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

//echo $resp;
$json = json_decode($resp, true);
//print_r($json);
$title = $json["data"]["children"][0]["data"]["title"];
$url = $json["data"]["children"][0]["data"]["url"];
$redditlink = "https://www.reddit.com" . $json["data"]["children"][0]["data"]["permalink"];
echo "<h3>$title</h4><div id='redditlinks'><a href=$url>Source</a><a href=$redditlink >Reddit link</a></div>";

?>