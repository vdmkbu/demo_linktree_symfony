<?php


namespace App\Form\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\UniqueUser;
use App\Validator\UniqueEmail;

class UserRegistration
{

    /**
     * @Assert\NotBlank(message="Empty email")
     * @Assert\Email()
     * @UniqueEmail()
     */
    public string $email;

    /**
     * @Assert\NotBlank(message="Empty username")
     * @UniqueUser()
     */
    public string $username;

    /**
     * @Assert\NotBlank(message="Empty password")
     * @Assert\Length(min=5, minMessage="Password is too short")
     */
    public string $plainPassword;
}