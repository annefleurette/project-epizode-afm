<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class EpisodesManager extends Manager
{
    // On récupère la liste de tous les épisodes publiés d'une série
    public function getEpisodesList($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.number AS "number", e.title AS "title", e.publishing_status AS "publishing", ROUND(COALESCE(e.price, 0) - COALESCE(e.promotion, 0), 2) AS "price", COALESCE(e.likes_number, 0) AS "likesNumber", e.date AS "lastUpdate" FROM episodes e LEFT JOIN series s ON s.id = e.id_series WHERE s.id = 1 ORDER BY e.number');
		$req->execute(array($id));
	    $episodesList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $episodesList;
	}
	// On récupère les information d'un épisode d'une série avec l'id
	public function getEpisodeId($id) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", s.title AS "series", m.pseudo AS "author", ia.url AS "avatar", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", m.type AS "type", e.likes_number AS "numberLikes", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.words_number/300) AS "timeReading" FROM episodes e LEFT JOIN series s ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN comments com ON com.id_episode = e.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE e.id = ?');
		$req->execute(array($id));
	    $oneEpisodesUser = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $oneEpisodesUser;
	}
	// On récupère les packs prix
	public function getCoinsPack() {
		$db = $this->dbConnect();
		$req = $db->query('SELECT name AS "name", ROUND(COALESCE(price, 0) - COALESCE(promotion, 0), 2) AS "price", coins_number AS "coinsNumber" FROM packs');
	    $getPacks = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $getPacks;
	}
	// On ajoute un nouvel épisode
	public function addEpisode($number, $title, $content, $publishing_status, $date, $id_series, $price, $promotion, $words_number)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO episodes(number, title, content, publishing_status, date, id_series, price, likes_number, promotion, words_number) VALUES(?, ?, ?, ?, ?, ?, ?, 0, ?, ?)');
		$req->execute(array($number, $title, $content, $publishing_status, $date, $id_series, $price, $promotion, $words_number));
	    $addEpisode = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $addEpisode;
	}
	// On modifie un épisode
	public function updateEpisode($number, $title, $content, $publishing_status, $date, $price, $promotion, $words_number, $id)
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
			'id' => $id
		)); 
		return $updateEpisode;
	}
	// On ajoute un like dans la table épisode
	public function updateLikesEpisode($likes_number, $id)
	{
		$db = $this->dbConnect();
		$updateLikesEpisode = $db->prepare('UPDATE episodes SET likes_number = :newlikes_number WHERE id = :id');
		$updateLikesEpisode->execute(array(
			'newlikes_number' => $likes_number,
			'id' => $id
		)); 
		return $updateLikesEpisode;
	}
	// On supprime un épisode
	public function deleteEpisode($id)
	{
		$db = $this->dbConnect();
		$deleteEpisode = $db->prepare('DELETE FROM episodes WHERE id = ?');
    	$deleteEpisode->execute(array($id));
    	return $deleteEpisode;
	}
}