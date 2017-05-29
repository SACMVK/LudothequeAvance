<html>
<head>
<!-- require_once ('ihm/pages/feedback.php') -->
<title>Ludotheque BTS</title>

<?php require ('ihm/css/effets.php'); ?>
</head>


<body>
	
<?php require_once ('ihm/header/header.php');?>
<?php require_once ('ihm/menus/menuAdmin.php');?>
<?php require_once ('job/class/Individu.php');?>
    require_once ('resultat/individu_liste.php');
    
    require_once ('job/class/Individu.php');
$compte1 = new Individu('vannes', 'victor hugo', 56000, 'morhbien', 'user1@gmail.fr', 065346526, 'user1', 2017, 1224, 'admin', 'user1', 'user1', '1999');
$compte2 = new Individu('Rennes', 'victor hugo', 35000, 'bretgne', 'user2@gmail.fr', 065346526, 'user2', 2017, 1224, ' not admin', 'user2', 'user2', '1988',2);
$compte3 = new Individu('Nantes', 'victor hugo', 41000, 'pays de loire', 'user3@gmail.fr', 065346526, 'user3', 2017, 1224, 'not admin', 'user3', 'user3', '1977',3);
$liste=array();
$liste[]=$compte1;
$liste[]=$compte2;
$liste[]=$compte3;

?>
<br />
<?php require_once ('ihm/footer/footer.php');?>
</body>


</html>