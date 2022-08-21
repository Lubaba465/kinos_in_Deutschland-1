var i = 0;
var images = [];
var slideTime = 1950;
var elements = document.getElementsByClassName('slide');

for (let i = 0; i < elements.length; i++) {
    images[i] = elements[i].src;

}

function changePicture() {
    document.getElementById('slideshowimage').style.backgroundImage = "url(" + images[i] + ")";

    if (i < images.length - 1) {
        i++;
    } else {
        i = 0;
    }
    setTimeout(changePicture, slideTime);
}

window.addEventListener('load', changePicture);


