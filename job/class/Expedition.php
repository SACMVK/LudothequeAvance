<?php

class Expedition {

    private $envoiDateEnvoi;
    private $envoiDateReception;
    private $envoiEtatJeu;
    private $envoiPiecesManquantes;
    private $retourDateEnvoi;
    private $retourDateReception;
    private $retourEtatJeu;
    private $retourPiecesManquantes;

    function __construct($envoiDateEnvoi, $envoiDateReception, $envoiEtatJeu, $envoiPiecesManquantes, $retourDateEnvoi, $retourDateReception, $retourEtatJeu, $retourPiecesManquantes) {
        $this->envoiDateEnvoi = $envoiDateEnvoi;
        $this->envoiDateReception = $envoiDateReception;
        $this->envoiEtatJeu = $envoiEtatJeu;
        $this->envoiPiecesManquantes = $envoiPiecesManquantes;
        $this->retourDateEnvoi = $retourDateEnvoi;
        $this->retourDateReception = $retourDateReception;
        $this->retourEtatJeu = $retourEtatJeu;
        $this->retourPiecesManquantes = $retourPiecesManquantes;
    }

    function setEnvoiDateEnvoi($envoiDateEnvoi){
        $this->envoiDateEnvoi = $envoiDateEnvoi;
    }
    function getEnvoiDateEnvoi(){
        return $this->envoiDateEnvoi;
    }
    function setEnvoiDateReception($envoiDateReception){
        $this->envoiDateReception = $envoiDateReception;
    }
    function getEnvoiDateReception(){
        return $this->envoiDateReception;
    }
    function setEnvoiEtatJeu($envoiEtatJeu){
        $this->envoiEtatJeu = $envoiEtatJeu;
    }
    function getEnvoiEtatJeu(){
        return $this->envoiEtatJeu;
    }
    function setEnvoiPiecesManquantes($envoiPiecesManquantes){
        $this->envoiPiecesManquantes = $envoiPiecesManquantes;
    }
    function getEnvoiPiecesManquantes(){
        return $this->envoiPiecesManquantes;
    }
    function setRetourDateEnvoi($retourDateEnvoi){
        $this->retourDateEnvoi = $retourDateEnvoi;
    }
    function getRetourDateEnvoi(){
        return $this->retourDateEnvoi;
    }
    function setRetourDateReception($retourDateReception){
        $this->retourDateReception = $retourDateReception;
    }
    function getRetourDateReception(){
        return $this->retourDateReception;
    }
    function setRetourEtatJeu($retourEtatJeu){
        $this->retourEtatJeu = $retourEtatJeu;
    }
    function getRetourEtatJeu(){
        return $this->retourEtatJeu;
    }
    function setRetourPiecesManquantes($retourPiecesManquantes){
        $this->retourPiecesManquantes = $retourPiecesManquantes;
    }
    function getRetourPiecesManquantes(){
        return $this->retourPiecesManquantes;
    }

    
    
    
}
