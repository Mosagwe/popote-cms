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
                alert('Error')
            }
        });
    })


    $("#confirm_pwdr").keyup(function() {
        var confirm_pwd = $("#confirm_pwd").val();

        $.ajax({
            type: "post",
            url: "/admin/confirm-passwor",
            data: {confirm_pwd: confirm_pwd },
            success: function(res) {

                if (res == "false") {
                    $(confirmPassword).html(
                        "<font color=red> password matches </font>"
                    );
                } else if (res == "true") {
                    $(confirmPassword).html(
                        "<font color=green >passwords didnt match </font>"
                    );
                }
            },
            error: function() {
                alert("Errors");
            }
        });
    });

    $("#centre_id").select2({
    placeholder:"Select Centres",
    })

       


});
