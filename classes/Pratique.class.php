<?php

class Pratique
{
// Attributs
    private $idsport;
    private $idpersonne;
    private $niveau;

    public function __construct($valeurs = array())
    {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'id_sport':
                    $this->setIdSport($valeur);
                    break;
                case 'id_personne':
                    $this->setIdPersonne($valeur);
                    break;
                case 'niveau':
                    $this->setNiveau($valeur);
                    break;
            }
        }
    }

    public function getIdSport()
    {
        return $this->idsport;
    }

    public function setIdSport($idsport)
    {
        $this->idsport = $idsport;
    }

    public function getIdPersonne()
    {
        return $this->idpersonne;
    }

    public function setIdPersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;
    }
    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }
}
