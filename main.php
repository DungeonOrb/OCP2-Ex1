<?php
require 'DBConnect.php';
require 'ContactManager.php';
    $line = readline("Entrez votre commande : ");
    if($line = "list") {
        echo "affichage de la liste \n";
            ContactManager::findAll();
        }