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

    public function getRecherche($id_sport, $niveau, $depart)
    {
        $listePersonne =array();
        $sql='SELECT p.nom, prenom,depart FROM `personne` p JOIN pratique pr ON p.id_personne = pr.id_personne
                                                     JOIN sport s ON s.id_sport=pr.id_sport
        WHERE s.id_sport='.$id_sport.' AND niveau=\''.$niveau.'\'
        AND depart='.$depart.' AND p.id_personne !='.$_COOKIE['connect'].'
        GROUP BY p.nom, prenom
        ORDER BY p.nom';
        $req= $this->db->query($sql);

        while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
              $listePersonne[] = new Personne($personne);
        }
        $req->closeCursor();
        return $listePersonne;
    }


    public function getAllPersonne()
    {
        $listePersonne =array();
        $sql='SELECT id_personne, nom, prenom, depart, mail FROM personne';
        $req= $this->db->query($sql);

        while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
              $listePersonne[] = new Personne($personne);
        }
        $req->closeCursor();
        return $listePersonne;
    }

    public function getDepartement()
    {
        $listeDepartement =array();
        $sql='SELECT DISTINCT depart FROM personne
              ORDER BY depart';
        $req= $this->db->query($sql);

        while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
              $listeDepartement[] = new Personne($personne);
        }
        $req->closeCursor();
        return $listeDepartement;
    }

    public function getPersonneMail($mail)
    {
      $requete = $this->db->prepare(
        'SELECT id_personne, nom, prenom, depart, mail
        FROM personne where mail=:mail;');
        $requete->bindValue(':mail', $mail);
        $requete->execute();
        return new Personne($requete->fetch(PDO::FETCH_OBJ));
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
