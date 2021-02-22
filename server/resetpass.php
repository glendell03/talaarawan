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
        exit("Password updated");
    } else {
        exit("something went wrong");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <form method="POST">
        <input type="password" name="password" placeholder="New password">
        <br>
        <input type="submit" name="submit" value="Update password">
    </form>
</body>

</html>