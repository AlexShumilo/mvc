<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 04.09.2018
 * Time: 17:14
 */
include_once ROOT . '/models/Model_Comments.php';
include_once ROOT . '/controllers/Controller.php';

class CommentsController extends Controller {

    public function __construct() {
        parent::__construct();                                          // вызываем констракт-метод родителя, в котором создаётся объект View
        $this->commentsModel = new Model_Comments();                    // создаём объект модели комментариев для взаимодействия с базой
    }

    public function actionIndex() {
        try {
            function clean($value = "") {                               // очистка пришедших данных от ненужных символов
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);

                return $value;
            }
            $result = true;                                             // флаг для пометки результата обработки POST-запроса

            if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['theme']) && $_POST['comment']) {
                $_POST['name'] = clean($_POST['name']);
                $_POST['email'] = clean($_POST['email']);
                $_POST['theme'] = clean($_POST['theme']);
                $_POST['comment'] = clean($_POST['comment']);            // если форма пришла, то записываем безопасные данные в базу
                $newsId = $_POST['news_id'];

                $this->commentsModel->setComment($_POST['name'], $_POST['email'], $_POST['theme'], $_POST['comment'], $newsId);
            } else {
                return $result = false;                                 // если форма не пришла или не со всеми данными, то ставим флаг false
            }
            $this->view->result = $result;
            $this->view->newsId = $_POST['news_id'];                    // устанавливаем переменную для использования в ссылке

            $this->view->generate('template_view.phtml', 'comments/index.phtml'); // формируем вьюшку

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }


}

?>