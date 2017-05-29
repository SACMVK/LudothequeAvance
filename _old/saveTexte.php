<?php


Function saveTexte($texte) {
	/*
	r : ouvre en lecture seule, et place le pointeur de fichier au début du fichier.
    r+ : ouvre en lecture et écriture, et place le pointeur de fichier au début du fichier.
    w : ouvre en écriture seule; place le pointeur de fichier au début du fichier et réduit la taille du fichier à 0. Si le fichier n'existe pas, on tente de le créer.
    w+ : ouvre en lecture et écriture; place le pointeur de fichier au début du fichier et réduit la taille du fichier à 0. Si le fichier n'existe pas, on tente de le créer.
    a : ouvre en écriture seule; place le pointeur de fichier à la fin du fichier file. Si le fichier n'existe pas, on tente de le créer.
    a+ : ouvre en lecture et écriture; place le pointeur de fichier à la fin du fichier. Si le fichier n'existe pas, on tente de le créer.
	 */
	$fichier = fopen ("data/_old/errorLog.txt", "w+");
	// Ecriture du texte
	fputs ($fichier, $texte);//$texte['texte']
	// Fermeture
	fclose ($fichier);
}
