<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.09.2018
 * Time: 10:49
 */
class Model_About extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function getEmployees() {
        $sql = $this->connection->prepare("SELECT * FROM employees");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>