<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->userCmd = $this->model('Commande');
    }

    public function login()
    {
        if (isLoggedIn()) {
            $this->view('commandes');
        } else {
            //vérifie si POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $formData = [
                    "email" => trim($_POST['email']),
                    "email_err" => "",
                    "mdp" => trim($_POST['mdp']),
                    "mdp_err" => "",
                ];

                //Validation des champs
                if (empty($formData['email'])) {
                    $formData['email_err'] = "Merci d'entrer votre email";
                }

                if (empty($formData['mdp'])) {
                    $formData['mdp_err'] = "Merci d'entrer votre mot de passe";
                }

                if (!$this->userModel->findUserByEmail($formData['email'])) {
                    $formData['email_err'] = "Aucun compte avec cet email n'existe, veuillez vous enregistrer";
                }

                //Si toutes les erreurs sont vides, on valide le formulaire
                if (empty($formData['mdp_err']) && empty($formData['email_err'])) {
                    $loggedInUser = $this->userModel->login($formData['email'], $formData['mdp']);
                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $formData['mdp_err'] = "Le mot de passe ne correspond pas à l'email";
                        $this->view('users/login', $formData);
                    }
                } else {
                    $this->view('users/login', $formData);
                }
            } else {
                //charge le formulaire
                $formData = [
                    "email" => "",
                    "email_err" => "",
                    "mdp" => "",
                    "mdp_err" => "",
                ];
                $this->view('users/login', $formData);
            };
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['id'] = $user->id;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['email'] = $user->email;
        redirect('commandes');
    }

    public function register()
    {
        //vérifie si POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $formData = [
                "prenom" => trim($_POST['prenom']),
                "prenom_err" => "",
                "nom" => trim($_POST['nom']),
                "nom_err" => "",
                "email" => trim($_POST['email']),
                "email_err" => "",
                "mdp" => trim($_POST['mdp']),
                "mdp_err" => "",
                "verif_mdp" => trim($_POST['verif_mdp']),
                "verif_mdp_err" => "",
            ];

            //Validation des champs
            if (empty($formData['prenom'])) {
                $formData['prenom_err'] = "Merci d'entrer un prénom";
            }

            if (empty($formData['nom'])) {
                $formData['nom_err'] = "Merci d'entrer un nom";
            }

            if (empty($formData['email'])) {
                $formData['email_err'] = "Merci d'entrer un email";
            } else {
                if (filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                    if ($this->userModel->findUserByEmail($formData['email'])) {
                        $formData['email_err'] = "Un compte avec cet email existe déjà";
                    }
                } else {
                    $formData['email_err'] = "L'email entré n'est pas valide";
                }
            }

            if (empty($formData['mdp'])) {
                $formData['mdp_err'] = "Merci d'entrer un mot de passe";
            } elseif (strlen($formData['mdp']) < 6) {
                $formData['mdp_err'] = "Le mot de passe doit contenir au moins 6 caractères";
            }

            if (empty($formData['verif_mdp'])) {
                $formData['verif_mdp_err'] = "Merci de confimer votre mot de passe";
            } else {
                if ($formData['mdp'] != $formData['verif_mdp']) {
                    $formData['verif_mdp_err'] = "Les mots de passe ne correspondent pas";
                }
            }

            //Si toutes les erreurs sont vides, on valide le formulaire
            if (empty($formData['prenom_err']) && empty($formData['nom_err']) && empty($formData['mdp_err']) && empty($formData['verif_mdp_err']) && empty($formData['email_err'])) {
                //Hash du mot de passe
                $formData['mdp'] = password_hash($formData['mdp'], PASSWORD_DEFAULT);
                $result = $this->userModel->addUser($formData);
                if ($result) {
                    $_SESSION['id'] = $result->id;
                    $_SESSION['prenom'] = $formData['prenom'];
                    $_SESSION['email'] = $formData['email'];
                    redirect('commandes');
                } else {
                    $formData['mdp'] = '';
                    $formData['verif_mdp'] = '';
                    $formData['erreur'] = 'Une erreur est survenue, nous n\'avons pas pu créer le compte. Merci de réessayer';
                    $this->view('users/register', $formData);
                }
            } else {
                $this->view('users/register', $formData);
            }
        } else {
            $formData = [
                "prenom" => "",
                "prenom_err" => "",
                "nom" => "",
                "nom_err" => "",
                "email" => "",
                "email_err" => "",
                "mdp" => "",
                "mdp_err" => "",
                "verif_mdp" => "",
                "verif_mdp_err" => "",
            ];

            $this->view('users/register', $formData);
        };
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['prenom']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('');
    }

    public function getUserAxios()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $user = $this->userModel->getUserById($_SESSION['id']);
        echo json_encode($user);
    }

    public function updateUserAxios()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $data = json_decode(file_get_contents("php://input"));
        $id = filter_var($data->id, FILTER_SANITIZE_STRING);
        $adresse = filter_var($data->adresse, FILTER_SANITIZE_STRING);
        $cp = filter_var($data->cp, FILTER_SANITIZE_STRING);
        $ville = filter_var($data->ville, FILTER_SANITIZE_STRING);

        if ($this->userModel->updateUserAdresse($id, $adresse, $cp, $ville)) {
            echo json_encode('success');
        } else {
            echo json_encode('echec');
        };
    }

    public function monCompte()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $user = $this->userModel->getUserById($_SESSION['id']);
        $commandes = $this->userCmd->getCommandesByUser($_SESSION['id']);

        foreach ($commandes as $commande) {
            $lignesCmd = $this->userCmd->getLignesCmdByIdCmd($commande->id);
            $commande->lignes = $lignesCmd;
        }

        $formData = [
            "prenom" => $user->prenom,
            "prenom_err" => "",
            "nom" => $user->nom,
            "nom_err" => "",
            "email" => $user->email,
            "email_err" => "",
            "adresse" =>  $user->adresse,
            "cp" =>  $user->codepostal,
            "ville" =>  $user->ville
        ];

        $data = [
            'form' => $formData,
            'cmds' => $commandes
        ];

        $this->view('users/compte', $data);
    }

    public function compteModif()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $formData = [
                "prenom" => trim($_POST['prenom']),
                "prenom_err" => "",
                "nom" => trim($_POST['nom']),
                "nom_err" => "",
                "email" => trim($_POST['email']),
                "email_err" => "",
                "adresse" =>  trim($_POST['adresse']),
                "cp" =>  trim($_POST['cp']),
                "ville" =>  trim($_POST['ville'])
            ];

            if (empty($formData['prenom'])) {
                $formData['prenom_err'] = "Merci d'entrer un prénom";
            }

            if (empty($formData['nom'])) {
                $formData['nom_err'] = "Merci d'entrer un nom";
            }

            if (empty($formData['email'])) {
                $formData['email_err'] = "Merci d'entrer un email";
            }

            if (empty($formData['prenom_err']) && empty($formData['nom_err']) && empty($formData['email_err'])) {
                $result = $this->userModel->updateUser($_SESSION['id'], $formData);
                if ($result) {
                    redirect('users/monCompte');
                } else {
                    $formData['erreur'] = 'Une erreur est survenue, nous n\'avons pas pu créer le compte. Merci de réessayer';
                    $this->view('users/compteModif', $formData);
                }
            }

            $this->view('users/compte-modif', $formData);
        } else {
            $user = $this->userModel->getUserById($_SESSION['id']);

            $formData = [
                "prenom" => $user->prenom,
                "prenom_err" => "",
                "nom" => $user->nom,
                "nom_err" => "",
                "email" => $user->email,
                "email_err" => "",
                "adresse" =>  $user->adresse,
                "cp" =>  $user->codepostal,
                "ville" =>  $user->ville
            ];
            $this->view('users/compte-modif', $formData);
        }
    }
}
