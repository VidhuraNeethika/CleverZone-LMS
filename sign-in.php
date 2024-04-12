<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"]["id"])) {
?>

    <script src="script.js"></script>
    <script>
        goToHome();
    </script>

<?php

} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CleverZone | Sign In</title>
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="aos.css">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="img/logo/CleverZone Short Logo.svg" type="image/x-icon">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row vh-100">

                <div class="col-12 col-lg-6 img-area-lft d-none d-md-block"></div>

                <div class="col-12 col-lg-6 content-area-rght d-flex align-items-center">
                    <div class="row p-5">

                        <div class="col-12">
                            <div class="logo-4 mt-2" onclick="goToHome();"></div>
                        </div>

                        <div class="col-12 mt-4">
                            <a href="index.php" class="text-black-50">Home</a>
                            <span class="text-black-50"><i class="bi bi-chevron-right"></i></span>
                            <span class="text-black-50">Sign In</span>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">

                                <div class="col-6">
                                    <h3 class="">Sign In</h3>
                                </div>

                                <div class="col-6 d-flex justify-content-end">
                                    <button class="send-request-btn" onclick="getRequestAlert();">Request to Sign In</button>
                                </div>

                            </div>
                        </div>

                        <?php

                        $u = "";
                        $p = "";

                        if (isset($_COOKIE["u"])) {
                            $u = $_COOKIE["u"];
                        }

                        if (isset($_COOKIE["p"])) {
                            $p = $_COOKIE["p"];
                        }

                        ?>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 mt-4">
                                    <span class="input-top-lbl">Username</span>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo $u; ?>" class="form-control" id="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <span class="input-top-lbl">Password</span>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $p; ?>">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 d-none" id="verificationCodeArea">
                                    <span class="input-top-lbl">Verification Code</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="verification_code" placeholder="Verification Code" aria-label="Username" aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-link-45deg"></i></span>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- modal -->

                        <div class="modal fade" id="request_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header mt-3">
                                        <h6 class="modal-title small-title" id="exampleModalLabel">Request to Sign In</h6>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-12 col-md-6">
                                                <span class="input-top-lbl">First Name</span>

                                                <div class="input-group mb-3">
                                                    <select class=" w-hlf" aria-label="Example select with button addon" id="pt">
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
                                                    <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : John Doe" id="fst_name">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <span class="input-top-lbl">Last Name</span>
                                                <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : Fransis" id="lst_name">
                                            </div>

                                            <div class="col-12">
                                                <span class="input-top-lbl">Email Address</span>
                                                <input type="text" aria-label="Address line 2" class="form-control" placeholder="Ex : hello@example.com" id="mle">
                                            </div>

                                            <div class="col-6 mt-3">
                                            <span class="input-top-lbl">Gender</span>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="gns" id="mgender" checked>
                                                        <label class="form-check-label" for="st_gender">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gns" id="mgender">
                                                        <label class="form-check-label" for="st_gender">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-unq-close" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn-unq-submit" onclick="submit_request();">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->

                        <div class="col-12 mt-5">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember_me">
                                        <label class="form-check-label text-black-50" for="remember_me">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="text-black-50">Fogot Password?</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-5">
                            <button class="signInBtn-si" onclick="signIn();">Sign In</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.min.js"></script>
        <script src="aos.js"></script>

        <script>
            AOS.init({
                duration: 900,
            });
        </script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="//code.tidio.co/obgngwi69oy3kootdyykcvyeujlvlgs1.js" async></script>

        <script src="script.js"></script>
    </body>

    </html>

<?php
}
?>