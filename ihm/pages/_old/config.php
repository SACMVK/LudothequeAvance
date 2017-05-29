<?php

/* stefan : titre page
 */
echo utf8_encode('<h1>Configuration</h1>');

/* stefan : les variables $config et $liste_droits
 * ont �t� cr��es dans l'index.
 */

/* stefan : A chaque "submit", PHP sauvegarde les donn�es du formulaire
 * dans l'array $_POST, variable accessible depuis l'ensemble du programme.
 * On peut donc r�cup�rer ces valeurs afin de mettre � jour l'objet $config.
 * Enfin, comme submit recharge la page,
 * il va donc relancer toutes les actions de la page.
 */

// stefan : fonction de mise � jour de l'objet $config par rapport aux valeurs stock�es dans $_POST
$config = miseAJourConfig($config);

/* stefan : fonction d'affichage de l'objet $config et $_POST (sur les cl�s $config
 * A d�commenter pour tester
 */
affichageObjetConfig($config);
affichageObjetPOST($config);

// stefan : fonction d'affichage de la page
echo utf8_encode(afficherConfig($config,$liste_droits));


// stefan : fonction d'enregistrement du XML
saveConfig($config);


Function afficherConfig($config,$liste_droits){
	
	/* stefan : Balise d'ouverture du formulaire
	 */
	$affichage_config = '<DIV id=config><FORM name=config action="index.php" method="POST"><HR/>';
	
	/* stefan : On fait une boucle afin de traiter chaque option
	 * en fonction de son type :
	 * on met une checkbox s'il s'agit d'un boolean,
	 * une zone de saisie avec fl�ches s'il s'agit d'un nombre
	 * une liste d�roulante (SELECT + OPTION) s'il s'agit d'attribuer
	 * un niveau de droits � une action.
	 */
	foreach ( $config as $xml_nom_option => $option ) {
		/* stefan : on ajoute l'option ainsi que son texte explicatif.
		 * Chaque option recevra en name le nom dans le XML (diff�rent du texte explicatif).
		 * Cela permet la r�cup�ration des donn�es lors de la soumission du formulaire.
		 */
		$affichage_config .= '<DIV class=text><LABEL for="'.$xml_nom_option.'">'.$option[0].'</LABEL></DIV>';
		/* stefan : ci-dessous ligne � d�commenter afin de voir le type des diff�rentes valeurs:
		 * NB : quand il s'agit d'une valeur booldean false, php n'affiche rien.
		 * On peut forcer son affichage � l'aide d'un caste (int)
		 */
		
		 //echo utf8_encode($xml_nom_option.' '.$option[0].' '.$option[1].' '.gettype($option[1]).'<br>');
		 
		
		/* stefan : en fonction du type, on va afficher diff�rents types d'input
		 * 
		 */
		switch (gettype($option[1])){
			/* stefan : Dans le cas o� il s'agit d'une valeur bool�enne,
			 * on va afficher un liste d�roulante comportant deux choix possibles : oui ou non.
			 */
			case 'boolean':$xml_nom_option;
			/* stefan : Ouverture de la balise de liste d�roulante
			 */
			$affichage_config .= '<SELECT class=valeur_option_boolean name="'.$xml_nom_option.'">';
			/* stefan : si le boolean == true,
			 * alors on cr�� la liste avec "oui" s�lectionn�.
			 */
			if ($option[1]){
				$affichage_config .= '<OPTION value=1 selected="selected">oui</OPTION>';
				$affichage_config .= '<OPTION value=0>non</OPTION>';
			}
			/* stefan : Sinon, on cr�� la liste avec le "non" s�lectionn�.
			 */
			else {
				$affichage_config .= '<OPTION value=1>oui</OPTION>';
				$affichage_config .= '<OPTION value=0 selected="selected">non</OPTION>';
			}
			/* stefan : Fermeture de la balise de liste d�roulante
			 */
			$affichage_config .= '</SELECT>';
			break;
			/* stefan : l'input number permet d'afficher les deux fl�ches pour
			 * augmenter ou diminuer les valeurs.
			 * J'ai �galement mis un minimum (min=0) afin d'�viter les valeurs n�gatives.
			 */
			case 'integer':
			$affichage_config .= '<INPUT type=number class=valeur_option_number name="'.$xml_nom_option.'"  value='.$option[1].' min=0></INPUT>';
			break;
			/* stefan : par d�faut, il s'agit du select box des droits.
			 */
			default:
				/* stefan : Balise d'ouverture de la liste d�roulante
				 */
				$affichage_config .= '<SELECT class=valeur_option_select name="'.$xml_nom_option.'">';
				/* stefan : On parcours la liste des droits issus de la base de donn�es
				 * afin de cr�er la liste d�roulante des droits.
				 */
				foreach ( $liste_droits as $droit ) {
					/* stefan : Si la valeur du XML ne correspond � aucune valeur de la base de donn�es,
					 * la page n'en tiendra pas compte et affichera la premi�re valeur (adml).
					 * Sinon, la valeur du XML sera celle s�lectionn�e dans la liste d�roulante.
					 */
					$selected = '';
					if ($option[1]==$droit){
						$selected = 'selected="selected"';
					}
					/* stefan : Ajout du droit � la liste d�ronlte
					 */
					$affichage_config .= '<OPTION value='.$droit.' '.$selected.'>'.$droit.'</OPTION>';
				}
				/* stefan : Balise de fermeture de la liste d�roulante
				 */
				$affichage_config .= '</SELECT>';
			break;
		}
		$affichage_config .= '<HR/>';
	}

	/* Saut de ligne pour espacer la liste des options avec le bouton de sauvegarde.
	 */
	$affichage_config .= '<br><br>';
	
	/* stefan : ajout du bouton de sauvegarde
	 */
	$affichage_config .= '<DIV><INPUT type=submit class=bouton_config value="Sauvegarder la configuration"/></DIV>';
	
	/* stefan : balise de fermeture du formulaire
	 */
	$affichage_config .= '</FORM><DIV>';
	
	
	return $affichage_config;
}





/* Quand on clique sur sauvegader,
 * les donn�es sont entr�es dans la variable $_POST,
 * qui est une supervariable globale accessible de partout.
 * Chaque donn�e est entr�e de la mani�re suivante :
 * $_POST [name] = valeur.
 * Le "name" est celui des input et select.
 * C'est la cl� par laquelle on pourra donc retrouver nos valeurs dans $_POST.
 */
Function miseAJourConfig($config){
	foreach ( $config as $xml_nom_option => $option ) {
		/* stefan : on commence par un test pour savoir si la cl� existe dans $_POST :
		 * si la page est charg�e, le $_POST est vide.
		 * $_POST contiendra les valeurs � mettre � jour une fois submit cliqu�.
		 */
		if(array_key_exists($xml_nom_option,$_POST)){
			/* stefan : on a toujours ce probl�me de stockage de valeurs bool�enne dans PHP :
			 * il met des 0 et des 1. Qui peuvent pour le coup passer pour des integers.
			 * On a donc un switch en fonction du type initial de la valeur stock�e
			 * dans $config et on caste les valeurs de $_POST en fonction.
			 * Ce qui est ne simplifie pas les choses, c'est que l'on peut
			 * entrer des valeurs bool�ennes avec 0/1 ou true/false,
			 * PHP accepte les deux mais stocke 0/1.
			 */
			switch (gettype($option[1])){
				case 'boolean':
					if ($_POST[$xml_nom_option]==1){
						$config[$xml_nom_option][1] = true;
					}
					else {
						$config[$xml_nom_option][1] = false;
					};
				break;
				case 'integer':
					$config[$xml_nom_option][1] = (int)$_POST[$xml_nom_option];
				break;
				default:
					$config[$xml_nom_option][1] = $_POST[$xml_nom_option];
			}
		}
	}
	return $config;
}


/* stefan : Fonctions d'affichage dont je me suis servi
 * pour le debuggage (notamment un soucis de rafraichissement du formulaire
 * et de probl�me sur le stockage des valeurs bool�ennes.
 */


Function affichageObjetConfig($config){
	foreach ( $config as $xml_nom_option => $option ) {
		echo 'exist '.$xml_nom_option.array_key_exists($xml_nom_option,$_POST).'<br>';
		echo utf8_encode($xml_nom_option).'<br>';
		echo utf8_encode($option[0]).'<br>';
		echo utf8_encode($option[1]).'<br>';
		echo '<br>';
	}
}

Function affichageObjetPOST($config){
	foreach ( $config as $xml_nom_option => $option ) {
		echo 'exist '.$xml_nom_option.array_key_exists($xml_nom_option,$_POST).'<br>';
		echo utf8_encode($_POST[$xml_nom_option]).'<br>';
		echo gettype($_POST[$xml_nom_option]).'<br>';
		echo '<br>';
	}
}



?>







