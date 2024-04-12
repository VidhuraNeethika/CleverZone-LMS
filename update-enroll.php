<?php

session_start();
require "connection.php";

$user = $_SESSION["u"]["id"];

Database::iud("UPDATE `users` SET `user_packages`='1' WHERE `id`='" . $user . "'");

$user_data = Database::search("SELECT * FROM `users` WHERE `id`='" . $_SESSION["u"]["id"] . "'");
$user_fa = $user_data->fetch_assoc();
$_SESSION["u"] = $user_fa;

echo "ok";

?>
