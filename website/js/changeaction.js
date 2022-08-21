function changeAction() {

    var actionurls = document.getElementsByClassName("myForm");

    for (let i = 0; i < actionurls.length; i++) {
        const actionurl = actionurls[i];
        actionurl.action = "addOrEditMoviePage.php";

    }
}