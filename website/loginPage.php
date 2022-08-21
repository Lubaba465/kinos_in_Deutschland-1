<?php
include "phpLogic/loginPageLogic.php";
include "helper/messageHelper.php";
?>
<!DOCTYPE html>
<html lang="de">

<link rel="stylesheet" href="CSS/forms.css">

<body>
<?php include "php/head.php" ?>
<?php include "php/navigation.php" ?>

<br>

<div class="myForm">
    <?php if (isset($usermsg) && isset($msgTitle)) {
        MessageHelper::messageHandler($msgTitle, $usermsg);
    } ?>

    <form method="post">
        <h1>Anmelden</h1>

        <div class="form">


            <label for="email"><b>E-Mail</b></label>
            <input type="email" placeholder="E-Mail eingeben" name="email" required>

            <label for="userPassword"><b>Passwort</b></label>
            <input type="password" placeholder="Passwort eingeben" name="userPassword" required>

            <button name="loginButton" type="submit">Anmelden</button>

        </div>

    </form>
</div>
<br>

<?php include "php/footer.php" ?>

</body>

</html>

