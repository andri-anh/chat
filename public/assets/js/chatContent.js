var formMessage = document.querySelector("#formMessage"),
inputMessage = document.querySelector("#inputMessage"),
btnSendMessg = document.querySelector(".btnSendMssg"),
messageContent = document.querySelector(".discutionContent");

formMessage.onsubmit = (e) => {
    e.preventDefault();
}

function scrollToBottom() {
    messageContent.scrollTop = messageContent.scrollHeight;
}

messageContent.onmouseenter = () => {
    messageContent.classList.add("active");
}

messageContent.onmouseleave = () => {
    messageContent.classList.remove("active");
}

btnSendMessg.onclick = () => {
    console.log("Chat Messenger with php.");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../Controllers/insertMessages.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputMessage.value = ""; // Vider l'input après l'envoie de message
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(formMessage);
    xhr.send(formData);
}


setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../Controllers/getMessages.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                messageContent.innerHTML = data;
                if (!messageContent.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(formMessage);
    xhr.send(formData);
}, 500)