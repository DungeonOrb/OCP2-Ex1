<?php

class ContactManager{


    /*public static function findAll() 
    {
        $db = DBConnect::getPDO();
        $contacts = $db->query('SELECT * FROM contact ORDER BY id ASC');
        foreach($contacts as $contact)
        {
            echo $contact['id']. " ". $contact['name']. " ". $contact['email']. " ". $contact['phone_number']. "\n";
        }
    }*/

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