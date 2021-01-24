<?php


namespace App\Controller\API\V1;


use App\Entity\Link;
use App\Repository\LinkRepository;
use App\Repository\VisitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends AbstractController
{
    private SerializerInterface $serializer;
    private LinkRepository $linkRepository;
    private VisitRepository $visitRepository;

    public function __construct(SerializerInterface $serializer, LinkRepository $linkRepository, VisitRepository $visitRepository)
    {
        $this->serializer = $serializer;
        $this->linkRepository = $linkRepository;
        $this->visitRepository = $visitRepository;
    }

    /**
     * @Route("/api/v1/links", name="api_links")
     */
    public function links()
    {
        $links = $this->getUser()->getLinks();
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

    /**
     * @Route("/api/v1/links/{link}/visits")
     */
    public function linkVisits(Link $link)
    {

        $json = $this->serializer->serialize($link->getVisits(), 'json', [
           'ignored_attributes' => ['link'],
           'circular_reference_handler' => function ($object) {
                return $object->getId();
           }
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}