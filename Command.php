<?php
require_once 'ContactManager.php';
require_once 'Contact.php';

class Command
{
    private ContactManager $manager;


    public function list(): void
    {
        $this->manager = new ContactManager();
        echo "affichage de la liste \n";
        $contacts = $this->manager->findAll();
        // parcours de la liste des contact et affichage par ligne
        foreach ($contacts as $contact) {
            echo $contact->toString() . PHP_EOL;
        }
    }
}
