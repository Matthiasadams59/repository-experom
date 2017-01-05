<?php
include("modele/general.php");
include("modele/modes.php");
include("modele/salles.php");
include('controller/debug.php');
include("controller/capteurSelect.php");


$messageError = null;


// récupération de toutes les données des salles
$tableau = array(
    'typeDeRequete'=>'select',
    'table'=>'salles',
    'param'=>array(
        'IDmaison'=>$_SESSION['IDmaison']
    ));

$tableauDonneesSalles = requeteDansTable($db,$tableau);



// récupération de tout les noms de modes pour ensuite les affichers
$tableau = array('param'=> array('champ'=>$_SESSION["IDmaison"]));

$tableauDonneesMode = getDataMode($db,$tableau);


// création d'un tableau avec les noms des modes et suppression des doublons
$arrayNameMode = array();
$arrayMode = array();

for ( $k = 0; $k < count($tableauDonneesMode); $k ++ ) {
    $arrayNameMode[] = $tableauDonneesMode[$k]['nom'];
}

// mise à jour des clefs dans un nouveau tableau.
$arrayNameMode = array_unique($arrayNameMode);
foreach ($arrayNameMode as $key => $mode) {
    $arrayMode[] = $mode;
}

// récupération des modes par salles, puis récup du nom, pour mettre à jour la page

function getModeSalle($db,$idSalle)
{
    $tableau = array(
        'typeDeRequete'=>'select',
        'table'=>'salles',
        'param'=>array(
            'IDmaison'=>$_SESSION['IDmaison'],
            'ID'=>$idSalle
        ));

    $tableauDonneesSalles = requeteDansTable($db,$tableau);

    /*$tableau = array('param' => array('nom' => $tableauDonneesSalles[0]['nom'], 'IDmaison' => $_SESSION['IDmaison']));*/
    /*$arrayCapteurSelect = getDataModeByName($db, $tableau);*/
    $tableau = array('typeDeRequete' => 'select', 'table' => 'modes', 'param' => array('ID' => $tableauDonneesSalles[0]['ID_mode']));
    $arrayDataModeBySalle = requeteDansTable($db, $tableau);
    if (isset($arrayDataModeBySalle[0]['nom'])) {
        $nomMode = $arrayDataModeBySalle[0]['nom'];
        return $nomMode;
    }
}


// fonction qui retourne la valeur du type demandé.
function getdataCapteur($db,$idSalle) {
    $value = array();
    $tableau = array('param'=>array('ID_salle'=>$idSalle));
    $dataSalle = getDataSalle($db,$tableau);
    foreach ($dataSalle as $key => $data)

    if ($data['type'] == 'temperature') {
        if ($data['temperature']!= null) {
            $value['temp'] = $data["temperature"];
        }
    }
    if ($data['type'] == 'humidite') {
        if ($data['humidite']!= null) {
            $value['hum'] = $data["humidite"];
        }
    }
    return $value;
}





if ($_GET['target2'] == 'ajouter') {
    include('controller/espaceClient/maison/createSalle.php');
}
else if ($_GET['target2'] == 'supprimer') {
    include('controller/espaceClient/maison/removeSalle.php');
}
else if ($_GET['target2'] == "activer-mode") {
    include('controller/espaceClient/maison/activateMode.php');
}
else if ($_GET['target2'] == "consommation") {
    include('vue/espaceClient/commation.php');
}
else {
    include('vue/espaceClient/maMaisonV2.php');
}