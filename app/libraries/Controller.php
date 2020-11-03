<?php
    /*
     * Controller de base
     * Charge les models et les views
     */

    class Controller {
        //Chargement model
        public function model($model) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }

        //Chargement view
        public function view($view, $data = []) {
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die('La vue n\'existe pas');
            }
        }
    }

?>