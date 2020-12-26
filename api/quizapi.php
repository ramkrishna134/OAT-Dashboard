<?php
error_reporting(0);
$url = 'http://13.67.92.237:9092/quiz'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$values = json_decode($data); // decode the JSON feed
$countquiz= count($values);
?>