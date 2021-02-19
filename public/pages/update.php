<?php include "../../server/updateNote.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <!-- UPDATE -->
    <span><?php echo $title_err; ?></span>
    <span><?php echo $description_err; ?></span>
    <div class="note-modal">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <input type="text" name="title" value="<?php echo $title ?>" placeholder="title">
            <textarea id="textArea" type="text" name="description"><?php echo $description ?></textarea>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit">submit</button>
        </form>
    </div>
</body>

</html>