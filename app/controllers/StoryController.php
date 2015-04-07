<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Forms\Form,
    Phalcon\Forms\Element;

class StoryController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for story
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $this->persistent->parameters = array('search' => $this->request->getPost('search'));
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

        $story = Story::query()
        ->where('title LIKE :search: OR text LIKE :search:')
        ->bind(array('search' => '%'.$parameters['search'].'%'))->execute();
        if (count($story) == 0) {
            $this->flash->notice("The search did not find any story");

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "index"
            ));
        }
        $paginator = new Paginator(array(
            "data" => $story,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        // get user
        $userData = $this->session->get('auth');
        $user = User::findFirst($userData['id']);
        $story = new Story();
        $form = new AppForm\StoryForm($story, array('mode' => 'create', 'user' => $user));


        $this->view->setVar("form",$form);
    }

    /**
     * Edits a story
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $story = Story::findFirstByid($id);
            if (!$story) {
                $this->flash->error("story was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "story",
                    "action" => "index"
                ));
            }

            // get user
            $userData = $this->session->get('auth');
            $user = User::findFirst($userData['id']);
            $form = new AppForm\StoryForm($story, array('mode' => 'edit', 'user' => $user));

            $this->view->setVar('story', $story);
            $this->view->setVar("form",$form);
            
        }
    }

    /**
     * Creates a new story
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "index"
            ));
        }

        $story = new Story();

        $story->setTitle($this->request->getPost("title"));
        $story->setText($this->request->getPost("text"));
        $story->setDate($this->request->getPost("date"));
        $story->setAuthor($this->request->getPost("author"));
        

        if (!$story->save()) {
            foreach ($story->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "new"
            ));
        }

        $this->flash->success("story was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "story",
            "action" => "index"
        ));

    }

    /**
     * Saves a story edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $story = Story::findFirstByid($id);
        if (!$story) {
            $this->flash->error("story does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "index"
            ));
        }

        $story->setTitle($this->request->getPost("title"));
        $story->setText($this->request->getPost("text"));
        $story->setDate($this->request->getPost("date"));
        $story->setAuthor($this->request->getPost("author"));
        

        if (!$story->save()) {

            foreach ($story->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "edit",
                "params" => array($story->id)
            ));
        }

        $this->flash->success("story was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "story",
            "action" => "index"
        ));

    }

    /**
     * Deletes a story
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $story = Story::findFirstByid($id);
        if (!$story) {
            $this->flash->error("story was not found");

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "index"
            ));
        }

        if (!$story->delete()) {

            foreach ($story->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "story",
                "action" => "search"
            ));
        }

        $this->flash->success("story was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "story",
            "action" => "index"
        ));
    }

}
