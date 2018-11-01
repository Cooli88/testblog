<?php

namespace Repositories;


use Dto\Article;

class ArticleRepository
{
    const TABLE_NAME = 'articles';

    /**
     * @param Article $article
     */
    public function save(Article $article)
    {
        $article->updated_at = date('Y-m-d h:i:s');
        if(!$article->id){
            $this->insert($article);
        }else{
            $this->update($article);
        }
    }

    /**
     * @param Article $article
     */
    private function insert(Article $article)
    {
        $tableName = static::TABLE_NAME;
        $sql = "INSERT INTO $tableName (title, image_uri, text, status, created_at, updated_at) values (:title, :image_uri, :text, :status, :created_at, :updated_at)";

        $articleArray = (array)$article;
        unset($articleArray['id']);

        $article->id = (int)(\App::$db->executeSave($sql, $articleArray));
    }

    /**
     * @param Article $article
     */
    private function update(Article $article)
    {
        $tableName = static::TABLE_NAME;
        $sql = "UPDATE $tableName SET title = :title, image_uri = :image_uri, text = :text, status = :status, created_at = :created_at, updated_at = :updated_at WHERE id = :id";
        \App::$db->executeSave($sql, (array)$article);
    }

    /**
     * @param int $id
     *
     * @return Article|null
     */
    public function findOneById($id)
    {
        $tableName = static::TABLE_NAME;

        $articles = \App::$db->execute("SELECT * from $tableName WHERE id =:id AND status =:status ", ['id'=>$id, 'status'=>Article::STATUS_ACTIVE,], Article::class);
        return isset($articles[0]) ? $articles[0] : null;
    }

    /**
     * @return array|Article[]
     */
    public function findAll()
    {
        $tableName = static::TABLE_NAME;
        return \App::$db->execute("SELECT * from $tableName WHERE status =:status ;", ['status'=>Article::STATUS_ACTIVE,], Article::class);
    }
}