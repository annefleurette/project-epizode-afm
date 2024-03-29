<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Manager.php');
class SeriesManager extends Manager
{
    // On récupère les informations sur toutes les séries
    public function getAllSeries()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "author", m.type AS "type", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.date_publication AS "date" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN series s ON s.id_member = m.id LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover LEFT JOIN logos l ON l.id = m.id_logo GROUP BY s.id');
	    $getAllSeries = $req->fetchAll();
	    $req->closeCursor();
	    return $getAllSeries;
	}
	// On récupère les informations d'une série pour usage privé
	public function getOneSeriesData($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", s.summary AS "summary", m.id AS "idmember", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "publisher_author", s.publisher_author_description AS "publisher_author_description", m.type AS "type", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.meta_description AS "meta" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN episodes e ON e.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE s.id = ?');
		$req->execute(array($idseries));
		$oneSeriesUserData = $req->fetch();
		$req->closeCursor();
		return $oneSeriesUserData;
	}
	// On récupère les informations d'une série pour usage public
	public function getOneSeriesPublicData($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", s.summary AS "summary", m.id AS "idmember", m.pseudo AS "member", l.name AS "publisher", s.publisher_author AS "publisher_author", s.publisher_author_description AS "publisher_author_description", m.type AS "type", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.meta_description AS "meta" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN episodes e ON e.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE s.publishing_status = "published" AND s.id = ?');
		$req->execute(array($idseries));
		$oneSeriesPublicData = $req->fetch();
		$req->closeCursor();
		return $oneSeriesPublicData;
	}
    // On récupère les 3 séries les plus récentes publiées par des amateurs
    public function getLastThreeSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "author", m.type AS "type", ia.url AS "avatar", ia.alt AS "altavatar", s.pricing_status AS "pricing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", m.id AS "idmember" FROM members m LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN series s ON s.id_member = m.id LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date_publication DESC LIMIT 3');
	    $seriesLastThreeUsers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesLastThreeUsers;
    }
    // On récupère les 3 séries les plus récentes publiées par des éditeurs
    public function getLastThreeSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title",l.name AS "publisher", s.publisher_author AS "author", m.type AS "type", il.url AS "logo", il.alt AS "altlogo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", m.id AS "idmember" FROM members m LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series s ON s.id_member = m.id LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date_publication DESC LIMIT 3');
	    $seriesLastThreePublishers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesLastThreePublishers;
    }
    // On récupère le top 5 des séries amateurs publiées avec le plus d'abonnés
    public function topFiveSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", ia.alt AS "alt", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", m.id AS "idmember" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 5');
	    $seriesTopFiveUsers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesTopFiveUsers;
    }
    // On récupère le top 5 des séries éditeurs publiées avec le plus d'abonnés
    public function topFiveSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", ic.alt AS "altcover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", il.alt AS "alt", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", m.id AS "idmember" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 5');
	    $seriesTopFivePublishers = $req->fetchAll();
	    $req->closeCursor();
	    return $seriesTopFivePublishers;
	}
	// On récupère toutes les séries publiées qui possèdent des tags définis (recommandation)
	public function getCommonTagsSeries($tags)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "member", m.id AS "idmember", m.type AS "type", ia.url AS "avatar", ia.alt AS "altavatar", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", il.alt AS "altlogo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM members m LEFT JOIN series s ON s.id_member = m.id LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN episodes e ON e.id_series = s.id LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover WHERE s.publishing_status = "published" AND t.name = ? GROUP BY s.id ORDER BY "numberSubscribers" DESC LIMIT 3');
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
	// On ajoute une série
	public function addSeries($title, $summary, $idmemberrelated, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription, $meta)
	{
		$db = $this->dbConnect();
		$addNewSeries = $db->prepare('INSERT INTO series(title, summary, date_publication, date_modification, id_member, pricing_status, publishing_status, authors_right, id_cover, publisher_author, publisher_author_description, meta_description) VALUES(?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?)');
		$addNewSeries->execute(array($title, $summary, $idmemberrelated, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription, $meta));
		return $addNewSeries;
	}	
	// On modifie une série
	public function updateSeries($title, $summary, $pricing, $publishing, $rights, $idcoverrelated, $publisherauthor, $publisherauthordescription, $meta, $idseries)
	{
		$db = $this->dbConnect();
		$updateSeries = $db->prepare('UPDATE series SET title = :newtitle, summary = :newsummary, date_modification = NOW(), pricing_status = :newpricing_status, publishing_status = :newpublishing_status, authors_right = :newauthors_right, id_cover = :newid_cover, publisher_author = :newpublisher_author, publisher_author_description = :newpublisher_author_description, meta_description = :newmeta_description WHERE id = :idseries');
        $updateSeries->execute(array(
			'newtitle' => $title,
			'newsummary' => $summary,
			'newpricing_status' => $pricing,
			'newpublishing_status' => $publishing,
			'newauthors_right' => $rights,
			'newid_cover' => $idcoverrelated,
			'newpublisher_author' => $publisherauthor,
			'newpublisher_author_description' => $publisherauthordescription,
			'newmeta_description' => $meta,
			'idseries' => $idseries
		)); 
		return $updateSeries;
	}
	// On modifie le statut d'une série
	public function updateSeriesStatus($publishing_status, $idseries)
	{
		$db = $this->dbConnect();
		$updateSeriesStatus = $db->prepare('UPDATE series SET publishing_status = :newpublishing_status WHERE id = :id');
		$updateSeriesStatus->execute(array(
			'newpublishing_status' => $publishing_status,
			'id' => $idseries
		)); 
		return $updateSeriesStatus;
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
		$req = $db->prepare('SELECT COUNT(id_series) FROM series_has_members_subscription WHERE id_series = ?');
		$req->execute(array($idseries));
	   	$seriesSubscription = $req->fetch();
	    $req->closeCursor();
	    return $seriesSubscription;
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
	// On récupère les utilisateurs qui se sont abonnés à une série
	public function getSeriesSubscribers($idseries)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_member FROM series_has_members_subscription WHERE id_series = ?');
		$req->execute(array($idseries));
	    $seriesSubscribers = $req->fetchAll(\PDO::FETCH_COLUMN);
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
	public function addSeriesSubscription($idseries, $idmember, $notifications)
	{
		$db = $this->dbConnect();
		$seriesSubscription = $db->prepare('INSERT INTO series_has_members_subscription(id_series, id_member, subscription_notifications) VALUES(?, ?, ?)');
    	$seriesSubscription->execute(array($idseries, $idmember, $notifications));
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
	// On supprime tous les abonnements à une série
	public function deleteAllSeriesSubscriptions($idseries)
	{
		$db = $this->dbConnect();
		$deleteAllSeriesSubscriptions = $db->prepare('DELETE FROM series_has_members_subscription WHERE id_series = ?');
		$deleteAllSeriesSubscriptions->execute(array($idseries));
		return $deleteAllSeriesSubscriptions;
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

	// On récupère les résultats d'une recherche de mots clés parmi les séries
	public function getResearchSeriesResults($keyword)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT DISTINCT s.title AS "title", s.id AS "id", ic.url AS "cover", ic.alt AS "alt", s.summary AS "summary", m.pseudo AS "member", m.type AS "type", s.publisher_author AS "author", l.name AS "publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags", s.pricing_status AS "pricing", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers" FROM series s LEFT JOIN episodes e ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo LEFT JOIN series_has_tags h ON h.id_series = s.id LEFT JOIN tags t ON t.id = h.id_tag LEFT JOIN covers c ON c.id = s.id_cover LEFT JOIN images ic ON ic.id = c.id_cover LEFT JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE s.publishing_status = "published" AND CONCAT(s.title, s.summary, m.pseudo, COALESCE(s.publisher_author, ""), t.name) LIKE ? GROUP BY s.id');
		$req->execute(array($keyword));
	    $researchSeriesResults = $req->fetchAll();
	    $req->closeCursor();
	    return $researchSeriesResults;
	}

	// On récupère les résultats d'une recherche de mots clés parmi les auteurs
	public function getResearchAuthorsResults($keyword)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT DISTINCT m.pseudo AS "member", m.type AS "type", m.id AS "id", l.name AS "publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", COUNT(DISTINCT s.id) AS "numberWritings" FROM series s LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE s.publishing_status = "published" AND CONCAT(m.pseudo, COALESCE(s.publisher_author, ""), COALESCE(l.name, "")) LIKE ? GROUP BY m.id');
		$req->execute(array($keyword));
		$researchAuthorsResults = $req->fetchAll();
		$req->closeCursor();
		return $researchAuthorsResults;
	}

	// On récupère les résultats d'une recherche de mots clés parmi les épisodes
	public function getResearchEpisodesResults($keyword)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT DISTINCT m.pseudo AS "member", m.type AS "type", l.name AS "publisher", ia.url AS "avatar", ia.alt AS "altavatar", il.url AS "logo", il.alt AS "altlogo", s.id AS "idseries", s.title AS "title", e.number AS "number", e.id AS "id", e.title AS "titleEpisode", e.content AS "content" FROM series s LEFT JOIN episodes e ON s.id = e.id_series LEFT JOIN members m ON m.id = s.id_member LEFT JOIN avatars a ON a.id = m.id_avatar LEFT JOIN images ia ON ia.id = a.id_avatar LEFT JOIN logos l ON l.id = m.id_logo LEFT JOIN images il ON il.id = l.id_logo WHERE s.publishing_status = "published" AND e.publishing_status = "published" AND CONCAT(e.title, e.content) LIKE ?');
		$req->execute(array($keyword));
		$researchEpisodesResults = $req->fetchAll();
		$req->closeCursor();
		return $researchEpisodesResults;
	}
}
