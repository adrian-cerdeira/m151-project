<?php

namespace App\Controller;

use App\Entity\Items;
use App\Form\ItemType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ItemController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $items = $this->getDoctrine()->getRepository(Items::class)->findAll();
        $form = $this->createForm(ItemType::class, $items);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->addAction($form->getData());
            return $this->redirect("/");
        }

        return $this->render(
            'items/index.html.twig',
            array(
                'items' => $items,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/remove/{id}")
     */
    public function removeAction(Request $request, $id)
    {
        $removedItem = $this->getDoctrine()->getRepository(Items::class)->find($id);

        if ($removedItem) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($removedItem);
            $entityManager->flush();
        }

        return $this->redirect('/');
    }

    private function addAction($form)
    {
        $item = new Items();
        $item->setName($form['name']);
        $item->setAmount($form['amount']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($item);
        $entityManager->flush();
    }
}
