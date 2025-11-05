<?php
require 'DBConnect.php';
require 'ContactManager.php';
require 'Contact.php';
//    $line = readline("Entrez votre commande : ");
//    if($line = "list") {
//        echo "affichage de la liste \n";
//            ContactManager::findAll();
//        }
$manager = new ContactManager();
$contact = $manager->findAll();
var_dump($contact);
