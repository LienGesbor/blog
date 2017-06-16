<?php

// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    
//    Password must contain at least eight characters. One uppercase letter, one lowercase, and a number.
//    No special characters.    
    /**
     * @Assert\NotBlank()
     * 
     * @Assert\Length(
     *  min=8,
     *  minMessage = "Your password must be at least {{ limit }} characters long",
     * )
     * 
     * @Assert\Regex(
     *  pattern="/[a-z]+/",
     *  message="Your password must contain a lowercase letter."
     * )
     * @Assert\Regex(
     *  pattern="/[A-Z]+/",
     *  message="Your password must contain an uppercase letter."
     * )
     * @Assert\Regex(
     *  pattern="/[0-9]+/",
     *  message="Your password must contain a number."
     * )
     * @Assert\Regex(
     *  pattern="/\W+/",
     *  message="Your password must contain a special character."
     * )
     * 
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     *@ORM\Column(type="string", length=50)
     * 
     */
    private $role = 'ROLE_USER';


    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        
        return array('ROLE_USER');
        
    }

    // other methods, including security methods like getRoles()
}