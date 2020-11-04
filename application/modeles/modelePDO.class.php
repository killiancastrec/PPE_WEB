<?php


class modelePDO
{

    /**
     * Objet de la classe PDO
     * @var PDO
     */

    public static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    public static $pdoStResults = null;
    public static $requete = ""; //texte de la requête
    public static $resultat = null; //résultat de la requête

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    /**
     * Permet de se connecter à la base de données
     */
    public static function seConnecter() {

        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR . ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //méthode de la classe PDO
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //méthode de la classe PDO
                self::$pdoCnxBase->query("SET CHARACTER SET utf8"); //méthode de la classe PDO
            } catch (Exception $e) {
                // l’objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    public static function seDeconnecter() {
        self::$pdoCnxBase = null;
        //si on n'appelle pas la méthode, la déconnexion a lieu en fin de script
    }

    protected static function getLesTuplesByTable($table) {
        self::seConnecter();

        self::$requete = "select * from $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    protected static function getLeTupleTableById($table, $id) {
        self::seConnecter();

        self::$requete = "select * from $table where id=:idTable";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idTable', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }


}