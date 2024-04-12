<?php

session_start();
require "connection.php";

$lesson_name = $_POST["lesson_name"];
$subject = $_POST["subject"];
$grade = $_POST["grade"];

if (empty($lesson_name)) {
    echo "lnE";
} else if ($subject == 0) {
    echo "se";
} else if ($grade == 0) {
    echo "ge";
} else {

    if (isset($_FILES["file"])) {
        $note = $_FILES["file"];
        $fileName = "notes//" . "LSN - " . uniqid() . ".pdf";
        move_uploaded_file($note["tmp_name"], $fileName);
    } else {
        echo "nt";
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `lesson_notes` (`title`,`subject`,`note`,`grade`,`date`) VALUES ('".$lesson_name."','".$subject."','".$fileName."','".$grade."','".$date."')");

    echo "ok";

}

?>