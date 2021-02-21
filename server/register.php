<?php

require_once "config.php";

$name = $email = $password = $confirm_password = "";
$name_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST['name']))) {
        $name_err = "Please enter a name";
    } else {
        $sql = "SELECT user_id FROM users WHERE name = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = trim($_POST['name']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $name_err = "This name is already taken.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again late.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST['email']))) {
        $email_err = "Please enter a email";
    } else {
        $sql = "SELECT user_id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST['email']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again late.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
