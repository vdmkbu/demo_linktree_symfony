<?php

namespace App\Controller;

use App\Entity\Link;
use App\Entity\Visit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitsController extends AbstractController
{
    /**
     * @Route("/visits/{link}", name="visits", methods="POST")
     */
    public function store(Link $link, Request $request, EntityManagerInterface $entityManager)
    {

        $visit = new Visit();
        $visit->setUserAgent($request->headers->get('User-Agent'));
        $visit->setLink($link);
        $visit->setCreatedAt(new \DateTime());

        $entityManager->persist($visit);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'visit saved'
            ],
            200,
            []
        );

    }
}
