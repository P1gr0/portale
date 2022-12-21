let like;

//utilizzata per il setTimeout della funzione typeWriter
let timeOut;

//funzione che crea immagine per il badge
function createBadgeFor(social) {
    if (social.toLowerCase() == "facebook")
        return "https://img.shields.io/badge/facebook-blue?style=for-the-badge&logo=facebook&logoColor=white";
    if (social.toLowerCase() == "whatsapp")
        return "https://img.shields.io/badge/whatsapp-green?style=for-the-badge&logo=whatsapp&logoColor=white";
    if (social.toLowerCase() == "youtube")
        return "https://img.shields.io/badge/youtube-red?style=for-the-badge&logo=youtube&logoColor=white";
    if (social.toLowerCase() == "github")
        return "https://img.shields.io/badge/Github-black?style=for-the-badge&logo=github&logoColor=white";
    if (social.toLowerCase() == "instagram")
        return "https://img.shields.io/badge/instagram-blueviolet?style=for-the-badge&logo=instagram&logoColor=orangered";
    if (social.toLowerCase() == "twitter")
        return "https://img.shields.io/badge/twitter-dodgerblue?style=for-the-badge&logo=twitter&logoColor=white";
    if (social.toLowerCase() == "linkedin")
        return `https://img.shields.io/badge/LinkedIn-blue?style=for-the-badge&logo=linkedin&logoColor=white`;
    if (social.toLowerCase() == "tiktok")
        return "https://img.shields.io/badge/tiktok-black?style=for-the-badge&logo=tiktok&logoColor=red";
}

//funzione che crea badge per i link social dell'utente
function createSocialBadges(socialLinks) {
    for (let social in socialLinks) {
        let a = document.createElement("a");
        a.href = socialLinks[social];
        a.target = "_blank";
        let img = document.createElement("img");
        img.src = createBadgeFor(social);
        img.alt = social + "-badge";
        a.append(img);
        document.querySelector("#badges").append(a);
    }
}

//funzione eseguita dopo che la chiamata POST ha restituito i dati
function createContent(content) {

    let whoIAm = document.querySelector("div[data-selected='0'] h3");
    whoIAm.innerText = `Sono ${content["chi_sono"]["nome"]} ${content["chi_sono"]["cognome"]}, ${content["chi_sono"]["ruolo"]}`;
    like = content["mi_piace"];
    createSocialBadges(content["contatti_social"]);

    document.querySelector("#emailTo").value = content["email"];
}

//chiamata POST per recuperare i dati del portale
window.getData = function () {
    axios.post("home/getdata").then(response => {
        createContent(response.data);
    }).catch()
}

// il seguente cambia il contenuto mostrato nella pagina in base alla sezione clickata sulla sidebar
//.to-select sono gli elementi della sidebar
document.querySelectorAll(".to-select").forEach(element => {
    element.addEventListener("click", (e) => {
        //aggiunge classe active all'elemento selezionato, la rimuove dagli altri
        document.querySelectorAll(".to-select").forEach(item => {
            if (item === e.target) item.classList.add("active")
            else item.classList.remove("active");
        });
        //rende visibile il contenuto relativo all'elemento della sidebar selezionato, non visibili gli altri
        document.querySelectorAll(".content").forEach(item => {
            if (item.dataset.selected === e.target.dataset.selected) item.style.display = "initial"
            else item.style.display = "none"
        })
    })
});

//funzione che anima la stampa (utilizzata nella sezione cosa mi piace)
//riceve in input un selettore al quale "appende" il contenuto creato
window.typeWriter = function (parentSelector) {
    let i = 0;
    clearTimeout(timeOut);
    let p = document.querySelector(`${parentSelector}`).querySelector("p");
    p.innerHTML = "";

    (function repeat() {
        if (i < like.length) {
            if (like.charAt(i) == '<') {
                p.innerHTML += like.substr(i, like.substr(i).indexOf('>') + 1);
                i += like.substr(i).indexOf('>') + 1;
            }
            else if (like.charAt(i) == '&' && like.charAt(i + 1) != ' ') {
                p.innerHTML += like.substr(i, like.substr(i).indexOf(';') + 1);
                i += like.substr(i).indexOf(';') + 1;
            }
            else p.innerHTML += like.charAt(i++);
            timeOut = setTimeout(repeat, 30);
        }
    })();
}

window.selectLastSection = function () {    
    document.querySelector("div[data-selected='3']").style.display = "initial";
    document.querySelector("div[data-selected='0']").style.display = "none";
    document.querySelector("a[data-selected='3']").classList.add("active");
    document.querySelector("a[data-selected='0']").classList.remove("active");    
}