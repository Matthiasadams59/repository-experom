<?php
include("vue/header.php");
include("vue/footer.php");
ob_start();
$titre = "donnée perso";
?>
<section id="modifierDonnerPersonnel">
    <h1>Mon compte</h1>

    <div id="profil">
        <h2>Profil du membre</h2>
        <ul>
            <li><em class="informations">Rôle: </em><div class="informations"><?php echo $_SESSION['role'] ?></div></li>
            <li><em class="informations">E-mail: </em><div class="informations"><?php echo $_SESSION['mail'] ?></div></li>
            <li><em class="informations">Nom: </em><div class="informations"><?php echo $_SESSION['nom'] ?> </div></li>
            <li><em class="informations">Adresse: </em><div class="informations"><?php echo $_SESSION['adresse'] ?></div></li>
            <li><em class="informations">Inscrit le: </em><div class="informations"><?php echo $_SESSION['dateInscription'] ?></div></li>
            <li><em class="informations">Numéro: </em><div class="informations"><?php echo '0'.$_SESSION['numero'] ?></div></li>
        </ul>
    </div>
    <div id="modifier">
        <h2>Modifier mes informations</h2>
        <form method="post" action="/espace-client/modifier-donnees-perso-control">
            <div><label for="modifierMail">Modifier mon E-mail</label><input type="text"
                                                                             name="modifierMail"
                                                                             id="modifierMail"></div>
            <div><label for="modifierMdp">Modifier mon mot de passe</label><input type="text"
                                                                                  name="modifierMdp"
                                                                                  id="modifierMdp"></div>
            <div><label for="modifierAdresse">Modifier adresse</label><input type="text"
                                                                             name="modifierAdresse"
                                                                             id="modifierAdresse"></div>
            <div><label for="modifierNumero">Modifier numero</label><input type="text"
                                                                             name="modifierNumero"
                                                                             id="modifierNumero"></div>
            <div class="message"><?php echo $messageErreur ?></div>
            <input type="submit" value="Valider" class="envoyer">


        </form>
        <div><a href="/espace-client/modifier-donnees-perso/ajouter-un-utilisateur">Ajouter un utilisateur secondaire</a></div>


    </div>
</section>
<?php
$section = ob_get_clean();
include("gabarit.php");




