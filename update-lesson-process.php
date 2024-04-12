<?php

session_start();
require "connection.php";

$lesson_name = $_POST["lesson_name"];
$subject = $_POST["subject"];
$grade = $_POST["grade"];
$lesson_id = $_POST["lesson_id"];
$pre_note = $_POST["pre_note"];

if (empty($lesson_name)) {
    echo "lnE";
} else {

    $fileName;

    if (isset($_FILES["file"])) {
        $note = $_FILES["file"];
        $fileName = "notes//" . "LSN - " . uniqid() . ".pdf";
        move_uploaded_file($note["tmp_name"], $fileName);
    } else {
        $fileName=$pre_note;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("UPDATE `lesson_notes` SET `title`='".$lesson_name."',`subject`='".$subject."',`note`='".$fileName."',`grade`='".$grade."' WHERE `id`='".$lesson_id."'");

    echo "ok";

}

?>