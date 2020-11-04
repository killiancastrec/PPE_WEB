<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Les Produits</h1>
        <div class="row center">
            <h5 class="header col s12 light">Boutique fictive</h5>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">
        <?php
        for ($i = 0; $i < VariablesGlobales::$nbProduits ; $i = $i + 3) {
            if ($i <= VariablesGlobales::$nbProduits - 1) {
                ?>
                <!--   Icon Section   -->
                <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="index.php?controleur=Produit&action=afficherUnProduit&id=<?php echo VariablesGlobales::$lesProduits[$i]->id ?>">
                            <h2 class="center light-blue-text"><i class="material-icons">local_offer</i></h2>
                            <h5 class="center"
                                href="index.php?controleur=Produit&action=afficherUnProduit"><?php echo VariablesGlobales::$lesProduits[$i]->LibelleProduit; ?></h5>
                            <h3 class="center"><img
                                        src="public/images/produit<?php echo VariablesGlobales::$lesProduits[$i]->id ?>.jpg"
                                        class="image"></h3>

                            <h5 class="light center"><?php echo VariablesGlobales::$lesProduits[$i]->PrixHTProduit . " € "; ?></h5>
                        </a>
                    </div>
                </div>

                <?php
            }
            if ($i + 1 <= VariablesGlobales::$nbProduits - 1) {
                ?>
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="index.php?controleur=Produit&action=afficherUnProduit&id=<?php echo VariablesGlobales::$lesProduits[$i + 1]->id ?>">
                            <h2 class="center light-blue-text"><i class="material-icons">local_offer</i></h2>
                            <h5 class="center"><?php echo VariablesGlobales::$lesProduits[$i + 1]->LibelleProduit; ?></h5>
                            <h3 class="center"><img
                                        src="public/images/produit<?php echo VariablesGlobales::$lesProduits[$i + 1]->id ?>.jpg"
                                        class="image"></h3>

                            <h5 class="light center"><?php echo VariablesGlobales::$lesProduits[$i + 1]->PrixHTProduit . " € "; ?></h5>
                        </a>
                    </div>
                </div>

                <?php
            }
            if ($i + 2 <= VariablesGlobales::$nbProduits - 1) {
                ?>
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="index.php?controleur=Produit&action=afficherUnProduit&id=<?php echo VariablesGlobales::$lesProduits[$i + 2]->id ?>">
                            <h2 class="center light-blue-text"><i class="material-icons">local_offer</i></h2>
                            <h5 class="center"><?php echo VariablesGlobales::$lesProduits[$i + 2]->LibelleProduit; ?></h5>
                            <h3 class="center"><img
                                        src="public/images/produit<?php echo VariablesGlobales::$lesProduits[$i + 2]->id ?>.jpg"
                                        class="image">
                            </h3>

                            <h5 class="light center"><?php echo VariablesGlobales::$lesProduits[$i + 2]->PrixHTProduit . " € "; ?></h5>
                        </a>
                    </div>
                </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<br/><br/>
</div>