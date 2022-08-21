function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
    var navbar = document.getElementById('myTopnav');

    window.onscroll = function() {
    if (window.pageYOffset > 0) {
    navbar.classList.add('scrolled');
} else {
    navbar.classList.remove('scrolled');
}
}
