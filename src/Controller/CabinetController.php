<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CabinetController extends AbstractController
{
    /**
     * @Route("/cabinet", name="user_cabinet")
     */
    public function index()
    {
        if ($this->getUser()) {
            $id = $this->getUser()->getId();

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findUserById($id);

            return $this->render('cabinet/index.html.twig',
                [
                    'user' => $user[0]
                ]
            );
        }
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/cabinet/edit", name="edit_user_data")
     */
    public function editUserData(Request $request)
    {
        if ($this->getUser()) {

            $id = $this->getUser()->getId();

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findUserById($id);

            $form = $this->createForm(EditUserData::class, $user[0]);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Your changes were saved!'
                );
                return $this->redirectToRoute('user_cabinet');
            }

            return $this->render('cabinet/edit.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        return $this->redirectToRoute('app_login');

    }
}