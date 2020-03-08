<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ItemController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        return new Response('<html><body>HALLO</body></html>');
    }
}
