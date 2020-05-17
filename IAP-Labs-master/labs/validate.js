//create a function to validate our form
//then call the function when form is submitted

function validateForm() {
	var fname = document.forms ["user_details"]["first_name"].value;
	var lname = document.forms ["user_details"]["last_name"].value;
	var city = document.forms ["user_details"] ["city_name"].value;

	//user_details is the name of our form

	if (fname==null || lname=="" || city=="") {
		alert ("All details required were not supplied");
		return false;
	} else {
return true;
}
}