$(document).ready( function(){
    $( "#email-partial" ).load( "partials/emailform.html" );
});  

function saveEmailFormData(data) {

	$.ajax({
            url:"http://www.yellowrangler.com/mos/leah/ajax/saveemailformdata.php",
            data: data,
            type:"GET",
            dataType:"jsonp",
            contentType: "application/json",
            success: function (rvar, status, xhr) {
                var rv = rvar;
                
                if (rv == "Ok") 
                {
                    $('#email-form').trigger("reset");

                    alert("Success: We were able to add your information.");
                }
                else 
                {
                    alert("Error: Unable to add your information - Please try again later.");
                }
            },
            error: function (xhr, status, errorthrown) {
                alert("Error: Status"+status);
            }
        });
}