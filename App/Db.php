<?php

namespace App;

use App;

class Db
{

    /** @var \PDO */
    public $pdo;

    public function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
    }

    protected function getPDOSettings()
    {

        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    public function execute($query, array $params = null, $fetchClass = null)
    {
        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            $this->setFetchClass($stmt, $fetchClass);
            return $stmt->fetchAll();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        $this->setFetchClass($stmt, $fetchClass);
        return $stmt->fetchAll();

    }

    private function setFetchClass($stmt, $fetchClass)
    {
        if($fetchClass){
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $fetchClass);
        }
    }

    public function executeSave($query, array $params=null)
    {
        //todo если не удался саве выбросить ошибку
        if(is_null($params)){
            $this->pdo->query($query);
            return $this->pdo->lastInsertId();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $this->pdo->lastInsertId();
    }
}