<?php

require "connection.php";

$user = $_POST["user_id"];

$user_data = Database::search("SELECT * FROM `users` WHERE `id`='" . $user . "'");
$user_Rs = $user_data->num_rows;

if ($user_Rs == 1) {
    $user_data_set = $user_data->fetch_assoc();

    $status = $user_data_set["status"];

    if ($status == 1) {
        Database::iud("UPDATE `users` SET `status`='2' WHERE `id`='" . $user . "' ");
        echo "deactivate";
    } else {
        Database::iud("UPDATE `users` SET `status`='1' WHERE `id`='" . $user . "' ");
        echo "activate";
    }
}

?>