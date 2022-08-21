<?php
/*include "helper/dummyDataHelper/cinemaDummyData.php"; */

include "phpLogic/userDetailHomePageLogic.php";?>

<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="css/userDetailHomePage.css">
</head>

<body>
<?php include "php/head.php";?>
<?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1){?>

    <?php include "php/navigation.php" ?>
    <div class="user-container">


        <div class=" movie-container ">
            <?php

            if (isset($_SESSION['userId'])) {

                ?>

                <div class="cinema-container">

                    <?php

                    foreach ($cinemas as $cinema) {
                        ?>

                        <form class="myForm" method="get" action="addOrEditCinemaPage.php">
                            <button class="submitbutton" name="update" type="submit">
                                <input type="hidden" name="id" value="<?php echo $cinema['cinemaId']; ?>">


                                <div class="movie-item">

                                    <a onclick="changeAction()">

                                        <img src="<?php echo $cinema['cinemaImage'] ?>"/>

                                    </a>

                                    <a class="icon"> <i class="far fa-edit" value="edit"></i></a>
                                    <div class="icon-trash">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="input-field" value="" name="delete"/>


                                    </div>
                                </div>


                            </button>

                        </form>
                        <script>
                            function changeAction() {

                                var actionurls = document.getElementsByClassName("myForm");

                                for (let i = 0; i < actionurls.length; i++) {
                                    const actionurl = actionurls[i];
                                    actionurl.action = "userDetailMoviePage.php";

                                }
                            }
                        </script>

                    <?php } ?>

                </div>


            <?php } ?>

            <div class="addbutton">

                <a href="addOrEditCinemaPage.php" class="" aria-disabled="false">kino hinzufügen</a>

            </div>

        </div>

    </div>
    <?php include "php/footer.php" ?>

<?php } else{ header("Location:error.php"); }?>



</body>

</html>

<script>
    function changeAction() {

        var actionurls=  document.getElementsByClassName("myForm");

        for (let i = 0; i < actionurls.length; i++) {
            const actionurl = actionurls[i];
            actionurl.action = "userDetailMoviePage.php";

        }
    }
</script>