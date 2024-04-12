<?php

require "connection.php";

?>
<div class="row mt-1 p-2">
    <?php

    $users = Database::search("SELECT * FROM `users` WHERE `user_role`='2'");
    $users_nr = $users->num_rows;

    if ($users_nr >= 1) {

        for ($at = 0; $at < $users_nr; $at++) {
            $users_data = $users->fetch_assoc();

            $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $users_data["user_role"] . "'");
            $user_role_data = $user_role->fetch_assoc();
    ?>

            <div class="col-12 request-list-view-iteams my-1">
                <div class="row">

                    <div class="col-12">
                        <label class="request-type" id="userRole<?php echo $users_data["id"] ?>"><?php echo $user_role_data["name"] ?></label>

                        <div class="row my-1 pt-2">

                            <div class="col-12 col-lg-5">
                                <h6 class="text-black-50 text-truncate"><b>Name : </b> <?php echo $users_data["first_name"] . " " . $users_data["last_name"] ?></h6>
                            </div>

                            <div class="col-12 col-lg-5">
                                <h6 class="text-black-50 text-truncate"><b>Email : </b> <?php echo $users_data["email"] ?></h6>
                            </div>

                            <div class="col-6 col-lg-1">
                                <p>
                                    <button class="update-btn" type="button" data-bs-toggle="collapse" data-bs-target="#col<?php echo $users_data["id"] ?>" aria-expanded="false" aria-controls="collapseExample">Update</button>
                                </p>
                            </div>

                            <div class="col-6 col-lg-1">
                                <button class="dlt-btn" onclick="delete_academic_officers(<?php echo $users_data['id'] ?>);">Delete</button>
                            </div>

                        </div>
                    </div>

                    <div class="collapse" id="col<?php echo $users_data["id"] ?>">
                        <div class="card card-body">
                            <div class="row">

                                <div class="col-12 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOname<?php echo $users_data['id'] ?>" placeholder="Name" value="<?php echo $users_data["first_name"] ?>">
                                        <label for="name">First Name</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOlname<?php echo $users_data['id'] ?>" placeholder="Name" value="<?php echo $users_data["last_name"] ?>">
                                        <label for="name">Last Name</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOmobile<?php echo $users_data['id'] ?>" placeholder="Username" value="<?php echo $users_data["mobile"] ?>">
                                        <label for="Amobile">Mobile Number</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="ACOemail<?php echo $users_data['id'] ?>" placeholder="name@example.com" value="<?php echo $users_data["email"] ?>">
                                        <label for="Aemail">Email</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOaddress1<?php echo $users_data['id'] ?>" placeholder="Username" value="<?php echo $users_data["address_line_01"] ?>">
                                        <label for="Aaddress1">Address Line 01</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOaddress2<?php echo $users_data['id'] ?>" placeholder="Username" value="<?php echo $users_data["address_line_02"] ?>">
                                        <label for="Aaddress2">Address Line 02</label>
                                    </div>
                                </div>


                                <?php

                                $user_city = Database::search("SELECT * FROM `city` WHERE `id`='" . $users_data['city'] . "'");
                                $user_city_data = $user_city->fetch_assoc();

                                ?>

                                <div class="col-12 col-md-4">
                                    <select class="form-control mt-1 p-2" aria-label="Default select example" id="ACOcity<?php echo $users_data['id'] ?>">
                                        <option selected value="<?php echo $users_data['city'] ?>"><?php echo $user_city_data['name'] ?></option>
                                        <?php

                                        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`!='" . $users_data['city'] . "'");
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

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="ACOusername<?php echo $users_data['id'] ?>" placeholder="Username" value="<?php echo $users_data["username"] ?>">
                                        <label for="ACOusername">Username</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="ACOpassword<?php echo $users_data['id'] ?>" placeholder="Password" value="<?php echo $users_data["password"] ?>">
                                        <label for="ACOpassword">Password</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-check form-switch">
                                        <?php

                                        if ($users_data["status"] == 1) {
                                        ?>
                                            <input class="form-check-input" type="checkbox" role="switch" id="ACOverification<?php echo $users_data['id'] ?>" checked onclick="status_change_ac_all(<?php echo $users_data['id'] ?>)">
                                            <label class="form-check-label" for="ACOverification" id="ACOveri_label<?php echo $users_data['id'] ?>">Make as non-verified user.</label>
                                        <?php
                                        } else {
                                        ?>
                                            <input class="form-check-input" type="checkbox" role="switch" id="ACOverification<?php echo $users_data['id'] ?>" onclick="status_change_ac_all(<?php echo $users_data['id'] ?>)">
                                            <label class="form-check-label" for="ACOverification" id="ACOveri_label<?php echo $users_data['id'] ?>">Make as verified user.</label>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button onclick="update_all_academic_officers(<?php echo $users_data['id'] ?>);" class="update-btn-2">Update</button>
                                </div>

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
            <span>No Verified Academic Officers</span>
        </div>
    <?php
    }

    ?>
</div>