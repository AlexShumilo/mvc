<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.08.2018
 * Time: 13:00
 */
include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/components/View.php';

class NewsController extends Controller {

    private $newsModel;

    function __construct()
    {
        parent::__construct();
    }

    public function actionIndex($category = NULL) {
        try {
            //$result = $this->newsModel->getNewslist;

            //$this->view->news = $result;
            $this->view->some_data = 'Hello world!';
            $this->view->time = time();
            //$this->view->count = count($result);

            $this->view->generate('template_view.php', 'news/index.php');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }

}
?>