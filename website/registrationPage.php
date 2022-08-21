<!DOCTYPE html>
<html lang="de">

<?php
      include "phpLogic/registrationPageLogic.php";
      include "helper/messageHelper.php";
?>


<head>
    <link rel="stylesheet" href="css/forms.css">
</head>

<body>

    <?php include "php/head.php" ?>
    <?php include "php/navigation.php" ?>
    <script src="js/checkSignup.js"></script>



    <br>

    <div class="myForm">
        <?php if (isset($usermsg) && isset($msgTitle)) {
            MessageHelper::messageHandler($msgTitle, $usermsg);
        } ?>
        <form method="post">
            <h1 >Registrierung</h1>
            <div class="form">
            <label for="name"><b>Name</b></label>
            <input type="text" name="name" placeholder="Name eingeben" onkeyup="checkName(this.value)">
            <p id="checkName" onkeyup="validatePassword(this.value);"></p>

            <label for="email"><b>E-mail</b></label>
            <input type="email" name="email" placeholder="E-Mail eingeben">

            <label for="password"><b>Passwort</b></label>
            <input type="password" id="password" name="password" onkeyup="validatePassword(this.value),checkPassword()"
                   placeholder="Passwort eingeben">
            <p id="passwordmessage" onkeyup="validatePassword(this.value);"></p>
            <label for="confirmedPassword"><b>Passwort bestätigen</b></label>
            <input type="password" onkeyup="checkPassword();" id="confirmedPassword" name="confirmedPassword"
                   placeholder="Passwort bestätigen">
            <p id="message" onkeyup="checkPassword();"></p>
                <button name="signup" type="submit">Registrieren</button>

                <label><input type="checkbox" name="terms" required>
                    <a href="terms.php" target="_blank">Nutzungsbedingungen</a> akzeptieren
                </label>
                <br>
                <label><input type="checkbox" name="privacy" required>
                    <a href="privacy.php" target="_blank">Datenschutzerklärung</a> akzeptieren
                </label>

            </div>
        </form>
    </div>
    <br>

    <?php include "php/footer.php" ?>

</body>

</html>