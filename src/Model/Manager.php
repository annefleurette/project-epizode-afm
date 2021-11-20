<?php
namespace AnneFleurMarchat\Epizode\Model;
class Manager
{
	//Récupération de la la base de donnnées
	protected function dbConnect()
	{
	    //$db = new \PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', 'root');
		$db = new \PDO('mysql:host=epizodefqn130990.mysql.db;dbname=epizodefqn130990;charset=utf8', 'epizodefqn130990', 'Epizode13091990DataBase');
	    return $db;
	}
}