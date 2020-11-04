<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">PPE Boutique CASTREC Killian</h1>
        <div class="row center">
            <h5 class="header col s12 light">Boutique fictive</h5>
        </div>
        <br><br>

    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col s6">
            <h3 class="center"><img src="public/images/produit<?php echo VariablesGlobales::$unProduit->id ?>.jpg"
                                    class="image"></h3>

        </div>
        <div class="col s6 center-align">
            <h5 class="center"><?php echo VariablesGlobales::$unProduit->LibelleProduit; ?></h5>
            <p class="light center"><?php echo VariablesGlobales::$unProduit->DescProduit; ?>
                <br/><?php echo VariablesGlobales::$unProduit->PrixHTProduit . " € "; ?><br/>
            <div style="width: 50%; margin-left: 25%;">
                <form method="post"
                      action="index.php?controleur=Panier&action=ajouterProduit&id=<?php echo VariablesGlobales::$unProduit->id ?>"
                      id="ajoutProduit">

                    <select id="monSelect" name="monSelect">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                    <label>Quantite</label>
                    <input type="submit" name="valideAjout" id="valideAjout" value="Ajout">
                </form>
            </div>
            </p>
        </div>
    </div>
</div>