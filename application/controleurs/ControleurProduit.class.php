<?php

class ControleurProduit
{
    public function __construct()
    {
        // si on séparait les modèles, le constructeur donnerait son chemin
        // require_once Chemins::MODELES.'gestion_categories.class.php';    
    }

    public function afficher()
    {
        VariablesGlobales::$lesProduits = GestionBoutique::getLesProduits();
        VariablesGlobales::$nbProduits = GestionBoutique::getNbProduits();
        require Chemins::VUES . 'v_produits.inc.php';
    }

    public function afficherUnProduit()
    {

        VariablesGlobales::$unProduit = GestionBoutique::getProduitById($_REQUEST['id']);
        require Chemins::VUES . 'v_unproduit.inc.php';
    }

    public static function getProduitById($idProduit)
    {
        return (GestionBoutique::getProduitById($idProduit));
    }

    Public static function getLesCategories()
    {
        return (GestionBoutique::getLesCategories());
    }

    Public static function getLesFournisseurs()
    {
        return (GestionBoutique::getLesFournisseurs());
    }

    Public static function ajoutProduit()
    {
        GestionBoutique::ajoutProduit($_POST['libelleProd'], $_POST['prixProd'], $_POST['qteProd'], $_POST['descProd'], $_POST['fournProd'], $_POST['categProd']);
    }

    public static function getMaxIdPlusUn(){
        return(GestionBoutique::getMaxIdPlusUn());

    }
}

?>