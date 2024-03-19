<?php 

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow GET, POST, and OPTIONS requests
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow the Content-Type and Authorization headers






include("connect.php");

getAllData("user" , "1=1");
