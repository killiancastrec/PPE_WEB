<?php
require_once "../../application/modeles/gestion_boutique.class.php";
require_once "../../configs/mysql_config.class.php";
GestionBoutique::seConnecter();
//var_dump(GestionBoutique::$pdoCnxBase);

// Récupération du codepostal posté
$recherche =strtolower($_GET["q"]);
// Recherche du CP dans la base
GestionBoutique::$requete="select distinct CP,Ville from codespostaux where CP like'$recherche%' or ville like '$recherche%' order by CP";
GestionBoutique::$pdoStResults=GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
GestionBoutique::$pdoStResults->execute();

GestionBoutique::$pdoStResults->setFetchMode(PDO::FETCH_OBJ);
while ($ligne = GestionBoutique::$pdoStResults->fetch() ){
$cp=$ligne->CP;
$ville=$ligne->Ville;
echo "$cp - $ville|$cp|$ville\n";
}
// Fermeture de la base
GestionBoutique::$pdoStResults->closeCursor();
//Affichage du résultat (traité par le code du formulaire
echo GestionBoutique::$resultat;

/*
foreach ($ligne as $row){
    $cp=$ligne->CP;
    $ville=$ligne->Ville;
    $lname[trim("$cp - $ville|$cp|$ville\n")] = null;
}
// Fermeture de la base
GestionBoutique::$pdoStResults->closeCursor();
//Affichage du résultat (traité par le code du formulaire
echo $resultat->nbResultats;
*/
 
?>
