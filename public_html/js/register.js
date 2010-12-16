$(document).ready(function() {

    $('#registerButton').click(function () {

        //Get the data from all the fields
        var firstName = $('input[name=firstName]');
        var lastName = $('input[name=lastName]');
        var userName = $('input[name=userName]');
        var password = $('input[name=password]');
        var email = $('input[name=email]');
        var fb_uid = $('input[name=fb_uid]');

        //Simple validation to make sure user entered something
        if (firstName.val()=='') {
            alert('Field cannot be empty!');
            return false;
        }
        if (lastName.val()=='') {
            alert('Field cannot be empty!');
            return false;
        }
        if (password.val()=='') {
            alert('Field cannot be empty!');
            return false;
        }
        if (email.val()=='') {
            alert('Field cannot be empty!');
            return false;
        }

        //organize the data properly
        var data = 'fname='  + encodeURIComponent(firstName.val()) + '&lname='  + encodeURIComponent(lastName.val()) + '&uname='  + encodeURIComponent(userName.val()) + '&password='  + encodeURIComponent(password.val()) + '&email='  + encodeURIComponent(email.val()) + '&fb_uid='  + encodeURIComponent(fb_uid.val());
        
        //disable form elements
        $('#registerButton').attr('disabled', 'disabled');
        $('#firstName').attr('disabled', 'disabled');
        $('#lastName').attr('disabled', 'disabled');
        $('#userName').attr('disabled', 'disabled');
        $('#email').attr('disabled', 'disabled');
        $('#password').attr('disabled', 'disabled');

        $('#updateMessage').html('<img src="img/ajax-loader.gif" width="16" height="11" />');

        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax/register.php",

            //GET method is used
            type: "POST",

            //pass the data
            data: data,

            //Do not cache the page
            cache: false,

            //success
            success: function (data, textStatus, XMLHttpRequest) {
                if(textStatus == 'success'){

                    //hide the form
                    $('#registerForm').hide();

                    //show the success message
                    $('#updateMessage').html('<p class="connected"><img src="img/check.png">Account created successfully</p>');

                    //show login informtion
                    //$('#login').html('<p>You can now login <a href="./login">here</a></p>');
                    $('#loginButton').html('<input value="Log in" type="button" onclick="window.location.href=\'login.php\'; " >');

                }else alert('Sorry, unexpected error. Please try again later.');
            }
        });

        return false;
    });
 });
