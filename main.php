<?php
require 'DBConnect.php';
require 'ContactManager.php';
require 'Contact.php';
require 'Command.php';
$command = new Command();
$line = readline("Entrez votre commande : ");
if ($line == "list") {
    $command->list();
} elseif (preg_match('/^detail\s+\d+/', $line)) {
    $command->detail($line);
} elseif (preg_match('/^create\s+\S+\s+\S+\s+\S+/', $line)) {
    $command->create($line);
} elseif (preg_match('/^delete\s+\d+/', $line)) {
    $command->delete($line);
} elseif ($line == "help") {
    $command->help();
}
