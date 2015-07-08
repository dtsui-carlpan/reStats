function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
var ref = document.referrer;
if ( (ref.indexOf("google")!= -1) || (ref.indexOf("search.yahoo")!= -1) || (ref.indexOf("bing")!= -1) )
{
    //add cookie
    setCookie('organic', 'yes', 100);
}

$(document).ready(function() {
    $(".signup label").click(function(){
        $(".signup label").removeClass("first");
        $(this).addClass("first");
    });
    $('#next').click(function() {
        if (!$('.username-error').html() && !$('.email-error').html() && !$('.password-error').html()) {
            var res_check_email = check_email();
            var res_check_username = check_username();
            var res_check_password = check_password();
            if (res_check_email && res_check_username && res_check_password) {
                $("#join-form").submit();
            }
        } else {
            check_email();
            check_username();
            check_password();
        }
        return false;
    });

    $("#join_password").change(function() {
        return check_password();
    });

    $("#join_email").change(function() {
        return check_email();
    });

    $("#join_username").change(function(){
        return check_username();
    });

    $("#back").click(function () {
        $(".step22").fadeOut(400).delay( 800 );
        $(".step21").fadeIn(400).delay( 800 );
    });
    $('input[name="signup[custom5]"]').val(get_cookie('_ga'));
    $('input[name="signup[custom4]"]').val(get_cookie('__utmx'));
});

function check_password() {
    var password= $("#join_password").val();
    var pwdre=/^[A-Za-z0-9]{6,16}$/;
    if(pwdre.test(password)){
        $(".password-error").empty();
        $(".check-password").removeClass('state-error');
        $(".check-password .success").show();
        return true;
    }
    else{
        $(".check-password .success").hide();
        $(".check-password").addClass('state-error');
        $(".password-error").html("Password must be from 6 to 16 characters and use only A-Z and 0-9!");
        return false;
    }
}

function check_email() {
    var email= $("#join_email").val();
    var emailre=/^[A-Za-z0-9\._-]+@[A-Za-z0-9\._-]+\.[A-Za-z]{2,4}$/;
    if (emailre.test(email)){
        $(".email-error").empty();
        $(".check-email").removeClass('state-error');
        $(".check-email .success").show();
        return true;
    }
    else{
        $(".check-email .success").hide();
        $(".check-email").addClass('state-error');
        $(".email-error").html("Email is required!");
        return false;
    }
}

function check_username() {
    var username= $("#join_username").val();
    var unamere=/^[A-Za-z0-9]{6,16}$/;
    if (unamere.test(username)) {
        $.ajax({
            type:"POST",
            url: "/check_signup.php",
            dataType: 'json',
            data:"username="+username+"&act=check_name",
            beforeSend: function() {
                return;
            },
            success: function(data) {
                if (data.status == '1') {
                    $(".username-error").empty();
                    $(".check-username").removeClass('state-error');
                    $(".check-username .success").show();
                } else {
                    $(".check-username .success").hide();
                    $(".check-username").addClass('state-error');
                    $(".username-error").html("Username is already exists!");
                }
            },
            error: function() {return;}
        });
    }
    else {
        $(".check-username .success").hide();
        $(".check-username").addClass('state-error');
        $(".username-error").html("Username must be from 6 to 16 characters and use only A-Z and 0-9!");
    }
    return true;
}

