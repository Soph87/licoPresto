<?php
class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMenuItems()
    {
        $this->db->query("SELECT * FROM menu");
        return $this->db->resultSet();
    }
}
