function load() {
    // server response string goes into data
    data = '{"uname":"DogLover", "fname":"John", "dname":"Milo", "breed":"Schnauzer", "age":7, "act1":"Sleeping", "act2":"Eating", "act3":"Barking"}';
    obj = JSON.parse(data);
    document.getElementById("uname").innerHTML = obj.uname;
}