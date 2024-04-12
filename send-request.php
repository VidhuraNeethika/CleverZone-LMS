<?php

require "connection.php";

$userRole = 4;
$personal_title = $_POST["personal_title"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];

if(empty($first_name)){
    echo "fn";
}else if(empty($last_name)){
    echo "ln";
}else if(empty($email)){
    echo "eml";
}else{

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `request`(`personal_title`,`first_name`,`last_name`,`gender`,`user_role`,`email`,`date_time`) VALUES ('" . $personal_title . "','" . $first_name . "','" . $last_name . "','" . $gender . "','" . $userRole . "','" . $email . "','" . $date . "')");
echo "ok";

}
?>
