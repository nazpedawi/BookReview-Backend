<?php

namespace App\Models;

class ReviewModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllReviewsByBookId(int $bookId)
    {
        $query = self::$pdo->prepare(
            'SELECT r.review_id, r.book_id, r.user_id, r.rating, r.review_text, r.review_date, 
                    u.firstName, u.lastName
             FROM Reviews r
             LEFT JOIN Users u ON r.user_id = u.user_id
             WHERE r.book_id = :book_id
             ORDER BY r.review_date DESC'
        );

        $query->bindParam(':book_id', $bookId, \PDO::PARAM_INT);
        $query->execute();

        // Fetch all reviews for the given book
        $reviews = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $reviews;
    }

    public function createReview($review)
    {
         $data = [
        ':book_id' => $review["book_id"],
        ':user_id' => $review["user_id"],
        ':review_text' => $review["review_text"],
        ':rating' => $review["rating"]
        ];

        $query = "INSERT INTO Reviews (book_id, user_id, review_text, rating, review_date) 
              VALUES (:book_id, :user_id, :review_text, :rating, NOW())";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute($data);

        return $this->getReviewById(self::$pdo->lastInsertId());
    }

    public function getReviewById(int $reviewId)
    {
        $query = self::$pdo->prepare(
            'SELECT r.review_id, r.book_id, r.user_id, r.rating, r.review_text, r.review_date, 
                    u.firstName, u.lastName
             FROM Reviews r
             LEFT JOIN Users u ON r.user_id = u.user_id
             WHERE r.review_id = :review_id'
        );

        $query->bindParam(':review_id', $reviewId, \PDO::PARAM_INT);
        $query->execute();

        $review = $query->fetch(\PDO::FETCH_ASSOC);

        return $review;
    }
}