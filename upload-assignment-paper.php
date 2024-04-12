<?php

session_start();
require "connection.php";

$student_id = $_SESSION["u"]["id"];
$assignment_id = $_POST["assignment_id"];

if (isset($_FILES["assignment_file"])) {
    $assignment_file = $_FILES["assignment_file"];
    $fileName = "assignments//" . "UP-ASGN - " . uniqid() . ".pdf";
    move_uploaded_file($assignment_file["tmp_name"], $fileName);
} else {
    echo "as";
}

$assignment_marks = Database::search("SELECT * FROM `assignment_marks` WHERE `assignments_id`='" . $assignment_id . "'");
$assignment_marks_nr = $assignment_marks->num_rows;

if ($assignment_marks_nr == 1) {

    Database::iud("UPDATE `assignment_marks` SET `uploaded_assignment`='" . $fileName . "'");
    echo "ok";
} else {

    Database::iud("INSERT INTO `assignment_marks`(`assignments_id`,`student_id`,`uploaded_assignment`) VALUES ('" . $assignment_id . "','" . $student_id . "','" . $fileName . "')");
    echo "ok";
}

?>
