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
    public function getCoinsNumber($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT coins_number FROM members WHERE id = ?');
		$req->execute(array($id));
	    $coinsNumber = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $coinsNumber;
	}
	// On récupère les informations de profil d'un membre amateur
	public function getUserProfileData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.gender AS "gender", m.pseudo AS "pseudo", m.email AS "email", m.surname AS "surname", m.name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.country AS "country", m.birthdate AS "birthdate", ia.url AS "avatar", m.description AS "description" FROM members m INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar WHERE m.type = "user" AND m.id = ?');
		$req->execute(array($id));
	    $userProfile = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userProfile;
	}
	// On récupère les informations de profil d'un membre éditeur
	public function getPublisherProfileData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.pseudo AS "pseudo", l.name AS "name", m.company_name AS "company", m.email AS "email", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.country AS "country", il.url AS "logo", m.description AS "description" FROM members m INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo WHERE m.type = "publisher" AND m.id = ?');
		$req->execute(array($id));
	    $publisherProfile = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherProfile;
	}
	// On récupère les informations de dépense d'un membre amateur
	public function getUserBillsData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT b.id AS "reference", b.date AS "date", b.amount AS "amountTTC", ROUND(0.945*b.amount, 2) AS "amountHT", ROUND(0.055*b.amount, 2) AS "VAT", m.surname AS "surname", m.name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city" FROM bills b INNER JOIN members_has_bills has ON has.bill_id = b.id INNER JOIN members m ON m.id = has.member_id AND m.type = "user" WHERE m.id = ? GROUP BY b.id');
		$req->execute(array($id));
	    $billsDataUser = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $billsDataUser;
	}
	// On récupère les informations de dépense d'un membre éditeur
	public function getPublisherBillsData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT b.id AS "reference", b.date AS "date", b.amount AS "amountTTC", ROUND(0.945*b.amount, 2) AS "amountHT", ROUND(0.055*b.amount, 2) AS "VAT", m.company_name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city" FROM bills b INNER JOIN members_has_bills has ON has.bill_id = b.id INNER JOIN members m ON m.id = has.member_id WHERE m.id = 2 AND m.type = "publisher" GROUP BY b.id');
		$req->execute(array($id));
	    $billsDataPublisher = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $billsDataPublisher;
	}
	// On récupère l'information pour savoir si le membre accepte les notifications emails ou pas
	public function getNotificationsSubscriptionData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT has.subscription_notifications FROM series_has_members_subscription has INNER JOIN members m ON m.id = has.id_member WHERE m.id = ?');
		$req->execute(array($id));
	    $notifcationsSubscription = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $notifcationsSubscription;
	}
}