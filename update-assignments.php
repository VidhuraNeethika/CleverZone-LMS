<?php

require "connection.php";

$assignment_id = $_POST["assignment_id"];
$assignment_code = $_POST["assignment_code"];
$assignment_name = $_POST["assignment_name"];
$subject = $_POST["subject"];
$grade = $_POST["grade"];
$starting_date = $_POST["starting_date"];
$closing_date = $_POST["closing_date"];
$old_assignment = $_POST["assignment"];

if (empty($assignment_code)) {
    echo "ac";
} else if (empty($assignment_name)) {
    echo "an";
} else if (empty($starting_date)) {
    echo "sd";
} else if (empty($closing_date)) {
    echo "cd";
} else {

    $fileName;

    if (isset($_FILES["assignment_file"])) {
        $assignment_file = $_FILES["assignment_file"];
        $fileName = "assignments//" . "ASGN - " . uniqid() . ".pdf";
        move_uploaded_file($assignment_file["tmp_name"], $fileName);
    } else{
        $fileName = $old_assignment;
    }

    Database::iud("UPDATE `assignments` SET `assignment_code`='" . $assignment_code . "',`assignment_name`='" . $assignment_name . "',`subject`='" . $subject . "',`grade`='" . $grade . "',`assignment`='" . $fileName . "',`starting_date`='" . $starting_date . "',`ending_date`='" . $closing_date . "' WHERE `id`='".$assignment_id."'");

    echo "ok";
}

?>
