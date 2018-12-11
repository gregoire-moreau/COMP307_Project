function showProfile(dname, breed, age, act1, act2, act3, image) {
    var title = dname + "'s Profile";
    var win = window.open("showprofile.html", 'Profile', "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=" + screen.width + ",height="+ screen.height);
    
    win.onload = function() {
        win.document.getElementById("dname").innerHTML = dname;
        win.document.getElementById("name").innerHTML = dname; 
        win.document.getElementById("breed").innerHTML = breed;
        win.document.getElementById("age").innerHTML = age;
        win.document.getElementById("act1").innerHTML = act1;
        win.document.getElementById("act2").innerHTML = act2;
        win.document.getElementById("act3").innerHTML = act3;
        win.document.getElementById("photo").setAttribute("src", "uploads/"+image);
     }      
}

function schedule(id) {
    var win = window.open("playdateform.html", '', "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=" + screen.width + ",height="+ screen.height);
    
    win.onload = function() {
        win.document.getElementById("id").innerHTML = id;
        win.document.getElementById("date").setAttribute('valueAsDate', new Date());
        win.document.getElementById("date").setAttribute('min', new Date());
        win.document.getElementById("date").setAttribute('max', "2019-12-31");
     }      
}