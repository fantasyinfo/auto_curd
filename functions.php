<?php
include './constant.php';
include './class.db.inc.php';
class Functions extends DB
{

    public  function login_system($email_id, $pass)
    {
        $error = 0;
        if (!empty($email_id)) {
            $sql = "SELECT * FROM user WHERE email_id = '$email_id' AND status = '1'";
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetch();

            if (!empty($user)) {
                $userEmail = $user['email_id'];
                $userPassword = $user['password'];
                $userId = $user['id'];
            }

            if (!empty($pass)) {
                if ($pass != $userPassword) {
                    $_SESSION['error'] = 'Incorrect password';
                    header('Location:  ' . SITE_HOME_URL . "/login.php");
                    $error++;
                    return;
                }
            }

            if ($error == 0) {
                $_SESSION['user_email'] = $userEmail;
                $_SESSION['user_id'] = $userId;
                header('Location:  ' . SITE_HOME_URL);
            }
        }
    }

    public function fetchAllData()
    {
        $sql = "SELECT * FROM autos";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function fetchSingle($id)
    {
        $sql = "SELECT * FROM autos WHERE autos_id = $id";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetch();
        return $data;
    }

    public function insertData($make, $model, $year, $mileage)
    {
        $sql = "INSERT INTO autos (make,model,year,mileage) VALUES ('$make', '$model','$year','$mileage')";

        if ($this->conn->exec($sql)) {

            $_SESSION['success'] = 'Record added';
            header('Location:  ' . SITE_HOME_URL . "/index.php");
            return;
        }
    }

    public function updateData($id, $make, $model, $year, $mileage)
    {
        $sql = "UPDATE autos SET make = '$make',model = '$model',year = '$year',mileage = '$mileage' WHERE autos_id = $id";

        if ($this->conn->exec($sql)) {

            $_SESSION['success'] = 'Record edited';
            header('Location:  ' . SITE_HOME_URL . "/index.php");
            return;
        }
    }

    public function deleteData($id)
    {
        $sql = "DELETE FROM autos WHERE autos_id = $id";

        if ($this->conn->exec($sql)) {

            $_SESSION['success'] = 'Record deleted';
            header('Location:  ' . SITE_HOME_URL . "/index.php");
            return;
        }
    }
}

// creating object
$function = new Functions;



// login system

if (isset($_POST['login_btn'])) {

    if (empty($_POST['email_id']) || empty($_POST['password'])) {
        $_SESSION['error'] = 'User name and password are required';
        header('Location:  ' . SITE_HOME_URL . "/login.php");
        return;
    } else if (empty($_POST['email_id'])) {
        $_SESSION['error'] = 'Email id is required';
        header('Location:  ' . SITE_HOME_URL . "/login.php");
        return;
    } else if (empty($_POST['password'])) {
        $_SESSION['error'] = 'Password is required';
        header('Location:  ' . SITE_HOME_URL . "/login.php");
        return;
    }


    $email_id = filterInput($_POST['email_id']);
    $pass = filterInput($_POST['password']);
    $function->login_system($email_id, $pass);
}

// adding new entry
if (isset($_POST['add_new_btn'])) {
    if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = 'All fields are required';
        header('Location:  ' . SITE_HOME_URL . "/add.php");
        return;
    } else if (!is_numeric($_POST['year'])) {
        $_SESSION['error'] = 'Year must be an integer';
        header('Location:  ' . SITE_HOME_URL . "/add.php");
        return;
    } else if (!is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = 'Mileage must be an integer';
        header('Location:  ' . SITE_HOME_URL . "/add.php");
        return;
    }

    $make = filterInput($_POST['make']);
    $model = filterInput($_POST['model']);
    $year = filterInput($_POST['year']);
    $mileage = filterInput($_POST['mileage']);
    $function->insertData($make, $model, $year, $mileage);
}


// updating entry
if (isset($_POST['update_btn'])) {
    $id = filterInput($_POST['_id']);

    if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = 'All fields are required';
        header('Location:  ' . SITE_HOME_URL . "/edit.php?action=edit&id=$id");
        return;
    } else if (!is_numeric($_POST['year'])) {
        $_SESSION['error'] = 'Year must be an integer';
        header('Location:  ' . SITE_HOME_URL . "/edit.php?action=edit&id=$id");
        return;
    } else if (!is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = 'Mileage must be an integer';
        header('Location:  ' . SITE_HOME_URL . "/edit.php?action=edit&id=$id");
        return;
    }


    $make = filterInput($_POST['make']);
    $model = filterInput($_POST['model']);
    $year = filterInput($_POST['year']);
    $mileage = filterInput($_POST['mileage']);
    $function->updateData($id, $make, $model, $year, $mileage);
}

if (isset($_GET['action']) && $_GET['action'] == 'deleteSure' && isset($_GET['id'])) {
    $id = filterInput($_GET['id']);
    $function->deleteData($id);
}
// filter data
function filterInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}