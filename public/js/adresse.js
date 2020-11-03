//Les inputs du formulaire :
let adresse = document.getElementById('adresse');
let cp = document.getElementById('cp');
let ville = document.getElementById('ville');
let enregistre = document.getElementById('enregistrer');
//Bouton de validation :
let valideAdresse = document.getElementById('valideAdresse')

const initForm = () => {
    //Si l'adresse existe ne base de donnée, on l'affiche dans le form
    userAdresse = localStorage.getItem('adresse' + userId);
    if(userAdresse === null) {
        axios.get(`${urlRoot}/users/getUserAxios`)
        .then(resp => {
            let user = resp.data;

            user.adresse != null ? adresse.value = user.adresse : "";
            user.codepostal != null ? cp.value = user.codepostal : "";
            user.ville != null ? ville.value = user.ville : "";

            userAdresse = {adresse : user.adresse, cp : user.codepostal, ville : user.ville};
            userAdresse = JSON.stringify(userAdresse);
            localStorage.setItem('adresse' + userId , userAdresse);
            userAdresse = JSON.parse(userAdresse);
            isValidable();
        })
    } else {
        userAdresse = JSON.parse(userAdresse);

        userAdresse.adresse != null ? adresse.value = userAdresse.adresse : "";
        userAdresse.cp != null ? cp.value = userAdresse.cp : "";
        userAdresse.ville != null ? ville.value = userAdresse.ville : "";
        isValidable();
    }
}

const updateForm = (input) => {
    //Permet de mettre à jour l'adresse dans le local storage pour éviter 
    //de perdre les infos si on rafraichit la page
    if(input === 'adresse') {
        userAdresse.adresse = adresse.value;
    } else if(input === 'cp') {
        userAdresse.cp = cp.value;
    } else {
        userAdresse.ville = ville.value;
    }
     
    userAdresse = JSON.stringify(userAdresse);
    localStorage.setItem('adresse' + userId , userAdresse);
    userAdresse = JSON.parse(userAdresse);

    isValidable();
}

const afficheRecap = () => {
    let recapUl = document.getElementById('recap');
    panier = localStorage.getItem('panier' + userId);
    panier = JSON.parse(panier);

    let ulContent = panier.map((item) => {
        return('<li>' + item.nom_plat + '<p><span>x ' + item.qtt + '</span><span>'+ item.prix_unite * item.qtt +',00µp</span></p></li>')
    }).join('');

    //Affichage des éléments du panier :
    while(recapUl.firstChild) { 
        recapUl.removeChild(recapUl.firstChild); 
    }
    recapUl.insertAdjacentHTML('beforeend', ulContent);

    //affichage du prix total :
    totalRecap();
}

const isValidable = () => {
    //Si tous les champs sont remplis, le bouton de validation n'est plus disabled et la session est mise à jour
    if(adresse.value && cp.value && ville.value){
        axios.post(`${urlRoot}/commandes/adresseRemplie`, {
            adresseRemplie : true
        });
        valideAdresse.disabled = false
    } else {
        axios.post(`${urlRoot}/commandes/adresseRemplie`, {
            adresseRemplie : false
        });
        valideAdresse.disabled = true;
    }
}

const totalRecap = () => {
    let total = totalPanier();
    let totalSpan = document.getElementById('totalSpanListe');
    totalSpan.removeChild(totalSpan.firstChild);
    totalSpan.insertAdjacentText('afterbegin', total + ',00µp');
}

const adresseValide = (e) => {
    e.preventDefault();
    //Si la case est cochée, on update la base de donnée du user
    if(enregistre.checked) {
        axios.post(`${urlRoot}/users/updateUserAxios`, {
            id : userId,
            adresse : adresse.value,
            cp : cp.value,
            ville : ville.value
        })
        .then(resp => {
            if(resp.data === "echec") {
                document.getElementById('error').innerText = 'Un problème est survenu, merci de réessayer plus tard';
                return;
            }
        })
        .catch(err => {
            document.getElementById('error').innerText = 'Un problème est survenu, merci de réessayer plus tard';
            return;
        });
    }
    //Si tous les champs sont remplis, on valide le changement de page
    if(adresse.value && cp.value && ville.value){
        axios.post(`${urlRoot}/commandes/adresseRemplie`, {
            adresseRemplie : true
        })
        .then(resp => document.location.href = `${urlRoot}/commandes/paiement`)
        .catch(err => {
            document.getElementById('error').innerText = 'Un problème est survenu, merci de réessayer plus tard';
            return;
        });
    }
}

initForm();
isValidable();
afficheRecap();
valideAdresse.addEventListener('click', (e) => adresseValide(e));
adresse.addEventListener('input', () => updateForm('adresse'));
cp.addEventListener('input', () => updateForm('cp'));
ville.addEventListener('input', () => updateForm('ville'));
