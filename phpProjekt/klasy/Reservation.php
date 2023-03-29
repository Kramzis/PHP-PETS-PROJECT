<?php

class Reservation
{
    function saveToDB($db, $userId){
        $animalSpecie = $_POST['species'];
        $animalSex = $_POST['animalSex'];
        $animalSize = $_POST['animalSize'];
        $animalAge = $_POST['animalAge'];
        $animalTraits = $_POST['animalTrait1'].';'.$_POST['animalTrait2'].';'.$_POST['animalTrait3'];
        $animalCoat = $_POST['animalCoat'];
        if($db->insert("INSERT INTO reservations VALUES (NULL, '$userId', '$animalSpecie', '$animalSex','$animalSize', '$animalAge', '$animalTraits', '$animalCoat', 'przyjęto')")){
            return true;
        } else {
            return false;
        }

    }
}