<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\LoginType;
use App\Form\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    /**
     * @Route("/register")
     */
    public function registerAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Speicherung eines Users
        }

        return $this->render(
            'login/register.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Anmelden eines Users
        }

        return $this->render(
            'login/login.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
