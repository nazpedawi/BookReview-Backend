<?php

namespace App\Models;


class ArticleModel extends Model
{
    static $resultLimit = 10;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($page = 1)
    {
        $offset = ($page - 1) * self::$resultLimit; // Calculate offset

        // Prepare and execute the paginated query
        $query = self::$pdo->prepare('SELECT * FROM articles ORDER BY posted_at DESC LIMIT :limit OFFSET :offset');
        $query->bindParam(':limit', self::$resultLimit, \PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $query->execute();

        // Fetch results
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $statement = self::$pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $statement->execute(["id" => $id]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($article)
    {
        $query = "insert into articles (title, content, author, posted_at) VALUES (:title, :content, :author, :posted_at)";
        $statement = self::$pdo->prepare($query);
        $statement->execute([...$article, "posted_at" => date('Y-m-d H:i:s')]);

        $newArticleId = self::$pdo->lastInsertId();
        return $this->get($newArticleId);
    }
}
