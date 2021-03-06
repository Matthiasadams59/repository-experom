<?php

/**
 * AJAX
 * Info maison selon le pseudo (cf ajax/home.js)
 */

if (isset($_GET['target3'])) {

    /*récupération IDmaison*/
    $tableau = array('typeDeRequete'=> 'select','table'=>'users','param'=>array('pseudo'=>$_GET['target3']));
    $IDmaison = requeteDansTable($db,$tableau)[0]['IDmaison'];
    if ($IDmaison != -1) {

        /*récupération des données des utilisateurs de la même maison*/
        $tableau = array('IDmaison' => $IDmaison);
        $arrayDataUsers = fetchDataUsers($db, $tableau);

        /*récupération de tout les noms modes de la maison.*/
        $tableau = array('IDmaison' => $IDmaison);
        $arrayNameMode = fetchNameMode($db, $tableau);

        $tableau = array('IDmaison' => $IDmaison);
        $arrayNameSalle = fetchNameSalle($db, $tableau);


    ?>

    <div class="info-BO">
        <h1>Utilisateurs</h1>
        <ul>
            <?php foreach($arrayDataUsers as $key => $value) { ?>
            <li class="users" onclick="ajaxEditPerso(this.textContent)"><?= $value['pseudo'] ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="info-BO">
        <h1>Salles</h1>
        <ul>
            <?php foreach($arrayNameSalle as $key => $value) { ?>
                <li class="autres"><?= $value['nom'] ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="info-BO">
        <h1>Modes</h1>
       <ul>
           <?php foreach($arrayNameMode as $key => $value) { ?>
               <li class="autres"><?= $value['nom'] ?></li>
           <?php } ?>
       </ul>
    </div>

    <?php } else { ?>

    <div class="admin">
        <div>C'est un admin ! désolé...</div>
    </div>
    <?php } ?>


<?php

}