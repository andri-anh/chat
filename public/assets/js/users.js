var users = document.querySelector(".contenu_recherche"),
recherche = document.querySelector(".rechercher input"),
btnSearch = document.querySelector(".rechercher button");


btnSearch.onclick = () => {
    recherche.classList.toggle("active");
    recherche.focus();
    btnSearch.classList.toggle("active");
    recherche.value = "";
}

// Recherche un/des utilisateur(s)
recherche.onkeyup = () => {
    let resultat = recherche.value;
    if (recherche != "") {
        recherche.classList.add("active");
    } else {
        recherche.classList.remove("active");
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../Controllers/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                users.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("Resultat=" + resultat);
}


// Listes des utilisateurs inscrit
setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../../Controllers/utilisateurs.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!recherche.classList.contains("active")) {
                    users.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 1000)