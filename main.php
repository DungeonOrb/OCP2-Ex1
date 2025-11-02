<?php
require 'DBConnect.php';
require 'ContactManager.php';
//$contacts = $db->query('SELECT * FROM contact ORDER BY id ASC');
//    $line = readline("Entrez votre commande : ");
//    if($line = "list") {
//        echo "affichage de la liste";
//        foreach($contacts as $contact){
//            echo $contact['id'];
//        }
//    }
ContactManager::findAll();