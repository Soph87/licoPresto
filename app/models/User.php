<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($email, $mdp)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $result = $this->db->resultSingle();
        $hashed_mdp = $result->mdp;

        if (password_verify($mdp, $hashed_mdp)) {
            return $result;
        }

        return false;
    }

    public function addUser($data)
    {
        $this->db->query('INSERT INTO users (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)');

        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mdp', $data['mdp']);

        if ($this->db->execute()) {
            $id = $this->db->lastId();
            return false;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->resultSingle();

        if ($this->db->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $user = $this->db->resultSingle();
        return $user;
    }

    public function updateUserAdresse($id, $adresse, $cp, $ville)
    {
        $this->db->query('UPDATE users SET adresse = :adresse, codepostal = :cp, ville = :ville WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':adresse', $adresse);
        $this->db->bind(':cp', $cp);
        $this->db->bind(':ville', $ville);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id, $data)
    {
        $this->db->query('UPDATE users SET prenom = :prenom, nom = :nom, email = :email, adresse = :adresse, codepostal = :cp, ville = :ville WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':adresse', $data['adresse']);
        $this->db->bind(':cp', $data['cp']);
        $this->db->bind(':ville', $data['ville']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
