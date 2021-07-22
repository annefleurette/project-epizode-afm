<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class SeriesManager extends Manager
{
    // On récupère les informations sur toutes les séries
    public function getAllSeries()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", s.summary AS "summary", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "author_publisher", m.type AS "type", ia.url AS "avatar", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN episodes e ON e.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover GROUP BY s.id');
	    $getAllSeries = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllSeries;
	}
    // On récupère les informations de performance de toutes les séries --> A voir en mentorat
    // On récupère les informations d'une série
	public function getOneSeriesData($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", s.summary AS "summary", m.id AS "idmember", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "publisher_author", m.type AS "type", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN episodes e ON e.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE s.id = ?');
		$req->execute(array($idseries));
		$oneSeriesUserData = $req->fetch();
	    $req->closeCursor();
	    return $oneSeriesUserData;
    }
    // On récupère les 3 séries les plus récentes publiées par des amateurs
    public function getLastThreeSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", s.pricing_status AS "pricing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN series s ON s.id_member = m.id LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date_publication DESC LIMIT 3');
	    $seriesLastThreeUsers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesLastThreeUsers;
    }
    // On récupère les 3 séries les plus récentes publiées par des éditeurs
    public function getLastThreeSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date_publication DESC LIMIT 3');
	    $seriesLastThreePublishers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesLastThreePublishers;
    }
    // On récupère le top 10 des séries amateurs publiées avec le plus d'abonnés
    public function topTenSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", COUNT(DISTINCT sub.id_member) AS "numberSubscribers" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 10');
	    $seriesTopTenUsers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesTopTenUsers;
    }
    // On récupère le top 10 des séries éditeurs publiées avec le plus d'abonnés
    public function topTenSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", COUNT(DISTINCT sub.id_member) AS "numberSubscribers" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 10');
	    $seriesTopTenPublishers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesTopTenPublishers;
	}
	// On récupère toutes les séries publiées qui possèdent des tags définis (recommandation)
	public function getCommonTagsSeries($tags)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "member", ia.url AS "avatar", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE t.name = ? GROUP BY s.id ORDER BY "numberSubscribers" DESC LIMIT 3');
		$req->execute(array($tags));
		$seriesCommonTags = $req->fetchAll();
		$req->closeCursor();
		return $seriesCommonTags;
	}
	// On récupère la couverture d'une série
	public function getSeriesCover($idseries)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ic.url FROM covers c INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN series s ON s.id_cover = c.id WHERE s.id = ?');
        $req->execute(array($idseries));
        $seriesCover = $req->fetch(\PDO::FETCH_COLUMN);
        $req->closeCursor();
        return $seriesCover;		
	}
	// On récupère l'id de la couverture d'une série
	public function getSeriesIdCover($idseries)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_cover FROM series WHERE id = ?');
        $req->execute(array($idseries));
        $seriesIdCover = $req->fetch(\PDO::FETCH_COLUMN);
        $req->closeCursor();
        return $seriesIdCover;		
	}
	// On récupère des résultats de recherche de série avec des mots clés
	public function getResearchSeries($keywords)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", s.summary AS "summary", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "publisher_author", m.type AS "type", ia.url AS "avatar", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN episodes e ON e.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE lower(s.title) LIKE "%?%" OR lower(m.pseudo) LIKE "%?%" OR lower(l.name) LIKE "%?%" OR lower(s.publisher_author) LIKE "%?%" GROUP BY s.id');
        $req->execute(array($keywords));
        $seriesResearch = $req->fetchAll();
        $req->closeCursor();
        return $seriesResearch;		
	}
	// On ajoute une série
	public function addSeries($title, $summary, $idmemberrelated, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription)
	{
		$db = $this->dbConnect();
		$addNewSeries = $db->prepare('INSERT INTO series(title, summary, date_publication, date_modification, id_member, pricing_status, publishing_status, authors_right, id_cover, publisher_author, publisher_author_description) VALUES(?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?)');
		$addNewSeries->execute(array($title, $summary, $idmemberrelated, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription));
		return $addNewSeries;
	}	
	// On modifie une série
	public function updateSeries($title, $summary, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription, $idseries)
	{
		$db = $this->dbConnect();
		$updateSeries = $db->prepare('UPDATE series SET title = :newtitle, summary = :newsummary, date_modification = NOW(), pricing_status = :newpricing_status, publishing_status = :newpublishing_status, authors_right = :newauthors_right, id_cover = :newid_cover, publisher_author = :newpublisher_author, publisher_author_description = :newpublisher_author_description WHERE id = :idseries');
        $updateSeries->execute(array(
			'newtitle' => $title,
			'newsummary' => $summary,
			'newpricing_status' => $pricing,
			'newpublishing_status' => $publishing,
			'newauthors_right' => $rights,
			'newid_cover' => $idcoverrelated,
			'newpublisher_author' => $publisherauthor,
			'newpublisher_author_description' => $publisherauthordescription,
			'idseries' => $idseries
		)); 
		return $updateSeries;
	}
	// On passe le statut d'une série en supprimé
	public function updateSeriesDeleted($publishing_status, $idseries)
	{
		$db = $this->dbConnect();
		$updateSeriesDeleted = $db->prepare('UPDATE series SET publishing_status = :newpublishing_status WHERE id = :id');
		$updateSeriesDeleted->execute(array(
			'newpublishing_status' => $publishing_status,
			'id' => $idseries
		)); 
		return $updateSeriesDeleted;
	}
	// On supprime une série
	public function deleteSeries($idseries)
	{
		$db = $this->dbConnect();
		$deleteSeries = $db->prepare('DELETE FROM series WHERE id = ?');
    	$deleteSeries->execute(array($idseries));
    	return $deleteSeries;
	}
	// On récupère les informations d'abonnement d'une série
	public function getSeriesSubscriptions($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(DISTINCT id_series) FROM series_has_members_subscription WHERE id_series = ?');
		$req->execute(array($idseries));
	   	$seriesSubscription = $req->fetch();
	    $req->closeCursor();
	    return $seriesSubscription;
	}
	// On récupère les utilisateurs qui se sont abonnés à une série
	public function getSeriesSubscribers($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_member FROM series_has_members_subscription WHERE id_series = ?');
		$req->execute(array($idseries));
	    $seriesSubscribers = $req->fetch();
	    $req->closeCursor();
	    return $seriesSubscribers;
	}
    // On récupère les id de toutes les séries
    public function getAllIdSeries()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id"FROM series s ORDER BY s.id');
	    $getAllIdSeries = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $getAllIdSeries;
	}
	// On récupère l'id d'une série à partir de l'id du membre et de son titre
	public function getSeriesId($idmember, $title)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id" FROM series s INNER JOIN members m ON s.id_member = m.id WHERE m.id = ? AND s.title = ? LIMIT 1');
		$req->execute(array($idmember, $title));
		$seriesId = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesId;
	}
	// On récupère tous les id de série d'un membre
	public function getAllSeriesId($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "ids" FROM series s INNER JOIN members m ON s.id_member = m.id WHERE m.id = ? ORDER BY s.id');
		$req->execute(array($idmember));
	    $getAllSeriesId = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $getAllSeriesId;
	}
	// On récupère tous les titres de série d'un membre
	public function getAllTitles($idmember)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.title AS "titles" FROM series s INNER JOIN members m ON s.id_member = m.id WHERE m.id = ? ORDER BY s.id');
		$req->execute(array($idmember));
	    $getAllTitles = $req->fetchAll(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $getAllTitles;
	}
	// On récupère tous les tags existants
	public function getAllTags()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT name FROM tags');
	    $getAllTags = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllTags;
	}
	// On ajoute un tag
	public function addTag($name)
	{
		$db = $this->dbConnect();
		$addNewTag = $db->prepare('INSERT INTO tags(name) VALUES(?)');
		$addNewTag->execute(array($name));
	    return $addNewTag;
	}
	// On récupère l'id d'un tag à partir du nom du tag
	public function getTagId($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM tags WHERE name = ?');
		$req->execute(array($name));
		$tagId = $req->fetch(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $tagId;
	}
	// On récupère les tags d'une série
	public function getTagSeries($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t.name AS "tag" FROM tags t LEFT JOIN series_has_tags st ON t.id = st.id_tag LEFT JOIN series s ON s.id = st.id_series WHERE s.id = ?');
		$req->execute(array($idseries));
		$tagSeries = $req->fetchAll(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $tagSeries;
	}
	// On récupère les id des tags d'une série
	public function getIdTagSeries($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t.id AS "id" FROM tags t LEFT JOIN series_has_tags st ON t.id = st.id_tag LEFT JOIN series s ON s.id = st.id_series WHERE s.id = ?');
		$req->execute(array($idseries));
		$tagIdSeries = $req->fetchAll(\PDO::FETCH_COLUMN);
		$req->closeCursor();
		return $tagIdSeries;
	}
	// On ajoute un tag à une série
	public function addTagSeries($idtagrelated, $idseriesrelated)
	{
		$db = $this->dbConnect();
		$addTagSeries = $db->prepare('INSERT INTO series_has_tags(id_tag, id_series) VALUES(?, ?)');
		$addTagSeries->execute(array($idtagrelated, $idseriesrelated));
	    return $addTagSeries;
	}
	// On modifie un tag
	public function updateTag($name, $idtag)
	{
		$db = $this->dbConnect();
		$updateTag = $db->prepare('UPDATE tags SET name = :newname WHERE id = :idtag');
		$updateTag->execute(array(
			'newname' => $name,
			'idtag' => $idtag
		)); 
		return $updateTag;
	}
	// On modifie un tag d'une série
	public function updateTagSeries($idtag, $idseries)
	{
		$db = $this->dbConnect();
		$updateTagSeries = $db->prepare('UPDATE series_has_tags SET id_tag = :newid_tag WHERE id_series = :idseries');
		$updateTagSeries->execute(array(
			'newid_tag' => $idtag,
			'idseries' => $idseries
		)); 
		return $updateTagSeries;
	}
	// On supprime un tag
	public function deleteTag($idtag)
	{
		$db = $this->dbConnect();
		$deleteTag= $db->prepare('DELETE FROM tags WHERE id = ?');
    	$deleteTag->execute(array($idtag));
    	return $deleteTag;
	}
	// On supprime un tag d'une série
	public function deleteTagSeries($idtagrelated, $idseriesrelated)
	{
		$db = $this->dbConnect();
		$deleteTagSeries= $db->prepare('DELETE FROM series_has_tags WHERE id_tag = ? AND id_series = ?');
    	$deleteTagSeries->execute(array($idtagrelated, $idseriesrelated));
    	return $deleteTagSeries;
	}
	// On ajoute un nouvel abonnement
	public function addSeriesSubscription($idseries, $idmember)
	{
		$db = $this->dbConnect();
		$seriesSubscription = $db->prepare('INSERT INTO series_has_members_subscription(id_series, id_member) VALUES(?, ?)');
    	$seriesSubscription->execute(array($idseries, $idmember));
    	return $seriesSubscription;
	}
	// On supprime un abonnement
	public function deleteSubscription($idseries, $idmember)
	{
		$db = $this->dbConnect();
		$deleteSubscription = $db->prepare('DELETE FROM series_has_members_subscription WHERE id_series = ? AND id_member = ?');
    	$deleteSubscription->execute(array($idseries, $idmember));
    	return $deleteSubscription;
	}
	// On ajoute une cover
	public function addCover($idcover)
	{
		$db = $this->dbConnect();
		$addCover = $db->prepare('INSERT INTO covers(id_cover) VALUES(?)');
	    $addCover->execute(array($idcover));
	    return $addCover;
	}
	// On modifie une cover
	public function updateCover($idimage, $idcover)
	{
		$db = $this->dbConnect();
		$updateCover = $db->prepare('UPDATE covers SET id_cover = :newid_cover WHERE id = :idcover');
		$updateCover->execute(array(
			'newid_cover' => $idimage,
			'idcover' => $idcover
		)); 
		return $updateCover;
	}
	// On supprime une cover
	public function deleteCover($idcover)
	{
		$db = $this->dbConnect();
		$deleteCover= $db->prepare('DELETE FROM covers WHERE id = ?');
    	$deleteCover->execute(array($idcover));
    	return $deleteCover;
	}
	// On récupère l'id d'une cover à partir de l'id de l'image
	public function getCoverId($idcover)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM covers WHERE id_cover = ?');
		$req->execute(array($idcover));
	    $coverId = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $coverId;
	}
}