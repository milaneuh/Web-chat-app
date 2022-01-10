//Récupération des élément du HTML
const searchInput = document.querySelector(".users .search input"),
    searchBt = document.querySelector(".users .search button"),
    usersList = document.querySelector(".users .usersList");

//Si on clique sur le bouton de recherche :
searchBt.onclick = () => {
    //On change ses classes pour changer son apparence
    searchInput.classList.toggle("active");
    searchInput.focus();
    searchBt.classList.toggle("active");

    //On créer une valeure de base de la recherche qui sera 
    //modifié en fonction de ce que l'utilisateur écrit
    searchInput.value = "";
}

//Quand l'utilisateur arrête d'écrire dans la barre de recherche:
searchInput.onkeyup = () => {
    //On récupère l'input de l'utilisateur
    let search = searchInput.value;
    if (search != "") {
        searchInput.classList.add("active");
    } else {
        searchInput.classList.remove("active");
    }

    //--Ajax--//
    //On créer un objet XML
    let xhr = new XMLHttpRequest();
    //On se connecte au fichier php/search.php et on charge les 
    //résultat de la recherche
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

//Toute les 0.5s on appel cette méthode. Cette méthode va executer la requête
//php du fichier php/users.php et récupérer les données renvoyées pour les 
//afficher dans la div usersList
setInterval(() => {
        console.log("Methode");
        
        //Ajax
        //On créer un objet XML
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/users.php", true);
        xhr.onload = () => {
            console.log(xhr.readyState)
            if (xhr.readyState == XMLHttpRequest.DONE) {
                let data = xhr.response;
                console.log(xhr.response)
                if (!searchInput.classList.contains("active")) {
                    //Si notre barre de rechere n'est PAS active :
                    usersList.innerHTML = data;
                }
            }
        }
        xhr.send();
    }, 500) //Cette fonction s'activera souvent après 500ms
