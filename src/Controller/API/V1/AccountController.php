<?php


namespace App\Controller\API\V1;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{

    /**
     * @Route("/api/v1/account", name="api_account")
     */
    public function account()
    {
        return $this->json([
            'message' => '123'
        ]);
    }
}