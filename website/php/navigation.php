<!DOCTYPE html>
<html>

<link rel="stylesheet" href="css/navigation.css">

<body>

<nav>
    <div class="topnav" id="myTopnav">
        <a class="active logo" href="index.php"><img src="./ressources/images/logo.png" alt=""></a>
        <?php
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==true){
        ?>
            <a  href="userDetailHomePage.php">Meine Kinos</a>
            <a  href="userProfilePage.php">Profil</a>
            <a href="logoutPage.php">Abmelden</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <?php
        }
        else{
            ?>
            <a href="loginPage.php">Anmelden</a>
            <a  href="registrationPage.php">Registrierung</a>
            <a href="#" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        <?php }
        ?>

    </div>
</nav>

<script src="js/menu.js">

</script>

</body>
</html>