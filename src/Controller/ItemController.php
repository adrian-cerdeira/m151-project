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
    // TODO: Refactor
    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $items = new Items();
        $form = $this->createForm(ItemType::class, $items);
        $items = $items->getAll();

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
        // $item = $this->connection()->query("SELECT * FROM ac_items WHERE Id = '$id'");
        // $form = $this->createForm(EditItemType::class);
        // $form->get('amount')->setData($item->id);
        // $form->get('name')->setData($item->getName());

        // $form->handleRequest($request);
        // $isFormSubmitted = $form->isSubmitted() && $form->get('submit')->isClicked() && $form->isValid();
        // $isCanceled = $form->isSubmitted() && $form->get('cancel')->isClicked();

        // if ($isFormSubmitted) {
        //     $this->saveItemChanges($form->getData(), $item);
        //     return $this->redirect("/");
        // } else if ($isCanceled) {
        //     return $this->redirect("/");
        // }

        // return $this->render('items/edit.html.twig', [
        //     'form' => $form->createView()
        // ]);
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
        $item->create($item);
    }

    private function saveItemChanges($form, $item)
    {
        $item->setName($form['name']);
        $item->setAmount($form['amount']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
    }
}
