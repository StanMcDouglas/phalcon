<?php

class SessionController extends \Phalcon\Mvc\Controller
{

    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->getId(),
            'name' => $user->getEmail()
        ));
    }

    public function indexAction() {

    }

    public function startAction()
    {
        if ($this->request->isPost()) {

            //Receiving the variables sent by POST
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');

            $password = sha1($password);

            //Find the user in the database
            $user = User::findFirst(array(
                "email = :email: AND password = :password: AND active = 'Y'",
                "bind" => array('email' => $email, 'password' => $password)
            ));
            if ($user != false) {

                $this->_registerSession($user);

                $this->flash->success('Welcome ' . $user->getEmail());

                //Forward to the 'invoices' controller if the user is valid
                return $this->dispatcher->forward(array(
                    'controller' => 'story',
                    'action' => 'index'
                ));
            }

            $this->flash->error('Wrong email/password');
        }

        //Forward to the login form again
        return $this->dispatcher->forward(array(
            'controller' => 'session',
            'action' => 'index'
        ));

    }

}

