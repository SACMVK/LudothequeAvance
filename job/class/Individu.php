
<?php

class Individu extends Compte {

    // AhMaD: les attributs pour individu ca-a-dire un utilisateur et peut etre une groupe

    private $nom;
    private $prenom;
    private $dateNaissance;

    // AhMaD: Le connecteur aves (id user =-1) cela pour eviter faire deuxime constructeur pour le BD.
    //comme ca si tu crée un nouveau objet avec id il vas prendre le prendre sinon l'id=-1 par defaut  
    function __construct($ville, $adresse, $codePostal, $dpt, $email, $telephone, $pseudo, $dateInscription, $mdp, $droit, $nom, $prenom, $dateNaissance, $idUser = -1) {
       parent::__construct($ville, $adresse, $codePostal, $dpt, $email, $telephone, $pseudo, $dateInscription, $mdp, $droit, $idUser);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
    }

    // AhMaD: getter et setter, on vas les utiliser pour chercher les informations ou les modifier
    // iduser
    // id


    // nom
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    // prenom
    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    // date naissance
    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }



    // AhMaD: ToString pour afficher l'objet, le point pour concaténer, cela comme (+) en java
    function __toString() {
        return( "id= " . $this->idUser . ", Email :" . $this->email . ", N° tel: " . $this->telephone . ", Pseudo: " . $this->pseudo
                . ", Date d'nscription: " . $this->dateInscription . ", Mot de passe : " . $this->mdp . ", Droit: " . $this->droit . ", Nom: "
                . $this->nom . ", Prenom" . $this->prenom . ", Date de Naissance: " . $this->dateNaissance . ", Address complète est :  ville:" . $this->ville .
                ", Adresse" . $this->adresse . ", code postal" . $this->codePostal . ", departement:" . $this->dpt);
    }

}
