function formatAsJSON(a1, a2) {
    //a1 contains variable names, a2 contains corresponding data, lengths must agree
    if (a1.length != a2.length) {
        if (console) {
            console.log("The lengths of two arrays sent to formatAsJSON() did not match.");
            return null;
        }
    }
    //example json: '{"name":"John", "age":31, "city":"New York"}'
    var json = '{';
    var i;
    for (i = 0; i < a1.length; i++) {
        json += '"' + a1[i] + '":"' + a2[i] + '"';
        if (i+1 < a1.length) {
            json += ', ';
        }
    }
    json += '}';
    return json;
}

var key = [5, 1, 4];

function encrypt(var str) {
    var ciphered = "";
    let j = 0;
    for (let i = 0; i < str.length; i++) {
        var ascii = str.charCodeAt(i);
        if (j >= key.length) {
            j = 0;
        }
        ascii += key[j];
        ascii = ascii%127;
        ciphered = ascii.toString() + ciphered;
        j++;
    }
    return ciphered;
}

function decrypt(var str) {
    var deciphered = "";
    let j = 0;
    for (let i = str.lentgh-1; i >= 0; i--) {
        var ascii = str.charCodeAt(i);
        if (j >= key.length) {
            j = 0;
        }
        ascii -= key[j];
        while (ascii < 0) {
            ascii += 127;
        }
        deciphered = ascii.toString() + deciphered;
        j++;
    }
    return deciphered;  
}