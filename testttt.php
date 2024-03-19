<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'connect.php';
//include '../sendOTP.php';


// Function to generate a random verification code


// Retrieve data from URL parameters (GET method)
$username = $_GET["username"] ?? '';
$password = sha1($_GET["password"] ?? ''); // Hash password
$email = $_GET["email"] ?? '';
$verificationCode = rand(10000 , 99999);
echo 'start<br>'; // Debug output

// Ensure $con is defined and not null
if ($con !== null) {
    echo 'Database connection is valid<br>'; // Debug output
    $stmt = $con->prepare("SELECT * FROM user WHERE LOWER(user_email) = LOWER(?)");
    $stmt->execute(array($email));
    $count = $stmt->rowCount();
    echo "Number of rows in result: $count<br>"; // Debug output

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
        echo "Generated verification code: $verificationCode<br>"; // Debug output

        // Call insertData function to insert data into the 'user' table
        echo "Attempting to insert data into the 'user' table<br>"; // Debug output
      //  sendMail($email,$verificationCode);
      if (sendOTP($email, $verificationCode)) {
        echo "OTP sent successfully.";
    } else {
        echo "Failed to send OTP.";
    }
        insertData("user", $data);
    }
} else {
    // Handle case when database connection is not established
    echo "Database connection error.";
}
function sendOTP($email, $verificationCode) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'petshop1542024@gmail.com';             // SMTP username
        $mail->Password   = 'bxlmrmsyirxmdmla';                     // SMTP password (your Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('petshop1542024@gmail.com', 'Pet shop');     // Sender's email address and name
        $mail->addAddress($email);                                  // Recipient's email address

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Verification Code';
        $mail->Body    = 'Your verification code is: ' . $verificationCode;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->send();
        echo'message sent';
        return true; // Return true if email sent successfully
    } catch (Exception $e) {
        echo ''. $e->getMessage() .'';
        // Handle exception
        return false; // Return false if email sending failed
    }
} 
