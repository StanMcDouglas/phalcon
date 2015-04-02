<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

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
            $query = Criteria::fromInput($this->di, "Story", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $story = Story::find($parameters);
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

            $this->view->id = $story->getId();

            $this->tag->setDefault("id", $story->getId());
            $this->tag->setDefault("title", $story->getTitle());
            $this->tag->setDefault("text", $story->getText());
            $this->tag->setDefault("date", $story->getDate());
            $this->tag->setDefault("author", $story->getAuthor());
            
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
