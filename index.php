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

<body onload="enroll();">

    <div class="container-fluid">

        <div class="row">
            <?php require "header.php" ?>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-lg-11 offset-lg-1">

                                <div class="main-xxl-heading-area d-flex justify-content-center justify-content-lg-start">
                                    <div class="logo-2 mb-1" onclick="goToHome();"></div>
                                </div>

                                <div class="text-center text-lg-start" data-aos="fade-right">
                                    <h1 class="main-xxl-heading"> Learn Anywhere Anytime</h1>
                                </div>

                                <div class="text-black-50 justify-text">
                                The best thing for being sad," replied Merlin, beginning to puff and blow, 
                                "is to learn something. That's the only thing that never fails. You may 
                                grow old and trembling in your anatomies, you may lie awake at night listening 
                                to the disorder of your veins, you may miss your only love, you may see the 
                                world about you devastated by evil lunatics, or know your honour trampled in 
                                the sewers of baser minds. There is only one thing for it then — to learn. Learn 
                                why the world wags and what wags it. That is the only thing which the mind 
                                can never exhaust, never alienate, never be tortured by, never fear or distrust, 
                                and never dream of regretting. Learning is the only thing for you. Look what a 
                                lot of things there are to learn
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 home-side-img-area" data-aos="zoom-in"></div>

                </div>
            </div>
        </div>

        <!-- side menu -->
        <div class="left-side-menu p-3 d-none d-lg-block">

            <div class="row mb-3">
                <div class="col-8"><span>Menu</span></div>
                <div class="col-1"><span><i class="bi bi-list fs-5"></i></span></div>
            </div>

            <div class="row mb-3">
                <div class="col-8"><span onclick="go_to_signin();">Sign In</span></div>
                <div class="col-1"><span><i class="bi bi-box-arrow-in-right fs-5"></i></span></div>
            </div>

            <div class="row mb-3">
                <div class="col-8"><span>Sign Up</span></div>
                <div class="col-1"><i class="bi bi-clipboard fs-5"></i></div>
            </div>

        </div>
        <!-- side menu -->

        <div class="row mt-4">

            <div class="col-12 text-center my-3" data-aos="fade-up">
                <h3 class="fw-bold heading-main">Why Choose Us ?</h3>
                <span class="text-black-50">Get Package and Enjoy Learning</span>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="row">

                            <!-- 1 -->
                            <div class="col-12 col-md-6 mt-4" data-aos="fade-up">
                                <div class="w-c-u-cards">
                                    <div class="row">

                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="w-c-u-icon">
                                                <span><i class="bi bi-journals fs-icn"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <h4 class="heading-main">LEARN ANYWHERE ANY TIME</h4>
                                        </div>
                                        <div class="col-12 mt-3 paragraph-w-c-u">
                                            <span class="text-black-50">
                                                Even if you're on the go, you may still use our platform to access study materials
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="col-12 col-md-6 mt-4" data-aos="fade-up">
                                <div class="w-c-u-cards">
                                    <div class="row">

                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="w-c-u-icon">
                                                <span><i class="bi bi-globe fs-icn"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <h4 class="heading-main">Language is not a barrirer</h4>
                                        </div>
                                        <div class="col-12 mt-3 paragraph-w-c-u">
                                            <span class="text-black-50">
                                                Hih quality materials in both Sinhala and English Language
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- 3 -->
                            <div class="col-12 col-md-6 mt-4" data-aos="fade-up">
                                <div class="w-c-u-cards">
                                    <div class="row">

                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="w-c-u-icon">
                                                <span><i class="bi bi-clipboard fs-icn"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <h4 class="heading-main">Practice what you learnt</h4>
                                        </div>
                                        <div class="col-12 mt-3 paragraph-w-c-u">
                                            <span class="text-black-50">
                                                There are assignments in each of our learning spaces to test your understanding of the subject, as well as sample questions to practice
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- 4 -->
                            <div class="col-12 col-md-6 mt-4" data-aos="fade-up">
                                <div class="w-c-u-cards">
                                    <div class="row">

                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="w-c-u-icon">
                                                <span><i class="bi bi-clock-history fs-icn"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <h4 class="heading-main">Access Content Instantly</h4>
                                        </div>
                                        <div class="col-12 mt-3 paragraph-w-c-u">
                                            <span class="text-black-50">
                                                Withing minitues of enrolling up for a learning space, you'll get access to all the features
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row" data-aos="fade-in">
            <div class="col-12 mt-5">

                <div class="background">

                    <div class="row">
                        <div class="col-12 text-center mt-3">
                            <h3 class="fw-bold heading-main">Featured CleverZone Learning</h3>
                            <span class="text-black-50">Get Package and Enjoy Learning</span>
                        </div>
                    </div>

                    <div class="container d-flex justify-content-center">
                        <div class="panel pricing-table">

                            <?php

                            $packages = Database::search("SELECT * FROM `packages`");
                            $packages_nr = $packages->num_rows;

                            for ($pck = 0; $pck < $packages_nr; $pck++) {
                                $packages_data = $packages->fetch_assoc();
                            ?>

                                <div class="pricing-plan" data-aos="fade-up">
                                    <?php

                                    if ($packages_data["name"] == "Trail") {
                                    ?>
                                        <img src="img/gif/icons8-airplane-mode-on.gif" alt="" class="pricing-img" width="80">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="img/gif/icons8-rocket.gif" alt="" class="pricing-img mt-3 mt-md-0" width="80">
                                    <?php
                                    }
                                    ?>
                                    <h2 class="pricing-header"><?php echo $packages_data["name"] ?></h2>
                                    <ul class="pricing-features">
                                        <!-- <li class="pricing-features-item">One Month Free</li> -->
                                        <li class="pricing-features-item"><?php echo $packages_data["period"] ?> Only</li>
                                    </ul>
                                    <span class="pricing-price">USD.<?php echo $packages_data["Price"] ?>.00</span>

                                    <?php
                                    if ($packages_data["name"] == "Trail") {
                                        if (isset($_SESSION["u"]["id"])) {
                                            if ($_SESSION["u"]["user_packages"] == "1") {
                                    ?>
                                                <span class="fw-bold">Already Enrolled</span>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="pricing-button heading-main mt-4" onclick="go_to_signin();">For Free</button>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                        }else{
                                            ?>
                                                <button class="pricing-button heading-main mt-5" onclick="go_to_signin();">For Free</button>
                                            <?php
                                        }
                                    } else {

                                        if (isset($_SESSION["u"]["id"])) {
                                            if ($_SESSION["u"]["user_packages"] == "1") {
                                            ?>
                                                <span class="fw-bold">Already Enrolled</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="fs-mini-2 fw-bold">Click the Paypal Button to Enroll to System</span>
                                                <div id="paypal-button-container"></div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <span class="fs-mini fw-bold">Please Signin to the System & Enroll</span>
                                            <button class="pricing-button heading-main mt-4" onclick="go_to_signin();">Sign In First</button>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>

                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="fill-area"></div>

            </div>

        </div>

    </div>

    <?php require "footer.php" ?>


    <script src="https://www.paypal.com/sdk/js?client-id=Aclb-emP6_-oxmf3jrc23IVKcyedSaSQvhpzcyBfGoSUFELvigYJK78xL713zRKTaqmMB0BzGjYXUxh_&currency=USD&disable-funding=credit,card"></script>
    <script src="script.js"></script>


</body>

</html>