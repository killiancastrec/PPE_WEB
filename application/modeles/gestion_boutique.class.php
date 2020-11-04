<?php
require_once 'modelePDO.class.php';
class GestionBoutique extends modelePDO {
    // <editor-fold defaultstate="collapsed" desc="Champs statiques">


    /**
     * Retourne la liste des Catégories
     * @return type Tableau d'objets
     */
    public static function getLesCategories() {
        return self::getLesTuplesByTable("Categorie");
    }

    /**
     * Retourne la liste des Produits
     * @return type Tableau d'objets
     */
    public static function getLesProduits() {
        return self::getLesTuplesByTable("produit");
    }

    /**
     * Retourne la liste des Fournisseurs
     * @return type Tableau d'objets
     */
    public static function getLesFournisseurs() {
        return self::getLesTuplesByTable("fournisseur");
    }

    /**
     * Retourne la liste des produits d'une catégorie donnée
     * @param type $libelleCategorie Libellé de la catégorie
     * @return type
     */
    public static function getLesProduitsByCategorie($libelleCategorie) {
        self::seConnecter();

        self::$requete = "SELECT * FROM Produit P,Categorie C where P.idCategorie = C.id AND libelle = :libCateg";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libCateg', $libelleCategorie);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    /**
     * Retourne LE produit dont l'id est passé en paramètre
     * @param type $idProduit id du produit
     * @return type
     */
    public static function getProduitById($idProduit) {
        return self::getLeTupleTableById("produit", $idProduit);
    }

    public static function getNbProduits() {
        self::seConnecter();

        //self::$requete = "SELECT Count(*) FROM Produit";
        self::$requete = "SELECT Count(*) AS nbProduits FROM Produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        //return self::$resultat;
        return self::$resultat->nbProduits;
    }
    public static function getMaxIdPlusUn() {
        self::seConnecter();

        //self::$requete = "SELECT Count(*) FROM Produit";
        self::$requete = "SELECT max(id)+1 FROM Produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        //return self::$resultat;
        return self::$resultat;
    }

    /**
     * Ajoute une ligne dans la table Catégorie
     * @param type $libelleCateg Libellé de la Catégorie
     */
    public static function ajouterCategorie($libelleCateg) {

        self::seConnecter();

        self::$requete = "insert into Categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }

    public static function ajoutProduit($libelle, $prix, $qte, $desc, $fourn, $categ) {

        self::seConnecter();

        self::$requete = "CALL ajoutProduit(:libelle, :prix, :qte, :desc, :fourn, :categ)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelle);
        self::$pdoStResults->bindValue('prix', $prix);
        self::$pdoStResults->bindValue('qte', $qte);
        self::$pdoStResults->bindValue('desc', $desc);
        self::$pdoStResults->bindValue('fourn', $fourn);
        self::$pdoStResults->bindValue('categ', $categ);
        self::$pdoStResults->execute();
    }

    /**
     * Ajoute une ligne dans la table Client
     */
    public static function ajouterClient($nom, $prenom, $rue, $cp, $ville, $login, $mdp, $mail) {

        self::seConnecter();

        self::$requete = "call InsertClient(:nom, :prenom, :rue, :cp, :ville, :login, :mdp, :mail)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('prenom', $prenom);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('cp', $cp);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('mdp', sha1($mdp));
        self::$pdoStResults->bindValue('mail', $mail);
        self::$pdoStResults->execute();
    }

    /**
     * Vérifie si l'utilisateur est admin dans la base
     * @param type $login Login de l'utilisateur
     * @param type $passe Passe de l'UTILISATEUR
     * @return bool Boolean
     */
    public static function isAdminOk($login, $passe) {
        self::seConnecter();

        self::$requete = "SELECT * FROM client where login=:login and mdp=:mdp";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindvalue('mdp', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        if ((self::$resultat != null) and ( self::$resultat->isAdmin)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Vérifie si l'utilisateur existe dans la base dans la base
     * @param type $login Login de l'utilisateur
     * @param type $passe Passe de l'UTILISATEUR
     * @return bool Boolean
     */
    public static function userExiste($login, $passe) {
        self::seConnecter();

        self::$requete = "SELECT * FROM client where login=:login and mdp=:mdp";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindvalue('mdp', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        if(self::$resultat!=null) {
            return true;
        } else { 
            return false;
        }
    }

    public static function rechercheCP($recherche){
        self::seConnecter();

        self::$requete = "select distinct CP,Ville from codespostaux where CP like':recherche%' or ville like ':recherche%' order by CP";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('recherche', $recherche);
        self::$pdoStResults->execute();
        self::$pdoStResults->setFetchMode(PDO::FETCH_OBJ);
        //parcours et affichage des resultats
        while ($ligne = self::$pdoStResults->fetch()) {
            $cp = $ligne->CP;
            $ville = $ligne->Ville;
            echo "$cp - $ville|$cp|$ville\n";
        }
        // Fermeture de la base
        self::$pdoStResults->closeCursor();
        //Affichage du résultat (traité par le code du formulaire
        echo self::$resultat->nbResultats;
    }
}

?>