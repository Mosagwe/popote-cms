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
                        "<font color=green > Current password is incorrect</font>"
                    );
                }
            },
            error: function() {
                alert("Errors");
            }
        });
    });


    $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr('section_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: { section_id: section_id, status: status },
            success: function (res) {
                if (res['status'] == 0) {
                   $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>")
                } else if (res['status'] == 1) {
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>")
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

    $(". centredeletebtn").click(function (e) {
        
        e.preventDefault();
        alert('hello kanyata');
    })
});