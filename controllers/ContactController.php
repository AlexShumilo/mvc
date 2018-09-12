<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.09.2018
 * Time: 12:18
 */

include_once ROOT . '/models/Model_Contact.php';
include_once ROOT . '/controllers/Controller.php';

class ContactController extends Controller {
    private $contactModel;

    function __construct() {
        parent::__construct();                                            // вызываем констракт-метод родителя, в котором создаётся объект View
        $this->contactModel = new Model_Contact();
    }

    public function actionIndex() {
        try {
            $this->view->generate('template_view.phtml', 'contact/index.phtml'); // формируем вьюшку
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionContact() {
        try {
            function clean($value = "")
            {                               // очистка пришедших данных от ненужных символов
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);

                return $value;
            }

            $result = true;                                             // флаг для пометки результата обработки POST-запроса

            if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && $_POST['message']) {
                $_POST['name'] = clean($_POST['name']);
                $_POST['email'] = clean($_POST['email']);
                $_POST['theme'] = clean($_POST['phone']);
                $_POST['comment'] = clean($_POST['message']);            // если форма пришла, то записываем безопасные данные в базу

                $this->contactModel->setContact($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
            } else {
                return $result = false;                                 // если форма не пришла или не со всеми данными, то ставим флаг false
            }
            $this->view->result = $result;

            $this->view->generate('template_view.phtml', 'contact/contact.phtml'); // формируем вьюшку
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>