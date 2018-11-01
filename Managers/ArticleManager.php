<?php

namespace managers;

use Dto\Article;
use Exceptions\InvalidRouteException;
use Factories\ArticleFactory;
use Repositories\ArticleRepository;

class ArticleManager
{
    /** @var ArticleRepository */
    private $articleRepository;
    /** @var ArticleFactory  */
    private $articleFactory;

    public function __construct()
    {
        //todo внедрить через IOC
        $articleRepository = new ArticleRepository();
        $this->articleRepository = $articleRepository;

        $articleFactory = new ArticleFactory();
        $this->articleFactory = $articleFactory;
    }

    public function createArticle($post)
    {
        $articleDto = $this->articleFactory->createNewFromArray($post);
        $this->articleRepository->save($articleDto);
        return $articleDto;
    }

    public function getArticleById($id)
    {
        $article = $this->articleRepository->findOneById($id);
        if(!$article){
            //todo сделать Exception что не найден article id
            throw new InvalidRouteException();
        }

        return $article;
    }

    public function removeById($id)
    {
        $article = $this->getArticleById($id);

        $article->status = Article::STATUS_DELETED;
        $this->articleRepository->save($article);

        return $article;
    }
}