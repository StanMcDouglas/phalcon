<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $firstname;

    /**
     *
     * @var string
     */
    protected $lastname;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $last_login;

    /**
     *
     * @var string
     */
    protected $first_connexion;

    /**
     *
     * @var string
     */
    protected $last_connexion;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $active;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Method to set the value of field lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field last_login
     *
     * @param string $last_login
     * @return $this
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;

        return $this;
    }

    /**
     * Method to set the value of field first_connexion
     *
     * @param string $first_connexion
     * @return $this
     */
    public function setFirstConnexion($first_connexion)
    {
        $this->first_connexion = $first_connexion;

        return $this;
    }

    /**
     * Method to set the value of field last_connexion
     *
     * @param string $last_connexion
     * @return $this
     */
    public function setLastConnexion($last_connexion)
    {
        $this->last_connexion = $last_connexion;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field active
     *
     * @param string $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Returns the value of field lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field last_login
     *
     * @return string
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Returns the value of field first_connexion
     *
     * @return string
     */
    public function getFirstConnexion()
    {
        return $this->first_connexion;
    }

    /**
     * Returns the value of field last_connexion
     *
     * @return string
     */
    public function getLastConnexion()
    {
        return $this->last_connexion;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }
    public function initialize()
    {
        $this->hasMany('id', 'Story', 'author', array('alias' => 'Stories'));

    }
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'firstname' => 'firstname', 
            'lastname' => 'lastname', 
            'email' => 'email', 
            'last_login' => 'last_login', 
            'first_connexion' => 'first_connexion', 
            'last_connexion' => 'last_connexion', 
            'password' => 'password', 
            'active' => 'active'
        );
    }

    /**
     * @return User[]
     */
    public static function find($parameters = array())
    {
        return parent::find($parameters);
    }

    /**
     * @return User
     */
    public static function findFirst($parameters = array())
    {
        return parent::findFirst($parameters);
    }

    public function __toString() {
        return "$this->firstname $this->lastname";
    }



}
