<?php

require "connection.php";

$assignment_id = $_POST["assignment_id"];

Database::iud("UPDATE `assignment_marks` SET `status`='1' WHERE `assignments_id`='".$assignment_id."'");


?>