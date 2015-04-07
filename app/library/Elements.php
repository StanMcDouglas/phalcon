<?php

use Phalcon\Mvc\User\Component;

class Elements extends Component
{

    /**
     * function getMenu
     * @return string
     */
    public function getMenu()
    {

        // get Security Plugin to call the right template
        return $this->view->partial($this->getSecurity()->getPartialTemplate('elements/menu'));

    }

    /**
     * Get security manager
     * @return Security
     */
    public function getSecurity() {

        $Listeners = $this->dispatcher->getEventsManager()->getListeners('dispatch');
        return array_shift($Listeners);
    }


    public function getNav() {
        if ($this->getSecurity()->getRole() == 'Users') {
            $userData = $this->session->get('auth');
            $user = User::findFirst($userData['id']);
            $stories = Story::find(array(
                'conditions' => 'author = ?1',
                'bind' => array('1' => $user->getId()),
                'order' => 'date DESC',
                'limit' => 3
            ));
        } else {
            $stories = array();
        }

        // get Security Plugin to call the right template
        return $this->view->partial($this->getSecurity()->getPartialTemplate('elements/nav'), array('stories' => $stories));
    }

    public function getTabs()
    {

    }

    /**
     * function getCss
     * @return string
     */
    public function getCss() {
        $this->assets->addCss('css/style.css')->addCss('css/vendor/jquery-ui.css');
        return $this->assets->outputCss();
    }

    /**
     * function getJs
     * @return string
     */
    public function getJS() {
        $this->assets->addJs('js/vendor/jquery.js')
            ->addJs('js/vendor/jquery-ui.js')
            ->addJs('js/main.js');
        return $this->assets->outputJs();
    }

}