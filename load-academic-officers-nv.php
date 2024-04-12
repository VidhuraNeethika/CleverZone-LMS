<?php

require "connection.php";

$users_rs = Database::search("SELECT * FROM `users` WHERE `status`='2' AND `user_role`='2'");
$users_n_r = $users_rs->num_rows;

if ($users_n_r >= 1) {
    for ($ac = 0; $ac < $users_n_r; $ac++) {
        $users_data = $users_rs->fetch_assoc();
        $user_role = Database::search("SELECT * FROM `user_role` WHERE `id`='" . $users_data["user_role"] . "'");
        $user_role_data = $user_role->fetch_assoc();
?>
        <div class="col-12 request-list-view-iteams my-1">
            <div class="row">

                <div class="col-8 col-lg-10">
                    <label class="request-type" id="userRole<?php echo $users_data["email"] ?>"><?php echo $user_role_data["name"] ?></label>
                    <div class="row my-1">
                        <div class="col-12 col-lg-4">
                            <h6 class="text-black-50 text-truncate"><b>Name : </b> <?php echo $users_data["first_name"]." ".$users_data["last_name"] ?></h6>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h6 class="text-black-50 text-truncate"><b>Email : </b> <?php echo $users_data["email"] ?></h6>
                        </div>
                        <div class="col-12 col-lg-4 text-end">
                            <label class="p-1 rounded-circle bg-warning alert-nv"></label>
                        </div>
                    </div>
                </div>

                <div class="col-4 col-lg-2 d-flex justify-content-end">
                    <p>
                        <button class="dp-btn mt-4 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#col<?php echo $users_data["id"] ?>" aria-expanded="false" aria-controls="collapseExample">Send Invitation</button>
                    </p>
                </div>

                <div class="collapse" id="col<?php echo $users_data["id"] ?>">
                    <div class="card card-body">
                        <div class="row mt-3">

                            <div class="col-12 col-lg-11">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control"  value="<?php echo $users_data["email"] ?>" id="createUsername<?php echo $users_data["email"] ?>" placeholder="name@example.com">
                                            <label for="createUsername">Create Username</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="CZ@<?php echo $random = mt_rand(1000000, 9999999).$users_data["id"]; ?>" id="createPassword<?php echo $users_data["email"] ?>" placeholder="name@example.com">
                                            <label for="createPassword">Create Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <?php
                                            $verification_code_generate = uniqid();
                                            ?>
                                            <input type="text" class="form-control" id="verificationCode<?php echo $users_data["email"] ?>" placeholder="name@example.com" value="<?php echo $verification_code_generate ?>">
                                            <label for="verificationCode">Verification Code</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-1 d-flex justify-content-end justify-content-lg-center">
                                <button class="mt-2 send-btn" onclick="sendSignInDetails('<?php echo $users_data['email'] ?>');"><i class="bi bi-cursor"></i></button>
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
        <span>No Non-Verified Academic Officers</span>
    </div>
<?php
}

?>