<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.09.2018
 * Time: 11:41
 */
class Model_Gallery extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function getFooterGalleryImgs() {
        $sql = $this->connection->prepare("SELECT * FROM footer_gallery");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>