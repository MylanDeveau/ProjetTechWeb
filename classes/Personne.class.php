<?php

class Personne
{
// Attributs
    private $idpersonne;
    private $nom;
    private $prenom;
    private $departement;
    private $mail;

    public function __construct($valeurs = array())
    {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'id_personne':
                    $this->setIdPersonne($valeur);
                    break;
                case 'nom':
                    $this->setNom($valeur);
                    break;
                case 'prenom':
                    $this->setPrenom($valeur);
                    break;
                case 'depart':
                    $this->setDepartement($valeur);
                    break;
                case 'mail':
                    $this->setMail($valeur);
                    break;
            }
        }
    }

    public function getIdPersonne()
    {
        return $this->idpersonne;
    }

    public function setIdPersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }
}
