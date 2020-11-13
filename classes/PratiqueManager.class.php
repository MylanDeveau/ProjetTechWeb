<?php

class PratiqueManager
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add(Pratique $pratique)
    {
        $requete = $this->db->prepare(
            'INSERT INTO pratique (id_personne, id_sport, niveau)
							VALUES (:id_personne, :id_sport, :niveau);');

        $requete->bindValue(':id_personne', $pratique->getIdPersonne());
        $requete->bindValue(':id_sport', $pratique->getIdSport());
        $requete->bindValue(':niveau', $pratique->getNiveau());
        return $requete->execute();
    }

    public function getNiveauExistants()
    {
        $listeNiveau =array();
        $sql='SELECT DISTINCT niveau FROM pratique';
        $req= $this->db->query($sql);

        while ($pratique = $req->fetch(PDO::FETCH_OBJ)) {
              $listeNiveau[] = new Pratique($pratique);
        }
        $req->closeCursor();
        return $listeNiveau;
    }

    public function getNiveau($id_personne, $id_sport)
    {
        $requete = $this->db->prepare(
        'SELECT pr.id_sport, pr.id_sport, niveau FROM `personne` p JOIN pratique pr ON p.id_personne = pr.id_personne
                                                                   JOIN sport s ON s.id_sport=pr.id_sport
        WHERE pr.id_personne=:id_personne AND pr.id_sport=:id_sport');
        $requete->bindValue(':id_personne', $id_personne);
        $requete->bindValue(':id_sport', $id_sport);
        $requete->execute();
        return new Pratique($requete->fetch(PDO::FETCH_OBJ));
      }
}

?>
