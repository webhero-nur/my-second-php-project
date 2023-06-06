const userDataInLocalStorage = JSON.parse(localStorage.getItem("userData"));

if (!localStorage.getItem("userData")) {
    location.href = "./login.html";
}

const userFullName = `
        <div class="h1 fw-bolder text-info" style="font-family: 'Tilt Prism', cursive;">${userDataInLocalStorage[0].full_name}</div>
    `;

$("#user-full-name").html(userFullName);
$("#user-name").text(userDataInLocalStorage[0].full_name);
$("#user-full-name-card").text(userDataInLocalStorage[0].full_name);
$("#user-recovery-card").text(userDataInLocalStorage[0].recovery);

function logout() {
    localStorage.removeItem("userData");
    localStorage.removeItem("access-token");
    location.href = "login.html";
}
