<?php

class emprunt {

    public $idJeuP = null;
    public $idJeuT = null;
    public $nomJeu = null;
    public $idPreteur = null;
    public $nomPreteur = null;
    public $idEmprunteur = null;
    public $nomEmprunteur = null;
    public $dateInscriptionPreteur = null;
    public $dateInscriptionEmprunteur = null;
    public $statut = null;
    public $notification = null;
    public $propositionEmprunteurDateDebut = null;
    public $propositionEmprunteurDateFin = null;
    public $propositionPreteurDateDebut = null;
    public $propositionPreteurDateFin = null;
    public $envoiDateEnvoi = null;
    public $envoiDateReception = null;
    public $envoiEtatJeu = null;
    public $envoiPiecesManquantes = null;
    public $retourDateEnvoi = null;
    public $retourDateReception = null;
    public $retourEtatJeu = null;
    public $retourPiecesManquantes = null;

    function __construct() {
        
    }

    public function __toString() {
        $texte = $this->nomPreteur[1] . " " . $this->nomPreteur[0] . " | id " . $this->idPreteur . " | inscrit depuis " . $this->dateInscriptionPreteur . "<br>";
        $texte .= $this->nomEmprunteur[1] . " " . $this->nomEmprunteur[0] . " | id " . $this->idEmprunteur . " | inscrit depuis " . $this->dateInscriptionEmprunteur . "<br>";
        $texte .= $this->nomJeu . " | id " . $this->idJeuP . "<br>";
        $texte .= "<b>Etat de la demande</b> : " . $this->statut;
        $texte .= " (étape " . $this->notification . ")<br>";
        $texte .= "Proposition dates d'emprunt : du " . $this->propositionEmprunteurDateDebut . " au " . $this->propositionEmprunteurDateFin . "<br>";
        if ($this->propositionPreteurDateDebut != null) {
            $texte .= "Contre-proposition dates de prêt : du " . $this->propositionPreteurDateDebut . " au " . $this->propositionPreteurDateFin . "<br>";
        }
        $texte .= $this->printNotification();
        if ($this->envoiEtatJeu != null) {
            $texte .= "<b>Date envoi</b> " . $this->envoiDateEnvoi . " | ";
            $texte .= "<b>date réception</b> " . $this->envoiDateReception . "<br>";
            $texte .= "<b>Etat</b> " . $this->envoiEtatJeu . " | ";
            $texte .= "<b>Pièces manquantes</b> " . $this->envoiPiecesManquantes . "<br>";
        }
        if ($this->retourEtatJeu != null) {
            $texte .= "<b>Date renvoi</b> " . $this->retourDateEnvoi . " | ";
            $texte .= "<b>Date réception</b> " . $this->retourDateReception . "<br>";
            $texte .= "<b>Etat</b> " . $this->retourEtatJeu . " | ";
            $texte .= "<b>Pièces manquantes</b> " . $this->retourPiecesManquantes . "<br>";
        }
        return $texte;
    }

    public function genererExpedition(int $nombreDate) {
        if ($nombreDate >= 2) {
            $this->envoiEtatJeu = $this->getEtat();
            rand(0, 100) < 4 ? $this->envoiPiecesManquantes = "oui" : $this->envoiPiecesManquantes = "non";
        }
        if ($nombreDate == 4) {
            $this->retourEtatJeu = $this->getEtat();
            rand(0, 100) < 8 ? $this->retourPiecesManquantes = "oui" : $this->retourPiecesManquantes = "non";
        }
    }

    private function getEtat() {
        $listEtats = ["Neuf", "Bon état","Usé", "Abimé"];
        return $listEtats[rand(0, count($listEtats) - 1)];
    }

    private function printNotification() {
        $AnciennesValeurs = ["#nomJeu#", "#nomPreteur#", "#nomEmprunteur#", "#dateDebut#", "#dateFin#", "#envoiDateEnvoi#", "#envoiDateReception#", "#retourDateEnvoi#", "#retourDateReception#"];
        if ($this->propositionPreteurDateDebut == null) {
            $dateDebutValidee = $this->propositionEmprunteurDateDebut;
            $dateFinValidee = $this->propositionEmprunteurDateFin;
        } else {
            $dateDebutValidee = $this->propositionPreteurDateDebut;
            $dateFinValidee = $this->propositionPreteurDateFin;
        }
        $NouvellesValeurs = [$this->nomJeu, $this->nomPreteur[1] . " " . $this->nomPreteur[0], $this->nomEmprunteur[1] . " " . $this->nomEmprunteur[0], $dateDebutValidee, $dateFinValidee,$this->envoiDateEnvoi,$this->envoiDateReception,$this->retourDateEnvoi,$this->retourDateReception];

        $pdo = openConnexion();
        $requete = "SELECT * FROM notification WHERE idNotification='" . $this->notification . "';";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        $listEtats = null;
        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listEtats [] = $ligne;
        }
        $pdo = closeConnexion();
        $notification = "<b>Prêteur : " . $listEtats[0]["sujetPreteur"] . "</b> " . $listEtats[0]["corpsPreteur"] . "<br><b>Emprunteur : " . $listEtats[0]["sujetEmprunteur"] . "</b> " . $listEtats[0]["corpsEmprunteur"] . "<br>";
        return str_replace($AnciennesValeurs, $NouvellesValeurs, $notification);
    }

}
