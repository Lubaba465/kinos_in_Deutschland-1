<?php

include "phpLogic/userDetailMoviePageLogic.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="css/userDetailMoviePages.css">
</head>

<body>

<?php include "php/head.php"; ?>
<?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) { ?>

    <?php include "php/navigation.php" ?>

    <div class="user-container">

        <div class="movie-container">

            <div class="cinema-container">

                <?php foreach ($movies as $movie) { ?>

                    <form method="get" action="addOrEditMoviePage.php">

                        <button class='submitbutton' type="submit">
                            <input type="hidden" name="movieId" value="<?php echo $movie['movieId']; ?>">

                            <div class="movie-item">

                                <a onclick="changeAction()">

                                    <img src="<?php echo $movie['movieImage'] ?>"/>

                                </a>

                                <a class="icon"> <i class="far fa-edit" value="edit"></i></a>
                                <div class="icon-trash">
                                    <i class="far fa-trash-alt"></i>
                                    <input type="submit" class="input-field" value="" name="delete"/>


                                </div>
                            </div>


                        </button>

                    </form>
                    <script type="javascript" src="js/changeaction.js">
                    </script>

                <?php } ?>

            </div>

            <div class="addbutton">

                <a href="addOrEditMoviePage.php" class="" aria-disabled="false">Film hinzufügen</a>

            </div>

        </div>

    </div>

    <?php include "php/footer.php" ?>

<?php } else {
    header("Location:error.php");
} ?>

</body>


</html>