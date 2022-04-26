<?php

include './constant.php';
include './header.php';
?>



<div class="container mt-5">
    <div class="row">
        <h2 class="text-center">Welcome Please Login</h2>



        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="<?php echo SITE_HOME_URL . "/functions.php"; ?>">
                <div class="form-group">
                    <label for="email_id">Email address</label>
                    <input type="text" class="form-control" id="email_id" name="email_id">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="text" class="form-control" id="pass" name="password">
                </div>

                <button type="submit" name="login_btn" class="btn btn-primary mt-2">Login</button>
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
        <div class="col-md-3"></div>
    </div>
</div>



<?php
include './footer.php';
?>