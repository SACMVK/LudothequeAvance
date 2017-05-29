/* 
 * Fichiers contenant les scripts de modification et d'adaptation de la base de données
 */
/**
 * Author:  Manu
 * Created: 27 mai 2017
 */

ALTER TABLE a_pour_image DROP PRIMARY KEY;
ALTER TABLE a_pour_image ADD PRIMARY KEY (source);
# Clés étrangères de la table a_pour_image
  # Clé étrangère idPC
ALTER TABLE a_pour_image 
ADD CONSTRAINT fk_idPC_a_pour_image FOREIGN KEY (idPC) REFERENCES jeu_t(idPC) ON DELETE CASCADE;