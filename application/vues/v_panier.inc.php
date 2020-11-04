<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Panier</h1>


        <?php
        require_once Chemins::CONTROLEURS . 'ControleurProduit.class.php';
        ControleurPanier::initialiser();
        if (ControleurPanier::getNbProduits() == 0) { ?>
            <div class="row center">
                <h5 class="header col s12 light">Aucun Produit dans le panier</h5>
            </div>
            <?php
        } else {
            $lesProduits = ControleurPanier::getProduits();
            foreach ($lesProduits as $idProduit => $qteProduit) {
                VariablesGlobales::$unProduit = ControleurProduit::getProduitById($idProduit);
                ?>
                <div class="row">
                    <div class="col s6">
                        <h3 class="center"><img
                                    src="public/images/produit<?php echo VariablesGlobales::$unProduit->id ?>.jpg"
                                    class="image"></h3>

                    </div>
                    <div class="col s6">
                        <h5 class="center"><?php echo VariablesGlobales::$unProduit->LibelleProduit; ?></h5>
                        <p class="light center"><?php echo VariablesGlobales::$unProduit->DescProduit; ?>
                            <br/><?php echo VariablesGlobales::$unProduit->PrixHTProduit . " € "; ?><br/>
                            Quantité commandée : <?php echo $qteProduit; ?><br/>
                            Supprimer le produit du panier?<br/>
                            <a href="index.php?controleur=Panier&action=retirerProduit&id=<?php echo VariablesGlobales::$unProduit->id ?>"
                               class="center"><i class="material-icons medium center-align">clear</i></a>
                        </p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <p style="font-size: larger">
            <Strong>Total Panier : </Strong>
            <?php ControleurPanier::getTotalPanier() ?> €
        </p>

    </div>
</div>