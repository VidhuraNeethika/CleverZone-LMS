<?php

session_start();
require "connection.php";

$username = $_POST["username"];
$password = $_POST["password"];
$verification_code = $_POST["verification_code"];
$remember_me = $_POST["remember_me"];

if (empty($username)) {
    echo "un";
} else if (empty($password)) {
    echo "pw";
} else if (empty($verification_code)) {

    $user_data;

    $users_rs_admin = Database::search("SELECT * FROM `users` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `status`='1'");

    if ($users_rs_admin->num_rows == 1) {
        
        $user_data = $users_rs_admin->fetch_assoc();

        if ($user_data["user_role"] == 1) {

            echo "done-a";
            $_SESSION["u"] = $user_data;
        } else if ($user_data["user_role"] == 2) {

            echo "done-ac";
            $_SESSION["u"] = $user_data;
        } else if ($user_data["user_role"] == 3) {

            echo "done-t";
            $_SESSION["u"] = $user_data;
        } else if ($user_data["user_role"] == 4) {

            echo "done-s";
            $_SESSION["u"] = $user_data;
        } else {

            echo "error";
        }

    }else{
        echo "nvu";
    }


    if ($remember_me == "true") {
        setcookie("u", $username, time() + (60 * 60 * 24 * 365));
        setcookie("p", $password, time() + (60 * 60 * 24 * 365));
    } else {
        setcookie("u", "", -1);
        setcookie("p", "", -1);
    }
} else {

    $user_data;

    $users_rs_ = Database::search("SELECT * FROM `users` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `verification_code`='" . $verification_code . "'");
    $user_data_ = $users_rs_->fetch_assoc();

    if ($user_data_["user_role"] == 1) {

        echo "done-a";
        $_SESSION["u"] = $user_data_;
    } else if ($user_data_["user_role"] == 2) {

        echo "done-ac";
        $_SESSION["u"] = $user_data_;
    } else if ($user_data_["user_role"] == 3) {

        echo "done-t";
        $_SESSION["u"] = $user_data_;
    } else if ($user_data_["user_role"] == 4) {

        echo "done-s";
        $_SESSION["u"] = $user_data_;
    } else {

        echo "error";
    }

    Database::iud("UPDATE `users` SET `status`='1' WHERE `email`='" . $user_data_["email"] . "'");

    if ($remember_me == "true") {
        setcookie("u", $username, time() + (60 * 60 * 24 * 365));
        setcookie("p", $password, time() + (60 * 60 * 24 * 365));
    } else {
        setcookie("u", "", -1);
        setcookie("p", "", -1);
    }
}
