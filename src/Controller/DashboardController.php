<?php

namespace App\Controller;

use App\Entity\ApiToken;
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
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/dashboard/settings", name="app_dashboard_settings")
     */
    public function settings(Request $request): Response
    {
        $user = $this->getUser();
        $userProfile = $user->getUserProfile();
        $form = $this->createForm(ProfileSettingsFormType::class, $userProfile);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $userProfile = $userProfile ? $userProfile : $form->getData();

            $userProfile->setOwner($user);

            $this->em->persist($userProfile);
            $this->em->flush();

            return new RedirectResponse($this->generateUrl("app_dashboard_settings"));
        }

        return $this->render('dashboard/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/dashboard/settings/token/generate", name="app_generate_token")
     */
    public function generateToken()
    {
        $token = new ApiToken($this->getUser());

        $this->em->persist($token);
        $this->em->flush();

        return new RedirectResponse($this->generateUrl('app_dashboard_settings'));
    }
}
