if (!localStorage.getItem("userData")) {
    location.href = "http://localhost/expence_recorder/app/login.html";
}

function addExpense(e) {
    e.preventDefault();
    console.log($("#add-exp-form").serializeArray());
    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=add_expense&uid=" + JSON.parse(localStorage.getItem("userData"))[0].id,
        type: "POST",
        data: $("#add-exp-form").serializeArray(),
        headers: {
            "auth": "credentials " + localStorage.getItem("access-token")
        },
        success: function (res) {
            if (res === "Expense added") {
                swal("Expense Added", "Your Expense Been Added Successfully", "success")
                    .then(function (p) {
                        loadAllExpense();
                    });
            }
            else {
                alert("Something Went Wrong!!!");
            }
        }
    })
}

function deleteExpense(expID) {

    Swal.fire({
        title: 'Are you sure?',
        text: "Your record will be deleted. You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=delete_exp&exp_id=" + expID,
                type: "GET",
                headers: {
                    "auth": "credentials " + localStorage.getItem("access-token")
                },
                success: function (res) {
                    let timerInterval = 0;
                    Swal.fire({
                        title: res,
                        timer: 3000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    })
                    loadAllExpense()
                }
            });
        }
        else {
            let timerInterval = 0;
            Swal.fire({
                title: 'Your record is safe.',
                timer: 2000,
                timerProgressBar: true,
                willClose: () => {
                    clearInterval(timerInterval);
                }
            })
        }
    })



}

$.ajax({
    url: "http://localhost/expence_recorder/api/controller/exp_type_controller.php?op=list_exp_type&uid=" + JSON.parse(localStorage.getItem("userData"))[0].id,
    type: "GET",
    headers: {
        "auth": "credentials " + localStorage.getItem("access-token")
    },
    success: function (res) {
        let options = "";

        $.each(res, function (key, val) {

            option = `<option value="${val.id}">${val.title}</option>`;

            options += option;

        });

        $("#exp-types").html(options);
    }
});

const logout = () => {
    localStorage.removeItem("userData");
    localStorage.removeItem("access-token");
    location.href = "login.html";
}
function loadAllExpense() {
    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=list_all_expenses&uid=" + JSON.parse(localStorage.getItem("userData"))[0].id,
        type: "GET",
        headers: {
            "auth": "credentials " + localStorage.getItem("access-token")
        },
        success: function (res) {

            let trs = "";

            $.each(res, function (key, val) {

                tr = `<tr>
                <td>${key + 1}</td>
                <td>${val.curdate}</td>
                <td>${val.payee}</td>
                <td>${val.amount}</td>
                <td>
                    <button class="btn btn-info" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button class="btn btn-danger" title="Delete" onclick="deleteExpense(${val.id})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>`;

                trs += tr;

            });

            $("#expenses-list-table").html(trs);

        }
    });
}

loadAllExpense();