<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/{username}", name="user")
     */
    public function index(string $username): Response
    {
        $user = $this->userRepository->findOneBy([
            'username' => $username
        ]);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }


        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
