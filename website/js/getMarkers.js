function getMarkers (){

    $.ajax({
        type: "GET",
        url: "getMarkers.php",
        async: true,
        success: function (data) {
            var jsondata = JSON.parse(data);
            for (var i = 0; i < jsondata.cinemas.length; i++) {
                var popup = "<div> " + jsondata.cinemas[i].name + "</b> <br> <img style='height: 100px' src='" + jsondata.cinemas[i].path + "'> " +
                    "<br> <a  href='./cinemaOverviewPage.php?id=" + jsondata.cinemas[i].id + "&userid=" + jsondata.cinemas[i].userId + "' style='color: black!important;' " +
                    ">mehr info</a> </div>";
                addMarker(layer_markers, parseFloat(jsondata.cinemas[i].longitude), parseFloat(jsondata.cinemas[i].latitude), popup);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(
                getMarkers(), /* Try again after.. */
                1000); /* milliseconds */
        }
    });

}
