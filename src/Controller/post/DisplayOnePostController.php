<?php

namespace App\Controller\post;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\post\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DisplayOnePostController extends AbstractController
{
    /**
     * @Route("post/{id}", name="show_one_post", requirements={"id"="\d+"})
     */
    public function showPost($id, Request $request)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findPostById($id);


        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllComments($id);

        if ($post != null) {
            $comment = new Comment();
            $form = $this->createForm(CommentFormType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $this->getUser()->getId()) {
                $entityManager = $this->getDoctrine()->getManager();
                $user_id = $this->getUser()->getId();

                $content = $request->request->get('comment_form')['content'];

                $comment->setContent($content);
                $comment->setUserId($user_id);
                $comment->setCreatedAt(new \DateTime('now'));
                $comment->setPostId($id);

                $entityManager->persist($comment);
                $entityManager->flush();

                return $this->redirectToRoute('show_one_post', array('id' => $id));
            }

            return $this->render('post/displayOnePost.html.twig', [
                'post' => $post[0],
                'form' => $form->createView(),
                'comments' => $comments
            ]);
        } else {
            return $this->redirectToRoute('main');
        }
    }

}