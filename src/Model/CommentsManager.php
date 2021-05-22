<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class CommentsManager extends Manager
{
	// On récupère la liste de tous les commentaires
	public function getAllComments()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT com.id AS "id", m.pseudo AS "pseudo", l.name AS "name", com.date AS "date", s.title AS "series", e.number AS "episode", com.content AS "content", m.type AS "type" FROM comments com LEFT JOIN episodes e ON e.id = com.id_episode LEFT JOIN members m ON m.id = com.id_member LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id = e.id_series GROUP BY com.id');
	    $getAllComments = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllComments;
	}
	// On récupère la liste de tous les commentaires signalés
	public function getAlertComments()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT com.id AS "id", m.pseudo AS "pseudo", l.name AS "name", com.date AS "date", s.title AS "series", e.number AS "episode", com.content AS "content", m.type AS "type" FROM comments com LEFT JOIN episodes e ON e.id = com.id_episode LEFT JOIN members m ON m.id = com.id_member LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id = e.id_series WHERE com.alert_status = 1 GROUP BY com.id');
	    $getAlertComments = $req->fetchAll();
	    $req->closeCursor();
	    return $getAlertComments;
	}
	// On récupère les commentaires d'un épisode
	public function getCommentsEpisode($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "name", il.url AS "logo", com.id AS "id", com.date AS "date", com.content AS "content", m.type AS "type" FROM comments com LEFT JOIN episodes e ON e.id = com.id_episode LEFT JOIN members m ON m.id = com.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE e.id = ? ORDER BY com.date');
		$req->execute(array($idepisode));
	    $episodeCommentsList = $req->fetchAll();
	    $req->closeCursor();
	    return $episodeCommentsList;
	}
	// On compte le nombre de commentaires d'un épisode
	public function countCommentsPublished($idepisode)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(*) FROM comments WHERE id_episode = ?');
		$req->execute(array($idepisode));
		$nbcomments = $req->fetchAll(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $nbcomments;
	}
	// On ajoute un nouveau commentaire
	public function addComment($idmember, $idepisode, $content)
	{
		$db = $this->dbConnect();
		$addComment = $db->prepare('INSERT INTO comments(id_member, id_episode, content, date) VALUES(?, ?, ?, NOW())');
		$addComment->execute(array($idmember, $idepisode, $content));
	    return $addComment;
	}
	// On supprime un commentaire
	public function deleteComment($idcomment)
	{
		$db = $this->dbConnect();
		$deleteComment = $db->prepare('DELETE FROM comments WHERE id = ?');
		$deleteComment->execute(array($idcomment));
		return $deleteComment;
	}	
	// On modifie le statut d'alerte d'un commentaire
	public function updateCommentAlert($alert, $idcomment)
	{
		$db = $this->dbConnect();
		$updateAlertComment = $db->prepare('UPDATE comments SET alert_status = :newalert WHERE id = :idcomment');
		$updateAlertComment->execute(array(
			'newalert' => $alert,
			'idcomment' => $idcomment
		));
		return $updateAlertComment;
	}
}