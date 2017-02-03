<?php

/**
 * récupération données salles
 */

function getDataSalle($db,$tableau) {
    $query = 'SELECT capteurs.type, archives.temperature, archives.humidite, archives.numero 
    FROM salles
    JOIN capteurs ON capteurs.ID_salle = salles.ID
    JOIN archives ON archives.ID_capteur = capteurs.ID
    WHERE capteurs.ID_salle =:ID_salle';


    $param = $tableau['param'] ;
    $requete = $db->prepare($query);
    $requete->execute($param);

    $tableau = array();
    while ($donnees = $requete->fetch()) {

        $tableau[] = $donnees;
    }
    return $tableau;
}

function avgAllSalle($db,$tableau) {
    $request = $db -> prepare('SELECT round(avg(NULLIF(archives.temperature,0)),1) as temperature, round(avg(NULLIF(archives.humidite,0)),1) as humidite
FROM capteurs
JOIN archives on capteurs.ID = archives.ID_capteur
JOIN maison ON capteurs.ID_maison = maison.ID
WHERE capteurs.ID_maison = :IDmaison');

    $request -> execute($tableau);

    $array = array();
    while ($data = $request -> fetch()) {
        $array[] = $data;
    }
    return $array;


}

/**
 * récupère les données des capteurs, par rapport à leurs salles
 * @param $db
 * @param $tableau
 * @return array
 */

function getDataCapteursByNameSalle($db,$tableau) {
    $request = $db-> prepare('SELECT salles.ID, salles.nom as nom_salle,
 salles.isTemperature,
 salles.isHumidite,
  round(avg(NULLIF(archives.temperature,0)),1) as temperature,
   round(avg(NULLIF(archives.humidite,0)),1) as humidite,
    salles.ID_mode as ID_mode
FROM archives
JOIN capteurs on capteurs.ID  = archives.ID_capteur
JOIN salles on salles.ID = capteurs.ID_salle
JOIN maison on salles.IDmaison = maison.ID
WHERE salles.IDmaison =:IDmaison AND  salles.ID != -1 
GROUP BY salles.nom');

    $request -> execute($tableau);

    $newArray = array();
    while ($data = $request -> fetch()) {
        $newArray[] = $data;
    }
    return $newArray;
}



