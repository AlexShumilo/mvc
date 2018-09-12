<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.08.2018
 * Time: 18:50
 */
include_once ROOT . '/models/Model_Gallery.php';
class Controller
{
    protected $view;
    protected $galleryModel;

    function __construct() {
        $this->view = new View();
        $this->galleryModel = new Model_Gallery();
        $this->view->footerGallery = $this->galleryModel->getFooterGalleryImgs();
    }
}
?>