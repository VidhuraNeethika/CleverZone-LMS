<?php

require "connection.php";

$id = $_POST["id"];

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$city = $_POST["city"];

$mobile = $_POST["mobile"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$username = $_POST["username"];
$password = $_POST["password"];
$verification = $_POST["verification"];

if(empty($first_name)){
    echo "error";
}else if(empty($last_name)){
    echo "error";
}else if(empty($mobile)){
    echo "error";
}else if(empty($email)){
    echo "error";
}else if(empty($address1)){
    echo "error";
}else if(empty($address2)){
    echo "error";
}else if(empty($username)){
    echo "error";
}else if(empty($password)){
    echo "error";
}else {

    Database::iud("UPDATE `users` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`username`='".$username."',`email`='".$email."',`password`='".$password."',`mobile`='".$mobile."',`address_line_01`='".$address1."',`address_line_02`='".$address2."',`city`='".$city."',`status`='".$verification."' WHERE `id`='".$id."'");

    echo "ok";

}

?>