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
        $query = self::$pdo->prepare(
            'SELECT b.book_id, b.title, b.description, b.author, b.publication_year, b.cover_image, 
                    GROUP_CONCAT(g.name) AS genres 
             FROM Books b
             LEFT JOIN book_genres bg ON b.book_id = bg.book_id
             LEFT JOIN Genres g ON bg.genre_id = g.genre_id
             GROUP BY b.book_id
             ORDER BY b.title ASC'
        );
    
        $query->execute();
    
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBookById(int $id)
    {
        $query = "SELECT b.book_id, b.title, b.description, b.author, b.publication_year, b.cover_image, 
                     GROUP_CONCAT(g.name) AS genres
              FROM Books b
              LEFT JOIN book_genres bg ON b.book_id = bg.book_id
              LEFT JOIN Genres g ON bg.genre_id = g.genre_id
              WHERE b.book_id = :id
              GROUP BY b.book_id";

        $statement = self::$pdo->prepare($query);
        $statement->execute(["id" => $id]);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

    if ($result) {
        $result['genres'] = explode(',', $result['genres']);  // Ensure this is an array
    }

        return $result;  // Return the book with genres as an array
    }


    public function deleteBook(int $id) 
    {
        $query = "DELETE FROM Books WHERE book_id = :book_id";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(["book_id" => $id]);
    }

    public function createBook($book)
    {
         if (empty($book["title"]) || empty($book["description"]) || empty($book["author"]) || empty($book["publication_year"]) || empty($book["genres"]) || count($book["genres"]) < 1) {
         throw new Exception("All fields are required, and at least one genre must be provided.");
    }

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

    // Optionally, update the genres if provided
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

    // Re-insert the new genres for the book using the insertBookGenres method
    foreach ($genres as $genreId) {
        $this->insertBookGenres($bookId, $genreId);
    }

    return true;
    }

       
}