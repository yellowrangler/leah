$(document).ready( function(){
    $( "#email-partial" ).load( "partials/emailform.html" );

    $("#email-form").submit(function (e) {
    	e.preventDefault();

    	var emailformdata = $("#email-form").serialize();
    	var i = 0;

    	alert("form submited 1");
    });
});  