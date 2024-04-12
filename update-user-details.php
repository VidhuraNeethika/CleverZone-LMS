<?php

require 'connection.php';
session_start();

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$address_line_1 = $_POST["address_01"];
$address_line_2 = $_POST["address_02"];
$city = $_POST["city"];

if (empty($first_name)) {
    echo "ur";
} else if (empty($last_name)) {
    echo "ur";
} else if (empty($email)) {
    echo "er";
} else if (empty($mobile)) {
    echo "mr";
} else if (empty($password)) {
    echo "pw";
} else if (empty($address_line_1)) {
    echo "ar1";
} else if (empty($address_line_2)) {
    echo "ar2";
} else {

    Database::iud("UPDATE `users` SET `first_name`='" . $first_name . "',`last_name`='" . $last_name . "',`email`='" . $email . "',`password`='" . $password . "',`mobile`='" . $mobile . "',`address_line_01`='" . $address_line_1 . "',`address_line_02`='" . $address_line_2 . "',`city`='" . $city . "' WHERE `id`='".$_SESSION["u"]["id"]."'");
    
    $user_data = Database::search("SELECT * FROM `users` WHERE `id`='".$_SESSION["u"]["id"]."'");
    $user_fa = $user_data->fetch_assoc();
    $_SESSION["u"] = $user_fa;

    echo "ok";
}

?>
