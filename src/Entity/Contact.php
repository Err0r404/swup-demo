<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="35")
     */
    private $name;
    
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="150")
     * @Assert\Email()
     */
    private $email;
    
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="10", max="500")
     */
    private $message;
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param mixed $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}