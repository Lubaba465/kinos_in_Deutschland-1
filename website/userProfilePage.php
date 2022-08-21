<?php

include "phpLogic/userProfilePageLogic.php";
include "helper/messageHelper.php";
?>

<?php if ($loggedInUser != null && isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) { ?>
    <!DOCTYPE html>
    <html lang="de">

    <style>
        <?php include 'CSS/forms.css';?>
    </style>

    <body>

    <?php include "php/head.php"; ?>
    <?php include "php/navigation.php" ?>


    <div id="inputsDivs" class="myForm">
        <?php if (isset($usermsg) && isset($msgTitle)) {
            MessageHelper::messageHandler($msgTitle, $usermsg);
        } ?>
        <form method="post">
            <div class="form">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" placeholder="Name eintragen" required
                       value="<?php if ($loggedInUser !== null) echo $loggedInUser['name']; ?>">

                <label for="email"><b>E-Mail</b></label>
                <input type="text" placeholder="E-Mail eingeben" disabled
                       value="<?php if ($loggedInUser !== null) echo $loggedInUser['email']; ?> ">

                <label for="psw"><b>Passwort</b></label>
                <input type="password" name="psw" placeholder="Passwort eintragen" required
                       value="<?php if ($loggedInUser !== null) echo "••••••••"; ?>">

                <label for="pswb"><b>Passwort bestätigen</b></label>
                <input type="password" name="pswb" placeholder="Passwort bestätigen" required
                       value="<?php if ($loggedInUser !== null) echo "••••••••"; ?>">

                <input type="checkbox" name="deleteUserCheckBox">
                <label for="deleteUserCheckBox"><b><u>Konto löschen!!</u></b></label>

                <button name="submitBtn" type="submit">speichern</button>
            </div>
        </form>
    </div>

    <?php include "php/footer.php" ?>

    </body>

    </html>


<?php } else {
    header("Location:error.php");
} ?>
