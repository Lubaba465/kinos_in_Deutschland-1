<?php include "phpLogic/movieOverviewPageLogic.php" ?>
<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="css/movieOverviewPages.css">
</head>

<body>

<?php include "php/head.php" ?>
<?php include "php/navigation.php" ?>

<div id='slideshowimage' class="slideshow-container">

    <div class="slideshow-image">

        <img id="slideimag" src="<?php echo $movies['movieImage'] ?>"/>

    </div>

</div>

<hr>

<div>

    <div class="description-container">

        <h3>Film Name:</h3>

        <p>
            <?php echo $movies['movieName'] ?>
        </p>

    </div>

    <div class="description-container">

        <h3>Beschreibung:</h3>

        <p>
            <?php echo $movies['description'] ?>
        </p>

    </div>

    <div class="description-container">

        <h3>Preis:</h3>

        <p><?php echo $movies['price'] . " €" ?></p>

    </div>

    <div class="description-container">

        <h3>Erscheinungsdatum:</h3>

        <p><?php echo $movies['releaseDate'] ?></p>

    </div>

    <div class="description-container">

        <h3>Sprache:</h3>

        <p><?php echo $movies['language'] ?></p>

    </div>

</div>

<?php include "php/footer.php" ?>

</body>

</html>


<script>
    var bild = document.getElementById('slideshowimage');

    var slide = document.getElementById('slideimag').src;
    bild.style.backgroundImage = 'url(' + slide + ')';
</script>