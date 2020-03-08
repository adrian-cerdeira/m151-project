<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemController extends AbstractController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        return $this->render('items/index.html.twig');
    }
}
