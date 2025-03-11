<?php

namespace App\Controllers;

use App\Services\ResponseService;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    private $reviewModel;

    function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    function getAllReviewsByBookId($bookId)
    {
        $reviews = $this->reviewModel->getAllReviewsByBookId($bookId);
        
        if (empty($reviews)) {
            return [];
        } else {
            return $reviews;
        }
    }

    public function createReview()
{
    $data = $this->decodePostData();

    $this->validateInput(["review_text", "rating"], $data);

    // Check if rating is valid (between 1 and 5)
    if ($data["rating"] < 1 || $data["rating"] > 5) {
        ResponseService::Send("Rating must be between 1 and 5.", 400);
        return;
    }

    // Pass the data to the model to insert the review
    $newReview = $this->reviewModel->createReview($data);

    // Return the newly created review data as a response
    ResponseService::Send($newReview);
}

   
}
