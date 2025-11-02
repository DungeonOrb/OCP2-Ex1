<?php

class ContactManager{

    private $id;

    private $name;

    private $email;

    public $phone;

    public static function findAll() 
    {
        $db = DBConnect::getPDO();
        $contacts = $db->query('SELECT * FROM contact ORDER BY id ASC');
        foreach($contacts as $contact)
        {
            echo $contact['id']. " ". $contact['name']. " ". $contact['email']. " ". $contact['phone_number']. "\n";
        }
    }
}