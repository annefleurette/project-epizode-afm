<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class EpisodesManager extends Manager
{
    // On récupère la liste de tous les épisodes publiés d'une série
    public function getEpisodesList($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT number, title, COUNT(price - promotion) AS "amount", likes_number FROM episodes WHERE id = ? AND publishing_status = "published" ORDER BY number');
		$req->execute(array($id));
	    $episodesList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $episodesList;
	}
	// On récupère les information d'un épisode d'une série amateur avec l'id
	public function getEpisodeUserId($id) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", s.title AS "series", m.pseudo AS "author", ia.url AS "avatar", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", e.likes_number AS "numberLikes", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.words_number/300) AS "timeReading" FROM episodes e INNER JOIN series s ON s.id = e.id_series INNER JOIN members m ON m.id = s.id_author INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN comments com ON com.id_episode = e.id WHERE e.id = ?');
		$req->execute(array($id));
	    $oneEpisodesUser = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $oneEpisodesUser;
	}
	// On récupère les information d'un épisode d'une série éditeur avec l'id
	public function getEpisodePublisherId($id) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", s.title AS "series", l.name AS "publisher", il.url AS "logo", s.publisher_author AS "author", e.number AS "number", e.title AS "title", e.content AS "content", e.publishing_status AS "publishing", e.likes_number AS "numberLikes", COUNT(DISTINCT com.id_episode) AS "numberComments", ROUND(e.words_number/300) AS "timeReading" FROM episodes e INNER JOIN series s ON s.id = e.id_series INNER JOIN members m ON m.id = s.id_author INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN comments com ON com.id_episode = e.id WHERE e.id = ?');
		$req->execute(array($id));
	    $oneEpisodesUser = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $oneEpisodesUser;
	}
}