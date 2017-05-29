<?php

include 'job/dao/Pret_Dao.php';
$pret = selectPrets("WHERE idPret = " . $_REQUEST["idPret"])[0];
$pageAAfficher = "ihm/" . $_REQUEST["formulaire"];

