<?php

class SportManager
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add(Sport $sport)
    {
        $requete = $this->db->prepare(
            'INSERT INTO sport (nom)
							VALUES (:nom);');

        $requete->bindValue(':nom', $sport->getNom());
        return $requete->execute();
    }

    public function getAllSport()
    {
        $listeSport =array();
        $sql='SELECT id_sport, nom FROM sport';
        $req= $this->db->query($sql);

        while ($sport = $req->fetch(PDO::FETCH_OBJ)) {
              $listeSport[] = new Sport($sport);
        }

        return $listeSport;
        $req->closeCursor();
    }
}

?>
