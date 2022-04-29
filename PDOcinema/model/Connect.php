<?php
// Namespace permet d'éviter les collisions entre les noms de classes, au cas ou il aurait dans tous nos fichiers, deux classes de même nom. 
// Namespace va dont faire en sorte de différencier ces deux classes de mêmes noms par leur fichier qui n'est pas le même.
namespace Model;


// Une classe abstract est une classe qui ne sera pas intanciée. ( Pas de : new Connect( ... ) dans le projet) 
// Elle va permettre de définir les caractéristiques de plusieures classes d'objets '(ex : Class Personne dans POO Cinéma
// qui faire hériter à Acteur et Réalisteur. Mais qui ne sera jamais instancié elle-même, pas de New Personne(..) dans le projet)
abstract class Connect {
//Cette class permet de se connecter à la base de donnée
    const HOST = "Localhost";
    const DB = "cinema";
    const USER = "root";
    const PASS = "";

    // Dans le cadre ou PDO n'arrivera pas à se connecter à la base de donnée, on lui initie une variable ($ex) qui renverra 
    // la méthode getMessage pour renvoyer un message d'erreur
    public static function seConnecter() {
        try{
            return new \PDO("mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOException $ex) {
            return $ex->getMessage(); 
        }
    }
}