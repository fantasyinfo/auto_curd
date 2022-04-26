<?php

include './constant.php';

if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])) {
    header('Location:  ' . SITE_HOME_URL . "/login.php");
    return;
}


include './header.php';
?>



<div class="container mt-5">
    <div class="row">


        <div class="col-md-6">
            <h2 class="text-center">Add New Data</h2>
            <form method="post" action="<?php echo SITE_HOME_URL . "/functions.php"; ?>">
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" id="make" name="make">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model">
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" id="year" name="year">
                </div>
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <input type="text" class="form-control" id="mileage" name="mileage">
                </div>

                <button type="submit" name="add_new_btn" class="btn btn-primary mt-2">Add New Entry</button>
                </br>
                <?php
                //$_SESSION['error']

                if (isset($_SESSION['error'])) {
                    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
                    unset($_SESSION['error']);
                }

                ?>
            </form>
        </div>

    </div>
</div>



<?php
include './footer.php';
?>