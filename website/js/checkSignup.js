function checkPassword() {

    var password = document.getElementById("password");
    var confirmedPassword = document.getElementById("confirmedPassword");
    var message = document.getElementById("message");

    var match = "green";
    var notMatch = "red";

    if (password.value == "" || confirmedPassword.value == "") {
        rePasswordmessage.innerHTML =
            "";
    } else {

        if (confirmedPassword.value == password.value) {

        message.style.color = match;
       message.innerHTML = "Passwort ist identisch!";
        } else {
        message.style.color = notMatch;
          message.innerHTML = "Passwort ist nicht identisch!";
        }

    }
}


function checkName(Name) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("checkName").innerHTML =
                this.responseText;
            document.getElementById("checkName").style.color = "red";

        }
    };
    xhttp.open("GET", "getName.php?name=" + Name, true);
    xhttp.send();
}

function validatePassword(password) {

    if (password.length === 0) {
        document.getElementById("passwordmessage").innerHTML = "";
        return;
    }

    var pattern = new Array();
    pattern.push("[._-]");
    pattern.push("[A-Z]");
    pattern.push("[0-9]");
    pattern.push("[a-z]");

    //Check and display conditions
    var counter = 0;
    for (var i = 0; i < pattern.length; i++) {
        if (new RegExp(pattern[i]).test(password)) {
            counter++;
        }
    }

    var color = "";
    var strength = "";

    if (password.length < 8) {
        color = "red";
        strength = "Passwort zu kurz";
    } else {

        switch (counter) {
            case 0:
            case 1:
            case 2:
                strength = "Sehr schwach";
                color = "red";
                break;
            case 3:
                strength = "Mittel";
                color = "orange";
                break;
            case 4:
                strength = "Stark";
                color = "green";
                break;
        }
    }

    document.getElementById("passwordmessage").innerHTML = strength;
    document.getElementById("passwordmessage").style.color = color;
}
