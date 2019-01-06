<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request)
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findByExampleField(1);

        $paginator  = $this->get('knp_paginator');
        $appointments = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            5
        );

        $photoDirectory = $this->getParameter('photo_post_directory');

        return $this->render('site/index.html.twig', [
            'posts' => $posts,
            'appointments' => $appointments,
            'photoDirectory' => $photoDirectory
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}