<?php

require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleverZone | Online Education</title>
    <link rel="shortcut icon" href="img/logo/CleverZone Short Logo.svg" type="image/x-icon">
</head>

<body onload="start_functions_stu();">

    <div class="container-fluid">

        <div class="row mb-5">
            <?php require "header.php" ?>
        </div>

        <?php

        $new_date = new DateTime($_SESSION["u"]["date"]);
        $d2 = $new_date->add(new DateInterval('P30D'));
        $f_date =  $d2->format('Y-m-d H:i:s');

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if($_SESSION["u"]["user_packages"]=="2"){
            if ($f_date > $date) {
                ?>
                
                <?php
                } else {
                    ?>
                <script>
                    window.location="index.php";
                </script>
                <?php
                }
        }

        ?>

        <div class="row mt-5 pt-5">

            <div class="col-12 col-lg-3 mt-1 pt-lg-3">
                <div class="alert alert-light alert-dismissible fade show" role="alert">
                    Hey <strong><?php echo $_SESSION["u"]["first_name"] ?>!</strong> Welcome to CleverZone
                    <button type="button" class="btn-close-my" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
            </div>

            <div class="col-11 col-lg-7 mt-lg-4">

                <div class="input-group border-my mb-3">
                    <input type="text" class="form-control border-0 focus-none search-input bg-white" placeholder="Search keyword  (ex : manage administration)" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <span class="input-group-text bg-white" id="basic-addon2"><i class="bi bi-search"></i></span>
                </div>

                <div class="row pe-xxl-5">
                    <div class="col-11 col-lg-8 suggestions"></div>
                </div>

                <script>
                    const countries = [{
                        name: 'Dashboard'
                    }, {
                        name: 'View Lesson Notes'
                    }, {
                        name: 'View Assignments'
                    }, {
                        name: 'Profile'
                    }, {
                        name: 'Payment'
                    }];

                    const searchInput = document.querySelector('.search-input');
                    const suggestionsPanel = document.querySelector('.suggestions');

                    searchInput.addEventListener('keyup', function() {
                        const input = searchInput.value;
                        suggestionsPanel.innerHTML = '';
                        const suggestions = countries.filter(function(country) {
                            return country.name.toLowerCase().startsWith(input);
                        });
                        suggestions.forEach(function(suggested) {
                            const div = document.createElement('div');
                            div.innerHTML = suggested.name;
                            suggestionsPanel.appendChild(div);
                        });
                        if (input === '') {
                            suggestionsPanel.innerHTML = '';
                        }
                    })
                </script>
            </div>

            <!-- small device -->
            <div class="col-1 mt-2 mt-lg-2 pt-lg-3 d-block d-lg-none">

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <p>
                            <button class="btn-dec-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-list fs-2"></i>
                            </button>
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-12 d-block d-lg-none">
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <div class="tab">
                            <button class="tablinks" onclick="areaControl(event, 'dashboard')" id="defaultOpen"><i class="bi bi-house mx-1 me-2"></i> Dashboard <label class="active-label"></label></button>
                            <button class="tablinks" onclick="areaControl(event, 'Lesson_Notes')"><i class="bi bi-journal mx-1 me-2"></i> View Lesson Notes <label class="active-label"></label></button>
                            <button class="tablinks" onclick="areaControl(event, 'Assignments')"><i class="bi bi-card-checklist mx-1 me-2"></i> View Assignments <label class="active-label"></label></button>

                            <button class="tablinks"><i class="bi bi-check-circle mx-1 me-2"></i> Attendance</button>
                            <button class="tablinks"><i class="bi bi-credit-card mx-1 me-2"></i> Payments</button>
                            <button class="tablinks"><i class="bi bi-journal-plus mx-1 me-2"></i> Help Ticket</button>
                            <button class="tablinks"><i class="bi bi-chat mx-1 me-2"></i> View Help Ticket</button>
                            <button class="tablinks"><i class="bi bi-exclamation-circle mx-1 me-2"></i> Support</button>

                            <button class="tablinks" onclick="areaControl(event, 'Profile')"><i class="bi bi-person-circle mx-1 me-2"></i> Profile <label class="active-label"></label></button>
                            <button class="tablinks"><i class="bi bi-power mx-1 me-2"></i>Log Out <label class="active-label"></label></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- small device -->

            <!-- notification area -->
            <div class="col-12 col-lg-2 mt-1 pt-3 text-end text-md-center">

                <button class="mx-2 mt-3 btn-dec-none"><i class="fs-6 fw-bold bi bi-fullscreen"></i></button>

                <button class="mx-2 mt-3 btn-dec-none">
                    <i class="fs-5 fw-bold bi bi-envelope"></i>
                    <label class="num-label">0</label>
                </button>

                <button class="mx-2 mt-3 btn-dec-none">
                    <i class="fs-5 fw-bold bi bi-bell"></i>
                    <label class="num-label-2">0</label>
                </button>

                <button onclick="log_out();" class="mx-2 mt-3 btn-dec-none"><i class="fs-5 fw-bold bi bi-power"></i></button>

            </div>
            <!-- notification area -->

        </div>

        <div class="row mb-3">

            <div class="row mt-4">
                <div class="d-none d-lg-block col-3">

                    <div class="row  px-3 my-2">

                        <div class="col-12">
                            <div class="row bg-white p-3 mb-2 rounded">
                                <div class="col-2">
                                    <img src="img/other/d-user.png" alt="" width="40">
                                </div>
                                <?php

                                $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $_SESSION["u"]["user_role"] . "'");
                                $user_role_data = $user_role->fetch_assoc();

                                ?>
                                <div class="col-10 ps-4">
                                    <span class="text-truncate fw-bold d-block"><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"] ?> <i class="ms-2 bi bi-patch-check-fill text-primary"></i></span>
                                    <span class="small-title text-black-50"><?php echo $user_role_data["name"] ?></span>
                                    <?php

                                    if ($_SESSION["u"]["user_packages"] == "1") {
                                    ?>
                                        <span class="enrolled-label fs-mini">Enrolled User</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="enrolled-label-2 fs-mini">Trail User</span>
                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($_SESSION["u"]["status"] == 1) {
                        ?>
                            <div class="col-12 alert-verified">
                                <div>
                                    <span><i class="bi bi-check-circle-fill"></i></span>
                                    <span>Verified User</span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                    <div class="tab">
                        <button class="tablinks" onclick="areaControl(event, 'dashboard')" id="defaultOpen"><i class="bi bi-house mx-1 me-2"></i> Dashboard <label class="active-label"></label></button>
                        <button class="tablinks" onclick="areaControl(event, 'Lesson_Notes')"><i class="bi bi-journal mx-1 me-2"></i> View Lesson Notes <label class="active-label"></label></button>
                        <button class="tablinks" onclick="areaControl(event, 'Assignments')"><i class="bi bi-card-checklist mx-1 me-2"></i> View Assignments <label class="active-label"></label></button>

                        <button class="tablinks"><i class="bi bi-check-circle mx-1 me-2"></i> Attendance</button>
                        <button class="tablinks"><i class="bi bi-credit-card mx-1 me-2"></i> Payments</button>
                        <button class="tablinks"><i class="bi bi-journal-plus mx-1 me-2"></i> Help Ticket</button>
                        <button class="tablinks"><i class="bi bi-chat mx-1 me-2"></i> View Help Ticket</button>
                        <button class="tablinks"><i class="bi bi-exclamation-circle mx-1 me-2"></i> Support</button>

                        <button class="tablinks" onclick="areaControl(event, 'Profile')"><i class="bi bi-person-circle mx-1 me-2"></i> Profile <label class="active-label"></label></button>
                        <button class="tablinks" onclick="log_out();"><i class="bi bi-power mx-1 me-2"></i>Log Out <label class="active-label"></label></button>
                    </div>

                </div>

                <div class="col-12 col-lg-9">
                    <div class="row ms-1">

                        <div id="dashboard" class="tabcontent col-12">
                            <button class="panel-thumb"><i class="bi bi-house fs-4 shadow"></i></button>
                            <span class="heading-main fs-4 ms-2">Dashboard</span>

                            <p class="text-black-50 mt-3 ms-4"><i class="bi bi-info-circle"></i> Overview</p>

                            <div class="row p-2">

                                <div class="col-12 col-lg-8 dashboard-welcome-area">
                                    <div class="row">

                                        <div class="col-6 p-2 ps-3">
                                            <span class="heading-main fs-4 d-block">Welcome Back,</span>
                                            <span class="heading-main fs-4"><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"] ?></span>
                                        </div>

                                        <div class="col-6">
                                            <div class="dashboard-img"></div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row ps-2">

                                        <div class="col-12 text-end">
                                            <?php
                                            $d = new DateTime();
                                            $tz = new DateTimeZone("Asia/Colombo");
                                            $d->setTimezone($tz);
                                            $date = $d->format("Y-m-d");
                                            ?>
                                            <span class="heading-main text-black-50">Today</span>
                                            <span class="heading-main text-black-50"><?php echo $date ?></span>
                                        </div>

                                        <div class="col-12 dashboard-details-area bg-light">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="row bg-light p-2 mb-2 rounded">
                                                        <div class="col-2">
                                                            <img src="img/other/d-user.png" alt="" width="40">
                                                        </div>
                                                        <?php

                                                        $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $_SESSION["u"]["user_role"] . "'");
                                                        $user_role_data = $user_role->fetch_assoc();

                                                        ?>
                                                        <div class="col-10 ps-4">
                                                            <span class="text-truncate fw-bold d-block"><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"] ?> <i class="ms-2 bi bi-patch-check-fill text-primary"></i></span>
                                                            <span class="small-title text-black-50">@ <?php echo $_SESSION["u"]["username"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <span class="heading-main">Role </span>
                                                        </div>

                                                        <div class="col-8">
                                                            <label class="role-status"><?php echo $user_role_data["name"] ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <span class="heading-main">Full Name </span>
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="heading-main text-black-50"><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <span class="heading-main">Email </span>
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="heading-main text-black-50"><?php echo $_SESSION["u"]["email"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <span class="heading-main">Reg. Date </span>
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="heading-main text-black-50"><?php echo $_SESSION["u"]["date"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <span class="heading-main">Verification </span>
                                                        </div>

                                                        <div class="col-8">
                                                            <span class="heading-main text-black-50">
                                                                <?php

                                                                if ($_SESSION["u"]["status"] == 1) {
                                                                ?>
                                                                    <label class="verify-status">Verified User</label>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <label class="verify-status-2">Non-Verified User</label>
                                                                <?php
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center">
                                                    <span class="heading-main text-decoration-underline more" onclick="areaControl(event, 'Profile')">More</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <span class="heading-main fs-6"><i class="bi bi-bell fs-5 me-2"></i> Online Attendance</span>
                                            <hr>
                                        </div>

                                        <div class="col-12 text-center d-flex justify-content-center align-items-center attendance-area">
                                            <button class="refresh-btn shadow"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 text-danger">
                                            <span class="heading-main fs-6"><i class="bi bi-calendar-check fs-5 me-2"></i> Time Table</span>
                                            <hr>
                                        </div>

                                        <div class="col-12 text-center d-flex justify-content-center align-items-center time-table-area">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="Lesson_Notes" class="tabcontent col-12">
                            <button class="panel-thumb"><i class="bi bi-journal fs-4 shadow"></i></button>
                            <span class="heading-main fs-4 ms-2">View Lesson Notes</span>

                            <div class="row p-2">

                                <?php

                                $student_details = Database::search("SELECT * FROM `student_details` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
                                $student_details_data = $student_details->fetch_assoc();

                                $lesson_notes = Database::search("SELECT * FROM `lesson_details` WHERE `grade_id` = '" . $student_details_data["grade"] . "'");
                                $lesson_notes_rs = $lesson_notes->num_rows;

                                for ($ln = 0; $ln < $lesson_notes_rs; $ln++) {
                                    $lesson_notes_data = $lesson_notes->fetch_assoc();

                                    $grade_details = Database::search("SELECT * FROM `grade` WHERE `id`='" . $student_details_data["grade"] . "'");
                                    $grade_data =  $grade_details->fetch_assoc();
                                ?>

                                    <div class="col-12 list-view-iteams mt-2 rounded">
                                        <div class="row p-3">

                                            <div class="col-6">
                                                <span class="fw-bold"><?php echo $lesson_notes_data["title"] ?></span>
                                            </div>

                                            <div class="col-2">
                                                <label class="fw-bold subject-lable"><?php echo $lesson_notes_data["subject_name"] ?></label>
                                            </div>

                                            <div class="col-2 d-none d-lg-block">
                                                <label class="fw-bold">Grade : <?php echo $grade_data["name"] ?></label>
                                            </div>

                                            <div class="col-2 text-end">
                                                <button class="btn-dec-none text-decoration-underline fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#note<?php echo $lesson_notes_data["lesson_id"] ?>" aria-expanded="false" aria-controls="collapseExample">View</button>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <div class="collapse" id="note<?php echo $lesson_notes_data["lesson_id"] ?>">
                                                    <div class="card card-body">

                                                        <embed src="<?php echo $lesson_notes_data["note"] ?>" type="application/pdf" class="pdf-view">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>

                        <div id="Assignments" class="tabcontent col-12">
                            <button class="panel-thumb"><i class="bi bi-card-checklist fs-4 shadow"></i></button>
                            <span class="heading-main fs-4 ms-2">View Assignment</span>
                            <p class="text-black-50 ms-2 mt-3"><i class="bi bi-card-checklist"></i> Current Assignments</p>

                            <div class="row p-2" id="assignments_area"></div>

                        </div>

                        <div id="Profile" class="tabcontent col-12">
                            <button class="panel-thumb"><i class="bi bi-person-circle fs-4 shadow"></i></button>
                            <span class="heading-main fs-4 ms-2">My Profile</span>

                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="profile-cover-area">
                                                <img src="img/other/d-user.png" width="60px" alt="" class="user-img">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-5" id="user-details-area">

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <?php require "footer.php" ?>
        </div>


        <script>
            function areaControl(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

        <script src="script.js"></script>
    </div>

</body>

</html>