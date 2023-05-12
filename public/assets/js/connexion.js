var form = document.getElementById("formLogin"),
btnSubmit = document.getElementById("btnLogin"),
errorMessage = document.querySelector(".alert-danger");

btnSubmit.addEventListener('click', e => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../Controllers/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data)
                if (data === "success") {
                    location.href = "../../../views/utilisateurs.php";
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