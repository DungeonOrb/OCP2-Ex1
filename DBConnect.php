<?php



class DBConnect{

    static function getPDO() {
    try
    {
        return new PDO('mysql:host=localhost;dbname=adresses;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}
}