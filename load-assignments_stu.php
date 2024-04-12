<?php

session_start();
require "connection.php";

$students = Database::search("SELECT * FROM `student_details` WHERE `user_id`='" . $_SESSION["u"]["id"] . "'");
$student_details = $students->fetch_assoc();

$subjects_details = Database::search("SELECT * FROM `subject` WHERE `grade_id`='" . $student_details["grade"] . "'");
$subjects_nr = $subjects_details->num_rows;

for ($ad = 0; $ad < $subjects_nr; $ad++) {
    $subjects_data = $subjects_details->fetch_assoc();

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

    <div class="col-12 p-2 pt-3 text-white mt-1 rounded" style="background-color: rgba(<?php echo $random_color_1 ?>);" data-bs-toggle="collapse" data-bs-target="#sub<?php echo $subjects_data["id"] ?>" aria-expanded="false" aria-controls="collapseExample">

        <div class="row">
            <div class="col-6">
                <h6 class="list-title text-uppercase text-truncate"><?php echo $subjects_data["name"] ?></h6>
            </div>
            <div class="col-6 text-end">
                <label class="subject-label">Grade : <?php echo $student_details["grade"] ?></label>
            </div>
        </div>

    </div>

    <div class="col-12">
        <div class="collapse" id="sub<?php echo $subjects_data["id"] ?>">

            <div class="card card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead class="text-white" style="background-color: rgba(<?php echo $random_color_1 ?>);">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Assignment ID</th>
                                        <th scope="col">Assignment Name</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Download</th>
                                        <th scope="col">Upload</th>
                                        <th scope="col">Marks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    $assignment_details = Database::search("SELECT * FROM `assignments_details` WHERE `subject_id`='" . $subjects_data["id"] . "'");
                                    $assignment_nr = $assignment_details->num_rows;

                                    if ($assignment_nr >= 1) {
                                        for ($ass = 0; $ass < $assignment_nr; $ass++) {
                                            $assignment_data = $assignment_details->fetch_assoc();

                                            $assignment_marks = Database::search("SELECT * FROM `assignment_marks` WHERE `assignments_id`='" . $assignment_data["assignment_id"] . "'");
                                            $assignment_marks_nr = $assignment_marks->num_rows;
                                            $assignment_marks_data = $assignment_marks->fetch_assoc();

                                    ?>
                                            <tr>

                                                <th scope="row"><?php echo $ass + 1 ?></th>
                                                <td><?php echo $assignment_data["assignment_code"] ?></td>
                                                <td><?php echo $assignment_data["assignment_name"] ?></td>
                                                <td><?php echo $assignment_data["starting_date"] ?></td>
                                                <td><?php echo $assignment_data["ending_date"] ?></td>

                                                <?php

                                                $d = new DateTime();
                                                $tz = new DateTimeZone("Asia/Colombo");
                                                $d->setTimezone($tz);
                                                $date = $d->format("Y-m-d H:i:s");

                                                if ($assignment_data["ending_date"] < $date) {
                                                    if ($assignment_marks_nr == 1) {
                                                        ?>
                                                        <td class="text-center" colspan="2"><label class="submited">Submited</label></td>
                                                        <td class="text-center"><?php echo $assignment_marks_data["marks"]?></td>
                                                        <?php
                                                    } else {
                                                ?>
                                                        <td class="text-center" colspan="3"><label class="not-submited">Not Submited</label></td>
                                                    <?php
                                                    }
                                                } else {

                                                    ?>

                                                    <td class="text-center">
                                                        <a class="download-btn" download href="<?php echo $assignment_data["assignment"] ?>">Download</a>
                                                    </td>

                                                    <?php

                                                    if ($assignment_marks_nr == 0) {
                                                    ?>
                                                        <td class="text-center">
                                                            <button class="upload" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_assignment<?php echo $assignment_data['assignment_id'] ?>">Upload</button>
                                                        </td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td class="text-center">
                                                            <button class="upload" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_assignment<?php echo $assignment_data['assignment_id'] ?>">Re-Upload</button>
                                                        </td>
                                                    <?php
                                                    }

                                                    ?>

                                                    <td class="text-center">
                                                        <?php

                                                        if ($assignment_marks_nr == 0) {
                                                        ?>
                                                            <label class="mrks_label">Pending</label>
                                                            <?php
                                                        } else {

                                                            if ($assignment_marks_data["marks"] == "-") {
                                                            ?>
                                                                <label class="mrks_label">Pending</label>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <?php echo $assignment_marks_data["marks"] ?>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </td>
                                                <?php
                                                }
                                                ?>

                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="upload_assignment<?php echo $assignment_data['assignment_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Assignment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <span class="input-top-lbl">Upload Assignment</span>
                                                            <div class="mb-3">
                                                                <input class="file-upload border-my" type="file" id="upload_assignment_file<?php echo $assignment_data['assignment_id'] ?>" accept=".pdf">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="modal-close" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="modal-upload" onclick="upload_assignment(<?php echo $assignment_data['assignment_id'] ?>);">Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-black-50">No Assignments</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


<?php
}
?>