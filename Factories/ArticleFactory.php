<?php

namespace Factories;


use Dto\Article;

class ArticleFactory
{
    public function __construct()
    {
    }

    /**
     * @param array $array
     *
     * @return Article
     */
    public function createNewFromArray(array $array)
    {
        $article = Article::loadFromArray($array);
        $article->status = Article::STATUS_ACTIVE;
        $article->id = null;
        $article->created_at = date('Y-m-d h:i:s');
        return $article;
    }
}