<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connect.php';
include '../sendOTP.php';


// Function to generate a random verification code


// Retrieve data from URL parameters (GET method)
$username = $_GET["username"] ?? '';
$password = sha1($_GET["password"] ?? ''); // Hash password
$email = $_GET["email"] ?? '';
$verificationCode = rand(10000 , 99999);


// Ensure $con is defined and not null
if ($con !== null) {
  //  echo 'Database connection is valid<br>'; // Debug output
    $stmt = $con->prepare("SELECT * FROM user WHERE LOWER(user_email) = LOWER(?)");
    $stmt->execute(array($email));
    $count = $stmt->rowCount();
    //echo "Number of rows in result: $count<br>"; // Debug output

    if ($count > 0) {
        // Handle case when email already exists
        echo "Email already exists!";
    } else {
        $data = array(
            'user_name' => $username,
            'user_password' => $password,
            'user_email' => $email,
            'user_verifyCode' => $verificationCode
        );
       // echo "Generated verification code: $verificationCode<br>"; // Debug output

        // Call insertData function to insert data into the 'user' table
       // echo "Attempting to insert data into the 'user' table<br>"; // Debug output
      if (sendOTP($email, $verificationCode)) {
        echo "OTP sent successfully. ";
    } else {
        echo "Failed to send OTP. ";
    }
        insertData("user", $data);
    }
} else {
    // Handle case when database connection is not established
    echo "Database connection error.";
}

