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

<body onload="start_functions();start_functions_ac();">

    <div class="container-fluid">

        <div class="row mb-5">
            <?php require "header.php" ?>
        </div>

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
                        name: 'USA'
                    }, {
                        name: 'Japan'
                    }, {
                        name: 'UK'
                    }, {
                        name: 'Jan'
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
                            <button class="tablinks" onclick="areaControl(event, 'dashboard')" id="defaultOpen"><i class="bi bi-house mx-1 me-2"></i> Dashboard</button>
                            <button class="tablinks" onclick="areaControl(event, 'requests')"><i class="bi bi-person-plus mx-1 me-2"></i> Requests</button>
                            <button class="tablinks" onclick="areaControl(event, 'invitations')"><i class="bi bi-share mx-1 me-2"></i> Send Invitations</button>
                            <button class="tablinks" onclick="areaControl(event, 'manageStudents')"><i class="bi bi-person mx-1 me-2"></i>Manage Students</button>

                            <button class="tablinks" onclick="areaControl(event, 'checkResults')"><i class="bi bi-journal-arrow-up mx-1 me-2"></i> Release Results</button>

                            <button class="tablinks" onclick="areaControl(event, 'Profile')"><i class="bi bi-person-circle mx-1 me-2"></i> Profile </button>
                            <button class="tablinks" onclick="log_out();"><i class="bi bi-box-arrow-left mx-1 me-2"></i>Log Out </button>
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
                        <button class="tablinks" onclick="areaControl(event, 'dashboard')" id="defaultOpen"><i class="bi bi-house mx-1 me-2"></i> Dashboard</button>
                        <button class="tablinks" onclick="areaControl(event, 'requests')"><i class="bi bi-person-plus mx-1 me-2"></i> Requests</button>
                        <button class="tablinks" onclick="areaControl(event, 'invitations')"><i class="bi bi-share mx-1 me-2"></i> Send Invitations</button>
                        <button class="tablinks" onclick="areaControl(event, 'manageStudents')"><i class="bi bi-person mx-1 me-2"></i>Manage Students</button>

                        <button class="tablinks" onclick="areaControl(event, 'ReleaseResults')"><i class="bi bi-journal-arrow-up mx-1 me-2"></i> Release Results</button>

                        <button class="tablinks" onclick="areaControl(event, 'Profile')"><i class="bi bi-person-circle mx-1 me-2"></i> Profile </button>
                        <button class="tablinks" onclick="log_out();"><i class="bi bi-box-arrow-left mx-1 me-2"></i>Log Out </button>
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
                                                        <div class="col-10 ps-4 text-truncate">
                                                            <span class="text-truncate fw-bold d-block"><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"] ?> <i class="ms-2 bi bi-patch-check-fill text-primary"></i></span>
                                                            <span class="small-title text-black-50">@<?php echo $_SESSION["u"]["username"] ?></span>
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

                                                        <div class="col-8 text-truncate">
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
                                            <button class="refresh-btn shadow"><i class="bi bi-play-circle"></i> Start</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 text-danger">
                                            <span class="heading-main fs-6"><i class="bi bi-calendar-check fs-5 me-2"></i> Time Table</span> <span class="ms-2 heading-main text-decoration-underline text-black-50">Shedule Class</span>
                                            <hr>
                                        </div>

                                        <div class="col-12 text-center d-flex justify-content-center align-items-center time-table-area">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="requests" class="tabcontent col-12">

                        </div>

                        <div id="invitations" class="tabcontent col-12">
                            <button class="panel-thumb shadow"><i class="bi bi-share fs-4"></i></button>
                            <span class="heading-main fs-4 ms-2">Send Invitations</span>

                            <div class="row mt-3" id="stu_area">
                                <div class="col-12" id="STUsNV"></div>
                            </div>

                        </div>

                        <div id="manageStudents" class="tabcontent col-12">
                            <button class="panel-thumb shadow"><i class="bi bi-person fs-4"></i></button>
                            <span class="heading-main fs-4 ms-2">Manage Students</span>

                            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                <li class="nav-item me-2" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#manageStu" type="button" role="tab" aria-controls="home" aria-selected="true">Add Students</button>
                                </li>
                                <li class="nav-itemme-2 me-2" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#stus" type="button" role="tab" aria-controls="profile" aria-selected="false">Verified Students</button>
                                </li>
                                <li class="nav-itemme-3 me-2" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#AllStus" type="button" role="tab" aria-controls="profile" aria-selected="false">All Students</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="manageStu" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">

                                        <div class="col-12 col-md-4 my-2 mt-4">
                                            <span class="input-top-lbl">First Name</span>

                                            <div class="input-group mb-3">
                                                <select class=" w-hlf" aria-label="Example select with button addon" id="st_pt">
                                                    <?php

                                                    $p_title = Database::search("SELECT * FROM `personal_title`");
                                                    $p_nr = $p_title->num_rows;

                                                    for ($pt = 0; $pt < $p_nr; $pt++) {
                                                        $p_title_data = $p_title->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $p_title_data["id"] ?>"><?php echo $p_title_data["name"] ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                                <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : John" id="st_fst_name">
                                            </div>

                                        </div>

                                        <div class="col-12 col-md-4 my-2 mt-4">
                                            <span class="input-top-lbl">Last Name</span>
                                            <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : Ferdinandiz" id="st_lst_name">
                                        </div>

                                        <div class="col-12 col-md-4 my-2 mt-4">
                                            <span class="input-top-lbl">Mobile Number</span>
                                            <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : 0761234567" id="st_mobile">
                                        </div>

                                        <div class="col-12 col-md-8 my-2 mt-4">
                                            <span class="input-top-lbl">Email Address</span>
                                            <input type="mail" aria-label="Address line 2" class="form-control" placeholder="Ex : name@example.com" id="st_email">
                                        </div>

                                        <div class="col-6 col-md-4 mt-4">
                                            <span class="input-top-lbl">Gender</span>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gns" id="st_gender" checked>
                                                        <label class="form-check-label" for="st_gender">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gns" id="st_gender">
                                                        <label class="form-check-label" for="st_gender">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-md-8 my-2 mt-4">
                                            <span class="input-top-lbl">Address</span>
                                            <div class="input-group border-my">
                                                <input type="text" aria-label="Address line 1" class="form-control" placeholder="Ex : No 8. Queens Street" id="st_address_1">
                                                <input type="text" aria-label="Address line 2" class="form-control" placeholder="Kandy" id="st_address_2">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 my-2 mt-4">
                                            <span class="input-top-lbl">City</span>
                                            <select class="form-control mt-1" aria-label="Default select example" id="st_city">
                                                <option value="0">Select City</option>
                                                <?php

                                                $city_rs = Database::search("SELECT * FROM `city`");
                                                $city_nr = $city_rs->num_rows;

                                                for ($ct = 0; $ct < $city_nr; $ct++) {
                                                    $city_data = $city_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $city_data["id"] ?>"><?php echo $city_data["name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 my-2 mt-4">
                                            <span class="input-top-lbl">City</span>
                                            <select class="form-control mt-1" aria-label="Default select example" id="st_grade">
                                                <option value="0">Select Grade</option>
                                                <?php

                                                $city_rs = Database::search("SELECT * FROM `grade`");
                                                $city_nr = $city_rs->num_rows;

                                                for ($ct = 0; $ct < $city_nr; $ct++) {
                                                    $city_data = $city_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $city_data["id"] ?>"><?php echo $city_data["name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 d-flex justify-content-end my-2 pt-1">
                                            <button class="add-btn mt-md-5" onclick="add_students();">Add</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="stus" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">

                                        <div class="col-12 mt-3">
                                            <div class="input-group mb-3 border-my b-r-30">
                                                <span class="input-group-text text-black-50" id="basic-addon1"><i class="bi bi-search"></i></span>
                                                <input type="text" class="form-control border-0 focus-none" placeholder="Search Teachers" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col-12" id="AllSTUs"></div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="AllStus" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">

                                        <div class="col-12 mt-3">
                                            <div class="input-group mb-3 border-my b-r-30">
                                                <span class="input-group-text text-black-50" id="basic-addon1"><i class="bi bi-search"></i></span>
                                                <input type="text" class="form-control border-0 focus-none" placeholder="Search Teachers" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col-12" id="AllSTUss"></div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="ReleaseResults" class="tabcontent col-12">
                            <button class="panel-thumb shadow"><i class="bi bi-clipboard-check fs-4"></i></button>
                            <span class="heading-main fs-4 ms-2">Release Results</span>

                            <div class="row mt-3">

                                <!-- sorting -->
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-md-6 my-2 mt-4">
                                            <span class="input-top-lbl">Subject</span>
                                            <select class="form-control mt-1" aria-label="Default select example" id="st_subject_s_ac" onchange="load_results_ac()">
                                                <option value="0">Select Subject</option>
                                                <?php

                                                $subject_rs = Database::search("SELECT * FROM `subject`");
                                                $subject_nr = $subject_rs->num_rows;

                                                for ($ct = 0; $ct < $subject_nr; $ct++) {
                                                    $subject_data = $subject_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $subject_data["id"] ?>"><?php echo $subject_data["name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 my-2 mt-4">
                                            <span class="input-top-lbl">Grade</span>
                                            <select class="form-control mt-1" aria-label="Default select example" id="st_grade_s_ac" onchange="load_results_ac()">
                                                <option value="0">Select Grade</option>
                                                <?php

                                                $grade_rs = Database::search("SELECT * FROM `grade`");
                                                $grade_nr = $grade_rs->num_rows;

                                                for ($ct = 0; $ct < $grade_nr; $ct++) {
                                                    $grade_data = $grade_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $grade_data["id"] ?>"><?php echo $grade_data["name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!-- sorting -->

                                <div class="col-12 table-responsive">

                                    <table class="table table-light table-striped table-hover table-bordered table-sm">

                                        <thead>
                                            <tr>
                                                <th scope="col" class="fs-mini">#</th>
                                                <th scope="col" class="fs-mini">Student Name</th>
                                                <th scope="col" class="fs-mini">Assignment Code</th>
                                                <th scope="col" class="fs-mini">Subject</th>
                                                <th scope="col" class="fs-mini">Grade</th>
                                                <th scope="col" class="fs-mini">Assignment Name</th>
                                                <th scope="col" class="fs-mini">Assignment Paper</th>
                                                <th scope="col" class="fs-mini">Uploaded Sheet</th>
                                                <th scope="col" class="fs-mini">Marks</th>
                                                <th scope="col" class="fs-mini">Status</th>
                                                <th scope="col" class="fs-mini">Release</th>

                                            </tr>
                                        </thead>

                                        <tbody id="result-area">


                                        </tbody>

                                    </table>

                                </div>
                            </div>

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