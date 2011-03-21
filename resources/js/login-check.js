var emailOK = false;
var passOK = false;

function confirmPass() {

    var strOne = $('#password').val();
    var strTwo = $('#confirm_password').val();
    var passLength = $('#password').val().length;
    
    if (passLength >= 3) {

        if (strOne == strTwo) {
            $('#passwordCheck').css({"color" : '#00dd00'});
            $('#passwordCheck').html('Password OK');
            passOK = true;

        } else {
            $('#passwordCheck').css({"color" : '#dd0000'});
            $('#passwordCheck').html('Passwords Do Not Match');
            passOK = false;

        }
    } else {

        /* alert("too short"); */
        $('#passwordCheck').css({"color" : '#dd0000'});
        $('#passwordCheck').html('Password Too Short ( 3+ )');
        passOK = false;
    }

    enableSubmit();

}

function validateEmail(action) {

    apos = $('#emailAddress').val().indexOf("@");
    dotpos = $('#emailAddress').val().lastIndexOf(".");
    if (apos < 1 || dotpos - apos < 2) {

        $('#emailCheck').css({"color" : '#dd0000'});
        $('#emailCheck').html('Please enter a valid email address - you@domain.com');
        emailOK = false;
    } else {
        $('#emailCheck').css({"color" : '#00dd00'});
        $('#emailCheck').html('Email Address OK');
        emailOK = true;
    }

    enableSubmit(action);
}

function enableSubmit(action) {
    
        if ( (passOK == true)) {
            $('#fadedButton').css({display:  "none"});
            $('#showButton').css({display:  "block"});
            $('#login_form_submit').attr("disabled" , false);
        } else {
            $('#fadedButton').css({display:  "block"});
            $('#showButton').css({display:  "none"});    
            $('#login_form_submit').attr('disabled', 'disabled') ;       
        }

}
