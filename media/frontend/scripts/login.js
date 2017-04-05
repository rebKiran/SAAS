$(document).ready(function () {
    $('#submit_login').on('click', function (e) {
        e.preventDefault();

        var url = base_url + "frontLogin";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#loginfrm").serialize(),
            dataType: 'json',
            success: function (data)
            {
                if (data.status == 0) {
                    $(".submit_status").html('<div class="alert alert-danger"><strong>' + data.msg + '</strong></div>');
                } else {
                    $(".submit_status").html('<div class="alert alert-success"><strong>' + data.msg + '</strong></div>');
                    $("#loginfrm")[0].reset();
                    setTimeout(function () {
                        window.location = base_url + "user/dashboard";
                    }, 2000);
                }

            }
        });

    });
    
    
    $('#checkout_signup').on('click', function (e) {
        e.preventDefault();
        var url = base_url + "frontend/login/checkoutSignup";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#frm_checkout_signup").serialize(),
            dataType: 'json',
            success: function (data)
            {
                if (data.status == 0) {
                    $(".submit_status").html('<div class="alert alert-danger"><strong>' + data.msg + '</strong></div>');
                } else {
                    $(".submit_status").html('<div class="alert alert-success"><strong>' + data.msg + '</strong></div>');
                    $("#frm_checkout_signup")[0].reset();
                    
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }

            }
        });

    });
    
    
     $('#checkout_login').on('click', function (e) {
        e.preventDefault();

        var url = base_url + "frontend/login/checkoutLogin";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#frm_checkout_login").serialize(),
            dataType: 'json',
            success: function (data)
            {
                if (data.status == 0) {
                    $(".submit_status").html('<div class="alert alert-danger"><strong>' + data.msg + '</strong></div>');
                } else {
                    $(".submit_status").html('<div class="alert alert-success"><strong>' + data.msg + '</strong></div>');
                    $("#loginfrm")[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }

            }
        });

    });
});