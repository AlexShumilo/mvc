<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 30.08.2018
 * Time: 22:30
 */
include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/components/View.php';

class IndexController extends Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function actionIndex() {
        try {

            $this->view->generate('template_view.php', 'layouts/main_view.php');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}
?>