<?php


$titre = "Inscription";

/**
 * formulaire d'inscription
 */

include("modele/users.php");



// inscription utilisateur principal
if ($utilisateurSecondaire == False) {
    if (isset($_POST["nom"]) && isset($_POST["mail"]) && isset($_POST["adresse"]) && isset($_POST["mdp"]) && isset($_POST["rmdp"]) && $_GET['cible'] == "controllerInscription") {
        //même principe que pour connexion
        if (!empty($_POST["nom"]) && !empty($_POST["mail"]) && !empty($_POST["adresse"]) && !empty($_POST["mdp"]) && !empty($_POST["rmdp"])) {
            if ($_POST["mdp"] == $_POST["rmdp"]) {
                if (preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z]{2,4}$#",$_POST['mail'])) {
                    $tableau = array(
                        'typeDeRequete'=> 'select',
                        'table'=>'users',
                        'champ'=>'nom',
                        'param'=>array('champ'=>$_POST["nom"]));

                    if (requeteDansTable($db, $tableau) == array()) { // on verifie que l'array est vide, permet de verifier que "nom" n'existe pas déja dans la table
                        $tableau = array(
                            'typeDeRequete'=> 'select',
                            'table'=>'users',
                            'champ'=>'mail',
                            'param'=>array('champ'=>$_POST["mail"]));

                        if (requeteDansTable($db,$tableau) == array()) {
                            $tableau = array(
                                'typeDeRequete' => 'insert',
                                'table' => 'users',
                                'param' => array(
                                    'nom' => $_POST['nom'],
                                    'mail' => $_POST['mail'],
                                    'adresse' => $_POST['adresse'],
                                    'mdp' => $_POST['mdp'],
                                    'role' => 'principal'));

                            requeteDansTable($db, $tableau);

                            variablesSession($db,'nom',$_POST['nom']);
                            $_SESSION['message'] = "Vous êtes bien inscrit";
                            include("vue/accueil/accueil.php");
                        }
                        else {
                            $messageErreur = "Ce mail est déja prit";
                            include("vue/espaceClient/inscription.php");
                        }
                    } else {
                        $messageErreur = "Ce nom est déja utilisé";
                        include("vue/espaceClient/inscription.php");
                    }
                }
                else {
                    $messageErreur = "Attention ton adresse mail n'es pas valide";
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
} // Pour ajouter un nouvelle utilisateur à partir de l'utilisateur principal

if ($utilisateurSecondaire == True) {
    if (isset($_POST["nom"]) && isset($_POST["mdp"]) && isset($_POST["rmdp"]) && isset($_POST["mail"]) && $_GET['cible'] == "controllerInscriptionSecondaire") {
        if (!empty($_POST["nom"]) && !empty($_POST["mail"]) && !empty($_POST["mdp"]) && !empty($_POST["rmdp"])) {
            if ($_POST["mdp"] == $_POST["rmdp"]) {
                if (preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z]{2,4}$#",$_POST['mail'])) {
                    $tableau = array(
                        'typeDeRequete'=> 'select',
                        'table'=>'users',
                        'champ'=>'nom',
                        'param'=>array('champ'=>$_POST["nom"]));

                    if (requeteDansTable($db, $tableau) == array()) { // on verifie que l'array est vide, permet de verifier que "nom" n'existe pas déja dans la table
                        $tableau = array(
                            'typeDeRequete'=> 'select',
                            'table'=>'users',
                            'champ'=>'mail',
                            'param'=>array('champ'=>$_POST["mail"]));

                        if (requeteDansTable($db,$tableau) == array()) {
                            $tableau = array('typeDeRequete' => 'insert',
                                'table' => 'users',
                                'param'=>array(
                                    'nom'=>$_POST['nom'],
                                    'mail'=>$_POST['mail'],
                                    'adresse'=>$_SESSION['adresse'],
                                    'mdp'=>$_POST['mdp'],
                                    'role'=>'secondaire'));

                            requeteDansTable($db, $tableau);

                            $messageErreur = "L'Utilisateur secondaire a bien été crée";
                            include("vue/espaceClient/modifierDonneesPerso.php");
                        }
                        else {
                            $messageErreur = "Ce mail est déja prit";
                            include("vue/espaceClient/inscription.php");
                        }
                    } else {
                        $messageErreur = "Ce nom est déja utilisé";
                        include("vue/espaceClient/inscription.php");
                    }
                }
                else {
                    $messageErreur = "Attention ton adresse mail n'es pas valide";
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






