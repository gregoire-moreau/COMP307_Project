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