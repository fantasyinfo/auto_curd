<?php
include './functions.php';

if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])) {
    header('Location:  ' . SITE_HOME_URL . "/login.php");
    return;
}


// creating object
$function = new Functions;



// edit system

$makeValue = "";
$modelValue = "";
$yearValue = "";
$mileageValue = "";

if (isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['id'])) {

    $id = filterInput($_GET['id']);
    $singleData = $function->fetchSingle($id);

    if (!empty($singleData)) {
        $makeValue = $singleData['make'];
        $modelValue = $singleData['model'];
        $yearValue = $singleData['year'];
        $mileageValue = $singleData['mileage'];
    }
}


include './header.php';
?>


<div class="container mt-5">
    <div class="row">


        <div class="col-md-6">
            <h2 class="text-center">Edit Exiting Data</h2>
            <form method="post" action="<?php echo SITE_HOME_URL . "/functions.php"; ?>">
                <input type="hidden" name="_id" value="<?= $id ?>">
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" id="make" name="make" value="<?= $makeValue ?>">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?= $modelValue ?>">
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" id="year" name="year" value="<?= $yearValue ?>">
                </div>
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="<?= $mileageValue ?>">
                </div>

                <button type="submit" name="update_btn" class="btn btn-primary mt-2">Update Data</button>
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