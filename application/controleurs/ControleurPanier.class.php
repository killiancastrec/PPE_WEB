<?php
class ControleurPanier {
    public function afficherPanier(){
        require Chemins::VUES.'v_panier.inc.php';
    }
    public static function initialiser() {
        if (!isset($_SESSION['produits'])) {
            $_SESSION['produits'] = array();
        }
    }

    public static function vider() {
        $_SESSION['produits'] = array();
    }

    public static function detruire() {
        unset($_SESSION['produits']);
    }

    public static function ajouterProduit() {
        $idProduit=$_REQUEST['id'];
        $qte = $_POST['monSelect'];
        if(self::getQteByProduit($idProduit)>0){
            $qte = $qte + self::getQteByProduit($idProduit);
            self::modifierQteProduit($idProduit, $qte);
        }else{
            self::initialiser();
            $_SESSION['produits'][$idProduit] = $qte;
        }
        header("Location: index.php?controleur=Produit&action=afficher");
    }

    public static function modifierQteProduit($idProduit,$qte) {
        if (array_key_exists($idProduit, self::getProduits()))
            $_SESSION['produits'][$idProduit] = $qte;
    }

    public static function retirerProduit() {
        $idProduit=$_REQUEST['id'];
        if (array_key_exists($idProduit, self::getProduits()))
            unset ($_SESSION['produits'][$idProduit]);
        header("Location: index.php?controleur=Panier&action=afficherPanier");
    }

    public static function getProduits() {
        return $_SESSION['produits'];
    }

    public static function getNbProduits() {
        return isset($_SESSION['produits'])?count($_SESSION['produits']):0;
    }
    public static function getQteByProduit($idProduit) {
        $nb = 0;
        if (array_key_exists($idProduit, self::getProduits()))
            $nb=$_SESSION['produits'][$idProduit];

        return $nb;
    }

    public static function isVide() {
        return (self::getNbProduits() == 0);
    }

    public static function contains($idProduit) {
        return (array_key_exists($idProduit, self::getProduits()));
    }


    public static function getTotalPanier(){
        $total = 0;
        $lesProduits = self::getProduits();
        foreach ($lesProduits as $idProduit => $qteProduit) {
            $unProduit = ControleurProduit::getProduitById($idProduit);
            $prix = $unProduit->PrixHTProduit;
            $total = $total + $qteProduit * $prix;
        }
        echo $total;
    }
}