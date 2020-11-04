<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Partie Administration</h1>
        <div class="row center">
            <h5 class="header col s12 light">Ajout Produit</h5>
        </div>
        <form><!-- method="post" action="index.php?controleur=Produit&action=ajoutProduit">-->
            <label>Libelle du produit : </label><input type="text" name="libelleProd" id="libelleProd">
            <label>Prix du produit : </label><input type="text" name="prixProd" id="prixProd">
            <label>Quantité du stock : </label><input type="text" name="qteProd" id="qteProd">
            <label>Description du produit : </label><textarea type="text" name="descProd" id="descProd"></textarea>
            <label>Fournisseur : </label><select name="fournProd" id="fournProd">
                <?php
                foreach (VariablesGlobales::$lesFournisseurs as $unfourn) {
                    ?>
                    <option value="<?php echo $unfourn->idFournisseur; ?>"><?php echo $unfourn->NomFournisseur; ?></option>
                <?php } ?>
            </select><br>
            <label>Catégorie : </label><select name="categProd" id="categProd">
                <?php
                foreach (VariablesGlobales::$lesCategories as $uncateg) {
                    ?>
                    <option value="<?php echo $uncateg->idCategorie; ?>"><?php echo $uncateg->LibelleCategorie; ?></option>
                <?php } ?>
            </select><br>
            <input name="imageProduit" type="file" id="imageProduit"><br><br>
            <input type="submit">
        </form>
        <br><br>
        <?php
        if (isset($_POST['submit'])) {
            require_once(Chemins::CONTROLEURS . 'ControleurProduit.class.php');
            if (!empty($_FILES['imageProduit'])) {
                if ($_FILES['imageProduit']['error'] > 0) {
                    exit('Erreur n°' . $_FILES['imageProduit']['error']);
                }
                if (is_uploaded_file($_FILES['imageProduit']['tmp_name'])) {
                    //$_FILES['imageProduit']['name']['filename']='produit'.ControleurProduit::getMaxIdPlusUn();
                    if (move_uploaded_file($_FILES['imageProduit']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/PPE_WEB/' . Chemins::IMAGES . $_FILES['imageProduit']['name'])) {
                        echo 'Fichier enregistré';
                    } else {
                        exit('Erreur lors de l\'enregistrement');
                    }
                } else {
                    exit('Fichier non uploadé');
                }
            }
        }
        ?>


    </div>
</div>