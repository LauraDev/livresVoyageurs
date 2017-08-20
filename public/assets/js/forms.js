$(document).ready(function() {

    // Hide Errors
    $(".error").hide();



    // Show/Hide Mdp Help-text
    $("#pass-helptext").hide();
    
    $("#passUser").focus(function() {
        $("#pass-helptext").show();
    });
    $("#passUser").blur(function() {
        $("#pass-helptext").hide();
    });
    


    // Show/Hide Pseudo Help-text
    $("#pseudo-helptext").hide();

    $("#pseudoUser").focus(function() {
        $("#pseudo-helptext").show();
    });
    $("#pseudoUser").blur(function() {
        $("#pseudo-helptext").hide();
    });

});