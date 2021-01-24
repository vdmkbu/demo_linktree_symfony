<?php


namespace App\Controller\API\V1;


use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends AbstractController
{
    private SerializerInterface $serializer;
    private LinkRepository $linkRepository;

    public function __construct(SerializerInterface $serializer, LinkRepository $linkRepository)
    {
        $this->serializer = $serializer;
        $this->linkRepository = $linkRepository;
    }

    /**
     * @Route("/api/v1/links", name="api_links")
     */
    public function links()
    {
        $links = $this->linkRepository->findBy(['owner' => $this->getUser()]);
        $json = $this->serializer->serialize($links, 'json',
            [
                'group' => ['main'],
                'ignored_attributes' => ['owner', 'visits'],
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ]);

        return new JsonResponse($json, 200, [], true);

    }
}