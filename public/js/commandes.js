//inputs et boutons pour ajouter un plat au panier :
let inputsCarte = document.getElementsByClassName('inputsNumber');
let ajoutPlatBtns = document.getElementsByClassName('btnForm');
//elements pour affichage du panier :
let panierUl = document.getElementById('listePanier');
let totalSpan = document.getElementById('totalSpan');
let recuEl = document.getElementById('recuContainer');
//Bouton de validation du panier :
let validePanier = document.getElementById('validPanier');
let ValPanierResponsive = document.getElementById('validPanierResponsive');

// Amélioration graphique des inputs type number avec des boutons + et -
const jolisInputsNbr = (domInputs) => {
    for(let i = 0; i < domInputs.length; i++) {
        let input = domInputs[i];
        let plusBtn = domInputs[i].nextElementSibling;
        let moinsBtn = domInputs[i].previousElementSibling;
        let inputMax = input.getAttribute('max');
        let inputMin = input.getAttribute('min');
    
        plusBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let oldValue = parseFloat(input.value);
            let newVal = oldValue;
            oldValue < inputMax && newVal++;
            input.value = newVal;
            //force l'event on change
            const event = new Event("change");
            input.dispatchEvent(event);
        });
    
        moinsBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let oldValue = parseFloat(input.value);
            let newVal = oldValue;
            oldValue > inputMin && newVal--;
            input.value = newVal;
            //force l'event on change
            const event = new Event("change");
            input.dispatchEvent(event);
        })
    }
}

const ajouterPlat = (e, index)=> {
    e.preventDefault();
    //Récupération des datas :
    let id_plat = parseFloat(e.target.dataset.id);
    let nom_plat = e.target.dataset.nom;
    let quantite = parseFloat(inputsCarte[index].value);
    let prix_unite = parseFloat(e.target.dataset.prix);
    let img = e.target.dataset.img;

    let ligneCmd = {id_plat: id_plat, qtt: quantite, prix_unite: prix_unite, nom_plat: nom_plat, img: img};

    //Si le plat existe déjà dans le panier, on ajuste la quantité
    let isInBasket = false;
    for (let i = 0; i < panier.length; i++) {
        if(panier[i].id_plat === id_plat ) {
            panier[i].qtt = parseFloat(panier[i].qtt) + quantite;
            isInBasket = true;
        }
    }

    //S'il n'est pas dans le panier, on l'ajoute
    if(!isInBasket) {
        panier.push(ligneCmd);
    }
    
    //On remet l'input à sa valeur initiale
    inputsCarte[index].value = 1;

    panier = JSON.stringify(panier);
    localStorage.setItem('panier' + userId , panier);

    affichePanier();
    panierVignette();
}


const affichePanier = () => {
    panier = localStorage.getItem('panier' + userId);
    (panier === null) ? panier = [] : panier = JSON.parse(panier);

    //On met à jour la variable de session selon si le panier est vide ou non :
    if(panier.length > 0){
        axios.post(`${urlRoot}/commandes/panierPlein`, {
            panierPlein : true
        });
    } else {
        axios.post(`${urlRoot}/commandes/panierPlein`, {
            panierPlein : false
        });
    }
    
    //Création des éléments du panier :
    let ulContent = panier.map((item) => {
        return('<div class="panierItem"><div><img src="' + item.img + '" alt="photo du plat"></div><div class="panierTexte"><p class="panierTitre">' + item.nom_plat + '</p><div class="panierQuantite"><p class="prixPanier">'+ item.prix_unite +',00µp</p><div class="inputContainerPanier"><button class="qttMoinsP qttBtnP">-</button><input type="number" data-id="'+ item.id_plat +'" class="inputsPanier" max="10" min="1" value="'+ item.qtt +'"><button class="qttPlusP qttBtnP">+</button></div></div></div><button class="suppPanier" data-id="'+ item.id_plat +'">x</button></div>')
    }).join('');

    //Affichage des éléments du panier :
    while(panierUl.firstChild) { 
        panierUl.removeChild(panierUl.firstChild); 
    }

    panierUl.insertAdjacentHTML('beforeend', ulContent);
    let inputsPanier = document.getElementsByClassName('inputsPanier');
    jolisInputsNbr(inputsPanier);

    //Affichage total :
    let total = totalPanier();
    totalSpan.removeChild(totalSpan.firstChild);
    totalSpan.insertAdjacentText('afterbegin', total + ',00µp');

    let spanResponsive = document.querySelector('#navCmd p span');
    if(ValPanierResponsive){
        spanResponsive.removeChild(spanResponsive.firstChild);
        spanResponsive.insertAdjacentText('afterbegin', total + ',00µp');
        (panier.length > 0) ? ValPanierResponsive.disabled = false : ValPanierResponsive.disabled = true;
    }

    (panier.length > 0) ? validePanier.disabled = false : validePanier.disabled = true;

    //Ajout des écouteurs d'événement
    for (let i = 0; i < inputsPanier.length; i++) {
        inputsPanier[i].addEventListener('change', (e) => updatePanier(e));
    }
    let suppBtns = document.getElementsByClassName('suppPanier');
    for (let i = 0; i < suppBtns.length; i++) {
        suppBtns[i].addEventListener('click', (e) => suppPanier(e));
    }
}

const updatePanier = (e) => {
    e.preventDefault();
    let id_plat = parseFloat(e.target.dataset.id);

    for (let i = 0; i < panier.length; i++) {
        if(panier[i].id_plat === id_plat ) {
            panier[i].qtt = e.target.value;
            panier = JSON.stringify(panier);
            localStorage.setItem('panier' + userId, panier);

            affichePanier();
            panierVignette();
        }
    }
}

const suppPanier = (e) => {
    e.preventDefault();
    let id_plat = parseFloat(e.target.dataset.id);
    
    for (let i = 0; i < panier.length; i++) {
        if(panier[i].id_plat === id_plat) {
            panier.splice(i, 1);
            panier = JSON.stringify(panier);
            localStorage.setItem('panier' + userId, panier);

            affichePanier();
            panierVignette();
        }
    }
}

const validationPanier = () => {
    //On ne dirige vers la validation de l'adresse que si le panier n'est pas vide
    axios.post(`${urlRoot}/commandes/panierPlein`, {
        panierPlein : true
    })
    .then(resp => document.location.href = `${urlRoot}/commandes/adresse`);
}

jolisInputsNbr(inputsCarte);

for (let i = 0; i < ajoutPlatBtns.length; i++) {
    ajoutPlatBtns[i].addEventListener('click', e => ajouterPlat(e, i) )
}

affichePanier();

validePanier.addEventListener('click', validationPanier);
if(ValPanierResponsive){
ValPanierResponsive.addEventListener('click', validationPanier);
}


