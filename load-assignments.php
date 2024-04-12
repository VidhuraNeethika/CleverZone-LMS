<?php

session_start();
require "connection.php";

$assignment_details = Database::search("SELECT * FROM `assignments_details` WHERE `teacher_id`='" . $_SESSION["u"]["id"] . "'");
$assignment_nr = $assignment_details->num_rows;

for ($ad = 0; $ad < $assignment_nr; $ad++) {
    $assignment_data = $assignment_details->fetch_assoc();

    $color_code = array(
        '75, 119, 190',
        '27, 188, 155',
        '47, 53, 59',
        '142, 68, 173',
        '197, 191, 102',
        '136, 119, 169',
        '63, 171, 164',
        '242, 120, 75'
    );

    $random_color_1 = $color_code[array_rand($color_code)];

?>

    <div class="row my-1">
        <div class="col-12">

            <div class="row">

                <div class="col-12 p-2 pt-3 text-white" style="background-color: rgba(<?php echo $random_color_1 ?>);" data-bs-toggle="collapse" data-bs-target="#sub<?php echo $assignment_data["subject_name"] ?>" aria-expanded="false" aria-controls="collapseExample">

                    <h6 class="list-title text-uppercase text-truncate"><?php echo $assignment_data["subject_name"] ?></h6>

                </div>

            </div>

            <div class="collapse" id="sub<?php echo $assignment_data["subject_name"] ?>">

                <div class="card card-body bg-light">
                    <?php

                    $assignment_details_sv = Database::search("SELECT * FROM `assignments_details` WHERE `teacher_id`='" . $_SESSION["u"]["id"] . "' AND `subject_id`='" . $assignment_data["subject_id"] . "'");
                    $assignment_sv_nr = $assignment_details_sv->num_rows;

                    ?>

                    <div class="row">
                        <?php

                        if ($assignment_sv_nr >= 1) {

                            for ($rr = 0; $rr < $assignment_sv_nr; $rr++) {
                                $assignment_sv_data = $assignment_details_sv->fetch_assoc();

                        ?>
                                <div class="col-1 d-flex justify-content-center align-items-center">
                                    <label class="p-2 rounded-circle" style="background-color: rgba(<?php echo $random_color_1 ?>);"></label>
                                </div>

                                <div class="col-11 list-view-iteams-1 my-1 mt-2">

                                    <div class="row my-1">
                                        <div class="col-12 col-lg-6 pt-1">
                                            <h6 class="list-title text-uppercase text-truncate"><?php echo $assignment_sv_data["assignment_name"] ?></h6>
                                        </div>
                                        <div class="col-12 col-lg-2 pt-2">
                                            <h6 class="date-time"><?php echo $assignment_sv_data["starting_date"] ?></h6>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <button class="update-btn" type="button" data-bs-toggle="collapse" data-bs-target="#update_lesson<?php echo $assignment_sv_data["assignment_id"] ?>" aria-expanded="false" aria-controls="collapseExample">Update</button>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <button class="dlt-btn" onclick="delete_assignment(<?php echo $assignment_sv_data['assignment_id'] ?>);">Delete</button>
                                        </div>
                                    </div>

                                    <div class="collapse mt-2" id="update_lesson<?php echo $assignment_sv_data['assignment_id'] ?>">

                                        <div class="card card-body">

                                            <div class="row mt-2">

                                                <div class="col-12 col-md-4 my-2 mt-4">
                                                    <span class="input-top-lbl">Assignment Code</span>
                                                    <input type="text" class="form-control" value="<?php echo $assignment_sv_data["assignment_code"] ?>" placeholder="Ex : ASIGN - 00112233" id="as_code<?php echo $assignment_sv_data["assignment_id"] ?>">
                                                </div>

                                                <div class="col-12 col-md-8 my-2 mt-4">
                                                    <span class="input-top-lbl">Assignment Name</span>
                                                    <input type="text" class="form-control" value="<?php echo $assignment_sv_data["assignment_name"] ?>" placeholder="Ex : Carbon and Its Compounds" id="as_name<?php echo $assignment_sv_data["assignment_id"] ?>">
                                                </div>

                                                <div class="col-12 col-md-6 my-2 mt-4">
                                                    <span class="input-top-lbl">Subject</span>

                                                    <select id="as_subject<?php echo $assignment_sv_data["assignment_id"] ?>" class="form-control">
                                                        <option value="<?php echo $assignment_sv_data["subject_id"] ?>"><?php echo $assignment_sv_data["subject_name"] ?></option>
                                                        <?php

                                                        $subject_rs = Database::search("SELECT * FROM `subject_details` WHERE `users_id`='" . $_SESSION["u"]["id"] . "' AND `subject_id` = '".$assignment_sv_data["subject_id"]."'");
                                                        $subject_nr = $subject_rs->num_rows;

                                                        for ($sb = 0; $sb < $subject_nr; $sb++) {
                                                            $subject_data = $subject_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $subject_data["subject_id"] ?>"><?php echo $subject_data["subject_name"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>

                                                <div class="col-12 col-md-6 my-2 mt-4">
                                                    <span class="input-top-lbl">Grade</span>
                                                    <select id="as_grade<?php echo $assignment_sv_data["assignment_id"] ?>" class="form-control">
                                                    <option value="<?php echo $assignment_sv_data["grade_id"] ?>">Grade : <?php echo $assignment_sv_data["grade_name"] ?></option>
                                                        <?php

                                                        $grade_rs = Database::search("SELECT * FROM `subject_details` WHERE `users_id`='" . $_SESSION["u"]["id"] . "' AND `grade_id`!='".$assignment_sv_data["grade_id"]."'");
                                                        $grade_nr = $grade_rs->num_rows;

                                                        for ($gd = 0; $gd < $grade_nr; $gd++) {
                                                            $grade_data = $grade_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $grade_data["grade_id"] ?>">Grade : <?php echo $grade_data["grade_name"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-4 my-2 mt-4">
                                                    <span class="input-top-lbl text-warning">Re-Upload Assignment</span>
                                                    <div class="mb-3">
                                                        <input class="file-upload border-my" type="file" id="as_assignment<?php echo $assignment_sv_data["assignment_id"] ?>" accept=".pdf">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-4 my-2 mt-4">
                                                    <span class="input-top-lbl">Starting Date</span>
                                                    <input type="date" value="<?php echo $assignment_sv_data["starting_date"] ?>" class="form-control" id="as_date<?php echo $assignment_sv_data["assignment_id"] ?>">
                                                </div>

                                                <div class="col-12 col-md-4 my-2 mt-4">
                                                    <span class="input-top-lbl">Ending Date</span>
                                                    <input type="date" value="<?php echo $assignment_sv_data["ending_date"] ?>" class="form-control" id="as_en_date<?php echo $assignment_sv_data["assignment_id"] ?>">
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
                                                            <embed src="<?php echo $assignment_sv_data["assignment"] ?>#toolbar=0" type="application/pdf" class="pdf-view">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button onclick="update_assignment(<?php echo $assignment_sv_data['assignment_id'] ?>,<?php echo $assignment_sv_data['assignment'] ?>);" class="add-btn">Update</button>
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
                                <span>No Assignments</span>
                            </div>
                        <?php
                        }

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
}

?>