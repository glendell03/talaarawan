<?php
include("config.php");

if (!isset($_GET["code"])) {
    exit("Can't find page");
}
$code = $_GET["code"];
$getEmailQuery = mysqli_query($link, "SELECT email FROM resetpass WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery) == 0) {
    exit("Can't find page");
}

if (isset($_POST["password"])) {
    $pw = $_POST["password"];
    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];

    $query = mysqli_query($link, "UPDATE users SET password='$pw' WHERE email='$email'");

    if ($query) {
        $query = mysqli_query($link, "DELETE FROM resetpass WHERE code='$code'");
        header("location: ../public/auth/login.php");
        exit();
    } else {
        exit("something went wrong");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: 0;
        }

        body {
            background-color: #F4E7D6;
        }

        .row {
            background-color: white;
            border-radius: 30px;
        }

        img {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .btn1 {
            border: none;
            outline: none;
            height: 54px;
            width: 192px;
            background-color: #00303F;
            color: white;
            border-radius: 4px;
            font-weight: bold;
            display: block;
            margin-left: 150px;
            margin-bottom: 68px;


        }

        .btn1:hover {
            background-color: white;
            border: 1px solid;
            color: black;
        }

        .torq {
            background-color: #CAEFDB;
            padding-top: 92px;
            height: 600px;
        }

        .logo {
            text-size-adjust: 36px;
            padding-left: 49px;
            font-family: 'Nunito', sans-serif;
        }

        .form-row {
            padding-left: 49px;
            position: relative;
        }

        p {
            padding-left: 49px;
            font-family: 'Nunito', sans-serif;
            width: auto;

        }

        .form-control {
            height: 52px;
            width: 466px;
            border-color: black;
            padding-left: 60px;
        }

        section {
            padding-top: 82px;
        }

        .logo-text {
            font-family: 'Pacifico', cursive;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }

        .input-wrapper i {
            padding-left: 20px;
            position: absolute;
        }

        .error {
            position: absolute;
            color: red;
            bottom: -5px;
        }
    </style>
</head>

<body>

    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="../public/img/forgotpass.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <div class="torq">
                        <h2 class="logo font-weight-bold py-3"><span class="logo-text">Update Password</span></h2>

                        <form action="" method="post">
                            <div class="form-row">
                                <div class="input-wrapper my-3">
                                    <i class="ri-mail-line ri-lg"></i>
                                    <input type="password" placeholder="New Password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button type="submit" class="btn1 mt-3 mb-5">Update Password</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>