<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CabinetController extends AbstractController
{
    /**
     * @Route("/cabinet", name="user_cabinet")
     */
    public function index()
    {
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
}