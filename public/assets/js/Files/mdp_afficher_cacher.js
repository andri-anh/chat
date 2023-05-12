var password = document.getElementById("password");
var eyeToggle = document.getElementById("eye");

eyeToggle.onclick = () => {
    if (password.type == "password") {
        password.type = "text";
        eyeToggle.classList.add("active");
    } else {
        password.type = "password";
        eyeToggle.classList.remove("active");
    }
}