//Tout ce qui concerne la map de la page d'accueil :
var mymap = L.map('mapid').setView([45.75, 4.83], 13.5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '(c) <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(mymap);

L.marker([45.75, 4.834]).addTo(mymap);

//Smooth scrolling :
//Eléments de la nav :
let linkNav = document.getElementsByClassName('linkNav');
for (let i = 0; i < linkNav.length; i++) {
    let cible = linkNav[i].dataset.nav;
    linkNav[i].addEventListener('click', (e) => {
        e.preventDefault();
        smoothScroll(cible);
    })
}

document.getElementById('btnMenu').addEventListener('click', (e) => {
    e.preventDefault();
    smoothScroll('menu');
})


let headerH = document.getElementById('monHeader').getBoundingClientRect().height;

function smoothScroll(el){
    let cible = document.getElementById(el);
    let duree = 1000;
    let topEl = cible.getBoundingClientRect().top - headerH + 1;
    let startPosition = window.pageYOffset;
    let startTime = null;

    const animation = (currentTime) => {
        if (startTime === null) startTime = currentTime;
        let tempsEcoule = currentTime - startTime;
        let lancement = easeInOut(tempsEcoule, startPosition, topEl, duree);
        window.scrollTo(0, lancement);
        if (tempsEcoule < duree) requestAnimationFrame(animation);
    };

    const easeInOut = (t, b, c, d) => {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    };

    requestAnimationFrame(animation);
};