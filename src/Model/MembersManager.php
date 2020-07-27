<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class MembersManager extends Manager
{
    // On récupère les informations d'un auteur amateur
    public function getUserData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", ia.url AS "avatar", m.pseudo AS "pseudo", m.description AS "description", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", m.date_subscription AS "subscriptionDate" FROM members m INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN series s ON s.id_author = m.id INNER JOIN series_has_members_subscription has ON has.id_member = m.id WHERE m.id = ?');
		$req->execute(array($id));
	    $userData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userData;
	}
    // On récupère les informations d'un auteur éditeur
    public function getPublisherData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", il.url AS "logo", l.name AS "name", m.description AS "description", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate" FROM members m INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN series s ON s.id_author = m.id INNER JOIN series_has_members_subscription has ON has.id_member = m.id WHERE m.id = ?');
		$req->execute(array($id));
	    $publisherData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherData;
	}
	// On récupère la liste des auteurs d'un éditeur
    public function getAuthorsList($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.publisher_author AS "author", s.publisher_author_description AS "description" FROM series s INNER JOIN members m ON m.id = s.id_author WHERE m.id = ?');
		$req->execute(array($id));
	    $authorsList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $authorsList;
	}
	// On récupère le nombre de coins d'un membre
    public function getACoinsNumber($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT coins_number FROM members WHERE id = ?');
		$req->execute(array($id));
	    $coinsNumber = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $coinsNumber;
	}
}