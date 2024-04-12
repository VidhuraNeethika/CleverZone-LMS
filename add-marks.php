<?php

require "connection.php";

$marks = $_POST["marks"];
$assignment_id = $_POST["assignment_id"];

Database::iud("UPDATE `assignment_marks` SET `marks`='".$marks."' WHERE `assignments_id`='".$assignment_id."'");

echo "ok";


?>