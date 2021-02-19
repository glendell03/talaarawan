<?php include "../server/createNote.php" ?>
<?php include "../server/readNote.php" ?>

<?php
session_start();
if ($_SESSION["loggedin"] === false) {
    header("location: auth/login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaarawan</title>
    <link rel="stylesheet" href="./css/index.css">
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

    <!-- SEARCH -->
    <div class="searchbar">

        <input type="search" name="search" id="search" placeholder="Search notes">

        <div class="select-wrapper">
            <div class="vLine"></div>
            <select name="month" id="month">
                <option value="Month">MM</option>
                <option name="January" value="Jan">January</option>
                <option name="February" value="Feb">February</option>
                <option name="March" value="Mar">March</option>
                <option name="April" value="Apr">April</option>
                <option name="May" value="May">May</option>
                <option name="June" value="Jun">June</option>
                <option name="July" value="Jul">July</option>
                <option name="August" value="Aug">August</option>
                <option name="September" value="Sep">September</option>
                <option name="October" value="Oct">October</option>
                <option name="November" value="Nov">November</option>
                <option name="December" value="Dec">December</option>
            </select>
            <div class="vLine"></div>
            <select name="year" id="year">
                <option>YY</option>
                <option value="2020">2021</option>
                <option value="2020">2020</option>
            </select>
        </div>
    </div>

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