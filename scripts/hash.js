function hash(password) {
    var msg = password;
    var interim = "";
    var hashed = "";

    var i;
    var prev = 0;
    var salt = false;
    for (i = 0; i < msg.length; i++) {
        var code = msg.charCodeAt(i);
        interim += code.toString();
        if (salt) {
            interim += prev.toString(); // "salt" the string by deterministically adding extra characters
            salt = false;
        } else {
            prev = (prev+code)%10;
            salt = true;
        }
    }
    var j;
    for (j = 0; j*2 < interim.length; j++) {
        var n = interim[2*j] + interim[2*j+1];
        if (n <= 26) {
            n += 100;
        } else {
            n += 6;
        }
        while (n > 126) {
            n = n%126;
            n += 33;
        }
        var c = String.fromCharCode(n);
        hashed += c;
    }
    var first = hashed.slice(0, 4);
    var second = hashed.slice(-5, -1);
    return first.concat(second);
}