const userDataInLocalStorage = JSON.parse(localStorage.getItem("userData"));

const userFullName = `
    <div class="fs-3 fw-bolder text-info" style="font-family: 'Tilt Prism', cursive;">${userDataInLocalStorage[0].full_name}</div>
`;

$("#user-full-name").html(userFullName);

function windowOnLoad() {

    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=piechart_data&uid=" + userDataInLocalStorage[0].id,
        type: "GET",
        headers: {
            "auth": "credentials " + localStorage.getItem("access-token")
        },
        success: function (res) {

            let chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Expenses"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "##0.00\"\"",
                    indexLabel: "{label} {y}",
                    dataPoints: JSON.parse(res)
                }]
            });
            chart.render();

        }
    });


}

if (!localStorage.getItem("userData")) {
    location.href = "http://localhost/expence_recorder/app/login.html";
}

function addExpense(e) {
    e.preventDefault();
    console.log($("#add-exp-form").serializeArray());
    $.ajax({

        url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=add_expense&uid=" + userDataInLocalStorage[0].id,
        type: "POST",
        data: $("#add-exp-form").serializeArray(),
        headers: {
            "auth": "credentials " + localStorage.getItem("access-token")
        },
        success: function (res) {

            if (res === "Expense added") {
                Swal.fire(
                    'Added',
                    'Expense Added Successfully',
                    'success'
                )
                    .then(function (p) {
                        location.reload();
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
                    windowOnLoad();
                    loadAllExpense();
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

function loadAllExpenseType() {

    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/exp_type_controller.php?op=list_exp_type&uid=" + userDataInLocalStorage[0].id,
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

}

function logout() {
    localStorage.removeItem("userData");
    localStorage.removeItem("access-token");
    location.href = "login.html";
}

function loadAllExpense() {
    $.ajax({
        url: "http://localhost/expence_recorder/api/controller/exp_controller.php?op=list_all_expenses&uid=" + userDataInLocalStorage[0].id,
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

windowOnLoad();
loadAllExpenseType();
loadAllExpense();