// takes two arrays (variable names, data) and combines them in a JSON-formatted string
function formatAsJSON(a1, a2) {
    // array lengths must agree
    if (a1.length != a2.length) {
        if (console) {
            console.log("The lengths of two arrays sent to formatAsJSON() did not match.");
            return null;
        }
    }
    var json = '{';
    var i;
    for (i = 0; i < a1.length; i++) {
        json += '"' + a1[i] + '":"' + a2[i] + '"';
        if (i+1 < a1.length) {
            json += ', ';
        }
    }
    json += '}';
    var encrypted = encrypt(json);
    return encrypted;
}
// key for encryption: the Montreal area code 
var key = [5, 1, 4];
// block encrypts and inverts a given string
function encrypt(str) {
    var ciphered = "";
    let j = 0;
    for (let i = 0; i < str.length; i++) {
        var ascii = str.charCodeAt(i);
        if (j >= key.length) {
            j = 0;
        }
        ascii += key[j];
        ascii = ascii%127;
        ciphered = String.fromCharCode(ascii) + ciphered;
        j++;
    }
    return ciphered;
}
// block decrypts and inverts a given string
function decrypt(str) {
    var deciphered = "";
    let j = 0;
    for (let i = str.length-1; i >= 0; i--) {
        var ascii = str.charCodeAt(i);
        if (j >= key.length) {
            j = 0;
        }
        ascii -= key[j];
        while (ascii < 0) {
            ascii += 127;
        }
        deciphered = deciphered + String.fromCharCode(ascii);
        j++;
    }
    return deciphered;  
}