<?php


$titre = "Inscription";

/**
 * formulaire d'inscription
 */

include("modele/general.php");



// inscription utilisateur principal
if ($utilisateurSecondaire == False) {
    if (isset($_POST["pseudo"]) && isset($_POST["nom"]) && isset($_POST["mail"]) && isset($_POST['numero']) && isset($_POST["mdp"]) && isset($_POST["rmdp"]) && $_GET['target'] == "inscription-control") {
        //même principe que pour connexion
        if (isset($_POST["pseudo"]) && !empty($_POST["nom"]) && !empty($_POST["mail"]) && !empty($_POST['numero']) && !empty($_POST["mdp"]) && !empty($_POST["rmdp"])) {
            if ($_POST["mdp"] == $_POST["rmdp"]) {
                if (preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z]{2,4}$#",$_POST['mail']) && preg_match("#^0[1-68]([ .-]?[0-9]{2}){4}#",$_POST['numero'])) {
                    $tableau = array(
                        'typeDeRequete'=> 'select',
                        'table'=>'users',
                        'param'=>array('pseudo'=>$_POST["pseudo"]));

                    if (requeteDansTable($db, $tableau) == array()) { // on verifie que l'array est vide, permet de verifier que "nom" n'existe pas déja dans la table

                        $tableau = array(
                            'typeDeRequete'=> 'select',
                            'table'=>'users',
                            'param'=>array('mail'=>$_POST["mail"]));

                        if (requeteDansTable($db,$tableau) == array()) {
                            $tableau = array(
                                'typeDeRequete'=> 'select',
                                'table'=>'users',
                                'param'=>array('numero'=>$_POST["numero"]));

                            if (requeteDansTable($db,$tableau) == array()) {

                                $tableau = array(
                                    'typeDeRequete' => 'insert',
                                    'table' => 'users',
                                    'param' => array(
                                        'pseudo' => $_POST['pseudo'],
                                        'nom' => $_POST['nom'],
                                        'mail' => $_POST['mail'],
                                        'mdp' => $_POST['mdp'],
                                        'role' => 'principal',
                                        'dateInscription'=>'',
                                        'numero'=>$_POST['numero']
                                    ));

                                requeteDansTable($db, $tableau);
                                variablesSession($db, 'pseudo', $_POST['pseudo']);



                                $_SESSION['message'] = "Vous êtes bien inscrit";
                                include("vue/espaceClient/configMaison.php");
                            }
                            else {
                                $messageErreur = "Ce numéro est déjà utilisé";
                                include("vue/espaceClient/inscription.php");
                            }
                        }
                        else {
                            $messageErreur = "Ce mail est déja utilisé";
                            include("vue/espaceClient/inscription.php");
                        }
                    } else {
                        $messageErreur = "Ce pseudo est déja utilisé";
                        include("vue/espaceClient/inscription.php");
                    }
                }
                else {
                    $messageErreur = "Attention ton numéro ou ton mail n'es pas valide";
                    include("vue/espaceClient/inscription.php");
                }
            } else {
                $messageErreur = "Les mots de passe ne sont pas identiques";
                include("vue/espaceClient/inscription.php");
            }
        } else {
            $messageErreur = "Le/les champs est/sont vide(s)";
            include("vue/espaceClient/inscription.php");

        }
    } else {
        $messageErreur = "Les variables n'existe pas";
        include("vue/espaceClient/inscription.php");

    }
}


?>






