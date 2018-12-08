function load() {
    // post username to server, receive data

    data = '{"fname":"John", "dname":"Milo", "breed":"Schnauzer", "age":7, "act1":"Sleeping", "act2":"Eating", "act3":"Barking"}';
    obj = JSON.parse(data);
}