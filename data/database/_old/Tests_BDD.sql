# -------- REQUETAGE TESTS RECETTE ----------------------#

SELECT * FROM compte c
JOIN individu i on i.idUser=c.idUser
JOIN notation_user nu ON nu.idUser=c.idUser
JOIN commentaire_user cu ON cu.idNU=nu.idNU;