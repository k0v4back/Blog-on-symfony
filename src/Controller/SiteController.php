<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAllPost();

        return $this->render('site/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}