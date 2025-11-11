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
    public function create(string $input): void
    {
        $this->manager = new ContactManager();
        // Match "create name email phone"
        if (!preg_match('/^create\s+(\S+)\s+(\S+)\s+(\S+)/', trim($input), $matches)) {
            echo " Format invalide. Utilisez : create [nom] [email] [téléphone]" . PHP_EOL;
            return;
        }

        [$all, $name, $email, $phone] = $matches;

        $contact = $this->manager->new($name, $email, $phone);

        echo "✅ Nouveau contact ajouté : " . $contact . PHP_EOL;
    }
    public function delete(string $input): void
    {
        if (!preg_match('/^delete\s+(\d+)/', trim($input), $matches)) {
            echo "Format invalide. Utilisez : delete [id]" . PHP_EOL;
            return;
        }

        $id = (int)$matches[1];

        $deleted = $this->manager->deleteById($id);

        if ($deleted) {
            echo "Contact #{$id} supprimé avec succès." . PHP_EOL;
        } else {
            echo "Aucun contact trouvé avec l'ID {$id}." . PHP_EOL;
        }
    }
    public function help(): void
    {
        
            echo "Liste des commandes:" . PHP_EOL . "list: affiche les détails de l'ensemble des contacts de la base de données" . PHP_EOL . "detail [id]: affiche les détails d'un seul contact" . PHP_EOL . "create [nom] [email] [téléphone]: créer un nouveau contact dans la base de données" . PHP_EOL . "delete [id]: supprime un seul contact dans la base de données" . PHP_EOL . "help: affiche l'aide des commandes";
    }
}
