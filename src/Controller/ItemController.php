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
        $items = new Items();
        $form = $this->createForm(ItemType::class, $items);
        $items = $items->getAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $this->addAction($formData);

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
        $item = new Items();
        $item = $item->getById($id);

        $form = $this->createForm(EditItemType::class);
        $form->get('name')->setData($item->getName());
        $form->get('amount')->setData($item->getAmount());

        $form->handleRequest($request);
        $isSubmitted = $form->isSubmitted() && $form->get('submit')->isClicked() && $form->isValid();
        $isCanceled = $form->isSubmitted() && $form->get('cancel')->isClicked();

        if ($isSubmitted) {
            $formData = $form->getData();
            $this->save($formData, $id);

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
        $item = new Items();
        $item->delete($id);

        return $this->redirect('/');
    }

    private function addAction($form)
    {
        $item = new Items();
        $name = $form->getName();
        $amount = $form->getAmount();

        $item->setName($name);
        $item->setAmount($amount);

        $item->create();
    }

    private function save($form, $id)
    {
        $item = new Items();
        $name = $form['name'];
        $amount = $form['amount'];

        $item->setName($name);
        $item->setAmount($amount);

        $item->update($id);
    }
}
