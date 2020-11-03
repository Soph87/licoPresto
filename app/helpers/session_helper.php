<?php
session_start();

//Messages flash
function flash($name = '', $message = '', $classe = 'flashSuccess')
{
    if (!empty($name)) {
        if (!empty($message)) {
            //Si 2 ou 3 args, Set les variable de session
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            };

            if (!empty($_SESSION[$name . '_classe'])) {
                unset($_SESSION[$name . '_classe']);
            };

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_classe'] = $classe;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            //Si seulement 1 arg, affiche le message 
            $classe = !empty($_SESSION[$name . '_classe']) ? $_SESSION[$name . '_classe'] : '';
            echo '<div class="' . $classe . '" id="flashCard">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_classe']);
        }
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['id'])) {
        return true;
    }
    return false;
}

function panierPlein()
{
    if (isset($_SESSION['panier'])) {
        return true;
    }
    return false;
}

function adresseOk()
{
    if (isset($_SESSION['adresse'])) {
        return true;
    }
    return false;
}

function paiementOk()
{
    if (isset($_SESSION['paiement'])) {
        return true;
    }
    return false;
}
