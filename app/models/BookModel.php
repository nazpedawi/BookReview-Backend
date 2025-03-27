<?php

namespace App\Models;

class BookModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAllBooks()
    {
        $query = (
        'SELECT b.book_id, b.title, b.description, b.author, b.publication_year, b.cover_image, 
                GROUP_CONCAT(g.name) AS genres 
         FROM Books b
         LEFT JOIN book_genres bg ON b.book_id = bg.book_id
         LEFT JOIN Genres g ON bg.genre_id = g.genre_id
         GROUP BY b.book_id
         ORDER BY b.title ASC'
        );

        $statement = self::$pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($result as &$book) {
            $book['genres'] = $book['genres'] ? explode(',', $book['genres']) : [];
        }

        return $result;  
    }

    public function getFilteredBooks($searchQuery = '', $genre = '')
    {
         $query = '
        SELECT b.book_id, b.title, b.description, b.author, b.publication_year, b.cover_image, 
           GROUP_CONCAT(g.name) AS genres
        FROM Books b
         LEFT JOIN book_genres bg ON b.book_id = bg.book_id
         LEFT JOIN Genres g ON bg.genre_id = g.genre_id
         ';

        $params = [];
        $filters = [];

        // Filter by search query if provided
        if (!empty($searchQuery)) {
            $filters[] = "b.title LIKE :searchQuery";
            $params[':searchQuery'] = '%' . $searchQuery . '%';
        }

        // Apply any filters
        if (!empty($filters)) {
            $query .= " WHERE " . implode(" AND ", $filters);
        }

        $query .= " GROUP BY b.book_id ORDER BY b.title ASC";

        $stmt = self::$pdo->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Convert the concatenated genres string into an array for each book
        foreach ($result as &$book) {
            $book['genres'] = $book['genres'] ? explode(',', $book['genres']) : [];
        }

        // If a genre filter is provided, filter the books by genre
        if (!empty($genre)) {
            $result = array_filter($result, function($book) use ($genre) {
            // Check if the genre is in the book's genres array
            return in_array($genre, $book['genres']);
            });
        }

        return array_values($result);
    }

    public function getAllGenres()
    {
        $query = "SELECT genre_id, name FROM Genres";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();

        $genres = [];
        while ($row = $stmt->fetch()) {
            $genres[] = [
            'id' => $row['genre_id'],
            'name' => $row['name']
            ];
        }

        return $genres;
    }

    public function getBookById(int $id)
    {
            $query = "SELECT book_id, title, description, author, publication_year, cover_image
                      FROM Books
                      WHERE book_id = :id";
        
            $statement = self::$pdo->prepare($query);
            $statement->execute(["id" => $id]);
            $book = $statement->fetch(\PDO::FETCH_ASSOC);
        
            if (!$book) {
                return null; // Book not found
            }
        
            // Fetch genres for the book
            $query = "SELECT g.genre_id, g.name 
                      FROM Genres g
                      JOIN book_genres bg ON g.genre_id = bg.genre_id
                      WHERE bg.book_id = :id";
        
            $statement = self::$pdo->prepare($query);
            $statement->execute(["id" => $id]);
            $genres = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
            // Attach genres as an array of objects
            $book['genres'] = $genres;
        
            return $book;
        
    }

    public function deleteBook(int $id) 
    {
        $query = "DELETE FROM Books WHERE book_id = :book_id";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(["book_id" => $id]);
    }

    public function createBook($book)
    {
         $data = [
        "title" => $book["title"],
        "description" => $book["description"],
        "author" => $book["author"],
        "publication_year" => $book["publication_year"],
        "cover_image" => $book["cover_image"]
        ];

        $query = "INSERT INTO Books (title, description, author, publication_year, cover_image)
              VALUES (:title, :description, :author, :publication_year, :cover_image)";
         $stmt = self::$pdo->prepare($query);
         $stmt->execute($data);

        $bookId = self::$pdo->lastInsertId();

        foreach ($book["genres"] as $genreId) {
        $this->insertBookGenres($bookId, $genreId);
         }

        return $this->getBookById($bookId);
    }

    public function insertBookGenres($bookId, $genreId)
    {
        $query = "INSERT INTO book_genres (book_id, genre_id) VALUES (:book_id, :genre_id)";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute([':book_id' => $bookId, ':genre_id' => $genreId]);

        return true;
    }

    public function updateBook($id, $book)
    {
        $query = "UPDATE Books
              SET title = :title,
                  description = :description,
                  author = :author,
                  publication_year = :publication_year,
                  cover_image = :cover_image
              WHERE book_id = :id";

        $statement = self::$pdo->prepare($query);
        $statement->execute([
        "id" => $id,
        "title" => $book["title"],
        "description" => $book["description"],
        "author" => $book["author"],
        "publication_year" => $book["publication_year"],
        "cover_image" => $book["cover_image"]
        ]);

        // update the genres if provided
        if (isset($book["genres"])) {
        $this->updateBookGenres($id, $book["genres"]);
        }

        return $this->getBookById($id);
    }

    public function updateBookGenres($bookId, $genres)
    {
        $deleteQuery = "DELETE FROM book_genres WHERE book_id = :book_id";
        $deleteStmt = self::$pdo->prepare($deleteQuery);
        $deleteStmt->execute(["book_id" => $bookId]);

        // Re-insert the new genres for the book
        foreach ($genres as $genreId) {
        $this->insertBookGenres($bookId, $genreId);
        }

        return true;
    }
}