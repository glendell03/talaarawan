<?php include "../server/createNote.php" ?>
<?php include "../server/readNote.php" ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaarawan</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/note.css">
</head>

<body>
    <!-- DIARY -->

    <!-- <div class="note-modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="title" value="<?php echo $title; ?> " placeholder="title">
            <textarea type="text" name="description" value="<?php echo $description ?>" placeholder="description"></textarea>
            <button type="submit">submit</button>
        </form>
    </div> -->

    <!-- NOTE -->
    <div class="note-wrapper">
        <?php while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="note-container">
                <div class="date">

                    <?php echo date('M', strtotime($row['created_at'])); ?>

                    <?php echo date('d', strtotime($row['created_at'])); ?>

                </div>
                <div class="note">
                    <h1><?php echo $row['title'] ?></h1>
                    <p><?php echo $row['description'] ?></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    mysqli_close($link); // Closing Connection with Server
    ?>
</body>

</html>