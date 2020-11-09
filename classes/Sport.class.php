<?php

class Sport
{
// Attributs
    private $idsport;
    private $nom;

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
                case 'nom':
                    $this->setNom($valeur);
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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
}
