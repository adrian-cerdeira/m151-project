<?php

namespace App\Controller;

use App\Entity\Items;
use App\Form\EditItemType;
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
        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route("/edit/{id}")
     */
    public function editAction(Request $request, $id)
    {
        $item = $this->getDoctrine()->getRepository(Items::class)->find($id);
        $form = $this->createForm(EditItemType::class);
        $form->get('amount')->setData($item->getAmount());
        $form->get('name')->setData($item->getName());

        $form->handleRequest($request);
        $isFormSubmitted = $form->isSubmitted() && $form->get('submit')->isClicked() && $form->isValid();
        $isCanceled = $form->isSubmitted() && $form->get('cancel')->isClicked();

        if ($isFormSubmitted) {
            $this->saveItemChanges($form->getData(), $item);
            return $this->redirect("/");
        } else if ($isCanceled) {
            return $this->redirect("/");
        }

        return $this->render('items/edit.html.twig', [
            'form' => $form->createView()
        ]);
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

    private function saveItemChanges($form, $item)
    {
        $item->setName($form['name']);
        $item->setAmount($form['amount']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
    }
}
