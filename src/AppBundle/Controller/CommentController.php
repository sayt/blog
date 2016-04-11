<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\Type\CommentFormType1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CommentController extends Controller
{
    /**
     * @Route("/comment/new/{blog}", name="comment_new")
     */
    public function createNewComment(Request $request,Blog $blog)
    {
        $comment = new Comment();

        $comment->setDate(new \DateTime("now"));
        $comment->setName($this->getUser()->getUsername());
        $comment->setEmail($this->getUser()->getEmail());
        $comment->setBlog($blog);
        $form = $this->createForm(new CommentFormType1(), $comment);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute("blog_view", array(
                "id" => $comment->getBlog()->getId()
            ));
        }

        return $this->render(":Comment:commentForm.html.twig", array(
            "comment" => $form->createView(),
            "blog" => $comment->getBlog()
        ));

    }
}