<?php

class PersonneManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add(Personne $personne)
    {
        $requete = $this->db->prepare(
            'INSERT INTO personne (nom, prenom, depart, mail)
							VALUES (:nom, :prenom, :departement, :mail);');

        $requete->bindValue(':nom', $personne->getNom());
        $requete->bindValue(':prenom', $personne->getPrenom());
        $requete->bindValue(':departement', $personne->getDepartement());
        $requete->bindValue(':mail', $personne->getMail());

        return $requete->execute();
    }

    public function getPersonne($num)
    {
        $requete = $this->db->prepare(
            'SELECT id_personne, nom, prenom, depart, mail
				FROM personne where id_personne=:num;');
        $requete->bindValue(':num', $num);
        $requete->execute();
        return new Personne($requete->fetch(PDO::FETCH_OBJ));
    }
}

?>
