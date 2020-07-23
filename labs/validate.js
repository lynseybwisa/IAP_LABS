//create a function to validate our form
//then call the function when form is submitted

function validateForm(){
    var fname = document.forms["user_details"]["first_name"].value;
    var lname = document.forms["user_details"]["first_name"].value;
    var city = document.forms["user_details"]["city_name"].value;
//the user details comes from our form
if(fname == null || lname == "" || city == ""){
    alert("all details required were not supplied");
    return false;
}
return true;
}