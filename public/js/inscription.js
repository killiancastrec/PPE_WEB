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
        controleSaisie($(this).prop('i d'));
    });


    //-------------------------------------
    // TRAITEMENT DES CONTROLES DE SAISIES
    //-------------------------------------
    function controleSaisie(idchamp) {
        if ($("#" + idchamp).val() == "") {
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
                    if (pseudoExistant)
                        return;
                    regex = /^[a-z]+$/i;
                    messageErreur = "Pseudo non valide!";
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
            url: "chercherPseudo.php",
            data: "pseudo=" + $("#pseudo").val(),
            success: function (reponse) {
                if (reponse == 1) {
                    $("#pseudo").next().removeClass("messageok").addClass("message-erreur").text("Et non ! Le pseudo existe déjà ").show();
                    formValide = false;
                    pseudoExistant = true;
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
    //-------------------------------------
    // TRAITEMENT AUTOCOMPLETE CODEPOSTAL
    //-------------------------------------
    $("#cp").autocomplete("public/js/chercherCPVille.php", {
        width: 200,
    }); //D’autres options sont disponibles, voir doc en ligne
    $("#cp").result(function (event, data, formatted) {
        if (data) {
            $("#cp").val(data[1]);
            $("#ville").val(data[2]).attr("disabled", true);
        }
    });
});