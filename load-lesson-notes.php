<?php

session_start();
require "connection.php";


$lsn_rs = Database::search("SELECT * FROM `lesson_details` WHERE `users_id`='" . $_SESSION["u"]["id"] . "'");
$lns_nr = $lsn_rs->num_rows;

?>

<div class="row mt-3 p-2">
    <?php

    if ($lns_nr >= 1) {
        
        for ($rr = 0; $rr < $lns_nr; $rr++) {
            $lsn_data = $lsn_rs->fetch_assoc();

            // $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $lsn_data["subject"] . "'");
            // $subject_data = $subject_rs->fetch_assoc();

    ?>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <label class="p-2 half-white-bg rounded-circle"></label>
            </div>

            <div class="col-11 list-view-iteams-1 my-1 mt-2">

                <div class="row my-1">
                    <div class="col-12 col-lg-6 pt-1">
                        <h6 class="list-title text-uppercase text-truncate"><?php echo $lsn_data["title"] ?></h6>
                    </div>
                    <div class="col-12 col-lg-2 pt-2">
                        <h6 class="date-time"><?php echo $lsn_data["date"] ?></h6>
                    </div>
                    <div class="col-6 col-lg-2">
                        <button class="update-btn" type="button" data-bs-toggle="collapse" data-bs-target="#update_lesson<?php echo $lsn_data["lesson_id"] ?>" aria-expanded="false" aria-controls="collapseExample">Update</button>
                    </div>
                    <div class="col-6 col-lg-2">
                        <button class="dlt-btn" onclick="delete_lesson(<?php echo $lsn_data['lesson_id'] ?>);">Delete</button>
                    </div>
                </div>

                <div class="collapse mt-2" id="update_lesson<?php echo $lsn_data["lesson_id"] ?>">

                    <div class="card card-body">

                        <div class="row mt-2">

                            <div class="col-12 col-md-6 my-2 mt-1">
                                <span class="input-top-lbl">Lesson Name</span>
                                <input type="text" class="form-control" placeholder="Ex : Er Diagrams" value="<?php echo $lsn_data["title"] ?>" id="ulname<?php echo $lsn_data["lesson_id"] ?>">
                            </div>

                            <div class="col-12 col-md-6 my-2 mt-1">
                                <span class="input-top-lbl">Subject</span>

                                <?php

                                $user_subject = Database::search("SELECT * FROM `subject` WHERE `id`='" . $lsn_data["subject_id"]. "'");
                                $user_subject_data = $user_subject->fetch_assoc();

                                ?>

                                <select id="ulsubject<?php echo $lsn_data["lesson_id"] ?>" class="form-control">
                                    <option value="<?php echo $user_subject_data["id"] ?>"><?php echo $user_subject_data["name"] ?></option>
                                    <?php

                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`!='" . $lsn_data["subject_id"]. "'");
                                    $subject_nr = $subject_rs->num_rows;

                                    for ($sb = 0; $sb < $subject_nr; $sb++) {
                                        $subject_data = $subject_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $subject_data["id"] ?>"><?php echo $subject_data["name"] ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="col-12 col-md-6 my-2 mt-1">
                                <span class="input-top-lbl">Grade</span>
                                <select id="ulgrade<?php echo $lsn_data["lesson_id"] ?>" class="form-control">
                                    <?php

                                    $user_grade = Database::search("SELECT * FROM `grade` WHERE `id`='".$lsn_data["grade_id"]."'");
                                    $user_grade_data = $user_grade->fetch_assoc();

                                    ?>
                                    <option value="<?php echo $user_grade_data["id"] ?>">Grade : <?php echo $user_grade_data["name"] ?></option>
                                    <?php

                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" .$subject_data["grade_id"]. "' AND `id` !='".$lsn_data["grade_id"]."'");
                                    $grade_nr = $grade_rs->num_rows;

                                    for ($gd = 0; $gd < $grade_nr; $gd++) {
                                        $grade_data = $grade_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $grade_data["id"] ?>">Grade : <?php echo $grade_data["name"] ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 my-2 mt-1">
                                <span class="input-top-lbl">Uploaded Note</span>
                                <div class="mb-3 d-grid">
                                    <button class="text-start uploaded-btn" type="button" data-bs-toggle="collapse" data-bs-target="#view_lesson" aria-expanded="false" aria-controls="collapseExample">View Previously Uploaded Note</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="collapse mt-2" id="view_lesson">

                                    <div class="card card-body">
                                        <embed src="<?php echo $lsn_data["note"] ?>#toolbar=0" type="application/pdf" class="pdf-view">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 my-2 mt-1">
                                <span class="input-top-lbl text-warning">Re-Upload Note</span>
                                <div class="mb-3">
                                    <input class="file-upload border-my" type="file" id="ulfile<?php echo $lsn_data["lesson_id"] ?>" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 pt-5 d-flex justify-content-end">
                                <button onclick="update_lesson(<?php echo $lsn_data['lesson_id'] ?>,'<?php echo $lsn_data['note'] ?>');" class="add-btn">Update</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php
        }
    } else {
        ?>
        <div class="col-12 mt-3 text-black-50 text-center">
            <span>No Lesson Notes</span>
        </div>
    <?php
    }

    ?>
</div>