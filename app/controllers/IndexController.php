<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $user = User::findFirst(1);

        $stories = $user->getStories();
        $story =  $stories[0]->getText();

    }

}

