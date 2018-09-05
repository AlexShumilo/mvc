<?php

class Model_News extends Db {

    public function __construct() {
        parent::__construct();
    }


    public function getNewsList() {                                           // для получения всех новостей (используем таблицу category для получения названия категории и подставления в ссылку для ЧПУ)
        $result = $this->connection->query("SELECT * FROM news LEFT JOIN category ON news.news_cat_id = category.cat_id ORDER BY news_date DESC LIMIT 10");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastNews($count = 3) {                                 // получение последних новостей
        $sql = $this->connection->prepare("SELECT * FROM news LEFT JOIN category ON news.news_cat_id = category.cat_id ORDER BY news_date LIMIT :count");
        $sql->bindParam(':count', $count, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Функция для получения новостей, у которых news_day в таблице равно 1 (описано в запросе); запрос сливает две таблицы
     * по одинаковому полю айди категории
     * @return array массив объектов-строк таблицы, у которых ключи это названия полей, а значения это
     */
    public function getTopNews() {                                           // получение топ-новостей
        $sql = $this->connection->prepare("SELECT * FROM news LEFT JOIN category ON news.news_cat_id = category.cat_id WHERE news_day = 1 ORDER BY news_date LIMIT 4");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryNews($category) {                             // получение новостей по категории
        $sql = $this->connection->prepare("SELECT * FROM news INNER JOIN category ON news.news_cat_id = category.cat_id WHERE cat_code = :category");
        $sql->bindParam(':category', $category, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($newsId) {                                   // получение отдельной новости по id
        $sql = $this->connection->prepare("SELECT * FROM news WHERE news_id = :newsId");
        $sql->bindParam(':newsId', $newsId, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function setNewsViews($newsId) {                                  // увеличить значение количества просмотров на 1
        $sql = $this->connection->prepare("UPDATE news SET news_views = (news_views + 1) WHERE news_id = :newsId");
        $sql->bindParam(':newsId', $newsId, PDO::PARAM_INT);
        $sql->execute();
    }

    public function getNewsComments($newsId) {
        $sql = $this->connection->prepare("SELECT * FROM comments WHERE comments.news_id = :newsId");
        $sql->bindParam(':newsId', $newsId, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}