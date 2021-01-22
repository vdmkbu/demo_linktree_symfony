<?php


namespace App\Form\DTO;

use Symfony\Component\Validator\Constraints as Assert;


class Link
{
    /**
     * @Assert\NotBlank(message="Not empty")
     */
    public string $name;

    /**
     * @Assert\NotBlank(message="Not empty")
     * @Assert\Url()
     */
    public string $url;
}