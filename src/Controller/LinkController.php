<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkFormType;
use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 *
 */
class LinkController extends AbstractController
{
    private LinkRepository $linkRepository;
    private EntityManagerInterface $em;

    public function __construct(LinkRepository $linkRepository, EntityManagerInterface $em)
    {
        $this->linkRepository = $linkRepository;
        $this->em = $em;
    }

    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        return $this->render('link/index.html.twig', [
            'links' => $this->linkRepository->findBy(['owner' => $this->getUser()], ['name' => 'ASC'])
        ]);
    }

    /**
     * @Route("/dashboard/links/new", name="app_link_new")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(LinkFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $link = $form->getData();
            $link->setOwner($this->getUser());

            $this->em->persist($link);
            $this->em->flush();

            $this->addFlash('success', 'Link added!');
            return new RedirectResponse($this->generateUrl('app_dashboard'));


        }

        return $this->render('link/new.html.twig', [
            'linkForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard/links/{link}/edit", name="app_link_edit")
     * @IsGranted("MANAGE", subject="link")
     */
    public function edit(Link $link, Request $request)
    {
        $form = $this->createForm(LinkFormType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($link);
            $this->em->flush();

            $this->addFlash('success', 'Link updated!');
            return new RedirectResponse($this->generateUrl('app_dashboard'));
        }

        return $this->render('link/edit.html.twig', [
            'linkForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard/links/{link}/delete", name="app_link_delete")
     * @IsGranted("MANAGE", subject="link")
     */
    public function delete(Link $link)
    {
        $this->em->remove($link);
        $this->em->flush();

        $this->addFlash('success', 'Link deleted!');
        return new RedirectResponse($this->generateUrl('app_dashboard'));
    }
}
