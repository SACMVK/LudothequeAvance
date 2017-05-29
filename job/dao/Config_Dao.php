<?php


Function loadConfig() {
	// stefan : Chargement du fichier
	$xml_config = simplexml_load_file ( 'data/config/config.xml' );
	// stefan : cr�ation d'un array
	$config = [];
	// stefan : pour chaque élément ...
	foreach ( $xml_config as  $xml_option ) {
		// stefan : on ajoute l'option ainsi que son texte
		$xml_nom_option = utf8_decode(strval($xml_option->nom));
		$xml_texte_affichage_option = utf8_decode(strval($xml_option->texte_affichage));
		$xml_valeur_option = utf8_decode(strval($xml_option->valeur));

		/* stefan : concernant les valeurs bool�ennes
		 * elles sont stockées en tant que string.
		 * is_bool ne permet pas de faire la conversion
		 * en boolean.
		 * On passe donc par un test de valeur de la string :
		 * si c'est 'true', alors on stocke une valeur booléenne true,
		 * si c'est 'false', alors on stocke une valeur booléenne false.
		 */
		if ($xml_valeur_option=='true'){
			$xml_valeur_option = true;
		}
		else if ($xml_valeur_option=='false'){
			$xml_valeur_option = false;
		}
		/* stefan : le seul test automatisable concerne les nombre.
		 * is_numeric permet de parser (parcourir) la string.
		 * Si tous les caract�res sont des nombres, alors il s'agit
		 * bien d'un numeric (integer, float, ...).
		 */
		else if (is_numeric ($xml_valeur_option)){
			$xml_valeur_option = (int)$xml_valeur_option;
		}
		/* stefan : sinon, il s'agit d'une valeur string.
		 */
		$config [$xml_nom_option] = [$xml_texte_affichage_option,$xml_valeur_option];
	}
	return $config;
}





Function saveConfig($config) {
	$xml_config_output = new DOMImplementation ();
	// Création d'une instance DOMDocumentType (dtd)
	$dtd = $xml_config_output->createDocumentType ( 'config', '', 'data/config/config.dtd' );
	// Création d'une instance DOMDocument
	$root = $xml_config_output->createDocument ( "", "", $dtd );
	$root->encoding = "utf-8";
	
	// Gestion de l'affichage (passage à la ligne à chaque noeud enfant de la racine
	$root->formatOutput = true;
	
	// Cr�ation de la racine et ajout au document
	$config_node = $root->createElement ( 'config' );
	$root->appendChild ( $config_node );
	
	// On parcourt la liste des options
	foreach ( $config as $nom_option => $option ) {
	
	$option_node = $root->createElement ( 'option' );
	$config_node->appendChild ( $option_node );
	
	$nom_node = $root->createElement ( 'nom' );
	$option_node->appendChild ( $nom_node );
	$contenu = $root->createTextNode ( utf8_encode ( $nom_option ) );
	$nom_node->appendChild ( $contenu );
	
	$texte_affichage_node = $root->createElement ( 'texte_affichage' );
	$option_node->appendChild ( $texte_affichage_node );
	$contenu = $root->createTextNode ( utf8_encode ( $option [0] ) );
	$texte_affichage_node->appendChild ( $contenu );
	
	$valeur_node = $root->createElement ( 'valeur' );
	$option_node->appendChild ( $valeur_node );
	if (gettype( $option [1] )=='boolean'){
		if ($option [1] ){
			$option [1] = 'true';
		}
		else {
			$option [1] = 'false';
		}
	}
	$contenu = $root->createTextNode ( utf8_encode ( $option [1] ) );
	$valeur_node->appendChild ( $contenu );
	
	}
	
	// Enregistrement du fichier
	$root->save ( 'data/config/config.xml' );
	

}