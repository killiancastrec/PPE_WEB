
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">PPE Boutique CASTREC Killian</h1>
        <div class="row center">
            <h5 class="header col s12 light">Se connecter</h5>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">
        <form method="post" action="index.php?controleur=Connexion&action=verifier">
            <fieldset>
                <legend>Identification</legend>

                <label for="login">Votre login : </label><input type="text" name="login" /><br/>
                <label for="passe">Votre mot de passe : </label><input type="password" name="mdp" id="mdp" />
                <br/>
                <p>
                    <label>
                        <input type="checkbox" name="connexion_auto" id="connexion_auto" checked/>
                        <span>Connexion Automatique</span>
                    </label>
                </p>
                <input type="submit" value="Connexion"/>
            </fieldset>
        </form>
    </div>
    <br><br>
</div>
