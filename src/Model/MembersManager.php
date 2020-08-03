<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class MembersManager extends Manager
{
    // On récupère les informations d'un membre
    public function getMemberData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", ia.url AS "avatar", il.url AS "logo", l.name AS "name", m.pseudo AS "pseudo", m.description AS "description", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id WHERE m.id= ?');
		$req->execute(array($id));
	    $userData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userData;
	}
	// On récupère la liste des auteurs d'un éditeur
    public function getAuthorsList($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.publisher_author AS "author", s.publisher_author_description AS "description" FROM series s INNER JOIN members m ON m.id = s.id_member WHERE m.id = ?');
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
	// On récupère les informations de profil d'un membre
	public function getMemberProfileData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.gender AS "gender", m.pseudo AS "pseudo", l.name AS "name", m.company_name AS "company", m.email AS "email", m.surname AS "surname", m.name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.country AS "country", m.birthdate AS "birthdate", ia.url AS "avatar", il.url AS "logo", m.description AS "description", m.type AS "type" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE m.id = ?');
		$req->execute(array($id));
	    $userProfile = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userProfile;
	}
	// On récupère les informations de dépenses d'un membre
	public function getMemberBillsData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT b.id AS "reference", b.date AS "date", ROUND(b.amount, 2) AS "amountTTC", ROUND(0.945*b.amount, 2) AS "amountHT", ROUND(0.055*b.amount, 2) AS "VAT", m.surname AS "surname", m.name AS "name", m.company_name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.type AS "type" FROM bills b LEFT JOIN members_has_bills has ON has.bill_id = b.id LEFT JOIN members m ON m.id = has.member_id WHERE m.id = ? GROUP BY b.id');
		$req->execute(array($id));
	    $billsDataPublisher = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $billsDataPublisher;
	}
	// On récupère les informations de ventes d'un éditeur
	public function getPublisherGains($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", s.title AS "title", e.number AS "episode", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0)), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain" FROM series s LEFT JOIN members m ON m.id = s.id_member LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN sales sal ON sal.id_episode = e.id WHERE e.id = ? AND s.pricing_status = "paying" GROUP BY s.id');
		$req->execute(array($id));
	    $publisherGain = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherGain;
	}
	// On récupère les informations de ventes d'un éditeur au mois
	public function getPublisherGainsMonthly($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", s.title AS "title", e.number AS "episode", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0)), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesMonthNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain" FROM series s LEFT JOIN members m ON m.id = s.id_member LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN sales sal ON sal.id_episode = e.id WHERE e.id = ? AND s.pricing_status = "paying" AND MONTH(sal.date) = MONTH(CURRENT_DATE) - 1 GROUP BY s.id');
		$req->execute(array($id));
	    $publisherMonthGain = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherMonthGain;
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
	// On ajoute un membre
	public function addMember($pseudo, $email, $password)
	{
		$db = $this->dbConnect();
		$newmember = $db->prepare('INSERT INTO members (pseudo, email, password, type, date_subscription) VALUES(?, ?, ?, \'user\', NOW())');
	    $newmember->execute(array($pseudo, $email, $password));
	    return $newmember;
	}
	// On complète les informations de profil d'un membre --> A voir en mentorat
	// On supprime un membre
	public function deleteMember($id)
	{
		$db = $this->dbConnect();
		$deleteMember = $db->prepare('DELETE FROM members WHERE id = ?');
	    $deleteMember->execute(array($id));
	    return $deleteMember;
	}
	// On ajoute des coins à un membre
	public function updateCoinsNumber($coins_number, $id)
	{
		$db = $this->dbConnect();
		$updateCoinsNumber = $db->prepare('UPDATE members SET coins_number = :newcoins_number WHERE id = :id');
		$updateCoinsNumber->execute(array(
			'newcoins_number' => $coins_number,
			'id' => $id
		)); 
		return $$updateCoinsNumber;
	}
}