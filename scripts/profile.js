// opens a window showing a dog's profile page
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
// opens a window containing a playdate form
function schedule(id) {
    var win = window.open("playdateform.html", '', "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=" + screen.width + ",height="+ screen.height);
    
    win.onload = function() {
        win.document.getElementById("id").innerHTML = id;
        var today = new Date();
        win.document.getElementById("date").valueAsDate = today;
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();
        if(day < 10) {
            day = '0' + day;
        } 
        if(month < 10) {
            month = '0' + month;
        } 
        today = year + '-' + month + '-' +day;
        win.document.getElementById("date").min = today;
        win.document.getElementById("date").max= "2019-12-31";
     }      
}