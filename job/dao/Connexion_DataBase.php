<?php




Function openConnexion(){
	try {
		/* stefan : Variable de chemin de la base de donn�es.
		 */
		$cheminConnexion = 'mysql:host=localhost;dbname=ludotheque';
		
		/* stefan : Variable de login
		 */
		$login = 'root';
		
		/* stefan : Variable de login
		 */
		$pwd = '';
		
		/* stefan : Commande pour utilisation utf-8
		 */
		$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		
		/* stefan : Instanciation de la connexion en utilisant le chemin de la base de donn�es,
		 * le login, le mot de passe et les param�tres suppl�mentaires.
		 */
		$pdo = new PDO($cheminConnexion, $login, $pwd, $arrExtraParam);
		
		// G�n�ration rapport erreurs
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	return $pdo;
}

Function closeConnexion() {
    return null;
}




