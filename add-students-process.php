<?php

require 'connection.php';

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$personal_title = $_POST["personal_title"];
$city = $_POST["city"];

$mobile = $_POST["mobile"];
$email = $_POST["email"];
$address_line_1 = $_POST["address_line_1"];
$address_line_2 = $_POST["address_line_2"];
$gender = $_POST["gender"];

$grade = $_POST["grade"];

if (empty($first_name)) {
    echo "ur";
} else if (empty($last_name)) {
    echo "ur";
} else if (empty($mobile)) {
    echo "mr";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile)==0) {
    echo "mr";
} else if (empty($email)) {
    echo "er";
} else if (empty($address_line_1)) {
    echo "ar1";
} else if (empty($address_line_2)) {
    echo "ar2";
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `users` (`personal_title`,`first_name`,`last_name`,`email`,`mobile`,`address_line_01`,`address_line_02`,`city`,`user_role`,`status`,`gender`,`date`) VALUES ('".$personal_title."','".$first_name."','".$last_name."','".$email."','".$mobile."','".$address_line_1."','".$address_line_2."','".$city."','4','2','".$gender."','".$date."')");

    $last_id = Database::$connection->insert_id;

    Database::iud("INSERT INTO `student_grade`(`student`,`grade`) VALUES ('".$last_id."','".$grade."')");

    echo "ok";
}

?>
