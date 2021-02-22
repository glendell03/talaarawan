<?php include "../server/createNote.php" ?>
<?php include "../server/deleteNote.php" ?>

<?php
session_start();
if ($_SESSION["loggedin"] === null) {
    header("location: auth/login.php");
    exit;
} else {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<he <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaarawan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/searchs.css">
    <link rel="stylesheet" href="./css/notes.css">
    <link rel="stylesheet" href="./css/new.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/search1.js"></script>
    </head>

    <body>
        <nav>
            <h1 class="logo">Talaarawan</h1>
            <div class="sign-out">
                <ul>
                    <li> <a href="../server/logout.php">Signout</a></li>
                </ul>
            </div>
        </nav>
        <section>

            <div class="header-wrapper">

                <div class="header-container">
                    <h2 class="header">Welcome! <?php echo $name ?> </h2>
                    <h3 class="sub-header">How's your day today?</h3>
                </div>

                <button onclick="showHide()" class="search-button">
                    <i class="ri-search-line"></i>
                    <p>SEARCH</p>
                </button>

                <!-- SEARCH -->

                <div scroll="no" class="searchbar-container" id="show" style="display: none;">
                    <button class="close" onclick="!showHide()"><i class="ri-close-circle-line"></i></button>
                    <div class="searchbar">
                        <i class="ri-search-line"></i>

                        <input type="search" autocomplete="false" name="search" id="search" placeholder="Search notes">

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
                    <div class="result-wrapper">
                        <div class="result" id="result">
                        </div>
                    </div>
                </div>
            </div>

            <div class="new-note-wrapper">
                <button onclick="modal()" class="new-note-btn">
                    <i class="ri-chat-new-line"></i>
                    <p>NEW NOTE</p>
                </button>
            </div>

            <div class="create-wrapper" id="showModal" style="display: none;">
                <div class="background">
                    <form class="new-note-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="input-group">
                        <div class="new-head">
                            <input type="text" class="new-title" placeholder="Title" name="title" value="<?php echo $title ?>" />
                            <input type="date" class="datedesign" id="myDate" />
                        </div>
                        <textarea type="text" class="new-text-area" placeholder="Start your story here :)" name="description"><?php echo $description ?></textarea>
                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                        <div class="button-wrapper">
                            <button type="button" onclick="!modal()" class="cancel-btn">
                                <i class="ri-close-circle-line"></i>Discard
                            </button>
                            <button type="submit" class="submit-btn">
                                <i class="ri-save-line"></i>Save and close
                            </button>
                        </div>
                    </form>
                </div>
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
                        echo "<img src='./img/addnote.svg' />";
                    }
                    ?>
                <?php
                }
                ?>
            </div>
        </section>
    </body>

</html>