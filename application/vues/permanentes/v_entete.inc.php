<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>PPE Boutique</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="public/styles/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="public/styles/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="public/styles/autocompletion.css" />

        <script type="text/javascript" src="public/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="public/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="public/js/materialize.js"></script>
        <script type="text/javascript" src="public/js/init.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                var formValide;
                //TRAITEMENT DU CLICK SUR LE BOUTON VALIDER
                //-----------------------------------------

                $("#valider").click(function () {
                    formValide = true;
                    //Traitements de toutes les zones de saisies
                    $("#nouveauClient input[type=text], #nouveauClient input[type=password]").each(function () {
                        controleSaisie($(this).prop('id'));
                    });


                    //Traitement de la case à cocher
                    if (!$("#conditions").prop('checked', true)) {
                        $("#erreurConditions").addClass("message-erreur").text("Acceptation obligatoire!").fadeIn();
                        formValide = false;
                    } else
                        $("#erreurConditions").fadeOut();
                    //On valide ou pas le formulaire selon le booleen formValide
                    return formValide;
                });
                $(document).ready(function(){
                    $('select').formSelect();
                });


                //TRAITEMENT DU KEYPRESS DANS LES ZONES DE SAISIES :
                // On efface le message lorsqu'on remplit les champs
                //---------------------------------------------------
                $("#nouveauClient input[type=text], #nouveauClient input[type = password]").keypress(function () {
                    $(this).next().fadeOut();
                });


                //TRAITEMENT DU CLICK SUR LA CASE A COCHER (CONDITIONS GENERALES)
                //---------------------------------------------------------------
                $("#conditions").click(function () {
                    if ($(this).prop('checked', true))
                        $("#erreurConditions").fadeOut();
                    else
                        $("#erreurConditions").addClass("message-erreur").text("Acceptation obligatoire!").fadeIn();
                });
                //TRAITEMENT LORSQUE LES ZONES DE SAISIES PERDENT LE FOCUS
                //--------------------------------------------------------
                $("#nouveauClient input[type=text], #nouveauClient input[type=password]").blur(function () {
                    controleSaisie($(this).prop('id'));
                    //console.log(this);
                });

                //-------------------------------------
                // TRAITEMENT DES CONTROLES DE SAISIES
                //-------------------------------------
                function controleSaisie(idchamp) {
                    if ($("#" + idchamp).val() === "") {
                        $("#" + idchamp).next().removeClass("message-ok").addClass("messageerreur").
                                text("Le champ est vide !").fadeIn();
                        formValide = false;
                    } else {
                        var regex, messageErreur;
                        switch (idchamp) //Traitement selon l'id
                        {
                            case 'pseudo':
                                pseudoExistant = false;
                                cherchePseudoBD();
                                console.log(pseudoExistant);
                                if (pseudoExistant===true) {
                                    regex = /[1]/g;
                                    messageErreur = "Pseudo déjà existant";
                                    console.log("point 1");
                                }else{
                                    regex = /^[a-z0-9]+$/i;
                                    messageErreur = "Pseudo non valide!";
                                    console.log("point 2");}
                                break;
                            case 'pass1', 'pass2':
                                regex = /^[0-9a-zA-Z]{6,20}$/;
                                messageErreur = "MDP non valide!";
                                break;
                            case 'mail':
                                regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                                messageErreur = "email non valide!";
                                break;
                            default:
                                regex = "";
                        }
                        traiterRegex(idchamp, regex, messageErreur);
                    }
                }

                function cherchePseudoBD() {
                    $.ajax({
                        async: false,
                        type: "POST",
                        url: "/PPE_WEB/public/js/chercherPseudo.php",
                        data: "pseudo=" + $("#pseudo").val(),
                        success: function (reponse) {
                            if (reponse === "1") {
                                $("#pseudo").next().removeClass("messageok").addClass("message-erreur").text("Et non ! Le pseudo existe déjà ").show();
                                formValide = false;
                                console.log("jarrive la");
                                pseudoExistant =true;
                            }
                        }
                    });
                }
                function traiterRegex(idchamp, regex, messageErreur) {
                    if (!$("#" + idchamp).val().match(regex)) {
                        $("#" + idchamp).next().removeClass("message-ok").addClass("messageerreur").
                                text(messageErreur).show();
                        formValide = false;
                    } else
                        $("#" + idchamp).next().removeClass("messageerreur").
                                addClass("message-ok").text("OK").show();
                }

                //-------------------------------------
                // TRAITEMENT AUTOCOMPLETE CODEPOSTAL
                //-------------------------------------
                $("#cp").autocompleted('public/js/chercherCPVille.php', {
                    width: 200
                }); //D’autres options sont disponibles, voir doc en ligne


                $("#cp").result(function (event, data, formatted) {
                    if (data) {
                        $("#cp").val(data[1]);
                        $("#ville").val(data[2]).attr("disabled", true);
                    }
                });
            });
        </script>
    </head>
    <body>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">
                    <div class="logocase">
                        <div class="logobox"></div>
                        <div class="logobox"></div>
                    </div></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php">Accueil Boutique</a></li>
                    <li><a href="index.php?controleur=Produit&action=afficher">Produits</a></li>

                    <?php
                    if(isset($_COOKIE['login']) or isset($_COOKIE['login_admin'])){
                        ?>
                        <li><a href="index.php?controleur=Panier&action=afficherPanier">Mon Compte</a></li>
                        <li><a href="index.php?controleur=Connexion&action=seDeconnecter">Se Deconnecter</a></li>
                    <?php }
                    else{ ?>
                        <li><a href="index.php?controleur=Connexion&action=seConnecter">Connexion</a></li>
                        <li><a href="index.php?controleur=Connexion&action=sInscrire">Inscription</a></li>
                    <?php
                    } ?>

                    <li><a href="index.php?cas=afficherAccueil">Retour au Portfolio</a></li>
                </ul>

                <ul id="nav-mobile" class="sidenav">
                    <li><a href="index.php">Accueil Boutique</a></li>
                    <li><a href="index.php?controleur=Produit&action=afficher">Produits</a></li>

                    <?php
                    if(isset($_COOKIE['login']) or isset($_COOKIE['login_admin'])){
                        ?>
                        <li><a href="index.php?controleur=Panier&action=afficherPanier">Mon Compte</a></li>
                        <li><a href="index.php?controleur=Connexion&action=seDeconnecter">Se Deconnecter</a></li>
                    <?php }
                    else{ ?>
                        <li><a href="index.php?controleur=Connexion&action=seConnecter">Connexion</a></li>
                        <li><a href="index.php?controleur=Connexion&action=sInscrire">Inscription</a></li>
                    <?php
                    } ?>

                    <li><a href="index.php?cas=afficherAccueil">Retour au Portfolio</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
