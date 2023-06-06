if (localStorage.getItem("userData")) {
    location.href = "./my-expenses.html";
}

$("#login-form").on("submit", function (e) {

    e.preventDefault();

    let username = $("#username").val();
    let password = $("#password").val().split("").reverse().join("");

    let compositeString = btoa(username + ":" + password);

    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/user_controller.php?op=login",
        type: "GET",
        headers: {
            "auth": "credentials " + compositeString
        },
        success: function (res) {
            if (res === "") {
                alert("Invalid Credentials");
            }
            else {
                localStorage.setItem("userData", JSON.stringify(res));
                localStorage.setItem("access-token", compositeString);
                location.href = "my-expenses.html";
            }
        }
    })

});