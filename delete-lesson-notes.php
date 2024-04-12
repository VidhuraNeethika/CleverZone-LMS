<?php
require "connection.php";

$lesson_id = $_POST["lesson_id"];

Database::iud("DELETE FROM `lesson_notes` WHERE `id`='".$lesson_id."'");

echo "ok";

?>