<?php

require "connection.php";

$subject = $_POST["subject"];
$grade = $_POST["grade"];

if ($subject == 0) {
    $assignment_marks_d = Database::search("SELECT * FROM `assignment_marks_details`");
    if ($grade != 0) {
        $assignment_marks_d = Database::search("SELECT * FROM `assignment_marks_details` WHERE `grade_id`='" . $grade . "'");
    }
}

if ($grade == 0) {
    $assignment_marks_d = Database::search("SELECT * FROM `assignment_marks_details`");
    if ($subject != 0) {
        $assignment_marks_d = Database::search("SELECT * FROM `assignment_marks_details` WHERE `subject_id`='" . $subject . "'");
    }
}

if ($subject != 0 && $grade != 0) {
    $assignment_marks_d = Database::search("SELECT * FROM `assignment_marks_details` WHERE `subject_id`='" . $subject . "' AND `grade`='" . $grade . "'");
}

$assignment_marks_d_nr = $assignment_marks_d->num_rows;

if ($assignment_marks_d_nr >= 1) {

    for ($asm = 0; $asm < $assignment_marks_d_nr; $asm++) {
        $assignments_marks_data = $assignment_marks_d->fetch_assoc();
?>

        <tr>
            <th class="fs-mini text-truncate" scope="row"><?php echo $asm + 1 ?></th>

            <td class="fs-mini text-truncate"><?php echo $assignments_marks_data["student_first_name"] . " " . $assignments_marks_data["student_last_name"] ?></td>
            <td class="fs-mini text-truncate"><?php echo $assignments_marks_data["assignment_code"] ?></td>
            <td class="fs-mini text-truncate"><?php echo $assignments_marks_data["subject_name"] ?></td>
            <td class="fs-mini text-truncate text-center"><?php echo $assignments_marks_data["grade"] ?></td>
            <td class="fs-mini text-truncate"><?php echo $assignments_marks_data["assignment_name"] ?></td>

            <td class="fs-mini text-truncate text-center">
                <button type="button" class="view-btn-1" data-bs-toggle="modal" data-bs-target="#assignment_paper<?php echo $assignments_marks_data["asm_id"] ?>">
                    View
                </button>
            </td>

            <td class="fs-mini text-truncate text-center">
                <button type="button" class="view-btn-2" data-bs-toggle="modal" data-bs-target="#upload_paper<?php echo $assignments_marks_data["asm_id"] ?>">
                    View
                </button>
            </td>

            <td class="fs-mini text-truncate">
                <?php
                if($assignments_marks_data["marks"]=="-"){
                    ?>
                    <input type="text" class="marks-input" id="ass_marks_add">
                    <?php
                }else{
                    ?>
                    <input type="text" class="marks-input" id="ass_marks_add" value="<?php  echo $assignments_marks_data["marks"] ?>">
                    <?php
                }
                ?>
            </td>

            <td class="fs-mini text-truncate text-center"><label class="release-label"><?php echo $assignments_marks_data["status"] ?></label></td>

            <td class="fs-mini text-truncate">
                <button class="release-btn shadow" onclick="add_marks(<?php echo $assignments_marks_data['assignments_id'] ?>);">Add Marks</button>
            </td>

        </tr>

        <!-- Modal Assignment Paper -->
        <div class="modal fade" id="assignment_paper<?php echo $assignments_marks_data["asm_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title heading-main" id="exampleModalLabel">Assignment Paper</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <a class="download-btn" download href="<?php echo $assignments_marks_data["assignment_paper"] ?>">Download</a>
                            </div>

                            <div class="col-12 mt-2">
                                <embed src="<?php echo $assignments_marks_data["assignment_paper"] ?>#toolbar=0" type="application/pdf" class="pdf-view">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Assignment Paper -->

        <!-- Modal Upload Paper -->
        <div class="modal fade" id="upload_paper<?php echo $assignments_marks_data["asm_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title heading-main" id="exampleModalLabel">Uploaded Paper</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <a class="download-btn" download href="<?php echo $assignments_marks_data["uploaded_assignment"] ?>">Download</a>
                            </div>

                            <div class="col-12 mt-2">
                                <embed src="<?php echo $assignments_marks_data["uploaded_assignment"] ?>#toolbar=0" type="application/pdf" class="pdf-view">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Upload Paper -->

    <?php
    }
} else {
    ?>
    <tr>
        <th class="fs-mini text-truncate text-black-50 text-center" colspan="11">No Assignments</th>
    </tr>
<?php
}
?>