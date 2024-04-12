<?php
require "connection.php";

$assignment_id = $_POST["assignment_id"];

Database::iud("DELETE FROM `assignments` WHERE `id`='".$assignment_id."'");

echo "ok";

?>