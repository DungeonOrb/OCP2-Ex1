<?php

class ContactManager{


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
        $stmt = $db->prepare(
            "SELECT id, name, email, phone_number FROM contact WHERE id = ?"
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null; // si aucun résultat trouvé
        }

        return $this->mapRowToContact($row);
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
}