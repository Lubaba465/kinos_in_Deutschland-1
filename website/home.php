<div class="container">

    <div class="slideshow-container" id='slideshowimage'>

        <br>
        <script src="js/slideshows.js"></script>

        <div class="slideshow-image">

            <?php foreach ($imgList as $media) {
                if (isset($media['cinemaImage'])) {
                    ?>
                    <img class="slide" src="<?php echo $media['cinemaImage']; ?>">
                    <?php
                }
            }
            ?>

        </div>

    </div>
    <script src="js/slideshowbackground.js"></script>



    <form method="get" action="cinemaOverviewPage.php">
        <?php $_SESSION['cinema'] = $cinema['cinemaId']; ?>

        <input type="hidden" id="cinemaId" name="id" value="<?php echo $cinema['cinemaId']; ?>">
        <input type="hidden" id="userid" name="userid"
               value="<?php if (isset($_SESSION['userId'])) echo $_SESSION['userId']; ?>">

        <div class="topCinema-container">
            <div class="cinemacontainer">

                <div class="topcinemacontainer">

                    <h1 class="title"><span>The last viewed Cinema</span></h1>

                    <div class="topcinema">

                        <button class='submitbutton'>
                            <a href="cinemaOverviewPage.php">

                                <img alt="" src="<?php echo $cinema['cinemaImage']; ?>">

                            </a>
                        </button>


                    </div>

                </div>

                <div class="textbeschreibung">

                    <p><?php echo $cinema['cinemaName']; ?></p>

                    <br>

                    <p>
                        <?php echo $cinema['description']; ?>
                    </p>
                    <?php if (isset($_SESSION['isLoggedIn'])) { ?>
                        <?php if ($cinemadao->getCinemaLike($_SESSION['userId'], $cinema['cinemaId']) === true) { ?>

                            <div class="like" id="like">

                                <i class="fas fa-heart heart red-heart"></i>
                            </div>
                        <?php } else {

                            ?>

                            <div class="like" id="like">
                                <i class="fas fa-heart heart"></i>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>

                <div class="allcinema">

                    <a href="allCinema.php" aria-disabled="false">SEE MORE CINEMA</a>

                </div>

            </div>

        </div>
    </form>

    <script src="js/like.js"></script>

</div>

<section class="googlemap">

    <?php include('map.php') ?>

</section>


