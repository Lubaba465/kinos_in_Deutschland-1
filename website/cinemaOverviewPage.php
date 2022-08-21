<?php include "phpLogic/cinemaOverviewPageLogic.php" ?>
<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="css/cinemaoverviewPagesl.css">
</head>

<body>

<?php include "php/head.php" ?>
<?php include "php/navigation.php" ?>


<div id='slideshowimage' class="slideshow-container">

    <div>

    </div>


    <div class="slideshow-image">

        <img id='slideimag' src="<?php echo $cinemas['cinemaImage'] ?>"/>

    </div> <?php if (isset($_SESSION['isLoggedIn'])) { ?>

        <?php if ($cinemadao->getCinemaLike($_SESSION['userId'], $cinemas['cinemaId']) === true) { ?>

            <div class="like" id="like">

                <i class="fas fa-heart heart red-heart"></i>
            </div>
        <?php } else {?>
            <div class="like" id="like">
                <i class="fas fa-heart heart"></i>
            </div>
        <?php } ?>

    <?php } ?>
</div>

<hr>

<div class="description-container">

    <div>

        <h3>Kino Name:</h3>

        <p>
            <?php echo $cinemas['cinemaName'] ?>
        </p>

    </div>

    <div>

        <h3>Beschreibung:</h3>

        <p>
            <?php echo $cinemas['description'] ?>
        </p>

    </div>

    <div>

        <h3>Adresse:</h3>

        <p>
            <?php echo $cinemas['cinemaStreetName'] . " " . $cinemas['cinemaStreetNumber'] ?>
            <?php echo $cinemas['cinemaZipCode'] . " " . $cinemas['cityName'] ?>
            <?php echo $cinemas['state'] ?>
        </p>

    </div>

</div>

<div class="description-container">

    <form method="post" action="commentsave.php">

        <div>
            <input type="hidden" id="cinemaId" value="<?php echo $cinemaid; ?>" name="cinemaid">
            <input type="hidden" id="userid" value="<?php echo $userid; ?>" name="userid">

            <textarea name="comment" class="comment" placeholder="Kommentar zum Kino"></textarea>

        </div>

        <button name="newComment" class="btn">speichern</button>

    </form>

</div>
<div class="description-container">


    <?php foreach ($cinemaComments as $id => $cinemaComment) {

        $userCommentID = $cinemaComment['userId'];
        $user = $userdao->getUser($userCommentID);

        ?>

        <h3><?php echo isset($user['name']) ? $user['name'] : 'anonym'; ?></h3>
        <p><?php echo $cinemaComment['comment'] ?></p>
    <?php } ?>

</div>


<div>

    <div class=" movie-container">

        <div class="cinema-container">

            <?php

            foreach ($movies as $id) {
                if ($id['cinemaId'] == $cinemas['cinemaId']) { ?>

                    <form method="get" action="movieOverviewPage.php">

                        <input type="hidden" name="movieid" value="<?php echo $id['movieId']; ?>">

                        <button class="submitbutton" name="update" type="submit">
                            <a href="movieOverviewPage.php">
                                <img src="<?php echo $id['movieImage'] ?>" height="200" width="200"/>
                            </a></button>
                    </form>

                <?php }
            } ?>


        </div>
    </div>

</div>
<script src="js/like.js"></script>
<script src="js/cinema_background.js"></script>

<?php include "php/footer.php" ?>
</body>

</html>

