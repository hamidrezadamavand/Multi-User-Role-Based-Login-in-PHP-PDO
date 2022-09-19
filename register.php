<?php
include_once 'connection.php';
include_once 'secure_check.php';
session_start();
if (!empty($_SESSION['user'])) {
    header("location: logout.php");
}

$errors = ['firstname' => '', 'lastname' => '', 'username' => '', 'password' => '', 'rePassword' => ''];
$firstname = $lastname = $username = $role = $password = $rePassword = $msg_success = '';

if (isset($_POST['Register'])) {
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "Enter first name !!!";
    } else {
        $firstname = user_input($_POST['firstname']);
    }
    //_____________________________________________________________________________
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "Enter last name !!!";
    } else {
        $lastname = user_input($_POST['lastname']);
    }
    //_____________________________________________________________________________
    if (empty($_POST['username'])) {
        $errors['username'] = "Enter username  !!!";
    } else {
        $username = user_input($_POST['username']);
    }
    $role = user_input($_POST['role']);
    //_____________________________________________________________________________
    if (empty($_POST['password'])) {
        $errors['password'] = "Enter password !!!";
    } else {
        $password = user_input($_POST['password']);
        $rePassword = user_input($_POST['rePassword']);
        if ($password != $rePassword) {
            $errors['password'] = "Those passwords didn’t match. Try again!!!";
            $errors['rePassword'] = "Those passwords didn’t match. Try again!!!";
        }
    }
    //_____________________________________________________________________________
    if (empty($_POST['rePassword'])) {
        $errors['rePassword'] = "Enter confirm password !!!";
    } else {
        $rePassword = user_input($_POST['rePassword']);
    }
    //_____________________________________________________________________________
    if (!array_filter($errors)) {
        // check if email already exists
        $sql_username = "SELECT * FROM users WHERE username=:username LIMIT 1";
        $stmt_username = $conn->prepare($sql_username);
        $stmt_username->execute(['username' => $username]);
        if ($stmt_username->rowCount()) {
            $errors['username'] = "That username is taken , Try another";
        } else {
            // hash the password
            $passwordNew = md5($password);
            $sql = "INSERT INTO users(firstname, lastname, Role, username, password)
                    VALUE(:firstname, :lastname, :Role, :username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'Role' => $role,
                'username' => $username,
                'password' => $passwordNew,
            ]);
            $lastId = $conn->lastInsertId();
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $run = $stmt->execute(['id' => $lastId]);
            $user = $stmt->fetch();
            if ($run) {
                header('Location: login.php');
                exit;
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Registration Page</title>
</head>
<body>
<section class="form-02-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="_lk_de">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-03-main">
                            <div class="logo">
                                <img src="assets/images/user.png">
                            </div>
                            <div class="form-group">
                                <input type="text" name="firstname" class="form-control"
                                       placeholder="Enter FirstName" value="<?php echo $firstname; ?>">
                                <?php if ($errors['firstname'] != '') {
                                    ?>
                                    <span class="text-danger"><?php echo $errors['firstname']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="lastname" class="form-control"
                                       placeholder="Enter LastName" value="<?php echo $lastname; ?>">
                                <?php if ($errors['lastname'] != '') {
                                    ?>
                                    <span class="text-danger"><?php echo $errors['lastname']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control"
                                       placeholder="Enter Username" value="<?php echo $username; ?>">
                                <?php if ($errors['username'] != '') {
                                    ?>
                                    <span class="text-danger"><?php echo $errors['username']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Enter Password">
                                <?php if ($errors['password'] != '') {
                                    ?>
                                    <span class="text-danger"><?php echo $errors['password']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="rePassword" class="form-control"
                                       placeholder="Enter Confirm Password">
                                <?php if ($errors['rePassword'] != '') {
                                    ?>
                                    <span class="text-danger"><?php echo $errors['rePassword']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <select class="form-select rounded-pill" aria-label="" aria-required="true" name="role"
                                        style="height: 45px;">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary w-100 rounded-pill" style="height: 45px;"
                                       value="Register" name="Register">
                            </div>
                    </form>
                    <div class="form-group nm_lk"> Already have an account?<a href="login.php"> Log in</a></div>
                    <div class="form-group pt-0">
                        <div class="_social_04">
                            <ol>
                                <li><i class="fa fa-facebook"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-google-plus"></i></li>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-linkedin"></i></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>