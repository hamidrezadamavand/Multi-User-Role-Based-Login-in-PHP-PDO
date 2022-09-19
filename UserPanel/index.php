<?php
include_once '../connection.php';

session_start();
if (empty($_SESSION['user'])) {
    header('location:logout.php');
}
// restrict user to access admin.php page
if ($_SESSION['user']['Role'] == 'Amin') {
    header('location: AdminPanel/index.php');
}
$user = $_SESSION['user'];
$id = $user['id'];

$stmt = $conn->prepare("SELECT * FROM  users WHERE id='$id' ");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <h2>User Panel</h2>
            <h5><?= $row['firstname'] . "  " . $row['lastname']; ?></h5>
            <a href="../logout.php">logout</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>

