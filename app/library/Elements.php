<?php

use Phalcon\Mvc\User\Component;

class Elements extends Component
{


    public function getMenu()
        {
        return $this->view->partial('elements/menu');

    }

    public function getTabs()
    {

    }

    public function getCss() {
        $this->assets->addCss('css/style.css')->addCss('css/vendor/jquery-ui.css');
        return $this->assets->outputCss();
    }

    public function getJS() {
        $this->assets->addJs('js/vendor/jquery.js')
            ->addJs('js/vendor/jquery-ui.js')
            ->addJs('js/main.js');
        return $this->assets->outputJs();
    }

}