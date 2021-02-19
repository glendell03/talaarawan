<?php

require_once "../config.php";

$title = $description = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_title = trim($_POST['title']);
    $title = $input_title;

    $input_description = $_POST['description'];
    $description = $input_description;


    $sql = "INSERT INTO note (title, description) VALUES (?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_title, $param_description);

        $param_title = $title;
        $param_description = $description;

        if (mysqli_stmt_execute($stmt)) {
            header("location: ../public/index.php");
            exit();
        } else {
            echo "Something went wrong. Please Try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
