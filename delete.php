<?php
include './functions.php';

if (!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])) {
    header('Location:  ' . SITE_HOME_URL . "/login.php");
    return;
}

if (!isset($_GET['action']) && !isset($_GET['id']) && $_GET['id'] == "") {
    header('Location:  ' . SITE_HOME_URL);
    return;
}

// creating object
$function = new Functions;

$id = filterInput($_GET['id']);

include './header.php';

?>


<div class="container mt-5">
    <div class="row">


        <div class="col-md-6">
            <h2 class="text-center">Delete Data</h2>

            <table class="table">
                <tr>
                    <td colspan="2">Confirm: Deleting Laudations</td>
                </tr>
                <tr>
                    <td>
                        <a class="btn btn-danger"
                            href="<?= SITE_HOME_URL . '/functions.php?action=deleteSure&id=' . $id ?>">Delete</a>
                    </td>
                    <td>
                        <a class="btn btn-info" href="<?= SITE_HOME_URL ?>">Cancel</a>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>



<?php
include './footer.php';
?>