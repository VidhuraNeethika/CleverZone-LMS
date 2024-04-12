<?php

require "connection.php";

$user = $_POST["id"];

Database::iud("DELETE FROM `users` WHERE `id`='".$user."'");

echo "ok";

?>