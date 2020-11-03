<?php
class Commande
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

    public function getPlatById($id)
    {
        $this->db->query("SELECT * FROM menu WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultSingle();
    }

    public function ajoutCmd($user_id, $total, $adresse, $commande, $stripe_id)
    {
        $this->db->query('INSERT INTO commandes (id_user, prix_total, adresse_livraison, stripe_id) VALUES (:id, :total, :adresse, :stripe)');
        $this->db->bind(':id', $user_id);
        $this->db->bind(':total', $total);
        $this->db->bind(':adresse', $adresse);
        $this->db->bind(':stripe', $stripe_id);

        if ($this->db->execute()) {
            $id = $this->db->lastId();
            $result = $this->ajoutDetailCmd($id, $commande);
            return $result;
        } else {
            return false;
        }
    }

    public function ajoutDetailCmd($idCmd, $commande)
    {
        $this->db->query('INSERT INTO lignes_cmd(id_cmd, id_plat, quantite, prix_unite) VALUES (:id_cmd, :id_plat, :qtt, :prix )');
        $result = true;
        foreach ($commande as $ligne) {
            $this->db->bind(':id_cmd', $idCmd);
            $this->db->bind(':id_plat', $ligne->id_plat);
            $this->db->bind(':qtt', $ligne->qtt);
            $this->db->bind(':prix', $ligne->prix_unite);
            if (!$this->db->execute()) {
                $result = false;
            }
        }

        return $result;
    }

    public function getCommandesByUser($id)
    {
        $this->db->query('SELECT id, date, prix_total from commandes WHERE id_user = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getLignesCmdByIdCmd($id)
    {
        $this->db->query('SELECT lignes_cmd.quantite, lignes_cmd.prix_unite, menu.nom 
        FROM lignes_cmd 
        INNER JOIN menu
        ON menu.id = lignes_cmd.id_plat
        WHERE lignes_cmd.id_cmd = :id');

        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
}
