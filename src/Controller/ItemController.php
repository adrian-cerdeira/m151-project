<?php

namespace App\Controller;

use App\Entity\Items;
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
        $items = $this->getDoctrine()->getRepository(Items::class)->findAll();
        return $this->render('items/index.html.twig', array('items' => $items));
    }
}
