var request;
var data;
// calls a server-side script for information to populate the HTML
function load(PHPscript) {
    request = new XMLHttpRequest();
    request.open("POST", PHPscript, true);
    request.addEventListener("readystatechange", requestReceived, false);
    request.send('');
}
// logs out
function logout(){
    window.open("logout", "_self");
}