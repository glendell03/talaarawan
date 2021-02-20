<?php

require_once "config.php";

$title = $description = "";
$title_err = $description_err = "";


if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $input_title = trim($_POST['title']);
    if (empty($input_title)) {
        $title_err = "Please ente a title";
    } else {
        $title = $input_title;
    }

    $input_description = trim($_POST['description']);
    if (empty($input_description)) {
        $description_err = "Please enter you log";
    } else {
        $description = $input_description;
    }

    if (empty($title_err) && empty($description_err)) {

        $sql = "UPDATE notes SET title=?, description=? WHERE note_id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssi", $param_title, $param_description, $param_id);

            $param_title = $title;
            $param_description = $description;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: ../index.php");
            } else {
                echo "Something went wrong. Please try again late.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
        $id = trim($_GET['id']);

        $sql = "SELECT * FROM notes WHERE note_id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $title = $row["title"];
                    $description = $row["description"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wron. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($link);
    } else {
        header("location: error.php");
        exit();
    }
}
