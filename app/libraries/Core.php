<?php 
    /*
    * Classe Core de l'app
    * Créé les URLs & charge le controller core
    * URL FORMAT - /controller/method/params
    */ 

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();

            if($url) {
               //Cherche le controlleur correspondant à la 1ere valeur
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                    $this->currentController = ucwords($url[0]);
                    unset($url[0]);
                } 
            }

            //Require du controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            //Instantiation de la classe
            $this->currentController = new $this->currentController;

            //Vérifie la 2eme valeur (méthode)
            if(isset($url[1])) {
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //Récupère les params
            $this->params = $url ? array_values($url) : [];

            //Lance la method avec les params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            
        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }