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
        $em = $this->getDoctrine()->getManager();

        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAllPost();

        $paginator  = $this->get('knp_paginator');
        // Paginate the results of the query
        $appointments = $paginator->paginate(
        // Doctrine Query, not results
            $posts,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('site/index.html.twig', [
            'posts' => $posts,
            'appointments' => $appointments
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}