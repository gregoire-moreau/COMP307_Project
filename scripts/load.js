var request;
var data;

function load(PHPscript) {
    request = new XMLHttpRequest();
    request.open("POST", PHPscript, true);
    request.addEventListener("readystatechange", requestReceived, false);
    request.send('');
}