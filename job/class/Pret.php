<?php

class Pret {

    private $idPret;
    private $jeuP;
    private $emprunteur;
    private $propositionEmprunteurDateDebut;
    private $propositionEmprunteurDateFin;
    private $propositionPreteurDateDebut;
    private $propositionPreteurDateFin;
    private $idNotification;
    private $notification; // Dictionnaire avec pour clés : sujetPreteur, corpsPreteur, sujetEmprunteur, corpsEmprunteur
    private $statutDemande;
    private $expedition;

    function __construct($jeuP, $emprunteur, $propositionEmprunteurDateDebut, $propositionEmprunteurDateFin, $propositionPreteurDateDebut, $propositionPreteurDateFin, $idNotification, $notification, $statutDemande, $idPret = -1) {
        $this->idPret = $idPret;
        $this->jeuP = $jeuP;
        $this->emprunteur = $emprunteur;
        $this->propositionEmprunteurDateDebut = $propositionEmprunteurDateDebut;
        $this->propositionEmprunteurDateFin = $propositionEmprunteurDateFin;
        $this->propositionPreteurDateDebut = $propositionPreteurDateDebut;
        $this->propositionPreteurDateFin = $propositionPreteurDateFin;
        $this->idNotification = $idNotification;
        $this->notification = $notification;
        $this->statutDemande = $statutDemande;
    }

    public function getIdPret() {
        return $this->idPret;
    }

    public function setIdPret($idPret) {
        $this->idPret = $idPret;
    }

    public function getJeuP() {
        return $this->jeuP;
    }

    public function setJeuP($jeuP) {
        $this->jeuP = $jeuP;
    }

    public function getEmprunteur() {
        return $this->emprunteur;
    }

    public function setEmprunteur($emprunteur) {
        $this->emprunteur = $emprunteur;
    }

    public function getPropositionEmprunteurDateDebut() {
        return $this->propositionEmprunteurDateDebut;
    }

    public function setPropositionEmprunteurDateDebut($propositionEmprunteurDateDebut) {
        $this->propositionEmprunteurDateDebut = $propositionEmprunteurDateDebut;
    }

    public function getPropositionEmprunteurDateFin() {
        return $this->propositionEmprunteurDateFin;
    }

    public function setPropositionEmprunteurDateFin($propositionEmprunteurDateFin) {
        $this->propositionEmprunteurDateFin = $propositionEmprunteurDateFin;
    }

    public function getPropositionPreteurDateDebut() {
        return $this->propositionPreteurDateDebut;
    }

    public function setPropositionPreteurDateDebut($propositionPreteurDateDebut) {
        $this->propositionPreteurDateDebut = $propositionPreteurDateDebut;
    }

    public function getPropositionPreteurDateFin() {
        return $this->propositionPreteurDateFin;
    }

    public function setPropositionPreteurDateFin($propositionPreteurDateFin) {
        $this->propositionPreteurDateFin = $propositionPreteurDateFin;
    }

    public function getIdNotification() {
        return $this->idNotification;
    }

    public function setIdNotification($idNotification) {
        $this->idNotification = $idNotification;
    }

    public function getNotification() {
        return $this->notification;
    }

    public function setNotification($notification) {
        $this->notification = $notification;
    }

    public function getStatutDemande() {
        return $this->statutDemande;
    }

    public function setStatutDemande($statutDemande) {
        $this->statutDemande = $statutDemande;
    }

    public function getExpedition() {
        return $this->expedition;
    }

    public function setExpedition($expedition) {
        $this->expedition = $expedition;
    }

    public static function getPretFromId($id) {
        foreach ($_SESSION["mesPrets"] as $pret) {
            if ($pret->getIdPret() == $id) {
                return $pret;
            }
        }
    }

    public static function getEmpruntFromId($id) {
        foreach ($_SESSION["mesEmprunts"] as $emprunt) {
            if ($emprunt->getIdPret() == $id) {
                return $emprunt;
            }
        }
    }

}
