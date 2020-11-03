let form = document.getElementById('payment-form');
let total = 0;

const initPaiement = () => {
    //Récupération de l'adresse du client :
    userAdresse = localStorage.getItem('adresse' + userId);
    userAdresse = JSON.parse(userAdresse);

    //Récupération du panier :
    panier = localStorage.getItem('panier' + userId);
    panier = JSON.parse(panier);

    total = totalPanier();
}

const createToken = () => {
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            formSubit(result.token.id)
        }
    });
};

const formSubit = (token) => {
    axios.post(`${urlRoot}/commandes/passerCmd`, {
        adresse : userAdresse,
        commande: panier,
        token: token
    })
    .then(resp => {
        if(resp.data === "echecPaiement") {
            document.getElementById('error').innerText = 'Un problème est survenu lors du paiement de votre commande, vous ne serez pas débité';
        } else if (resp.data === "echecCmd"){
            document.getElementById('error').innerText = 'Un problème est survenu lors de l\'enregistrement de votre commande, merci de nous contacter';
        } else {
            panier = [];
            userAdresse = {};
            localStorage.removeItem('adresse' + userId);
            localStorage.removeItem('panier' + userId);
            document.location.href = `${urlRoot}/commandes/succes`;
        }
    })
    .catch(err => document.getElementById('error').innerText = 'Un problème est survenu, merci de réessayer plus tard');
}

//Création et affichage de l'élément card de Stripe
var stripe = Stripe('pk_test_51HhLSYLevh1IWw17JNlRZZVsPGd6UQGddviJ5JLNRQMCiaVrB3ZA1CKuFmOsrcJDXN1XNUOW4NKGMmOR323S9a0U00VFv2YOg4');
var elements = stripe.elements();
var card = elements.create('card');
card.mount('#card-element');

//Récupération des éléments du local storage
initPaiement();

//Affichage du total sur le bouton de submission du form
document.getElementById('submitBtnPayer').innerText = `Payer ${total},00 µp`;

//Gestino des erreurs Stripe
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
  
//Submission du form
form.addEventListener('submit', function(e) {
    e.preventDefault();
    createToken();
});