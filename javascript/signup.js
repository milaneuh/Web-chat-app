const form = document.querySelector(".signup form");
const signupBtn = form.querySelector(".button input");
const errorTxt = form.querySelector(".errorTxt");
form.addEventListener("submit", function(event) {
    //On fait en sorte que on ne puisse pas retourner le formulaire
    event.preventDefault();
})
signupBtn.onclick = () => {
    //Ajax
    //On créer un objet XML
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    let data = xhr.response;
                    if (data == "success") {
                        location.href = "users.php"
                    } else {
                        errorTxt.textContent = data;
                        errorTxt.style.display = "block";

                    }
                }
            }
        }
        //On envoie les données du formulaire d'inscription à travers Ajax
    let formData = new FormData(form); //On créer un nouvel objet
    xhr.send(formData); //On envois les donénes au fichier php
}