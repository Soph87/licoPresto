<?php
class Commandes extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->commandeModel = $this->model('Commande');
    }

    public function index()
    {
        $data = [
            'plats' => $this->commandeModel->getMenuItems()
        ];

        $this->view('commandes/accueil', $data);
    }

    public function afficheCmd()
    {
        $this->view('commandes/recu');
    }

    public function panierPlein()
    {
        //Si le panier est plein, on ajoute une variable de session, sinon on la vide
        $data = json_decode(file_get_contents("php://input"));
        if ($data->panierPlein) {
            $_SESSION['panier'] = true;
            echo json_encode('ok');
        } else {
            unset($_SESSION['panier']);
            echo json_encode('nope');
        }
    }

    public function adresseRemplie()
    {
        $data = json_decode(file_get_contents("php://input"));
        if ($data->adresseRemplie) {
            $_SESSION['adresse'] = true;
            echo json_encode('ok');
        } else {
            unset($_SESSION['adresse']);
            echo json_encode('nope');
        }
    }

    public function adresse()
    {
        //Affichage de la page du remplissage de l'adresse de livraison
        if (!panierPlein()) {
            redirect('commandes');
        };

        $this->view('commandes/adresse');
    }

    public function paiement()
    {
        //Affichage de la page de paiement stripe
        if (!panierPlein()) {
            redirect('commandes');
            return;
        };

        if (!adresseOk()) {
            redirect('commandes/adresse');
            return;
        }

        $this->view('commandes/paiement');
    }

    public function passerCmd()
    {
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $data->id_user;
        $commande = $data->commande;
        $adresseObj = $data->adresse;

        $total = 0;
        foreach ($commande as $ligne) {
            $total += $ligne->qtt * $ligne->prix_unite;
        }

        $token = $data->token;
        $adresse = filter_var($adresseObj->adresse, FILTER_SANITIZE_STRING) . " - " . filter_var($adresseObj->cp, FILTER_SANITIZE_STRING) . " " . filter_var($adresseObj->ville, FILTER_SANITIZE_STRING);

        $stripe = new \Stripe\StripeClient(STRIPE_SECRET);

        $stripeResult = $stripe->charges->create([
            'amount' => $total * 100,
            'currency' => 'eur',
            'source' => $token,
            'description' => 'Commande LicoPresto',
            'receipt_email' => $_SESSION['email']
        ]);

        if ($stripeResult && $stripeResult->status === 'succeeded') {
            $result = $this->commandeModel->ajoutCmd($user_id, $total, $adresse, $commande, $stripeResult->id);
            if ($result) {
                unset($_SESSION['panier']);
                unset($_SESSION['adresse']);
                $_SESSION['paiement'] = true;
                echo json_encode('success');
            } else {
                echo json_encode('echecCmd');
            }
        } else {
            echo json_encode('echecPaiement');
        }
    }

    public function succes()
    {
        if (!paiementOk()) {
            redirect('commandes');
            return;
        };
        unset($_SESSION['paiement']);
        $this->view('commandes/succes');
    }
}
