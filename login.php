<?php
include_once 'connection.php';
include_once 'secure_check.php';
session_start();
$error = "";
if (!empty($_SESSION['user'])) {
    header("location: logout.php");
} else {
    if (isset($_POST['Login'])) {
        if (empty($_POST['username'])) {
            $error = 'Enter Username And Password';
        } else {
            $username = user_input($_POST['username']);
        }

        if (empty($_POST['password'])) {
            $error = 'Enter Username And Password';
        } else {
            $password = user_input(md5($_POST['password']));
        }
         if(!empty($_POST['username']) && !empty($_POST['password'])){
             $sql = "SELECT * FROM users WHERE username =:username AND password =:password";
             $query = $conn->prepare($sql);
             $query->bindParam(':username', $username, PDO::PARAM_STR);
             $query->bindParam(':password', $password, PDO::PARAM_STR);
             $query->execute();
             $results = $query->fetch(PDO::FETCH_ASSOC);
             if ($query->rowCount() > 0) {
                 $_SESSION['user'] = array(
                     'id' => $results['id'],
                     'username' => $results['username'],
                     'password' => $results['password'],
                     'Role' => $results['Role']
                 );
                 $Role = $_SESSION['user']['Role'];
                 switch ($Role) {
                     case 'User':
                         header('location:UserPanel/index.php');
                         break;
                     case 'Admin':
                         header('location:AdminPanel/index.php');
                         break;
                     case '':
                         header('location:logout.php');

                 }
             } else {
                 $error= "Wrong username or password !!!";
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Login Page</title>
</head>
<body>
<section class="form-02-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="_lk_de">
                    <div class="form-03-main">
                        <div class="logo">
                            <img src="assets/images/user.png">
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                                <?php if ($error) {
                                    ?>
                                    <span class="text-danger"><?php echo $error; ?></span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Enter Password">
                                <?php if ($error) {
                                    ?>
                                    <span class="text-danger"><?php echo $error; ?></span>
                                <?php } ?>
                            </div>

                            <div class="checkbox form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="">
                                    <label class="form-check-label" for="">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#">Forgot Password</a>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary w-100 rounded-pill" style="height: 45px;"
                                       value="Login" name="Login">
                            </div>
                        </form>
                        <div class="form-group nm_lk">Need an account?<a href="register.php"> Sign up</a></div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>