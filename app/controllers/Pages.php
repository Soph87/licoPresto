<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
    }

    public function index()
    {
        $plats = $this->pageModel->getMenuItems();
        $data = [
            'plats' => $plats
        ];

        $this->view('pages/accueil', $data);
    }
}
