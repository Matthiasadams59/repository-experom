<?php
ob_start();
?>
<header>
    <a href="/accueil"  class="inline logo" ><img src="/vue/style/images/logo-header.png" alt="logo_domisep" class="logo"></a></a>
    <nav class="inline">
        <ul id="menuAccueil">
            <li class="nonderoulant"><a href="/accueil">accueil</a></li>
            <li class="deroulant"><a href='/espace-client'>espace client</a>
                <?php if (isset($_SESSION["ID"]) & isset($_SESSION['IDmaison'])) { ?>
                    <div id="fleche"></div>
                <?php } ?>

                <ul class="deroulant">
                    <?php if (isset($_SESSION["ID"]) & isset($_SESSION['IDmaison'])) { ?> <!--si session on n'affiche pas le menu déroulant-->
                        <li><a href="/espace-client/ma-maison">Maison</a></li>
                        <li><a href="/espace-client/modes">Modes</a></li>
                        <?php if ($_SESSION["role"] == "principal"){?>
                            <li><a href="/espace-client/capteurs">Capteurs</a></li>
                            <li id="menuLast"><a href="/espace-client/modifier-donnees-perso">Comptes</a></li>
                        <?php }?>
                    <?php } ?>
                </ul>
            </li>
            <!--<li class ="nonderoulant"><a href="/faq">Faq</a></li>-->
            <li class="nonderoulant"><a href="/contact">Contact</a></li>
        </ul>
    </nav>
    <?php if (isset($messageGeneral)) { ?>
    <div align="center" id="deconnexion"><?php echo $messageGeneral;?></div> <?php } ?>
    <?php if (isset($_SESSION["ID"])) {?> <!--si la session afficher le bouton déco-->
        <form method = "post" class="inline" action = "/deconnexion-controller" >
            <input type = "submit" value = "déconnexion" ><br/><br/>
            <?php if (isset($_GET["cible"]) && ($_GET["cible"] == "/espace-client/inscription-controller" || $_GET["cible"] == "/espace-client/connexion-controller"))
            {echo $_SESSION["message"];}?>

            <!--si session et si cible existe et si cible=inscription afficher le message-->
        </form >
    <?php } ?>
</header>
<?php
$header = ob_get_clean();