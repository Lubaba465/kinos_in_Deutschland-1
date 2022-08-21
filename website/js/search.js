$(function () {
    var suggestions = [];
    var elements = document.getElementsByClassName('cinemaname');

    for (let i = 0; i < elements.length; i++) {


        if (elements[i].value != null) {
            suggestions[i] = '' + elements[i].value;
        } else {
            suggestions[i] = '';
        }


    }

    $('#search_text').autocomplete({
        source: suggestions,
        minLength: 2

    });

});
