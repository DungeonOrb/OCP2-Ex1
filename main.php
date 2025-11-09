<?php
require 'DBConnect.php';
require 'ContactManager.php';
require 'Contact.php';
require 'Command.php';
$command = new Command();
$line = readline("Entrez votre commande : ");
if ($line == "list") {
    $command->list();
    }