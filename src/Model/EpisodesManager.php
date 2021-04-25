<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class EpisodesManager extends Manager
{
	// On récupère la liste de tous les épisodes
    public function getAllEpisodes()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT e.id AS "id", ic.url AS "cover", s.title AS "series", m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", m.type AS "type", e.likes_number AS "numberLikes", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN comments com ON com.id_episode = e.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover LEFT JOIN sales sal ON sal.id_episode = e.id GROUP BY e.id');
	    $getAllEpisodes = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllEpisodes;
	}
	// On récupère la liste de tous les épisodes signalés
    public function getAlertEpisodes()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.title AS "series", m.pseudo AS "pseudo", l.name AS "publisher", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", m.type AS "type", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN sales sal ON sal.id_episode = e.id LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE e.alert_status = 1 GROUP BY e.id');
	    $getAlertEpisodes = $req->fetchAll();
	    $req->closeCursor();
	    return $getAlertEpisodes;
	}
	// On récupère la liste de tous les épisodes d'une série
    public function getEpisodesList($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.id AS "id", e.number AS "number", e.title AS "title", e.publishing_status AS "publishing", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COALESCE(e.likes_number, 0) AS "likesNumber", e.date AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series WHERE s.id = ? ORDER BY e.number');
		$req->execute(array($idseries));
	    $episodesList = $req->fetchAll();
	    $req->closeCursor();
	    return $episodesList;
	}
	//On compte le nombre d'épisodes d'une série qui ont été publiés
	public function countEpisodesPublished($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(*) FROM episodes WHERE publishing_status = "published" AND id_series = ?');
		$req->execute(array($idseries));
		$nbepisodes = $req->fetchAll(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $nbepisodes;
	}
	// On récupère la liste de tous les épisodes publiés d'une série
    public function getEpisodesPublishedList($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.number AS "number", e.title AS "title", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COALESCE(e.likes_number, 0) AS "likesNumber", e.date AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series WHERE s.id = ? AND e.publishing_status = "published" ORDER BY e.number');
		$req->execute(array($idseries));
	    $episodesPublishedList = $req->fetchAll();
	    $req->closeCursor();
	    return $episodesPublishedList;
	}
	// On récupère les informations d'un épisode d'une série avec l'id
	public function getEpisodeId($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", s.title AS "series", m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", m.type AS "type", e.likes_number AS "numberLikes", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN comments com ON com.id_episode = e.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE e.id = ?');
		$req->execute(array($idepisode));
	    $oneEpisodesUser = $req->fetch();
	    $req->closeCursor();
	    return $oneEpisodesUser;
	}
	// On récupère un épisode unitaire d'une série publié via son number et l'id de la série
	public function getEpisodePublished($number, $idseries)
	{
		$db = $this->dbConnect();
		$req_episode = $db->prepare('SELECT e.id AS "id", e.title AS "title", e.content AS "content", e.likes_number AS "numberLikes", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN comments com ON com.id_episode = e.id WHERE e.number = ? AND e.publishing_status="published" AND e.id_series = ? GROUP BY e.id');
		$req_episode->execute(array($number, $idseries));
		$episode_unitary_published = $req_episode->fetch();
		$req_episode->closeCursor();
		return $episode_unitary_published;
	}
	// On récupère les packs prix
	public function getCoinsPack()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT name AS "name", ROUND(COALESCE(price, 0) - COALESCE(promotion, 0), 2) AS "price", coins_number AS "coinsNumber" FROM packs');
	    $getPacks = $req->fetchAll();
	    $req->closeCursor();
	    return $getPacks;
	}
	// On ajoute un pack prix
	public function addCoinsPack($name, $price, $coins, $promotion)
	{
		$db = $this->dbConnect();
		$ddCoinsPack = $db->prepare('INSERT INTO packs(name, price, coins_number, promotion) VALUES(?, ?, ?, ?)');
		$ddCoinsPack->execute(array($name, $price, $coins, $promotion));
	    return $ddCoinsPack;
	}
	// On modifie un pack prix
	public function updateCoinsPack($name, $price, $coins, $promotion, $idpack)
	{
		$db = $this->dbConnect();
		$updateCoinsPack = $db->prepare('UPDATE packs SET name = :newname, price = :newprice, coins_number = :newcoins_number, promotion = :newpromotion WHERE id = :idpack');
		$updateCoinsPack->execute(array(
			'newname' => $name,
			'newprice' => $price,
			'newcoins_number' => $coins,
			'newpromotion' => $promotion,
			'idpack' => $idpack
		)); 
		return $updateCoinsPack;
	}
	// On supprime un pack prix
	public function deleteCoinsPack($idpack)
	{
		$db = $this->dbConnect();
		$deleteCoinsPack = $db->prepare('DELETE FROM packs WHERE id = ?');
    	$deleteCoinsPack->execute(array($idpack));
    	return $deleteCoinsPack;
	}
	// On ajoute un nouvel épisode
	public function addEpisode($number, $title, $content, $publishing_status, $id_series, $price, $promotion, $signs_number)
	{
		$db = $this->dbConnect();
		$addEpisode = $db->prepare('INSERT INTO episodes(number, title, content, publishing_status, date, id_series, price, likes_number, alert_status, promotion, signs_number) VALUES(?, ?, ?, ?, NOW(), ?, ?, 0, 0, ?, ?)');
		$addEpisode->execute(array($number, $title, $content, $publishing_status, $id_series, $price, $promotion, $signs_number));
	    return $addEpisode;
	}
	// On modifie un épisode
	public function updateEpisode($number, $title, $content, $publishing_status, $date, $price, $promotion, $words_number, $idepisode)
	{
		$db = $this->dbConnect();
		$updateEpisode = $db->prepare('UPDATE episodes SET number = :newnumber, title = :newtitle, content = :newcontent, publishing_status = :newpublishing_status, date = :newdate, price = :newprice, promotion = :newpromotion, words_number = :newwords_number WHERE id = :id');
		$updateEpisode->execute(array(
			'newnumber' => $number,
			'newtitle' => $title,
			'newcontent' => $content,
			'newpublishing_status' => $publishing_status,
			'newdate' => $date,
			'newprice' => $price,
			'newpromotion' => $promotion,
			'newwords_number' => $words_number,
			'id' => $idepisode
		)); 
		return $updateEpisode;
	}
	// On ajoute un like dans la table épisode
	public function updateLikesEpisode($likes_number, $idepisode)
	{
		$db = $this->dbConnect();
		$updateLikesEpisode = $db->prepare('UPDATE episodes SET likes_number = :newlikes_number WHERE id = :id');
		$updateLikesEpisode->execute(array(
			'newlikes_number' => $likes_number,
			'id' => $idepisode
		)); 
		return $updateLikesEpisode;
	}
	// On supprime un épisode
	public function deleteEpisode($idepisode)
	{
		$db = $this->dbConnect();
		$deleteEpisode = $db->prepare('DELETE FROM episodes WHERE id = ?');
    	$deleteEpisode->execute(array($idepisode));
    	return $deleteEpisode;
	}
	// On modifie le statut d'alerte d'un épisode
	public function updateEpisodeAlert($alert, $idepisode)
	{
		$db = $this->dbConnect();
		$updateAlertEpisode = $db->prepare('UPDATE episodes SET alert_status = :newalert WHERE id = :idepisode');
		$updateAlertEpisode->execute(array(
			'newalert' => $alert,
			'idcomment' => $idepisode
		));
		return $updateAlertEpisode;
	}
}