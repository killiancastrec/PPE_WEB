
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">PPE Boutique CASTREC Killian</h1>
        <div class="row center">
            <h5 class="header col s12 light">S'inscrire</h5>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">
        <form method="post" action="index.php?controleur=Connexion&action=validerInscription" id="nouveauClient">
            <div class="titre">Nouveau compte CLIENT</div>
            <fieldset>
                <legend> Identification : </legend>
                <i class="material-icons prefix">assignment_ind</i>
                <label for="pseudo">Pseudo choisi :</label> <input type='text' name='pseudo' id='pseudo' />
                <span> </span><br />
                <i class="material-icons prefix">lock</i>
                <label for="pass1"> Mot de passe :</label><input type='password' name='pass1' id='pass1' />
                <span> </span><br />
                <i class="material-icons prefix">lock</i>
                <label for="pass2"> Resaisir le passe :</label><input type='password' name='pass2' id='pass2' />
                <span> </span><br />
            </fieldset>
            <fieldset>
                <legend> Coordonnées : </legend>
                <i class="material-icons prefix">mail</i>
                <label for="mail">Adresse mail :</label> <input type='text' name='mail' id='mail' />
                <span> </span><br />
                <i class="material-icons prefix">person</i>
                <label for="nom">Nom :</label><input type='text' name='nom' id='nom' />
                <span> </span><br />
                <i class="material-icons prefix">mode_edit</i>
                <label for="prenom">Prénom :</label><input type='text' name='prenom' id='prenom' />
                <span> </span><br />
                <i class="material-icons prefix">room</i>
                <label for="rue">Rue :</label><input type='text' name='rue' id='rue' />
                <span> </span><br />
                <i class="material-icons prefix">room</i>
                <label for="cp">Code Postal :</label><input type='text' name='cp' id='cp' />
                <span> </span><br />
                <i class="material-icons prefix">location_city</i>
                <label for="ville">Ville :</label><input type='text' name='ville' id="ville"/>
                <span> </span><br/>
            </fieldset>
            <fieldset class="sansBordure">
                <span> Acceptez-vous de recevoir notre newsletter ? </span>
                <p>
                    <label>
                        <input name="group1" type="radio" checked />
                        <span>oui</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="group1" type="radio" />
                        <span>non</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" />
                        <label>J'accepte les <a href='/'>conditions générales</a></label>
                        <span  id='erreurConditions'> </span>
                    </label>
                </p>
                <br />
                <input type='submit' name='valider' id='valider' value='VALIDER' />
            </fieldset>
        </form>
    </div>
    <br><br>
</div>
