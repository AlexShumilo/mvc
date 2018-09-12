<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.09.2018
 * Time: 12:20
 */

class Model_Contact extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function setContact($name, $email, $phone, $message) {
        $sql = $this->connection->prepare("INSERT INTO `contacts`(`cont_name`, `cont_email`, `cont_phone`, `cont_message`) 
                                                    VALUES (:name, :email, :phone, :message)");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':phone', $phone, PDO::PARAM_INT);
        $sql->bindParam(':message', $message, PDO::PARAM_STR);

        $sql->execute();
    }

}
?>