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
    public function detail(string $input): void
    {
        $this->manager = new ContactManager();
        if (!preg_match('/^detail\s+(\d+)/', trim($input), $matches)) {
            echo "Format invalide. Utilisez : find [id]" . PHP_EOL;
            return; //arret de la fonction si la commande est invalide
        }

        $id = (int)$matches[1];

        $contact = $this->manager->findById($id); // recherche dans la bdd avec l'id fournis

        if ($contact === null) {
            echo "Aucun contact trouvé avec l'ID" . $id . PHP_EOL;
        } else {
            echo $contact . PHP_EOL;
        }
    }
}
