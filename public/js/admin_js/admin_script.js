$(document).ready(function() {
    //check admin password is corrct or not

    $("#current_pwd").keyup(function() {
        var current_pwd = $("#current_pwd").val();

        $.ajax({
            type: "post",
            url: "/admin/check-current-pwd",
            data: { current_pwd: current_pwd },
            success: function(res) {

                if (res == "false") {
                    $(checkCurrentPwd).html(
                        "<font color=red> Current password is incorrect</font>"
                    );
                } else if (res == "true") {
                    $(checkCurrentPwd).html(
                        "<font color=green > Current password is correct</font>"
                    );
                }
            },
            error: function() {
                alert("Errors");
            }
        });
    });


    $(".updateServiceStatus").click(function () {
        var status = $(this).text();
        var service_id = $(this).attr('service_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-service-status',
            data: { service_id: service_id, status: status },
            success: function (res) {
                if (res['status'] == 0) {
                   $("#service-"+service_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>")
                } else if (res['status'] == 1) {
                    $("#service-"+service_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>")
                }
            }, error: function () {
                alert('Error')
            }
        });
    });

    
    $(".updateCentreStatus").click(function () {
        var status = $(this).text();
        var centre_id = $(this).attr('centre_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-centre-status',
            data: { centre_id: centre_id, status: status },
            success: function (res) {
                if (res['status'] == 0) {
                   $("#centre-"+centre_id).html("<a class='updateCentreStatus' href='javascript:void(0)'>Inactive</a>")
                } else if (res['status'] == 1) {
                    $("#centre-"+centre_id).html("<a class='updateCentreStatus' href='javascript:void(0)'>Active</a>")
                }
            }, error: function () {
                alert('error')
            }
        });
    })
// validate Register 
    $("#registerForm").validate({
        rules: {
            name: "required",
            type: "required",   
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits:true
            },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            },
         
        },
        messages: {
            name: "Please enter your firstname",
        
            mobile: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 2 characters"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address",
        
        }
    });

    $("#confirm_password").keyup(function() {
        var current_pwd = $("#confirm_password").val();

        $.ajax({
            type: "post",
            url: "/admin/confirm-password",
            data: {confirm_password: confirm_password },
            success: function(res) {

                if (res == "false") {
                    $(confirmpassword).html(
                        "<font color=red> password matches </font>"
                    );
                } else if (res == "true") {
                    $(confirmpassword).html(
                        "<font color=green >passwords </font>"
                    );
                }
            },
            error: function() {
                alert("Errors");
            }
        });
    });

});
