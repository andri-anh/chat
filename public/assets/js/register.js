var form = document.getElementById("formRegister");
var btnSubmit = document.getElementById("btnRegistration");
var errorMessage = document.querySelector(".alert-danger");
var successMessage = document.querySelector("#alertSuccess");

btnSubmit.addEventListener('click', e => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../Controllers/registration.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if (data === "Succès: inscription réussie !") {
                    // location.href = "/templates/login.php";
                    successMessage.textContent = data;
                    successMessage.classList.toggle("activeSuccess");
                } else {
                    errorMessage.textContent = data;
                    errorMessage.classList.toggle("activeDanger");
                }
            }
        }
    }
    
    let formData = new FormData(form);
    xhr.send(formData);
})