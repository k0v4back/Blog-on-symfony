<?php

namespace App\Controller\post;

use App\Entity\Comments;
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

        if ($post != null) {
            $comment = new Comments();
            $form = $this->createForm(CommentFormType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $content = $request->request->get('comment_form')['content'];
                $user_id = $this->getUser()->getId();

                $comment->setContent($content);
                $comment->setUserId($user_id);
                $comment->setCreatedAt(new \DateTime('now'));

                $entityManager->persist($comment);
                $entityManager->flush();

                return $this->redirectToRoute('show_one_post', array('id' => $id));
            }
            return $this->render('post/displayOnePost.html.twig', [
                'post' => $post[0],
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('main');
        }
    }

}