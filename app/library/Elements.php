<?php

use Phalcon\Mvc\User\Component;

class Elements extends Component
{


    public function getMenu()
    {
            // get security plugin to call the right partial template
        $Listeners = $this->dispatcher->getEventsManager()->getListeners('dispatch');
        $security = array_shift($Listeners);

        return $this->view->partial($security->getPartialTemplate('elements/menu'));

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