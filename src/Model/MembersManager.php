<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class MembersManager extends Manager
{
    // On récupère les informations d'un membre
    public function getMemberData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", ia.url AS "avatar", il.url AS "logo", l.name AS "name", m.pseudo AS "pseudo", m.description AS "description", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id WHERE m.id= ?');
		$req->execute(array($idmember));
	    $userData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userData;
	}
	// On récupère la liste des auteurs d'un éditeur
    public function getAuthorsList($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.publisher_author AS "author", s.publisher_author_description AS "description" FROM series s INNER JOIN members m ON m.id = s.id_member WHERE m.id = ?');
		$req->execute(array($idmember));
	    $authorsList = $req->fetchAll();
	    $req->closeCursor();
	    return $authorsList;
	}
	// On récupère le nombre de coins d'un membre
    public function getCoinsNumber($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT coins_number FROM members WHERE id = ?');
		$req->execute(array($idmember));
	    $coinsNumber = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $coinsNumber;
	}
	// On ajoute des coins à un membre
	public function updateCoinsNumber($coins_number, $idmember)
	{
		$db = $this->dbConnect();
		$updateCoinsNumber = $db->prepare('UPDATE members SET coins_number = :newcoins_number WHERE id = :idmember');
		$updateCoinsNumber->execute(array(
			'newcoins_number' => $coins_number,
			'idmember' => $idmember
		)); 
		return $$updateCoinsNumber;
	}
	// On récupère les informations de profil d'un membre
	public function getMemberProfileData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.gender AS "gender", m.pseudo AS "pseudo", l.name AS "name", m.company_name AS "company", m.email AS "email", m.surname AS "surname", m.name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.country AS "country", m.birthdate AS "birthdate", ia.url AS "avatar", il.url AS "logo", m.description AS "description", m.type AS "type" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE m.id = ?');
		$req->execute(array($idmember));
	    $userProfile = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $userProfile;
	}
	// On récupère les informations génériques de tous les membres
	public function getMembersProfileData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT m.id AS "id", m.pseudo AS "pseudo", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate", m.coins_number AS "coinsNumber" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id GROUP BY m.id');
	    $usersData = $req->fetchAll();
	    $req->closeCursor();
	    return $$usersData;
	}
	// On récupère les informations de dépenses d'un membre
	public function getMemberBillsData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT b.id AS "reference", b.date AS "date", ROUND(b.amount, 2) AS "amountTTC", ROUND(0.945*b.amount, 2) AS "amountHT", ROUND(0.055*b.amount, 2) AS "VAT", m.gender AS "gender", m.surname AS "surname", m.name AS "name", m.company_name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.type AS "type" FROM bills b LEFT JOIN members_has_bills has ON has.id_bill = b.id LEFT JOIN members m ON m.id = has.id_member WHERE m.id = ? GROUP BY b.id');
		$req->execute(array($idmember));
	    $billsDataPublisher = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $billsDataPublisher;
	}
	// On enregistre une dépense
	public function addBill($amount)
	{
		$db = $this->dbConnect();
		$addBill = $db->prepare('INSERT INTO bills(date, amount) VALUES(NOW(), ?)');
	    $addBill->execute(array($amount));
	    return $addBill;
	}

	// On ajoute une dépense à un membre
	public function addMemberBill($idmemberrelated, $idbillrelated)
	{
		$db = $this->dbConnect();
		$addMemberBill = $db->prepare('INSERT INTO members_has_bills(id_member, id_bill) VALUES(?, ?)');
	    $addMemberBill->execute(array($idmemberrelated, $idbillrelated));
	    return $addMemberBill;
	}
	// On récupère les informations de ventes d'un éditeur
	public function getPublisherGains($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", s.title AS "title", e.number AS "episode", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0)), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain" FROM series s LEFT JOIN members m ON m.id = s.id_member LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN sales sal ON sal.id_episode = e.id WHERE e.id = ? AND s.pricing_status = "paying" GROUP BY s.id');
		$req->execute(array($idmember));
	    $publisherGain = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherGain;
	}
	// On récupère les informations de ventes d'un éditeur au mois
	public function getPublisherGainsMonthly($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", s.title AS "title", e.number AS "episode", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0)), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesMonthNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain" FROM series s LEFT JOIN members m ON m.id = s.id_member LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN sales sal ON sal.id_episode = e.id WHERE e.id = ? AND s.pricing_status = "paying" AND MONTH(sal.date) = MONTH(CURRENT_DATE) - 1 GROUP BY s.id');
		$req->execute(array($idmember));
	    $publisherMonthGain = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publisherMonthGain;
	}
	// On enregistre une vente
	public function addSale($idmemberrelated, $idepisoderelated)
	{
		$db = $this->dbConnect();
		$addSale = $db->prepare('INSERT INTO sales(id_member, id_episode) VALUES(?, ?)');
	    $addSale->execute(array($idmemberrelated, $idepisoderelated));
	    return $addSale;
	}
	// On récupère l'information pour savoir si le membre accepte les notifications emails ou pas
	public function getNotificationsSubscriptionData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT has.subscription_notifications FROM series_has_members_subscription has INNER JOIN members m ON m.id = has.id_member WHERE m.id = ?');
		$req->execute(array($idmember));
	    $notificationsSubscription = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $notificationsSubscription;
	}
	// On enregistre un statut de notifications
	public function addNotificationsSubscription($idseriesrelated, $idmemberrelated, $notifications)
	{
		$db = $this->dbConnect();
		$notificationsSubscription = $db->prepare('INSERT INTO series_has_members_subscription(id_series, id_member, subscription_notifications) VALUES(?, ?, ?)');
	    $notificationsSubscription->execute(array($idseriesrelated, $idmemberrelated, $notifications));
	    return $notificationsSubscription;
	}
	// On modifie un statut de notifications
	public function updateNotificationsSubscription($notifications, $idmemberrelated, $idseriesrelated)
	{
		$db = $this->dbConnect();
		$updateNotificationsSubscription = $db->prepare('UPDATE series_has_members_subscription SET subscription_notifications = :newsubscription_notifications WHERE id_member = :idmember AND id_series = :idseries');
		$updateNotificationsSubscription->execute(array(
			'newsubscription_notifications' => $notifications,
			'idmember' => $idmemberrelated,
			'idseries' => $idseriesrelated,
		)); 
		return $updateNotificationsSubscription;
	}
	// On ajoute un membre
	public function addMember($pseudo, $email, $password)
	{
		$db = $this->dbConnect();
		$addMember = $db->prepare('INSERT INTO members(pseudo, email, password, type, date_subscription) VALUES(?, ?, ?, \'user\', NOW())');
	    $addMember->execute(array($pseudo, $email, $password));
	    return $addMember;
	}
	// On modifie les informations de profil d'un membre
	public function updateMember($email, $companyname, $gender, $surname, $name, $address, $zipcode, $city, $country, $birthdate, $password, $description, $idavatarrelated, $idlogorelated, $idmember)
	{
		$db = $this->dbConnect();
		$updateMember = $db->prepare('UPDATE members SET email = :newemail, company_name = :newcompany_name, gender = :newgender, surname = :newsurname, name = :newname, address = :newaddress, zipcode = :newzipcode, city = :newcity, country = :newcountry, birthdate = :newbirthdate, password = :newpassword, description = :newdescription, id_avatar = :newid_avatar, id_logo = :newid_logo WHERE id = :idmember');
		$updateMember->execute(array(
			'newemail' => $email,
			'company_name' => $companyname,
			'newgender' => $gender,
			'newsurname' => $surname,
			'newname' => $name,
			'newaddress' => $address,
			'newzipcode' => $zipcode,
			'newcity' => $city,
			'newcountry' => $country,
			'newbirthdate' => $birthdate,
			'newpassword' => $password, 
			'newdescription' => $description,
			'newid_avatar' => $idavatarrelated,
			'newid_logo' => $idlogorelated,
			'idmember' => $idmember
		)); 
		return $updateMember;
	}
	// On supprime un membre
	public function deleteMember($idmember)
	{
		$db = $this->dbConnect();
		$deleteMember = $db->prepare('DELETE FROM members WHERE id = ?');
	    $deleteMember->execute(array($idmember));
	    return $deleteMember;
	}
	// On ajoute une image
	public function addImage($name, $type, $alt, $url)
	{
		$db = $this->dbConnect();
		$addImage = $db->prepare('INSERT INTO images(name, type, alt, url) VALUES(?, ?, ?, ?)');
	    $addImage->execute(array($name, $type, $alt, $url));
		return $addImage;
	}
	// On modifie une image
	public function updateImage($name, $type, $alt, $url, $idimage)
	{
		$db = $this->dbConnect();
		$updateImage = $db->prepare('UPDATE images SET name = :newname, type = :newtype, alt = :newalt, url = :newurl WHERE id = :idimage');
		$updateImage->execute(array(
			'newname' => $name,
			'newtype' => $type,
			'newalt' => $alt,
			'newurl' => $url,
			'idimage' => $idimage
		)); 
		return $updateImage;
	}
	//On récupère l'url d'une image pour une série donnée
	public function getImageSeriesUrl($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "url" FROM series s LEFT JOIN covers c ON s.id_cover = c.id LEFT JOIN images ic ON ic.id = c.id_cover WHERE s.id = ?');
		$req->execute(array($idseries));
	    $imageSeriesUrl = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $imageSeriesUrl;
	}
	//On récupère l'id d'une image pour une série donnée
	public function getImageSeriesId($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.id AS "id" FROM series s LEFT JOIN covers c ON s.id_cover = c.id LEFT JOIN images ic ON ic.id = c.id_cover WHERE s.id = ?');
		$req->execute(array($idseries));
	    $imageSeriesId = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $imageSeriesId;
	}
	// On supprime une image
	public function deleteImage($idimage)
	{
		$db = $this->dbConnect();
		$deleteImage = $db->prepare('DELETE FROM images WHERE id = ?');
    	$deleteImage->execute(array($idimage));
    	return $deleteImage;
	}
	// On récupère l'id d'une image à partir de son url
	public function getImageId($urlimage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM images WHERE url = ?');
		$req->execute(array($urlimage));
	    $imageId = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $imageId;
	}
	// On ajoute un logo
	public function addLogo($idlogo, $name)
	{
		$db = $this->dbConnect();
		$addLogo = $db->prepare('INSERT INTO logos(id_logo, name) VALUES(?, ?)');
	    $addLogo->execute(array($idlogo, $name));
	    return $addLogo;
	}
	// On modifie un logo
	public function updateLogo($idlogorelated, $name, $idlogo)
	{
		$db = $this->dbConnect();
		$updateLogo = $db->prepare('UPDATE logos SET id_logo = :newid_logo, name = :newname WHERE id = :idlogo');
		$updateLogo->execute(array(
			'newid_logo' => $idlogorelated,
			'newname' => $name,
			'idlogo' => $idlogo
		)); 
		return $updateLogo;
	}
	// On supprime un logo
	public function deleteLogo($idlogo)
	{
		$db = $this->dbConnect();
		$deleteLogo = $db->prepare('DELETE FROM logos WHERE id = ?');
    	$deleteLogo->execute(array($idlogo));
    	return $deleteLogo;
	}
	// On ajoute un avatar
	public function addAvatar($idavatar)
	{
		$db = $this->dbConnect();
		$addAvatar = $db->prepare('INSERT INTO avatars(id_avatar) VALUES(?)');
	    $addAvatar->execute(array($idavatar));
	    return $addAvatar;
	}
	// On modifie un avatar
	public function updateAvatar($idavatarrelated, $idavatar)
	{
		$db = $this->dbConnect();
		$updateLogo = $db->prepare('UPDATE avatars SET id_avatar = :newid_avatar WHERE id = :idavatar');
		$updateLogo->execute(array(
			'newid_avatar' => $idavatarrelated,
			'idavatar' => $idavatar
		)); 
		return $updateLogo;
	}
	// On récupère tous les pseudos des membres inscrits
	public function getMembersPseudo()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT pseudo FROM members');
	    $getPseudos = $req->fetchAll();
	    $req->closeCursor();
	    return $getPseudos;
	}
	// On récupère tous les emails des membres inscrits
	public function getMembersEmail()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT email FROM members');
	    $getEmails = $req->fetchAll();
	    $req->closeCursor();
	    return $getEmails;
	}
	// On récupère l'id d'un pseudo de membre
	public function getMemberId($pseudo)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM members WHERE pseudo = ?');
	    $req->execute(array($pseudo));
	    $memberId = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $memberId;
	}
	// On récupère les informations de membre qui correspondent à l'email saisi
	public function getMemberInfo($email)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT pseudo, password, type FROM members WHERE email = ?');
	    $req->execute(array($email));
	    $memberInfo = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $memberInfo;
	}
}