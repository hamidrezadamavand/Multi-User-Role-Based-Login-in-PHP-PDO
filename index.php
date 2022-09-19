<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .wrapper{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        a{
            display: block;
            font-size: 24px;
            font-family: sans-serif;
            text-decoration: none;
            color: #333;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            padding: 10px;
            letter-spacing: 2px;
            transition: all .25s;
        }

        a:hover{
            letter-spacing: 15px
    </style>
    <title>Home</title>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="wrapper">
                <a href="login.php">Register / Login</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
