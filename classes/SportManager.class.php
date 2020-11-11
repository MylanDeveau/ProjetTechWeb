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

    public function getFirstSport($id_personne)
    {
        $requete = $this->db->prepare(
        'SELECT s.id_sport, s.nom FROM `personne` p JOIN pratique pr ON p.id_personne = pr.id_personne
                                                     JOIN sport s ON s.id_sport=pr.id_sport
        WHERE p.id_personne=:id_personne
        LIMIT 1');
        $requete->bindValue(':id_personne', $id_personne);
        $requete->execute();
        return new Sport($requete->fetch(PDO::FETCH_OBJ));
      }
}

?>
