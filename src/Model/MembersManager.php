<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class MembersManager extends Manager
{
    // On récupère les informations privées d'un membre
    public function getMemberData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", l.name AS "name", m.pseudo AS "pseudo", m.description AS "description", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id WHERE m.id= ?');
		$req->execute(array($idmember));
	    $userData = $req->fetch();
	    $req->closeCursor();
	    return $userData;
	}
	// On récupère les informations publiques d'un membre
	public function getMemberPublicData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.id AS "id", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", l.name AS "name", m.pseudo AS "pseudo", m.description AS "description", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id WHERE s.publishing_status = "published" AND m.id = ?');
		$req->execute(array($idmember));
		$userPublicData = $req->fetch();
		$req->closeCursor();
		return $userPublicData;
	}
	// On récupère la liste des séries écrites par un membre pour un usage privé
	public function getAllSeriesMember($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "author_publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.publishing_status AS "publishing", m.type AS "type", s.pricing_status AS "pricing" FROM series s LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN members m ON m.id = s.id_member LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN covers c ON c.id = s.id_cover LEFT JOIN images ic ON ic.id = c.id_cover LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE m.id = ? GROUP BY s.id');
	    $req->execute(array($idmember));
		$getAllSeriesMember = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllSeriesMember;
	}
	// On récupère la liste des séries écrites par un membre pour un usage public
	public function getAllPublicSeriesMember($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "author_publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.publishing_status AS "publishing", m.type AS "type", s.pricing_status AS "pricing" FROM series s LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN members m ON m.id = s.id_member LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN covers c ON c.id = s.id_cover LEFT JOIN images ic ON ic.id = c.id_cover LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE s.publishing_status = "published" AND m.id = ? GROUP BY s.id');
	    $req->execute(array($idmember));
		$getAllPublicSeriesMember = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllPublicSeriesMember;
	}
	// On récupère la liste des séries auxquelles un membre est abonné
	public function getAllSubscriptionSeries($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "author_publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.publishing_status AS "publishing", m.type AS "type", s.pricing_status AS "pricing", m.id AS "idmember" FROM series s LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN members m ON m.id = s.id_member LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN covers c ON c.id = s.id_cover LEFT JOIN images ic ON ic.id = c.id_cover LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE sub.id_member = ? GROUP BY s.id');
	    $req->execute(array($idmember));
		$getAllSubscriptionSeries = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllSubscriptionSeries;
	}

	// On récupère la liste des auteurs d'un éditeur dont la série a été publiée
    public function getAuthorsList($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.publisher_author AS "author", s.publisher_author_description AS "description" FROM series s INNER JOIN members m ON m.id = s.id_member WHERE s.publishing_status = "published" AND m.id = ?');
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
	// On récupère les informations de profil d'un membre avec son id
	public function getMemberProfileData($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.gender AS "gender", m.pseudo AS "pseudo", m.password AS "password", l.name AS "name", m.company_name AS "company", m.email AS "email", m.surname AS "surname", l.name AS "name", m.address AS "address", m.zipcode AS "zipcode", m.city AS "city", m.country AS "country", m.birthdate AS "birthdate", ia.url AS "avatar", ia.name AS "nameAvatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", m.id_logo AS "idlogo", m.description AS "description", m.type AS "type", m.token AS "token" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE m.id = ?');
		$req->execute(array($idmember));
	    $userProfile = $req->fetch();
	    $req->closeCursor();
	    return $userProfile;
	}
	// On récupère les informations génériques de tous les membres
	public function getMembersProfileData()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT m.id AS "id", m.pseudo AS "pseudo", m.email AS "email", m.type as "type", COUNT(DISTINCT has.id_series) AS "numberSubscriptions", COUNT(DISTINCT s.id) AS "numberWritings", COUNT(DISTINCT s.publisher_author) AS "numberAuthors", m.date_subscription AS "subscriptionDate", m.coins_number AS "coinsNumber" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription has ON has.id_member = m.id GROUP BY m.id');
	    $usersData = $req->fetchAll();
	    $req->closeCursor();
	    return $usersData;
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
	public function addMember($pseudo, $email, $password, $type, $confirmation, $token)
	{
		$db = $this->dbConnect();
		$addMember = $db->prepare('INSERT INTO members(pseudo, email, password, type, date_subscription, confirmation, token) VALUES(?, ?, ?, ?, NOW(), ?, ?)');
	    $addMember->execute(array($pseudo, $email, $password, $type, $confirmation, $token));
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
	// On modifie les informations de profil d'un membre utilisateur (version simplifiée)
	public function updateQuickUserMember($email, $password, $description, $idavatarrelated, $idmember)
	{
		$db = $this->dbConnect();
		$updateQuickUserMember = $db->prepare('UPDATE members SET email = :newemail, password = :newpassword, description = :newdescription, id_avatar = :newid_avatar WHERE id = :idmember');
		$updateQuickUserMember->execute(array(
			'newemail' => $email,
			'newpassword' => $password, 
			'newdescription' => $description,
			'newid_avatar' => $idavatarrelated,
			'idmember' => $idmember
		)); 
		return $updateQuickUserMember;
	}
	// On modifie les informations de profil d'un membre utilisateur (version simplifiée)
	public function updateQuickPublisherMember($email, $password, $description, $idlogorelated, $idmember)
	{
		$db = $this->dbConnect();
		$updateQuickPublisherMember = $db->prepare('UPDATE members SET email = :newemail, password = :newpassword, description = :newdescription, id_logo = :newid_logo WHERE id = :idmember');
		$updateQuickPublisherMember->execute(array(
			'newemail' => $email,
			'newpassword' => $password, 
			'newdescription' => $description,
			'newid_logo' => $idlogorelated,
			'idmember' => $idmember
		)); 
		return $updateQuickPublisherMember;
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
	//On récupère l'url du logo d'un membre
	public function getImageLogoUrl($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT il.url AS "url" FROM members m LEFT JOIN logos l ON m.id_logo = l.id LEFT JOIN images il ON il.id = l.id_logo WHERE m.id = ?');
		$req->execute(array($idmember));
		$imageLogoUrl = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $imageLogoUrl;
	}
	//On récupère l'id de l'image associée au logo
	public function getImageLogoId($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT il.id AS "id" FROM members m LEFT JOIN logos l ON m.id_logo = l.id LEFT JOIN images il ON il.id = l.id_logo WHERE m.id = ?');
		$req->execute(array($idmember));
		$imageLogoId = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $imageLogoId;
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
	// On récupère l'id d'un logo à partir de l'id_logo
	public function getLogoId($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM logos WHERE id_logo = ?');
		$req->execute(array($id));
		$logoId = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $logoId;
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
	    $getPseudos = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $getPseudos;
	}
	// On récupère tous les emails des membres inscrits
	public function getMembersEmail()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT email FROM members');
	    $getEmails = $req->fetchAll(\PDO::FETCH_COLUMN);
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
		$req = $db->prepare('SELECT id, pseudo, password, type, token FROM members WHERE email = ?');
	    $req->execute(array($email));
	    $memberInfo = $req->fetch();
	    $req->closeCursor();
	    return $memberInfo;
	}
	// On modifie le token d'un membre
	public function updateToken($idmember, $token)
	{
		$db = $this->dbConnect();
		$updateToken = $db->prepare('UPDATE members SET token = :newtoken WHERE id = :idmember');
		$updateToken->execute(array(
			'newtoken' => $token,
			'idmember' => $idmember
		)); 
		return $updateToken;
	}
	// On modifie le mot de passe d'un membre
	public function updatePassword($idmember, $password)
	{
		$db = $this->dbConnect();
		$updatePassword = $db->prepare('UPDATE members SET password = :newpassword WHERE id = :idmember');
		$updatePassword->execute(array(
			'newpassword' => $password,
			'idmember' => $idmember
		)); 
		return $updatePassword;
	}
	// On récupère les informations de profil d'un membre avec son token
	public function getMemberProfileWithToken($token)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM members WHERE token = ?');
		$req->execute(array($token));
		$userInfo = $req->fetch();
		$req->closeCursor();
		return $userInfo;
	}
	// On récupère l'id de l'image sélectionnée comme avatar
	public function getIdImage($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM images WHERE name = ?');
		$req->execute(array($name));
		$idImage = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $idImage;
	}
	// On récupère l'id de l'avatar sur la base de l'id de l'image
	public function getIdAvatar($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM avatars WHERE id_avatar = ?');
		$req->execute(array($id));
		$idAvatar = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $idAvatar;
	}

}