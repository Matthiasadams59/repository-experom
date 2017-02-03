<?php

/**
 fetch données capteurs
 */

function getArchivesFromCapteur($db,$tableau)
{
    $array = array();
    $requete = $db->prepare('SELECT archives.* , capteurs.type, capteurs.nom, capteurs.ID_salle
        FROM capteurs
        JOIN archives ON archives.ID_capteur = capteurs.ID
        WHERE capteurs.ID_maison =:ID_maison
        AND capteurs.ID_salle != 0');

    $requete->execute($tableau);
    while($data = $requete->fetch()) {
        $array[] = $data;
    }
    return $array;
}

function updateTableCapteur($db,$tableau) {
    $request = $db->prepare('UPDATE capteurs SET ID_salle=:ID_salle WHERE serial_key=:serial_key AND ID_maison=:ID_maison');

    $request -> execute($tableau);

    $request -> closeCursor();
}
