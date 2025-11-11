<?php

class ContactManager
{


    public function findAll(): array
    {
        $db = DBConnect::getPDO();
        $rows = $db->query(
            "SELECT id, name, email, phone_number FROM contact ORDER BY id ASC"
        )->fetchAll();

        // Transforme chaque ligne de la BDD en objet Contact
        $contacts = [];
        foreach ($rows as $r) {
            $contacts[] = $this->mapRowToContact($r);
        }
        return $contacts;
    }

    public function findById(int $id): ?Contact
    {
        $db = DBConnect::getPDO();
        $query = $db->prepare(
            "SELECT id, name, email, phone_number FROM contact WHERE id = ?"
        );
        $query->execute([$id]);
        $row = $query->fetch();

        if (!$row) {
            return null; // si aucun résultat trouvé
        }

        return $this->mapRowToContact($row);
    }

    public function new(string $name, string $email, string $phoneNumber): Contact
    {
        $db = DBConnect::getPDO();
        $query = $db->prepare(
            "INSERT INTO contact (name, email, phone_number) VALUES (?, ?, ?)"
        );
        $query->execute([$name, $email, $phoneNumber]);

        
        $id = (int)$db->lastInsertId(); // récupérer l'ID du contact qui vient d'être ajouté
        $query = $db->prepare(
            "SELECT id, name, email, phone_number FROM contact WHERE id = ?"
        );
        $query->execute([$id]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        
        return $this->mapRowToContact($row); // retourne le contact sous forme de liste pour le montrer à l'utilisateur

        return $contact;
    }

    private function mapRowToContact(array $r): Contact
    {
        $contact = new Contact();
        $contact->setId((int)$r['id']);
        $contact->setName($r['name']);
        $contact->setEmail($r['email']);
        $contact->setPhoneNumber($r['phone_number']);
        return $contact;
    }
    public function deleteById(int $id): bool
    {
        $db = DBConnect::getPDO();

        $query = $db->prepare("DELETE FROM contact WHERE id = ?");
        $query->execute([$id]);

        return true;
    }
}
