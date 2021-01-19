<?php


namespace App\Controller\API\V1;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/v1/account", name="api_account")
     */
    public function account()
    {
        $user = $this->getUser();

        $json = $this->serializer->serialize($user, 'json', ['groups' => ['main']]);
        return $this->json($json, 200);
    }
}