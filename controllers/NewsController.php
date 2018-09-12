<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.08.2018
 * Time: 13:00
 */
include_once ROOT . '/models/Model_News.php';
include_once ROOT . '/models/Model_Categories.php';
include_once ROOT . '/controllers/Controller.php';

class NewsController extends Controller {

    private $newsModel;
    private $categoriesModel;

    function __construct() {
        parent::__construct();                                          // вызываем констракт-метод родителя, в котором создаётся объект View
        $this->newsModel = new Model_News();                            // создаём объект модели новостей для взаимодействия с базой
        $this->categoriesModel = new Model_Categories();
    }

    public function actionIndex($category = NULL) {                     // экшн для отображения всех новостей или по категориям
        try {
            if ($category == NULL) {
                $result = $this->newsModel->getNewslist();              // если категория не задана, то получаем все новости
            } else {
                $result = $this->newsModel->getCategoryNews($category); // если есть категория, то получаем новости по категории
            }

            $this->view->news = $result;
            $this->view->lastNews = $this->newsModel->getLastNews();                // получаем последние новости для правого сайдбара
            $this->view->categories = $this->categoriesModel->getCategories();

            $this->view->generate('template_view.phtml', 'news/index.phtml'); // формируем вьюшку
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionDetail($newsCode) {                            // экшн для отображения детальной новости
        try {
            $this->view->detailNews = $this->newsModel->getNewsByCode($newsCode); // получаем строку новости по пришедшему в параметр newsId
            $this->view->lastNews = $this->newsModel->getLastNews();          // получаем последние новости для правого сайдбара
            $this->view->categories = $this->categoriesModel->getCategories();// получаем категории для блока категорий

            $this->newsModel->setNewsViews($newsCode);                   // прибавляем единицу к полю счётчика просмотров новости

            $this->view->newsComments = $this->newsModel->getNewsComments($newsCode);

            $this->view->generate('template_view.phtml', 'news/detail.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionSearch() {
        try {
            function clean($value = "") {                               // очистка пришедших данных от ненужных символов
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);

                return $value;
            }

            if (isset($_POST['submit']) && isset($_POST['search'])) {
                $_POST['search'] = clean($_POST['search']);               // если форма пришла, то получаем её безопасные данные

                $result = $this->newsModel->getSearchNews($_POST['search']);
            } else {
                return $result = false;                                 // если форма не пришла или не со всеми данными, то ставим флаг false
            }

            $this->view->news = $result;

            $this->view->lastNews = $this->newsModel->getLastNews();    // получаем последние новости для правого сайдбара
            $this->view->categories = $this->categoriesModel->getCategories();

            $this->view->generate('template_view.phtml', 'news/index.phtml'); // формируем вьюшку

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
?>