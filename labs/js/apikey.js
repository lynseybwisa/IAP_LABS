$(document).ready(function(){
    
    $("#api-key-btn").click(function(event){
        //Prompt the user to confirm that they want to generate the api key
        var confirm_key = confirm("You are about to generate a new API Key!");
        if(!confirm_key){
            return;
        }

        $.ajax({
            url: "apikey.php",
            type: 'post',
            success: function(data){
                if (data['success'] === 1) {
                    //Everything went file
                    //Set your key in the text area
                    $("#api-key").val(data['message']);
                }else{
                    alert("Something wrong happened. Please try again.");
                }
            }
        });
        document.location.reload(true);
    });
});