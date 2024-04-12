<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="aos.css">
    <link rel="stylesheet" href="style.css">
</head>

<body onscroll="scrollEffect();">

    <div class="container-fluid">

        <!-- scroll -->

        <div class="scroll-top shadow" id="scroll-top">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
            </svg>
        </div>

        <script>
            const scrollTopButton = document.getElementById("scroll-top");

            scrollTopButton.addEventListener('click', () => {
                window.scrollTo(0, 0);
            })
        </script>

        <!-- scroll -->

        <div class="row fixed-top px-2">

            <div class="col-12  bg-white" id="headerMainShadow">
                <div class="row">

                    <div class="col-12 h-tab-2">
                        <div class="row py-2">

                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="container-fluid p0">

                                    <div class="col-md-3 ps-lg-5">
                                        <div class="logo" onclick="goToHome();"></div>
                                    </div>


                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="col-9">
                                        <div class="collapse navbar-collapse" id="navbarNavDropdown">

                                            <div class="col-12 col-md-2 text-md-center mt-3 mt-md-0">

                                                <div class="dropdown">
                                                    <button class="dropbtn text-start text-lg-center" onclick="goToHome();">Home</button>
                                                </div>

                                            </div>

                                            <?php

                                            if (isset($_SESSION["u"]["id"])) {
                                            ?>

                                                <div class="col-12 col-md-2 text-md-center">
                                                    <div class="dropdown">
                                                        <?php

                                                        if ($_SESSION["u"]["user_role"] == 2) {
                                                        ?>
                                                            <button class="dropbtn text-start text-lg-center" onclick="goToAOPanel();">Working Space</button>
                                                        <?php
                                                        } else if ($_SESSION["u"]["user_role"] == 3) {
                                                        ?>
                                                            <button class="dropbtn text-start text-lg-center" onclick="goToTecPanel();">Working Space</button>
                                                        <?php
                                                        } else if ($_SESSION["u"]["user_role"] == 4) {
                                                        ?>
                                                            <button class="dropbtn text-start text-lg-center" onclick="goToStuPanel();">Working Space</button>
                                                        <?php
                                                        } else if ($_SESSION["u"]["user_role"] == 1) {
                                                        ?>
                                                            <button class="dropbtn text-start text-lg-center" onclick="goToAdminPanel();">Admin Panel</button>
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                </div>

                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 col-md-2 text-lg-center">
                                                    <button type="button" class="hide-dropbtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please Sign In First">
                                                        Working Space
                                                    </button>
                                                </div>
                                            <?php
                                            }

                                            ?>

                                            <div class="col-12 col-md-2 text-md-center">
                                                <div class="dropdown">
                                                    <button class="dropbtn text-start text-lg-center">Pricing</button>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-2 text-md-center">
                                                <div class="dropdown">
                                                    <button class="dropbtn text-start text-lg-center">About Us</button>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-2 text-md-center">

                                                <div class="dropdown">
                                                    <button class="dropbtn text-start text-lg-center">Contact Us</button>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-lg-2 nav-items d-flex justify-content-end justify-content-lg-center border-side">
                                                <button class="signInBtn" onclick="goToSignIn();">Sign In</button>
                                                <button class="signUpBtn">Sign Up</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </nav>

                        </div>
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

    <script src="script.js"></script>
</body>

</html>