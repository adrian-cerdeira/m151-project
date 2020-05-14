<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Items;
use App\Entity\Users;
use App\Form\CommentType;
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
        if (!$this->isAuthenticated($request)) {
            return $this->redirect('/login');
        }

        $items = new Items();
        $user = new Users();
        $userId = $request->getSession()->get('userId');
        $user = $user->getById($userId);
        $form = $this->createForm(ItemType::class, $items);
        $items = $items->getAll();
        $form->handleRequest($request);

        // Erstellung eines Items handlen
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $this->addAction($formData);

            return $this->redirect('/');
        }

        return $this->render(
            'items/index.html.twig',
            [
                'items' => $items,
                'form' => $form->createView(),
                'userName' => $user->getUserName(),
            ]
        );
    }

    /**
     * @Route("/detail/{id}")
     */
    public function detailAction(Request $request, $id)
    {
        if (!$this->isAuthenticated($request)) {
            return $this->redirect('/login');
        }

        $item = new Items();
        $item = $item->getById($id);

        $comment = new Comments();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Kommentar erstellen
        }

        return $this->render(
            'items/item.html.twig',
            [
                'item' => $item,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/edit/{id}")
     */
    public function editAction(Request $request, $id)
    {
        if (!$this->isAuthenticated($request)) {
            return $this->redirect('/login');
        }

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

        return $this->render(
            'items/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/remove/{id}")
     */
    public function removeAction(Request $request, $id)
    {
        if (!$this->isAuthenticated($request)) {
            return $this->redirect('/login');
        }

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

    private function isAuthenticated($request)
    {
        $session = $request->getSession();

        if ($session->has('userId')) {
            return true;
        }

        return false;
    }
}
