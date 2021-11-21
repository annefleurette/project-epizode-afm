<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class EpisodesManager extends Manager
{
	// On récupère la liste de tous les épisodes
    public function getAllEpisodes()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT e.id AS "id", s.id AS "seriesid", ic.url AS "cover", s.title AS "series", m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", e.date_publication AS "date", m.type AS "type", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain", COUNT(DISTINCT lik.id_member) AS "numberLikers", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN comments com ON com.id_episode = e.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover LEFT JOIN sales sal ON sal.id_episode = e.id LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id GROUP BY e.id');
	    $getAllEpisodes = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllEpisodes;
	}
	// On récupère la liste de tous les épisodes signalés
    public function getAlertEpisodes()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT e.id AS "id", s.id AS "seriesid", s.title AS "series", m.pseudo AS "pseudo", l.name AS "publisher", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", e.date_publication AS "date", m.type AS "type", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT sal.id_member) AS "salesNumber", ROUND((COALESCE(e.price, 0) - COALESCE(e.promotion, 0))*COUNT(DISTINCT sal.id_member), 2) AS "totalGain", COUNT(DISTINCT lik.id_member) AS "numberLikers" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN sales sal ON sal.id_episode = e.id LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id WHERE e.alert_status = 1 GROUP BY e.id');
	    $getAlertEpisodes = $req->fetchAll();
	    $req->closeCursor();
	    return $getAlertEpisodes;
	}
	// On récupère la liste de tous les épisodes d'une série
    public function getEpisodesList($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.id AS "id", e.number AS "number", e.title AS "title", e.publishing_status AS "publishing", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(lik.id_episode) AS "likesNumber", e.date_publication AS "publicationDate", e.date_modification AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id WHERE s.id = ? GROUP BY e.id');
		$req->execute(array($idseries));
	    $episodesList = $req->fetchAll();
	    $req->closeCursor();
	    return $episodesList;
	}
	// On récupère l'id d'une série à partir de l'id d'un épisode
    public function getIdSeriesEpisode($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_series FROM episodes WHERE id = ?');
		$req->execute(array($idepisode));
	    $idSeriesEpisode = $req->fetch();
	    $req->closeCursor();
		return $idSeriesEpisode;
	} 
	// On récupère la liste de tous les numéros d'épisodes d'une série
    public function getEpisodesIdList($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.id FROM episodes e ORDER BY e.id');
		$req->execute(array($idseries));
	    $episodesIdList = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $episodesIdList;
	}
	// On récupère la liste de tous les épisodes publiés d'une série
    public function getEpisodesPublishedList($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.id AS "id", e.number AS "number", e.title AS "title", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(lik.id_episode) AS "likesNumber", e.date_publication AS "publicationDate", e.date_modification AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id WHERE s.id = ? AND e.publishing_status = "published" GROUP BY e.id ORDER BY e.number');
		$req->execute(array($idseries));
	    $episodesPublishedList = $req->fetchAll();
	    $req->closeCursor();
	    return $episodesPublishedList;
	}
	//On compte le nombre d'épisodes d'une série qui ont été publiés
	public function countEpisodesPublished($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(id) FROM episodes WHERE publishing_status = "published" AND id_series = ?');
		$req->execute(array($idseries));
		$nbepisodes = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $nbepisodes;
	}
	// On récupère les informations d'un épisode d'une série avec l'id
	public function getEpisodeId($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", s.title AS "series", m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", m.type AS "type", COUNT(lik.id_episode) AS "likesNumber", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", e.meta_description AS "meta", e.price AS "originalPrice", e.promotion AS "promotion", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading", e.date_publication AS "publicationDate", e.date_modification AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN comments com ON com.id_episode = e.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id WHERE e.id = ?');
		$req->execute(array($idepisode));
	    $oneEpisode = $req->fetch();
	    $req->closeCursor();
	    return $oneEpisode;
	}
	// On récupère les informations de likes d'un épisode
	public function getEpisodeLikes($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(id_episode) FROM episode_has_members_likers WHERE id_episode = ?');
		$req->execute(array($idepisode));
	    $episodeLikes = $req->fetch();
	    $req->closeCursor();
	    return $episodeLikes;
	}
	// On récupère les utilisateurs qui ont liké un épisode
	public function getEpisodeLikers($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_member FROM episode_has_members_likers WHERE id_episode = ?');
		$req->execute(array($idepisode));
	    $episodeLikers = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $episodeLikers;
	}
	// On récupère un épisode unitaire d'une série publié via son number et l'id de la série
	public function getEpisodePublished($number, $idseries)
	{
		$db = $this->dbConnect();
		$req_episode = $db->prepare('SELECT e.id AS "id", e.number AS "number", e.title AS "title", e.content AS "content", e.date_publication AS "publicationDate", e.date_modification AS "lastUpdate", COUNT(lik.id_episode) AS "likesNumber", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.signs_number/(300*5)) AS "timeReading", e.meta_description AS "meta" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN comments com ON com.id_episode = e.id LEFT JOIN episode_has_members_likers lik ON lik.id_episode = e.id WHERE e.number = ? AND e.publishing_status="published" AND e.id_series = ? GROUP BY e.id');
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
	public function addEpisode($number, $title, $content, $publishing_status, $id_series, $price, $promotion, $signs_number, $meta)
	{
		$db = $this->dbConnect();
		$addEpisode = $db->prepare('INSERT INTO episodes(number, title, content, publishing_status, date_publication, date_modification, id_series, price, alert_status, promotion, signs_number, meta_description) VALUES(?, ?, ?, ?, NOW(), NOW(), ?, ?, 0, ?, ?, ?)');
		$addEpisode->execute(array($number, $title, $content, $publishing_status, $id_series, $price, $promotion, $signs_number, $meta));
	    return $addEpisode;
	}
	// On modifie un épisode
	public function updateEpisode($number, $title, $content, $publishing_status, $price, $promotion, $signs_number, $meta, $idepisode)
	{
		$db = $this->dbConnect();
		$updateEpisode = $db->prepare('UPDATE episodes SET number = :newnumber, title = :newtitle, content = :newcontent, publishing_status = :newpublishing_status, date_publication = NOW(), date_modification = NOW(), price = :newprice, promotion = :newpromotion, signs_number = :newsigns_number, meta_description = :newmeta_description WHERE id = :id');
		$updateEpisode->execute(array(
			'newnumber' => $number,
			'newtitle' => $title,
			'newcontent' => $content,
			'newpublishing_status' => $publishing_status,
			'newprice' => $price,
			'newpromotion' => $promotion,
			'newsigns_number' => $signs_number,
			'newmeta_description' => $meta,
			'id' => $idepisode
		)); 
		return $updateEpisode;
	}
	// On modifie le statut d'un épisode dont la série a été suprimée
	public function updateEpisodeSeriesStatus($publishing_status, $idseries)
	{
		$db = $this->dbConnect();
		$updateEpisodeSeriesStatus = $db->prepare('UPDATE episodes SET publishing_status = :newpublishing_status WHERE id_series = :id');
		$updateEpisodeSeriesStatus->execute(array(
			'newpublishing_status' => $publishing_status,
			'id' => $idseries
		)); 
		return $updateEpisodeSeriesStatus;
	}
	// On ajoute un nouveau like
	public function addEpisodeLike($idepisode, $idmember)
	{
		$db = $this->dbConnect();
		$episodeLike = $db->prepare('INSERT INTO episode_has_members_likers(id_episode, id_member) VALUES(?, ?)');
    	$episodeLike->execute(array($idepisode, $idmember));
    	return $episodeLike;
	}
	// On supprime un like
	public function deleteLike($idepisode, $idmember)
	{
		$db = $this->dbConnect();
		$deleteLike = $db->prepare('DELETE FROM episode_has_members_likers WHERE id_episode = ? AND id_member = ?');
    	$deleteLike->execute(array($idepisode, $idmember));
    	return $deleteLike;
	}
	// On supprime tous les likes d'un épisode
	public function deleteAllSeriesSubscriptions($idepisode)
	{
		$db = $this->dbConnect();
		$deleteAllEpisodesSubscriptions = $db->prepare('DELETE FROM episode_has_members_likers WHERE id_episode = ?');
		$deleteAllEpisodesSubscriptions->execute(array($idepisode));
		return $deleteAllEpisodesSubscriptions;
	}
	// On change le statut d'un épisode
	public function updateEpisodeStatus($publishing_status, $idepisode)
	{
		$db = $this->dbConnect();
		$updateEpisodeStatus = $db->prepare('UPDATE episodes SET publishing_status = :newpublishing_status WHERE id = :id');
		$updateEpisodeStatus->execute(array(
			'newpublishing_status' => $publishing_status,
			'id' => $idepisode
		)); 
		return $updateEpisodeStatus;
	}
	// On supprime un épisode définitivement
	public function deleteEpisode($idepisode)
	{
		$db = $this->dbConnect();
		$deleteEpisode = $db->prepare('DELETE FROM episodes WHERE id = ?');
    	$deleteEpisode->execute(array($idepisode));
    	return $deleteEpisode;
	}
	// On récupère les informations de signalement d'un épisode
	public function getEpisodeAlert($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT alert_status FROM episodes WHERE id_episode = ?');
		$req->execute(array($idepisode));
		$episodeAlert = $req->fetch();
		$req->closeCursor();
		return $episodeAlert;
	}
	// On modifie le statut d'alerte d'un épisode
	public function updateEpisodeAlert($alert, $idepisode)
	{
		$db = $this->dbConnect();
		$updateAlertEpisode = $db->prepare('UPDATE episodes SET alert_status = :newalert WHERE id = :idepisode');
		$updateAlertEpisode->execute(array(
			'newalert' => $alert,
			'idepisode' => $idepisode
		));
		return $updateAlertEpisode;
	}
}