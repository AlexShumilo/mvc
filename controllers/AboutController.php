<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.09.2018
 * Time: 10:46
 */
include_once ROOT . '/models/Model_About.php';
include_once ROOT . '/controllers/Controller.php';

class AboutController extends Controller {
    private $aboutModel;

    function __construct() {
        parent::__construct();                                            // вызываем констракт-метод родителя, в котором создаётся объект View
        $this->aboutModel = new Model_About();                            // создаём объект модели о компании для взаимодействия с базой
    }

    public function actionIndex() {
        try {
            $this->view->employees = $this->aboutModel->getEmployees();

            $this->view->generate('template_view.phtml', 'about/index.phtml'); // формируем вьюшку
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>