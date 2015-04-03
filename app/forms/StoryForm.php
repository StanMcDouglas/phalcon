<?php


/**
 * StoryForm
 * Formulaire pour créer des stories
 */
namespace AppForm;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element;


class StoryForm extends Form {


    public function initialize($story, $options) {
        if ($options['mode'] == 'edit') {
            $this->add(new Element\Hidden('id'));
        }
        $this->add(new Element\Text('title'));
        $this->add(new Element\Textarea('text'));
        $this->add(new Element\Date('date', array('class' => 'datepicker')));
        $this->add(new Element\Hidden('author',array('value' => $options['user']->getId()) ));
    }
}
