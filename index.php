<?php
include './constant.php';
if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])) {
    header('Location:  ' . SITE_HOME_URL . "/welcome.php");
    return;
}
include './functions.php';
include './header.php';
$function = new Functions;
$data = $function->fetchAllData();

?>
<div class="container">
    <div class="row">
        <h2 class="mt-5">Welcome to the Automobiles Database</h2>

        <div class="col-md-12 mt-3">

            </br>
            <?php
            //$_SESSION['error']

            if (isset($_SESSION['success'])) {
                echo ('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
                unset($_SESSION['success']);
            }

            ?>







            <?php
            if (isset($data) && !empty($data)) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Mileage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $value) { ?>
                    <tr>
                        <td><?= $value['make']; ?></td>
                        <td><?= $value['model']; ?></td>
                        <td><?= $value['year']; ?></td>
                        <td><?= $value['mileage']; ?></td>
                        <td>
                            <a class="btn btn-info"
                                href="<?= SITE_HOME_URL . '/edit.php?action=edit&id=' . $value['autos_id'] ?>">Edit</a>
                            <a class="btn btn-danger"
                                href="<?= SITE_HOME_URL . '/delete.php?action=delete&id=' . $value['autos_id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php  }

                        ?>

                </tbody>

            </table>
            <?php } else {
                $html = "<table><tr colspan='5'>No rows found</tr></table>";
                echo $html;
            }

            ?>

        </div>


    </div>
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="<?= SITE_HOME_URL . '/add.php' ?>">Add New Entry</a>
            </br>
            <a class="btn btn-warning" href="<?= SITE_HOME_URL . '/logout.php' ?>">Logout</a>
        </div>
    </div>

</div>

<?php
include './footer.php';
?>