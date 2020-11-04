<?php
require_once "../../application/modeles/gestion_boutique.class.php";
require_once "../../configs/mysql_config.class.php";
GestionBoutique::seConnecter();
// Récupération du pseudo posté
$pseudoSaisi = $_POST['pseudo'];
// Recherche du pseudo dans la base (nombre de tuples renvoyés)
$requete = "select count(*) as nbResultats from client where login like '" . $pseudoSaisi . "'";
GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare($requete);
GestionBoutique::$pdoStResults->execute();
GestionBoutique::$resultat = GestionBoutique::$pdoStResults->fetch(PDO::FETCH_OBJ);
// Fermeture de la base
GestionBoutique::$pdoStResults->closeCursor();
//Affichage du résultat (traité par le code du formulaire : va renseigner le
//paramètre reponse de mon success)
echo GestionBoutique::$resultat->nbResultats;
?>
