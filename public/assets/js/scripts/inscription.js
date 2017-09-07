$(document).ready(function() {
    
    l = (l) => {
        console.log(l)
    }

    $("#form_pass_member_first").bind("keyup", function () {
        //TextBox left blank.
        if ($(this).val().length == 0) {
            $("#password_strength").html("");
            return;
        }
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        // regex.push("[$@$!%*#?&]"); //Special Character.
        var passed = 0;
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test($(this).val())) {
                passed++;
            }
        }
        //Validate for length of Password.
        if (passed > 2 && $(this).val().length >= 6) {
            passed++;
        }
        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
            case 2:
            case 3:
            $("#password_strength").html(`
                <div class="progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (danger)</span>
                    </div>
                </div>
            `);
                break;
            case 4:
                $("#password_strength").html(`
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only">100% Complete (success)</span>
                        </div>
                    </div>
                `);
                break;
            case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
        }
    });


    // Show/Hide Mdp Help-text
    $("#pass-helptext").hide();

    $("#form_pass_member_first").focus(function() {
        $("#pass-helptext").show();
    });
    $("#form_pass_member_first").blur(function() {
        $("#pass-helptext").hide();
    });


})