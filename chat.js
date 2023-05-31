const chat = document.getElementsByClassName("chat-bar")[0];
const header = document.getElementsByClassName("title-chat")[0];
const form = document.querySelector(".text-bar");//
groupId = form.querySelector(".groupId").value;
inputField = form.querySelector(".input-text");//
sendBtn = form.querySelector("button");//
chatBox = document.querySelector(".chat");//

header.addEventListener("click", function () {
    chat.classList.toggle("inActive")
    //
});

form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();

//onkeyup


sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "proses/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "proses/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("groupId=" + groupId);
}, 2000);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}