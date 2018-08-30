<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.08.2018
 * Time: 19:03
 */
class View {
    private $content;

    public function __set($name, $value) {
        $this->{$name} = $value;
    }

    function generate($templateView, $mainView) {
        if (!$mainView) {
            echo 'Установите вид!'; die;
        }

        $this->content = $this->getRenderHTML('views/' . $mainView);

        include 'views/layouts/' . $templateView;

    }
    public function getRenderHTML($path) {
        ob_start();
        include ($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

}

?>