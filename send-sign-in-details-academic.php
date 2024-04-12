<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require "connection.php";

$user_name = $_POST["user_name"];
$password = $_POST["password"];
$verification_code = $_POST["verification_code"];
$user_role = $_POST["user_role"];
$user_email = $_POST["user_email"];

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'vidhuraneethika000@gmail.com'; 
$mail->Password = 'ksfoaxckabmdbwvy'; 
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('vidhuraneethika000@gmail.com', 'CleverZone'); 
$mail->addReplyTo('vidhuraneethika000@gmail.com', 'CleverZone'); 
$mail->addAddress($user_email); 
$mail->isHTML(true);
$mail->Subject = 'CleverZone SignIn Details'; 

$bodyContent = '<h1 style="width: 100%;
background-color: #000000;
padding: 15px;
color: white;
text-align: center;
">CleverZone</h1>';  //header 

$bodyContent .= '<h2 style="color:black;">Your CleverZone Sign In Details</h2>'; //title

$bodyContent .=  '<span style="display:block: color:#696969">Hello, We checked your information. Below is the username, password and verification code you need to enter this application. You can Sign In using that username, password, and verification code.</span>'; //description 

$bodyContent .=  '<span style="display:block; margin-top: 25px;"> Your Role : ' . $user_role . '</span>'; //content
$bodyContent .=  '<span style="display:block; margin-top: 5px;"> Username : ' . $user_name . '</span>'; //content 
$bodyContent .=  '<span style="display:block; margin-top: 5px;"> Password : ' . $password . '</span>'; //content 
$bodyContent .=  '<span style="display:block; margin-top: 5px;"> Verification Code : ' . $verification_code . '</span>'; //content 

$bodyContent .= '<span style="color:black; display:block; margin-top: 35px;">Thank You..</span>'; //thank

$bodyContent .= '<div style="width: 100%;
background-color: #000000;
padding: 30px;
margin-top: 25px;
color: white;">
<span style=" display: block;">CleverZone</span>
<span style=" display: block;">Temple Rd, Waduragala, Kurunegala</span>
<span style=" display: block;">Tell : 0761821354</span>
</div>';  //footer 

$mail->Body    = $bodyContent;

if (!$mail->send()) {

    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {

    $user_role_rs = Database::search("SELECT * FROM `user_role` WHERE `name`='" . $user_role . "'");
    $user_role_data = $user_role_rs->fetch_assoc();

    $user_details = Database::search("SELECT * FROM `request` WHERE `email`='" . $user_email . "'");

    $users_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $user_email . "'");
    $user_details_data  = $users_rs->fetch_assoc();

    if ($user_details_data["user_role"] == 4) {

        Database::iud("UPDATE `users` SET `username`='" . $user_name . "' , `password`='" . $password . "' , `verification_code`='" . $verification_code . "' WHERE `email`='" . $user_details_data["email"] . "'");
        Database::iud("DELETE FROM `request` WHERE `email`='" . $user_details_data["email"] . "'");
    } else if ($user_details->num_rows == 1) {

        $userDataSet = $user_details->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `users` (`first_name`,`last_name`,`username`,`email`,`password`,`verification_code`,`user_role`,`status`,`date`) VALUES ('" . $userDataSet["first_name"] . "','" . $userDataSet["last_name"] . "','" . $user_name . "','" . $userDataSet["email"] . "','" . $password . "','" . $verification_code . "','" . $user_role_data["id"] . "','1','" . $date . "')");
        Database::iud("DELETE FROM `request` WHERE `email`='" . $userDataSet["email"] . "'");
    } else if ($user_details_data["user_role"] == 3) {

        Database::iud("UPDATE `users` SET `username`='" . $user_name . "' , `password`='" . $password . "' , `verification_code`='" . $verification_code . "' WHERE `email`='" . $user_details_data["email"] . "'");
    } else if ($user_details_data["user_role"] == 2) {

        Database::iud("UPDATE `users` SET `username`='" . $user_name . "' , `password`='" . $password . "' , `verification_code`='" . $verification_code . "' WHERE `email`='" . $user_details_data["email"] . "'");
    }

    echo 'ok';
}

?>
