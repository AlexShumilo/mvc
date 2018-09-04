<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 04.09.2018
 * Time: 17:15
 */

class Model_Comments extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function setComment($userName, $userEmail, $commentTheme, $commentText, $newsId) {
        $sql = $this->connection->prepare("INSERT INTO `comments`(`user_name`, `user_email`, `comment_theme`, 
                                  `comment_text`, `news_id`) VALUES (:name, :email, :theme, :text, :newsid)");
        $sql->bindParam(':name', $userName, PDO::PARAM_STR);
        $sql->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $sql->bindParam(':theme', $commentTheme, PDO::PARAM_STR);
        $sql->bindParam(':text', $commentText, PDO::PARAM_STR);
        $sql->bindParam(':newsid', $newsId, PDO::PARAM_INT);
        $sql->execute();

    }
}


?>