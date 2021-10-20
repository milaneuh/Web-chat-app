const searchInput = document.querySelector(".users .search input"),
    searchBt = document.querySelector(".users .search button"),
    usersList = document.querySelector(".users .usersList");

searchBt.onclick = () => {
    searchInput.classList.toggle("active");
    searchInput.focus();
    searchBt.classList.toggle("active");
    searchInput.value = "";
}
searchInput.onkeyup = () => {
    let search = searchInput.value;
    if (search != "") {
        searchInput.classList.add("active");
    } else {
        searchInput.classList.remove("active");
    }
    //Ajax
    //On créer un objet XML
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            let data = xhr.response;
            usersList.innerHTML = data;
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send("search=" + search);
}
setInterval(() => {
        //Ajax
        //On créer un objet XML
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/users.php", true);
        xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                let data = xhr.response;
                if (!searchInput.classList.contains("active")) {
                    //Si notre barre de rechere n'est PAS active :
                    usersList.innerHTML = data;
                }
            }
        }
        xhr.send();
    }, 500) //Cette fonction s'activera souvent après 500ms