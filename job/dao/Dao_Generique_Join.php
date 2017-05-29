<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * retourne la liste des champs d'une table sous forme de tableau
 * @param $pdo connection sur la base de donnees
 * @param $tableName nom de la table dont on veut la liste des champs
 * @return array liste des noms de champs de $tableName
 */
function getFieldsName ($pdo, $tableName) {
	$recordset = $pdo->query("SHOW COLUMNS FROM $tableName");
	$fields = $recordset->fetchAll(PDO::FETCH_ASSOC);
	foreach ($fields as $field) {
		$fieldNames[] = $field['Field'];
	}
	return $fieldNames;
}

/*
 * Fonction permettant d'énumerer les champs du constructeur par rapport à la construction dao
 * exemple : pour jeu_t,; énumère tous les champs du constructeur : $nbJoueursMin,$nbJoueursMax,$nom,$editeur,$regles,$difficulte,$public,$listePieces,$dureePartie pour la table jeu_t
 * @param $fieldsTable : Liste des noms des colonnes de la table
 */
function argConstruct($fieldsTable) {
    $valconst=array();
    for($i = 1, $size = count($fieldsTable); $i < $size; ++$i) {
        $valconst .= $$fieldsTable[$i].',';
        
    } 
    return $valconst;
}
  
/* Fonction DAO générique permettant de récupérer les valeurs des champs de 3 tables différents dans une même liste
 * @param $tablePK1 première table qui dispose de l'id PK
 * @param $table2 deuxième table  
 * @param $table3 troisième table
 * @param $onPK Clé primaire sur laquelle se font les jointures, ex : 'idPC'
 * @return array liste des des valeurs des 3 tables
 */

Function selectJoin($tablePK1,$table2,$table3,$onPK){
	/* M : Ouverture de la connexion
	 */
	$pdo = openConnexion();

	
	/* M : préparation de la requete - permet d'adapter les requetes en fonctions de variables
	 */
	$requete = "SELECT * FROM ".$table2." JOIN ".$tablePK1." ON ".$tablePK1.".".$onPK."=".$table2.".".$onPK." JOIN ".$table3." ON ".$table3.".".$onPK."=".$table2.".".$onPK.";";
        $fieldsT1[] = getFieldsName($pdo,$tablePK1);  //Liste des noms des colonnes de la première table qui dispose de l'id PK
        $fieldsT2[] = getFieldsName($pdo,$table2);    //Liste des noms des colonnes de la deuxième table
        $fieldsT3[] = getFieldsName($pdo,$table3);    //Liste des noms des colonnes de la troisième table
	$stmt = $pdo->prepare($requete);
	
	
	/* M : 
	 */
	$stmt->execute() ;

        //test qu'est ce que j'ai mis dans les array avec var_dump
        var_dump($fieldsT1);
        var_dump($fieldsT2);
        var_dump($fieldsT3);

	/* M : DÃ©claration de la variable liste que l'on va retourner
	 */
	$liste_Objet = array();
	
	/* M : Ressort chaque entrÃ©es une Ã  une
	 */
	while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) // Chaque entrÃ©e sera rÃ©cupÃ©rÃ©e et placÃ©e dans un array.
        {
            
            /* M :crÃ©ation des variable en local qui rÃ©cupÃ¨rent les donnÃ©es de la table pour chaque champs de l'objet
             *  en fonction du constructeur dÃ©fini dans Jeu_T
             */

            for($i = 1, $size = count($fieldsT2); $i < $size; ++$i) {
                $$fieldsT2[$i] = $donnees[$fieldsT2][$i]; // a vérifier car m'indique une erreur de conversion array to string, je ne sais pas si mon ajout de nom de variable est OK
            }
            for($j = 0, $size = count($fieldsT1); $j < $size; ++$j) {
                $$fieldsT1[$j] = $donnees[$fieldsT1][$j];
            }
            for($k = 0, $size = count($fieldsT3); $k < $size; ++$k) {
                $$fieldsT3[$k] = $donnees[$fieldsT3][$k];
            }
         /*foreach ($fieldsT2 as $keyT2 => $valueT2) {
             echo 'valueT2 ='.$keyT2[0].$valueT2; //test ce qui est mis dans la key et dans la value
             echo 'hello';
             $$valueT2 = $donnees[$valueT2];
         }

         foreach ($fieldsT1 as $keyT1 => $valueT1) {
             $$keyT1 = $donnees[$valueT1];
         }      
         foreach ($fieldsT3 as $keyT3 => $valueT3) {
             $$keyT3 = $donnees[$valueT3];
         }*/
            
            /* crÃ©ation du nouvel objet Jeu_T */
            $argsT2=implode(",",argConstruct($fieldsT2));
            $argsT1=implode(",",argConstruct($fieldsT1));
            $argsT3=implode(",",argConstruct($fieldsT3));
            
            $$table2 = new Jeu_T($argsT2.$argsT1.$argsT3.$donnees[$fieldsT1][0]);// Il faudrait renommer la classe comme la table donc dans le cas des jeu_t changer au lieu de Jeu_T
            
            // ajout de l'objet Ã  la liste
            $liste_Objet []= $$table2;
	}
	
	
	/* M : Fermeture de la connexion
	 */
	$pdo = closeConnexion();
	
	/* M : La valeur retournÃ©e est un array
	 */
	return $liste_Objet;
       
}