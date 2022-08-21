<!DOCTYPE html>
<html lang="de">
<?php
include "phpLogic/addOrEditMoviePageLogic.php";
include "helper/messageHelper.php";
?>

<link rel="stylesheet" href="css/forms.css">

<body>
<?php include "php/head.php" ?>
<?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) { ?>

    <?php include "php/navigation.php" ?>

    <?php

    require_once("DAO/interfaces/iMovieDAO.php");

    if (isset($_GET["delete"])) {
        $movieId = (isset($_GET["movieId"]) && is_string($_GET["movieId"])) ? $_GET["movieId"] : "0";

        $moviedao->deleteMovie($movieId);?>
        <div class="myForm">
            <h1>Der Eintrag wurde gelöscht!</h1>
        </div>


    <?php } else {
        echo $cinemaid; ?>

        <div class="myForm">
            <?php if (isset($usermsg) && isset($msgTitle) && !empty($usermsg) && !empty($msgTitle)) {
                MessageHelper::messageHandler($msgTitle, $usermsg);
            } ?>

            <form method="post" enctype="multipart/form-data">


                <h1>Neuen Film hinzufügen oder bearbeiten</h1>
                <div class="form">
                    <label for="name"><b>Name des Films</b></label>
                    <input type="text" required placeholder="Name eintragen" name="movieName"
                           value="<?php echo $movieName; ?>">

                    <label for="nr"><b>Preis</b></label>
                    <input type="number" required step="0.01" placeholder="Preis eintragen" name="price"
                           value="<?php echo $price; ?>">

                    <label for="erschd"><b>Erscheinungsdatum</b></label>
                    <input type="date" required placeholder="Erscheinungsdatum eintragen" name="releaseDate"
                           value="<?php echo $releaseDate; ?>">

                 <br><br><br>  <label for="spr"><b>Sprache</b></label>
                    <input type="text" required placeholder="Sprache eintragen" name="language"
                           value="<?php echo $language; ?>">

                    <label for="beschr"><b>Beschreibung</b></label><br>
                    <textarea name="description" required
                              placeholder="Beschreibung eintragen"><?php echo $description; ?></textarea><br><br>

                    <label class="content-grid"><b>Media</b></label><br>
                    <input type="file" name="image" required/> <br> <br>

                    <input class="addbutton" id="<?php echo $cTransName; ?>" name="<?php echo $cTransName; ?>"
                           type="submit" value="<?php echo $cTransType; ?>">
                </div>
            </form>

        </div>
    <?php } ?>

    <?php include "php/footer.php" ?>

<?php } else {
    header("Location:error.php");
} ?>
</body>

</html>


<?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) { ?>

<?php } else {
    header("Location:error.php");
} ?>