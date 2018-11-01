<?php

namespace Controllers;

use managers\ArticleManager;
use Repositories\ArticleRepository;

class Article extends \App\Controller
{
    /** @var ArticleManager */
    private $articleManager;
    /** @var ArticleRepository */
    private $articleRepository;

    public function __construct()
    {
        //todo внедрить через IOC
        $articleManager          = new ArticleManager();
        $this->articleManager    = $articleManager;
        $articleRepository       = new ArticleRepository();
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->findAll();
        return $this->render('Articles', ['articles'=>$articles]);
    }

    public function single($id)
    {
        $article = $this->articleManager->getArticleById($id);
        return $this->render('ArticleSingle', ['article'=>$article]);
    }

    public function create()
    {
        return $this->render('ArticleCreate');
    }

    public function add()
    {
        $articleDto = $this->articleManager->createArticle($_POST);

        return $this->returnJson($articleDto);
    }

    public function remove($id)
    {
        $this->articleManager->removeById($id);

        return $this->returnJson(['status'=>'ok']);
    }
}