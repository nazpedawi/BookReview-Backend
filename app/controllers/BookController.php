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

    function getBookById($id)
    {
        return $this->bookModel->getBookById($id);
    }

    function deleteBook($id)
    {
        $this->bookModel->deleteBook($id);
        ResponseService::Send([], 204);
    }

    function createBook()
    {
        $data = $this->decodePostData();

        $this->validateInput(["title", "description", "author", "publication_year", "genres", "cover_image"], $data);

        if (empty($data["genres"]) || count($data["genres"]) < 1) {
            ResponseService::Send("At least one genre is required.", 400);
            return;
        }

        $newBook = $this->bookModel->createBook($data);

        ResponseService::Send($newBook);
    }

    function updateBook($id)
    {
        $data = $this->decodePostData();

        $this->validateInput(["title", "description", "author", "publication_year", "genres", "cover_image"], $data);

        if (empty($data["genres"]) || count($data["genres"]) < 1) {
            ResponseService::Send("At least one genre is required.", 400);
            return;
        }

        $updatedBook = $this->bookModel->updateBook($id, $data);

        ResponseService::Send($updatedBook);
    }
    
}
