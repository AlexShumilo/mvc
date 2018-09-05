<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 05.09.2018
 * Time: 19:06
 */

class Model_Categories extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories() {
        $sql = $this->connection->prepare("SELECT * FROM category");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}