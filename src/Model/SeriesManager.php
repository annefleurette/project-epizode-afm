<?php
namespace AnneFleurMarchat\Epizode\Model;
require_once('Model/Manager.php');
class SeriesManager extends Manager
{
    // On récupère les informations sur toutes les séries écrites par des amateurs
    public function getSeriesUserData()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "user" GROUP BY s.id');
	    $seriesUserData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesUserData;
    }
    // On récupère les informations sur toutes les séries gérées par des éditeurs
    public function getSeriesPublisherData()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "publisher" GROUP BY s.id');
	    $seriesPublisherData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesPublisherData;
	}
    // On récupère les informations d'une série écrite par un amateur
	public function getOneSeriesUserData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "user" AND s.id = ?');
		$req->execute(array($id));
		$oneSeriesUserData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $oneSeriesUserData;
    }
    // On récupère les informations d'une série écrite par un éditeur
    public function getOneSeriesPublisherData($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "publisher" AND s.id = ?');
		$req->execute(array($id));
		$oneSeriesPublisherData = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $oneSeriesPublisherData;
    }
    // On récupère les 3 séries les plus récentes publiées par des amateurs
    public function getLastThreeSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", s.pricing_status AS "pricing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date DESC LIMIT 3');
	    $seriesLastThreeUsers = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesLastThreeUsers;
    }
    // On récupère les 3 séries les plus récentes publiées par des éditeurs
    public function getLastThreeSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", COUNT(DISTINCT e.id) AS "numberEpisodes", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY s.date DESC LIMIT 3');
	    $seriesLastThreePublishers = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesLastThreePublishers;
    }
    // On récupère le top 10 des séries amateurs publiées avec le plus d'abonnés
    public function topTenSeriesUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", COUNT(DISTINCT sub.id_member) AS "numberSubscribers" FROM series s INNER JOIN members m ON m.id = s.id_author INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE m.type = "user" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 10');
	    $seriesTopTenUsers = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesTopTenUsers;
    }
    // On récupère le top 10 des séries éditeurs publiées avec le plus d'abonnés
    public function topTenSeriesPublishers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT s.id AS "id", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", COUNT(DISTINCT sub.id_member) AS "numberSubscribers" FROM series s INNER JOIN members m ON m.id = s.id_author INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id WHERE m.type = "publisher" AND s.publishing_status = "published" GROUP BY s.id ORDER BY numberSubscribers DESC LIMIT 10');
	    $seriesTopTenPublishers = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesTopTenPublishers;
    }
    // On récupère 3 séries amateurs publiées qui possèdent des tags définis (recommandation)
    public function getCommonTagsSeriesUsers($tags)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", m.pseudo AS "author", ia.url AS "avatar", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN avatars a ON a.id = m.id_avatar INNER JOIN images ia ON ia.id = a.id_avatar INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "user" AND s.publishing_status = "published" AND t.name = ? GROUP BY s.id LIMIT 3');
        $req->execute(array($tags));
        $seriesUserCommonTags = $req->fetch(\PDO::FETCH_COLUMN);
	    $req->closeCursor();
	    return $seriesUserCommonTags;
    }
    // On récupère 3 séries éditeurs publiées qui possèdent des tags définis (recommandation)
    public function getCommonTagsSeriesPublishers($tags)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT s.id AS "id", ic.url AS "cover", s.title AS "title", l.name AS "publisher", s.publisher_author AS "author", il.url AS "logo", s.pricing_status AS "pricing", s.publishing_status AS "publishing", s.authors_right AS "rights", COUNT(DISTINCT e.id) AS "numberEpisodes", COUNT(DISTINCT sub.id_member) AS "numberSubscribers", GROUP_CONCAT(DISTINCT t.name SEPARATOR ", ") AS "tags" FROM series s INNER JOIN covers c ON c.id = s.id_cover INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN members m ON m.id = s.id_author INNER JOIN logos l ON l.id = m.id_logo INNER JOIN images il ON il.id = l.id_logo INNER JOIN episodes e ON e.id_series = s.id INNER JOIN series_has_members_subscription sub ON sub.id_series = s.id INNER JOIN series_has_tags h ON h.series_id = s.id INNER JOIN tags t ON t.id = h.tag_id WHERE m.type = "publisher" AND s.publishing_status = "published" AND t.name = ? GROUP BY s.id LIMIT 3');
        $req->execute(array($tags));
        $seriesPublisherCommonTags = $req->fetch(\PDO::FETCH_COLUMN);
        $req->closeCursor();
        return $seriesPublisherCommonTags;
	}
	// On récupère la couverture d'une série
	public function getSeriesCover($id)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ic.url FROM covers c INNER JOIN images ic ON ic.id = c.id_cover INNER JOIN series s ON s.id_cover = c.id WHERE s.id = ?');
        $req->execute(array($id));
        $seriesCover = $req->fetch(\PDO::FETCH_COLUMN);
        $req->closeCursor();
        return $seriesCover;		
	}
}