<?php
require_once Chemins::CONTROLEURS . 'ControleurProduit.class.php';
class ControleurConnexion {

    public function seConnecter(){
        require Chemins::VUES_ADMIN.'v_connexion.inc.php';
    }
    
    public function sInscrire(){
        require Chemins::VUES_ADMIN.'v_inscription.inc.php';
    }
    public function validerInscription(){
        GestionBoutique::seConnecter();
        GestionBoutique::ajouterClient($_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['pseudo'], $_POST['pass1'], $_POST['mail']);
        require Chemins::VUES_ADMIN.'v_connexion.inc.php';
    }
    
    public function verifier()
    {
        GestionBoutique::seConnecter();
        if (GestionBoutique::isAdminOk($_POST['login'], $_POST['mdp'])==true) {
            $_SESSION['login_admin'] = $_POST['login'];
            if (isset($_POST['connexion_auto'])) {
                setcookie('login', '');
                setcookie('login-admin', '');
                setcookie('login-admin', $_POST['login'], time() + 7 * 24 * 3600, null, null, false, true);
            }
            VariablesGlobales::$lesCategories = ControleurProduit::getLesCategories();
            VariablesGlobales::$lesFournisseurs= ControleurProduit::getLesFournisseurs();
            require Chemins::VUES_ADMIN . 'v_index_admin.inc.php';
        }
        else{
            if (GestionBoutique::userExiste($_POST['login'], $_POST['mdp'])==true) {
                $_SESSION['login'] = $_POST['login'];
                if (isset($_POST['connexion_auto'])) {
                    setcookie('login', '');
                    setcookie('login-admin', '');
                    setcookie('login', $_POST['login'], time() + 7 * 24 * 3600, null, null, false, true);
                }
                require Chemins::VUES_ADMIN . 'v_acces_user.inc.php';
            } else {
                require Chemins::VUES_ADMIN . 'v_acces_interdit.inc.php';
            }
        }
    }
    
    public function afficherIndexAdmin(){
        if (isset($_SESSION['login_admin'])){
            require Chemins::VUES_ADMIN.'v_index_admin.inc.php';
        }
        else{
            require Chemins::VUES_ADMIN.'v_connexion.inc.php';
        }
    }
    public function seDeconnecter(){
        $_SESSION=array();
        session_destroy();
        setcookie('login_admin', '');
        setcookie('login', '');
        header("Location:index.php");
    }
}
