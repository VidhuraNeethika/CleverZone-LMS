<?php

require "connection.php";

$assignment_code = $_POST["assignment_code"];
$assignment_name = $_POST["assignment_name"];
$subject = $_POST["subject"];
$grade = $_POST["grade"];
$starting_date = $_POST["starting_date"];
$closing_date = $_POST["closing_date"];

if(empty($assignment_code)){
    echo "ac";
}else if(empty($assignment_name)){
    echo "an";
}else if($subject==0){
    echo "sb";
}else if($grade==0){
    echo "gd";
}else if(empty($starting_date)){
    echo "sd";
}else if(empty($closing_date)){
    echo "cd";
}else{

    if (isset($_FILES["assignment_file"])) {
        $assignment_file = $_FILES["assignment_file"];
        $fileName = "assignments//" . "ASGN - " . uniqid() . ".pdf";
        move_uploaded_file($assignment_file["tmp_name"], $fileName);
    } else {
        echo "as";
    }

    Database::iud("INSERT INTO `assignments`(`assignment_code`,`assignment_name`,`subject`,`grade`,`assignment`,`starting_date`,`ending_date`) VALUES ('".$assignment_code."','".$assignment_name."','".$subject."','".$grade."','".$fileName."','".$starting_date."','".$closing_date."')");

    echo "ok";

}


?>