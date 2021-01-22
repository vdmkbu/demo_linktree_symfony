<?php

namespace App\Controller;

use App\Form\ProfileSettingsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard/settings", name="app_dashboard_settings")
     */
    public function settings(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $userProfile = $user->getUserProfile();
        $form = $this->createForm(ProfileSettingsFormType::class, $userProfile);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $userProfile = $userProfile ? $userProfile : $form->getData();

            $userProfile->setOwner($user);

            $entityManager->persist($userProfile);
            $entityManager->flush();

            return new RedirectResponse($this->generateUrl("app_dashboard_settings"));
        }

        return $this->render('dashboard/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
