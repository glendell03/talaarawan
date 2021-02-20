<?php include "../server/createNote.php" ?>
<?php include "../server/deleteNote.php" ?>

<?php
session_start();
if ($_SESSION["loggedin"] === null) {
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
    <style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
body{
    font-family: 'Nunito', sans-serif;
}
*{
    margin: 0;
    padding: 0;
    list-style: none;
    text-decoration: none;
}
nav{
    height: 80px;
    background: #87D1B8;
}
h1{
    font-family: 'Pacifico', cursive;
    font-size: 45px;
    color: #f5f4f4;
    position: absolute;
    top: 5px;
    left: 12%;
}
h2{
    font-family: 'Pacifico', cursive;
    font-size: 60px;
    color: #00303f;
    position: absolute;
    top: 125px;
    left: 8%;
}
h3{
    font-family: 'Nunito', sans-serif;
    color: black;
    font-size: 30px;
    position: absolute;
    top: 220px;
    left: 9%;
}
nav ul{
    float: right;
    margin-right: 25px;
}
nav ul li{
    display: inline-block;
    line-height: 80 px;
    margin: 0 , 15 px;
}
nav ul li a{
    position: relative;
    top: 30px;
    color: #f5f4f4;
    font-size; 18px;
    padding: 5px , 0;
    text-transform: uppercase;
    border: 10px solid;
    border-radius: 5px;
    border-color: #00303f;
    background-color: #00303f;
}
nav ul li a:before{
    position: absolute;
    content: '';
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background:#f5f4f4;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform .4s linear;
}
nav ul li a:hover:before{
    transform: scaleX(1);
    transform-origin: left; 
}
        </style>
</head>
<body>
<nav>
        <h1>Talaarawan</h1>
        <ul>
            <li> <a href="#">Log Out</a></li>
        </ul>
    </nav>
    <h2>Welcome!</h2>
    <h3>How's your day today?</h3>
</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaarawan</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <button><a href="../server/logout.php">Signout</a></button>
    <!-- DIARY -->

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


    <div class="note-modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="title" value="<?php echo $title ?>" placeholder="title">
            <textarea id="textArea" type="text" name="description"><?php echo $description ?></textarea>
            <input type="hidden" name="id" value="<?php echo $id = $_SESSION['id']; ?>" />
            <button type="submit">submit</button>
        </form>
    </div>


    <!-- NOTE -->
    <div class="note-wrapper">
        <?php
        $sql = "SELECT * FROM notes WHERE user_id=$id";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
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

                        <div class="cta">
                            <div class="edit">
                                <a href="./pages/update.php?id=<?= $row['note_id'] ?>"><i class="ri-edit-line ri-fw"></i></a>
                            </div>
                            <div class="remove">
                                <a href="../server/deleteNote.php?id=<?= $row['note_id'] ?>"><i class="ri-delete-bin-line"></i></a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php
            } else {
                echo "No log";
            }
            ?>
        <?php
        }
        ?>
    </div>

</body>
<script src="./js/index.js"></script>

</html>