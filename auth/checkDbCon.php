<?php
function checkDatabaseConnection($dsn, $user, $pass, $option) {
    try {
       // echo "Attempting to connect to the database...\n";
        $con = new PDO($dsn, $user, $pass, $option);
        // Set error mode and other attributes if needed
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //   echo "Database connected successfully.\n";
        // Return true if the connection was successful
        return true;
    } catch (PDOException $e) {
        // Print the error message
        echo "Error connecting to the database: " . $e->getMessage() . "\n";
        // Return false if an exception occurred
        return false;
    }
}

// Database connection parameters
$dsn = "mysql:host=sql310.infinityfree;dbname=if0_36135489_petshop";
$user = "if0_36135489";
$pass = "ProjectTwo1234";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);

// Call the function to check the database connection
$connected = checkDatabaseConnection($dsn, $user, $pass, $option);


