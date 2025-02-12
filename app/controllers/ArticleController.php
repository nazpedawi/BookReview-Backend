<?php

namespace App\Controllers;

use App\Services\ResponseService;
use App\Models\ArticleModel;

class ArticleController extends Controller
{
    private $articleModel;

    function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    /**
     * Get paginated list of articles
     */
    function getAll()
    {
        $page = (int)($_GET["page"] ?? 1);
        ResponseService::Send($this->articleModel->getAll($page));
    }
    function get($id)
    {
        ResponseService::Send($this->articleModel->get($id));
    }
    function create()
    {
        // get data from $_POST request using base class method
        $data = $this->decodePostData();

        // validate input using base class method
        $this->validateInput(["title", "content", "author"], $data);

        // save to DB
        $newArticle = $this->articleModel->create($data);

        // send the newly created object back to user
        ResponseService::Send($newArticle);
    }
}
