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
							VALUES (:id_personne, id_sport, :nom);');

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

        return $listeNiveau;
        $req->closeCursor();
    }
}

?>
