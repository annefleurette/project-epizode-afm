<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class CommentsManager extends Manager
{
	// On récupère les commentaires d'un épisode
	public function getCommentsEpisode($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.pseudo AS "pseudo", ia.url AS "avatar", l.name AS "name", il.url AS "logo", com.date AS "date", com.content AS "content", m.type AS "type" FROM comments com LEFT JOIN episodes e ON e.id = com.id_episode LEFT JOIN members m ON m.id = com.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE e.id = ? ORDER BY com.date');
		$req->execute(array($id));
	    $usersCommentsList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $usersCommentsList;
	}
	// On ajoute un nouveau commentaire
	public function addComment($idmember, $idepisode, $content, $date)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO comments(id_member, id_episode, content, date) VALUES(?, ?, ?, NOW()');
		$req->execute(array($idmember, $idepisode, $content));
	    $addComment = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $addComment;
	}
	// On supprime un commentaire
	public function deleteComment($id)
	{
		$db = $this->dbConnect();
		$deleteComment = $db->prepare('DELETE FROM comments WHERE id = ?');
		$deleteComment->execute(array($id));
		return $deleteComment;
	}	
	// On modifie le statut d'alerte d'un commentaire
	public function updateCommentAlert($alert, $id)
	{
		$db = $this->dbConnect();
		$updateAlert = $db->prepare('UPDATE comments SET alert_status = :newalert WHERE id = :id');
		$updateAlert->execute(array(
			'newalert' => $alert,
			'id' => $id
		));
		return $updateAlert;
	}
}