<?php
session_start();
$id = $_SESSION['id'];

require_once "config.php";

if (isset($_POST['query'])) {

    $query = "SELECT * FROM notes WHERE user_id = $id AND title OR description LIKE '%{$_POST['query']}%'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($notes = mysqli_fetch_array($result)) {
?>
            <div class="note-container">
                <div class="date">

                    <?php echo date('M', strtotime($notes['created_at'])); ?>

                    <?php echo date('d', strtotime($notes['created_at'])); ?>

                </div>
                <div class="note">
                    <h1><?php echo $notes['title'] ?></h1>
                    <p><?php echo $notes['description'] ?></p>
                </div>

                <div class="cta">
                    <div class="edit">
                        <a href="./pages/update.php?id=<?= $notes['note_id'] ?>"><i class="ri-edit-line ri-fw"></i></a>
                    </div>
                    <div class="remove">
                        <a href="../server/deleteNote.php?id=<?= $notes['note_id'] ?>"><i class="ri-delete-bin-line"></i></a>
                    </div>
                </div>
            </div>
        <?php
        }
    } else { ?>
        <img class='no-data' src='../public/img/nodata.svg' />

<?php }
}
?>