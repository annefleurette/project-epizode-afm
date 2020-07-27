<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class CommentsManager extends Manager
{
	// On récupère les commentaires amateurs d'un épisode
	public function getUsersCommentsEpisode($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.pseudo AS "pseudo", ia.url AS "avatar", com.date AS "date", com.content AS "content" FROM comments com INNER JOIN episodes e ON e.id = com.id_episode INNER JOIN members m ON m.id = com.id_member INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar WHERE m.type = "user" AND e.id = ? ORDER BY com.date');
		$req->execute(array($id));
	    $usersCommentsList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $usersCommentsList;
	}
	// On récupère les commentaires éditeurs d'un épisode
	public function getPublishersCommentsEpisode($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT l.name AS "name", il.url AS "logo", com.date AS "date", com.content AS "content" FROM comments com INNER JOIN episodes e ON e.id = com.id_episode INNER JOIN members m ON m.id = com.id_member INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo WHERE m.type = "publisher" AND e.id = ? ORDER BY com.date');
		$req->execute(array($id));
	    $publishersCommentsList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $publishersCommentsList;
	}
	// On récupère les commentaires admin d'un épisode
	public function getAdminCommentsEpisode($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT m.pseudo AS "pseudo", ia.url AS "avatar", com.date AS "date", com.content AS "content" FROM comments com INNER JOIN episodes e ON e.id = com.id_episode INNER JOIN members m ON m.id = com.id_member INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar WHERE m.type = "admin" AND e.id = ? ORDER BY com.date');
		$req->execute(array($id));
	    $adminCommentsList = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $adminCommentsList;
	}
}