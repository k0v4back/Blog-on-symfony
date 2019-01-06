<?php

namespace App\Controller\post;

use App\Entity\Post;
use App\Form\post\PostCreateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    /**
     * @Route("/manage/post/create", name="manage_post_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function managePosts(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostCreateFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $title = $request->request->get('post_create_form')['title'];
            $content = $request->request->get('post_create_form')['content'];
            $status = $request->request->get('post_create_form')['status'];
            $id = $this->getUser()->getId();
            $file = $request->files->get('post_create_form')['photo'];

            $uploads_directory = $this->getParameter('photo_post_directory');
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $uploads_directory,
                $fileName
            );

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setStatus($status);
            $post->setCreatedAt(new \DateTime('now'));
            $post->setAuthorId($id);
            $post->setPhoto($fileName);

            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Post success saved!'
            );
            return $this->redirectToRoute('manage_post');
        }

        return $this->render('post/createPost.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}