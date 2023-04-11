$("#signup-form").on("submit", function (e) {

    e.preventDefault();

    let dataToPost = {
        full_name: $("#full-name").val(),
        username: $("#username").val(),
        password: $("#password").val()
    };

    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/user_controller.php?op=insert",
        type: "POST",
        data: dataToPost,
        success: function (res) {
            if (res === 'SignUp Successful') {
                swal("Signed Up", "You may LogIn now", "success")
                    .then(function (p) {
                        location.href = "./login.html";
                    });
            }
            console.log(res);
        }
    })

    console.log(dataToPost);

});

function checkUsername(potentialUsername) {

    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/user_controller.php?op=check_username&potential_name=" + potentialUsername,
        type: "GET",
        success: function (res) {
            if (res === "username available") {
                $("#username").removeClass("border-danger");
                $("#username").addClass("border-success");
                $("#username-notice").removeClass("d-block");
                $("#username-notice").addClass("d-none");
                $("#submit-btn").removeAttr("disabled");
                console.log('Available');
            }
            else {
                $("#username").removeClass("border-success");
                $("#username").addClass("border-danger");
                $("#username-notice").removeClass("d-none");
                $("#username-notice").addClass("d-block");
                $("#submit-btn").attr("disabled", true);
                console.log('Not Available');
            }
        }
    });

}