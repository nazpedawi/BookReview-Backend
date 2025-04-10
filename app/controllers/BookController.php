<?php

namespace App\Controllers;

use App\Services\ResponseService;
use App\Models\BookModel;

class BookController extends Controller
{
    private $bookModel;

    function __construct()
    {
        $this->bookModel = new BookModel();
    }

    function getAllBooks()
    {
        ResponseService::Send($this->bookModel->getAllBooks());
    }

    public function getFilteredBooks($searchQuery, $genre)
    {
        ResponseService::Send($this->bookModel->getFilteredBooks($searchQuery, $genre));
    }

    function getAllGenres()
    {
        ResponseService::Send($this->bookModel->getAllGenres());
    }

    function getBookById($id)
    {
        return $this->bookModel->getBookById($id);
    }

    function deleteBook($id)
    {
        $this->bookModel->deleteBook($id);
        ResponseService::Send('Book deleted succesfully', 204);
    }

    function createBook()
    {
        $data = $this->decodePostData();

        // Handle file upload only if it exists
         if (!empty($_FILES['cover_image'])) {
            $data['cover_image'] = $this->handleFileUpload($_FILES['cover_image']);
            }

        // Ensure genres is an array
        if (isset($data['genres']) && is_string($data['genres'])) {
            $data['genres'] = json_decode($data['genres'], true);
             }

        // Validate input
         $this->validateInput(["title", "description", "author", "publication_year", "genres"], $data);

        if (empty($data["genres"]) || !is_array($data["genres"]) || count($data["genres"]) < 1) {
            ResponseService::Send("At least one genre is required.", 400);
            return;
            }

        $newBook = $this->bookModel->createBook($data);

        ResponseService::Send($newBook);
    }


    private function handleFileUpload($file)
    {
        // Check if the file was uploaded without errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
         ResponseService::Error("Error uploading the cover image.", 400);
            return false;
        }

        // Set the upload directory and file path
        $uploadDir = "images/";
        $uploadFile = $uploadDir . basename($file['name']);

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        if (!in_array($file['type'], $allowedTypes)) {
            ResponseService::Error("Invalid file type. Only JPG, JPEG, PNG, and WEBP files are allowed.", 400);
            return false;
        }

        // Move the uploaded file to the server directory
        if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
            ResponseService::Error("Failed to move the uploaded file.", 500);
            return false; 
        }

        // Return the path of the uploaded file
        return  basename($file['name']);
    }

    function updateBook($id)
    {
         $data = $this->decodePostData();

        // Handle file upload only if it exists
        if (!empty($_FILES['cover_image'])) {
            $data['cover_image'] = $this->handleFileUpload($_FILES['cover_image']);
        }

        // Ensure genres is an array
        if (isset($data['genres']) && is_string($data['genres'])) {
         $data['genres'] = json_decode($data['genres'], true);
         }

        // Validate input
         $this->validateInput(["title", "description", "author", "publication_year", "genres"], $data);

         if (empty($data["genres"]) || !is_array($data["genres"]) || count($data["genres"]) < 1) {
         ResponseService::Send("At least one genre is required.", 400);
            return;
        }

        $updatedBook = $this->bookModel->updateBook($id,$data);

        ResponseService::Send($updatedBook);
    }
}
