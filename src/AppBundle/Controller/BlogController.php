<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Form\Type\BlogFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("/new", name="blog_new")
     */
    public function createNewBlog(Request $request)
    {
        $blog = new Blog();

        $blog->setDate(new \DateTime("now"));
        $form = $this->createForm(new BlogFormType(), $blog);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $blog->setSzamlalo(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
            return $this->viewBlog($blog->getId());
        }

        return $this->render(":Blog:blogForm.html.twig", array(
            "blog" => $form->createView()
        ));
    }

    /**
     * @Route("/", name="blog_lista")
     */
    public function listAllBlog(){
        $blogs = $this->getDoctrine()->getRepository("AppBundle:Blog")->findAll();

        return $this->render(":Blog:blogList.html.twig", array(
           "blogs" => $blogs
        ));
    }

    /**
     * @Route("/{id}", name="blog_view")
     */
    public function viewBlog($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository("AppBundle:Blog")->find($id);
        $comments = $blog->getComments();

        $szamlalo = $blog->getSzamlalo();

        $blog->setSzamlalo($szamlalo+1);
        $em->flush();

        return $this->render(":Blog:blogView.html.twig",array(
           "blog" => $blog,
           "comments" => $comments
        ));
    }

    /**
     * @Route("/search/{minDate}/{maxDate}", name="blog_search")
     */
    public function searchBlog($minDate = null, $maxDate = null)
    {
        if ($minDate != null && $maxDate != null) {
            $where = "b.date >= '" . $minDate->format('Y-m-d H:i:s') . "'";
            $andWhere = "b.date <= '" . $maxDate->format('Y-m-d H:i:s') . "'";
        }
        elseif($minDate != null)
        {
            $where = "b.date >= '" . $minDate->format('Y-m-d H:i:s') . "'";
        }
        elseif($maxDate != null)
        {
            $where = "b.date <= '" . $maxDate->format('Y-m-d H:i:s') . "'";
        }
        else
        {
            $where = "";
            $andWhere = "";
        }
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Blog');

            $query = $repository->createQueryBuilder('b')
                ->where($where)
                ->andWhere($andWhere)
                ->orderBy("b.date", "ASC")
                ->getQuery();

            $blogs = $query->getResult();

        return $this->render(":Main:mainViewLine.html.twig", array(
            "blogs" => $blogs
        ));
    }
}