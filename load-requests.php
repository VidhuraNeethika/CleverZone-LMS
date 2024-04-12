<?php

require "connection.php";

?>

<button class="panel-thumb shadow"><i class="bi bi-person-plus fs-4"></i></button>
<span class="heading-main fs-4 ms-2">Requests</span>

<span class="d-block mt-3">Click
    <button class="tablinks-2" onclick="areaControl(event, 'invitations')">Here</button>
    to Send Invitations</span>

<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <li class="nav-item me-2" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listView" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-list-task"></i></button>
    </li>
    <li class="nav-item me-2" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#gridView" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="bi bi-grid"></i></button>
    </li>
</ul>
<div class="tab-content p-2" id="myTabContent">
    <div class="tab-pane fade show active" id="listView" role="tabpanel" aria-labelledby="home-tab">

        <div class="row">
            <?php

            $requestRs = Database::search("SELECT * FROM `request`");
            $requestNR = $requestRs->num_rows;

            if ($requestNR >= 1) {
                for ($rr = 0; $rr < $requestNR; $rr++) {
                    $requestData = $requestRs->fetch_assoc();

                    $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $requestData["user_role"] . "'");
                    $user_role_data = $user_role->fetch_assoc();
            ?>
                    <div class="col-12 request-list-view-iteams my-1">
                        <label class="request-type">Request : <?php echo $user_role_data["name"] ?></label>
                        <div class="row my-1">
                            <div class="col-12 col-lg-4">
                                <h6 class="text-black-50"><b>Name : </b> <?php echo $requestData["first_name"] . " " . $requestData["last_name"] ?></h6>
                            </div>
                            <div class="col-12 col-lg-4">
                                <h6 class="text-black-50"><b>Email : </b> <?php echo $requestData["email"] ?></h6>
                            </div>
                            <div class="col-12 col-lg-4 text-end">
                                <h6 class="date-time"><?php echo $requestData["date_time"] ?></h6>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 mt-3 text-black-50 text-center">
                    <span>No Requests</span>
                </div>
            <?php
            }

            ?>
        </div>

    </div>
    <div class="tab-pane fade" id="gridView" role="tabpanel" aria-labelledby="profile-tab">

        <div class="row">
            <?php

            $requestRs = Database::search("SELECT * FROM `request`");
            $requestNR = $requestRs->num_rows;

            if ($requestNR >= 1) {
                for ($rr = 0; $rr < $requestNR; $rr++) {
                    $requestData = $requestRs->fetch_assoc();

                    $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $requestData["user_role"] . "'");
                    $user_role_data = $user_role->fetch_assoc();
            ?>
                    <div class="col-6 col-lg-4">
                        <div class="row p-1">

                            <div class="col-12 request-list-view-iteams my-1">
                                <label class="request-type my-1">Request : <?php echo $user_role_data["name"] ?></label>
                                <div class="row my-1">
                                    <div class="col-12">
                                        <h6 class="text-black-50 text-truncate"><b>Name : </b> <?php echo $requestData["first_name"] . " " . $requestData["last_name"] ?></h6>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 text-truncate"><b>Email : </b> <?php echo $requestData["email"] ?></h6>
                                    </div>
                                    <div class="col-12 text-end">
                                        <h6 class="date-time"><?php echo $requestData["date_time"] ?></h6>
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
                    <span>No Requests</span>
                </div>
            <?php
            }

            ?>
        </div>

    </div>
</div>