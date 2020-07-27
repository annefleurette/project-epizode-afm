<?php
namespace AnneFleurMarchat\Epizode\Model;
class Manager
{
	//Récupération de la la base de donnnées
	protected function dbConnect()
	{
	    $db = new \PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', 'root');
	    return $db;
	}
}