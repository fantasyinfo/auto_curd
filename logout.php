<?php

include './constant.php';

unset($_SESSION['user_email']);
unset($_SESSION['user_id']);
header('Location:  ' . SITE_HOME_URL);