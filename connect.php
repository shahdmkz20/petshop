<?php
$dsn = "mysql:host=sql310.infinityfree.com;dbname=if0_36135489_petshop";
$user = "if0_36135489";
$pass = "ProjectTwo1234";
$option = array(
   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);
$countrowinpage = 9;
try {
  //echo "Attempting to establish database connection...<br>";
   $con = new PDO($dsn, $user, $pass, $option);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Database connection established successfully.<br>";
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
   header("Access-Control-Allow-Methods: POST, OPTIONS , GET");
   include "functions.php";
   if (!isset($notAuth)) {
      // checkAuthenticate();
   }
} catch (PDOException $e) {
   echo "Error: " . $e->getMessage() . "<br>";
   die("Connection failed: " . $e->getMessage());
}
?>
