<?php

class Message {

    // Charlotte

    private $idMessage;
    private $exp;// Objet Class Compte (Individu)
    private $dest;// Objet Class Compte (Individu)
    private $dateEnvoi;
    private $sujet;
    private $texte;

    //charlotte :constructeur 


    function __construct($exp, $dest, $dateEnvoi, $sujet, $texte, $idMessage = -1) {
        $this->idMessage = $idMessage;
        $this->exp = $exp;
        $this->dest = $dest;
        $this->dateEnvoi = $dateEnvoi;
        $this->sujet = $sujet;
        $this->texte = $texte;
    }

    // charlotte : getters et setters
    // idmessage
    public function getIdMessage() {
        return $this->idMessage;
    }

    public function setIdMessage($idMessage) {
        $this->idMessage = $idMessage;
    }

    // id expéditeur
    public function getExp() {
        return $this->exp;
    }

    public function setExp($exp) {
        $this->exp = $exp;
    }

    // id destinataire
    public function getDest() {
        return $this->dest;
    }

    public function setDest($dest) {
        $this->dest = $dest;
    }

    // type de Message


    public function getDateEnvoi() {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi($dateEnvoi) {
        $this->dateEnvoi = $dateEnvoi;
    }

    // sujet


    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    // texte

    public function getTexte() {
        return $this->texte;
    }

    public function setTexte($texte) {
        $this->texte = $texte;
    }

    // charlotte: ToString pour afficher 
    public function __toString() {
        return ( "idMessage= " . $this->idMessage . ", expediteur :" . $this->exp . ", destinataire: " . $this->dest . ", date d'envoi: " . $this->dateEnvoi . "sujet : " . $this->sujet . "texte : " . $this->texte);
    }

}
