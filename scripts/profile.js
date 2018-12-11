function showProfile(dname, breed, age, act1, act2, act3, image) {
    var title = dname + "'s Profile";
    var win = window.open("showprofile.html", title, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=" + screen.width + ",height="+ screen.height);
    
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