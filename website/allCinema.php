<?php include "phpLogic/allCinemaLogic.php"?>
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="css/allCinema.css">
</head>

<body>

    <?php include "php/head.php" ?>
    <?php include "php/navigation.php" ?>

    <div class="allcinema-container">
        <h1 class="allcinemalabel"><span>Alle Kinos</span></h1>

        <div class="search-container">

            <div class="input">

                <form method="get">

                    <input type="search"   id="search_text" class="search" name="searchInput" placeholder="Suche nach Kinos bitte nach Namen oder Bundesland...">
                    <span class="red-input"></span>
                    <button class='searchbutton' id="result"  name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

            </div>
            <script src="js/search.js"></script>

        </div>

        <div class="wrapper">


            <div class="three">
                <?php foreach ($cinemas as $id => $cinema){?>
                    <?php if(isset($cinema['cinemaId'])){ ?>
                        <form method="get" action="cinemaOverviewPage.php">

                            <div class="box section1">

                                <div class="cinemadescription">
                                    <input type="hidden" id='cinemaId' name="id" value="<?php echo $cinema['cinemaId']; ?>">
                                    <input type="hidden" id="userid" name="userid" value="<?php if(isset($_SESSION['userId'])) echo $_SESSION['userId']; ?>">


                                    <input class="cinemaname" type="hidden" value="<?php echo $cinema['cinemaName']?>">
                                    <p class="cinemaname" value="<?php echo $cinema['cinemaName']?>"> <?php echo $cinema['cinemaName']?></p>
                                    <p class="cinemaname"> <?php echo $cinema['description']?></p>


                                </div>

                                <div>
                                    <button class="submitbutton" name="update">
                                        <a href="cinemaOverviewPage.php">
                                            <img class="responsive" src="<?php echo $cinema['cinemaImage'];?>"> </a>
                                    </button>
                                </div>

                            </div>
                        </form>
                    <?php }?>
                <?php }?>
            </div>


        </div>

    </div>
<script>
        const boxes = document.querySelectorAll('.box')
        window.addEventListener('scroll', checkBoxes)
        checkBoxes()

        function checkBoxes() {

            const triggerBottom = window.innerHeight * 0.8

            boxes.forEach(box => {
                const boxTop = box.getBoundingClientRect().top
                if (boxTop < triggerBottom) {
                    box.classList.add('show')
                } else {
                    box.classList.remove('show')
                }
            })
        }
    </script>
    <script src="js/like.js"></script>

    <?php include "php/footer.php" ?>

</body>


</html>