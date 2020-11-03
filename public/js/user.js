let userId = document.querySelector('header').dataset.user;
let urlRoot = document.querySelector('header').dataset.url;

//Span nombre d'éléments dans le panier :
let panierSpan = document.getElementById('panierLength');

let panier = [];
let userAdresse = {};

//Affiche le nombre d'articles dans le panier :
const panierVignette = () => {
    panier = localStorage.getItem('panier' + userId);
    (panier === null) ? panier = [] : panier = JSON.parse(panier);

    let total = 0;
    for (let i = 0; i < panier.length; i++) {
        total += 1 * panier[i].qtt;
    }
    panierSpan.removeChild(panierSpan.firstChild);
    panierSpan.insertAdjacentText('afterbegin', total);
}

//Total du panier
const totalPanier = () => {
    panier = localStorage.getItem('panier' + userId);
    (panier === null) ? panier = [] : panier = JSON.parse(panier);
    let total = 0;
    for (let i = 0; i < panier.length; i++) {
        total += panier[i].prix_unite * panier[i].qtt;
    }
    return total;
}

panierVignette();