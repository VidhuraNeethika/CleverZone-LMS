
<?php

session_start();
require "connection.php";

?>

<div class="row">

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">First Name</span>
        <input type="text" class="form-control" placeholder="Ex : John" id="st_fst_name" value="<?php echo $_SESSION["u"]["first_name"] ?>">
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">Last Name</span>
        <input type="text" class="form-control" placeholder="Ex : Ferninandiz" id="st_lst_name" value="<?php echo $_SESSION["u"]["last_name"] ?>">
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">Email</span>
        <input type="text" class="form-control" placeholder="Ex : hello@example.com" id="st_email" value="<?php echo $_SESSION["u"]["email"] ?>">
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">Mobile</span>
        <input type="text" class="form-control" placeholder="Ex : 070 1234567" id="st_mobile" value="<?php echo $_SESSION["u"]["mobile"] ?>">
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">Username</span>
        <input type="text" class="form-control" placeholder="Ex : hello@example.com" disabled value="<?php echo $_SESSION["u"]["username"] ?>">
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">Password</span>
        <input type="text" class="form-control" id="st_password" value="<?php echo $_SESSION["u"]["password"] ?>">
    </div>

    <div class="col-12 col-md-8 my-2 mt-4">
        <span class="input-top-lbl">Address</span>
        <div class="input-group border-my">
            <input type="text" aria-label="Address line 1" class="form-control" placeholder="Ex : No 8. Queens Street" id="st_address_1" value="<?php echo $_SESSION["u"]["address_line_01"] ?>">
            <input type="text" aria-label="Address line 2" class="form-control" placeholder="Kandy" id="st_address_2" value="<?php echo $_SESSION["u"]["address_line_02"] ?>">
        </div>
    </div>

    <div class="col-12 col-md-4 my-2 mt-4">
        <span class="input-top-lbl">City</span>
        <select class="form-control mt-1" aria-label="Default select example" id="st_city">
            <?php

            $city_rs_1 = Database::search("SELECT * FROM `city` WHERE `id`='" . $_SESSION["u"]["city"] . "'");
            $city_nr_1 = $city_rs_1->num_rows;
            $city_data_1 = $city_rs_1->fetch_assoc();

            ?>
            <option value="<?php echo $_SESSION["u"]["city"] ?>"><?php echo $city_data_1["name"] ?></option>
            <?php

            $city_rs = Database::search("SELECT * FROM `city` WHERE `id` != '" . $_SESSION["u"]["city"] . "'");
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

    <div class="col-12 text-end mt-4">
        <button class="update-btn-2" onclick="update_user_details();">Update</button>
    </div>

</div>