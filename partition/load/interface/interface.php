<?php
//PHP Dev__ framework
if(file_exists(BASE_URL.'/function.php')){	require_once(BASE_URL.'/function.php'); }
$connection = new connect;
$connect->{ $connection->header() }();

$connect->{ $connection->home() }();

$connect->{ $connection->footer() }();