<?php

/**
 * Setup
 */

// require autoload file to autoload vendor libraries
require_once __DIR__ . '/../vendor/autoload.php';

// require local classes
use App\Services\EnvService;
use App\Services\ErrorReportingService;
use App\Services\ResponseService;
use App\Controllers\ReviewController;
use App\Controllers\BookController;
use App\Controllers\UserController;

// require vendor libraries
use Steampixel\Route;

// initialize global environment variables
EnvService::Init();

// initialize error reporting (on in local env)
ErrorReportingService::Init();

// set CORS headers
ResponseService::SetCorsHeaders();

/**
 * Main application routes
 */
// top level fail-safe try/catch
try {

    // get all books
    Route::add('/books', function () {
        $bookController = new BookController();
        $bookController->getAllBooks();
    });

    // get a specific book and its reviews
    Route::add('/books/([a-z-0-9-]*)', function ($id) {
        $bookController = new BookController();
        $reviewController = new ReviewController();

        sleep(2); 
        
        $book = $bookController->getBookById($id);
        if ($book) {
            $reviews = $reviewController->getAllReviewsByBookId($id);
    
            $response = [
                'book' => $book,
                'reviews' => $reviews
            ];

            ResponseService::Send($response);
        } else {
            ResponseService::Error("Book not found.", 404);
        }
    });
    
    // delete a book
    Route::add('/books/([0-9]*)', function ($id) {
        $bookController = new BookController();
        $bookController->deleteBook($id);
    }, 'delete');

    // create a new book
    Route::add('/books', function () {
    $bookController = new BookController();
    $bookController->createBook($_POST);
    }, ["post"]);

    // create a review for a book
    Route::add('/reviews', function () {
        $reviewController = new ReviewController();
        $reviewController->createReview($_POST);
    }, ["post"]);

    // get all genres
    Route::add('/genres', function () {
        $bookController = new BookController();
        $bookController->getAllGenres();
    }, ["get"]);
    
    // user sign up 
    Route::add('/users/signup', function () {
    $userController = new UserController();
    $userController->create($_POST);
    }, ["post"]);

    // user login and JWT generation
    Route::add('/users/login', function () {
    $userController = new UserController();
    $userController->authenticate($_POST);
    }, ["post"]);

    Route::add('/users/me', function () {
    $userController = new UserController();
    $userController->me();
    }, ["get"]);

    Route::add('/users/is-me/([0-9]*)', function ($id) {
    $userController = new UserController();
    $userController->isMe($id);
    }, ['get']);

    Route::add('/users/is-admin', function () {
        $userController = new UserController();
        $userController->checkIfAdmin();
        }, ['get']);


    /*
 * Update Book
 * Used POST instead of PUT.
 * Because the updatebook  form is multipart/form-data, and file uploads were causing issues with PUT.
 */

    Route::add('/books/([0-9]*)', function ($id) {
        $bookController = new BookController();
        $bookController->updateBook($id);
    }, 'post');

    /**
     * 404 route handler
     */
    Route::pathNotFound(function () {
        ResponseService::Error("route is not defined", 404);
    });
} catch (\Throwable $error) {
    if ($_ENV["environment" == "LOCAL"]) {
        var_dump($error);
    } else {
        error_log($error);
    }
    ResponseService::Error("A server error occurred");
}


Route::run();
