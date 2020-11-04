<?php

//echo sha1("mdp");
//echo sha1("motdepasse");
session_start();
ob_start();

require_once 'configs/chemins.class.php';
require_once Chemins::CONFIGS.'mysql_config.class.php';
require_once Chemins::MODELES.'modelePDO.class.php';
require_once Chemins::MODELES.'gestion_boutique.class.php';
require_once Chemins::CONFIGS.'variables_globales.class.php';
require Chemins::VUES_PERMANENTES . 'v_entete.inc.php';


$cas = (!isset($_REQUEST['cas'])) ? 'afficherAccueil' : $_REQUEST['cas'];

if (isset($_REQUEST['categorie'])) {
    $categorie = $_REQUEST['categorie'];
}//ou en une ligne avec opérateur conditionnel

if (isset($_COOKIE['login_admin'])){
    $_SESSION['login_admin']=$_COOKIE['login_admin'];
}


if (!isset($_REQUEST['controleur'])) {
    require_once(Chemins::VUES . "v_accueil.inc.php");
} else {
    $action = $_REQUEST['action'];

    $classeControleur = 'Controleur' . $_REQUEST['controleur']; //ex : ControleurProduits
    $fichierControleur = $classeControleur . ".class.php"; //ex : ControleurProduits.class.php
    require_once(Chemins::CONTROLEURS . $fichierControleur);

    $objetControleur = new $classeControleur(); //ex : $objetControleur = new ControleurProduits();
    $objetControleur->$action(); //ex : $objetControleur->afficher();
    //version avec classe statique
    // $classeStatiqueControleur = 'Controleur' . $_REQUEST['controleur'];
    // $classeStatiqueControleur::$action();
}
require Chemins::VUES_PERMANENTES . 'v_pied.inc.php';
?>
