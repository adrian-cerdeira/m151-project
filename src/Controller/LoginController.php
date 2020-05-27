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
            $formData = $form->getData();
            $this->registerUser($formData, $user);

            return $this->redirect('/');
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
            $formData = $form->getData();
            $this->loginUser($formData, $user, $request);

            return $this->redirect('/');
        }

        return $this->render(
            'login/login.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    private function registerUser($form, $user)
    {
        $userName = $form->getUserName();
        $password = $form->getPassword();

        $user->setUserName($userName);
        $user->setPassword($password);

        $user->register();
    }

    private function loginUser($form, $user, $request)
    {
        $userName = $form->getUserName();
        $password = $form->getPassword();

        $user->setUserName($userName);
        $user->setPassword($password);

        $loggedUser = $user->login();
        $loggedUserId = $loggedUser['id'];

        if ($loggedUser && $loggedUserId) {
            $session = $request->getSession();
            $session->set('userId', $loggedUserId);
        }
    }
}
