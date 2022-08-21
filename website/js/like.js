$("#like").click(function () {
    const element = document.querySelector(".heart")
    if( element.classList.contains("red-heart"))
    {
        var cinemaId=document.getElementById("cinemaId").value;
        var userid=     document.getElementById("userid").value;



        if (confirm('Sind Sie sicher?')) {
            $.ajax({
                url: "removelike.php",
                type: 'POST',
                data: {cinemaId:cinemaId,userid:userid},
                error: function () {
                    alert('es ist ein Fehler aufgetreten!');
                },
                success: function (data) {

                    $('.heart').removeClass('red-heart');


                }
            });
        }





    }else{

        var cinemaId=document.getElementById("cinemaId").value;
        var userid=     document.getElementById("userid").value;




        if (confirm('Sind Sie sicher?')) {
            $.ajax({
                url: "addCinemalike.php",
                type: 'POST',
                data: {cinemaId:cinemaId,userid:userid},
                error: function () {
                    alert('es ist ein Fehler aufgetreten!');
                },
                success: function (data) {

alert('add')
                    $('.heart').addClass('red-heart');


                }
            });}
    }





}  );
