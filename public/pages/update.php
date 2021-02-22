<?php include "../../server/updateNote.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="../css/update.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <!-- UPDATE -->
    <span><?php echo $title_err; ?></span>
    <span><?php echo $description_err; ?></span>
    <div class="note-modal">
        <h1>Update Note</h1>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="input-wrapper">
                <input class="update-input" type="text" name="title" value="<?php echo $title ?>" placeholder="Title">
                <textarea class="update-tarea" type="text" name="description"><?php echo $description ?></textarea>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="update-btn-container">
                    <a href="../index.php">
                        <div class="left-container">
                            <i class="ri-arrow-left-line ri-lg"></i>
                        </div>
                    </a>
                    <button type="submit" class="update-btn">Update</button>
                </div>
        </form>
    </div>
</body>

</html>