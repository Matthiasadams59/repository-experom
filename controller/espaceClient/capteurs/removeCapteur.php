<?php
if (isset($_GET['target3'])) {
    $tableau = array('typeDeRequete'=>'delete','table'=>'archives','param'=>array('ID_capteur'=>$_GET['target3']));
    requeteDansTable($db,$tableau);

    $tableau = array('typeDeRequete'=>'delete','table'=>'capteurs','param'=>array('ID'=>$_GET['target3']));
    requeteDansTable($db,$tableau);

    $messageSuccess = "Le capteurs à bien été supprimé";
}

include('vue/espaceClient/capteurs.php');
?>