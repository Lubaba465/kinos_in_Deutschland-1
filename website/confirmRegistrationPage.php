<?php

include "helper/sessionsHelper/sessionsHelper.php";
?>

<html>

<head>

</head>

<body>

<?php include "php/head.php" ?>
<?php include "php/navigation.php" ?>
<?php include "phpLogic/confirmRegistrationPageLogic.php" ?>

<div class="confirmReg-container">
    <div class="confirmReg-subContainer">
        <h1>Registrierung</h1>
        <p>
            <?php
            if(isset($userMSG)){echo $userMSG;}
            else{echo "Ein Fehler ist aufgetreten bitte versuch es nochmal";}
            ?>
        </p>

        <?php
        if(isset($_SESSION["isUserRegisted"]) && $_SESSION["isUserRegisted"] == true){
            ?>
            <a href="loginPage.php">Anmelden</a>
        <?php } else{ ?>
            <a href="registerUser.php">weiter registrieren</a>
        <?php } ?>
    </div>
</div>

<?php include "php/footer.php" ?>

</body>

</html>