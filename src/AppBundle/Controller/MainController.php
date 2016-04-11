<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Form\Type\BlogSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function createMain()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Blog');

        $query = $repository->createQueryBuilder('b')
            ->orderBy('b.date', 'DESC')
            ->getQuery();

        $blogs = $query->setMaxResults(10)->getResult();

        sort($blogs);

        return $this->render(":Main:mainView.html.twig", array(
            "blogs" => $blogs
        ));
    }

    /**
     * @Route("/query/{blog}/{line}", name="blog_query")
     */
    public function queryMinOrMax(Blog $blog, $line)
    {
        $limit = 3;
        if($line == "pre")
        {
            $where = "b.date <= '".$blog->getDate()->format('Y-m-d H:i:s')."'";
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Blog');

            $query = $repository->createQueryBuilder('b')
                ->where($where)
                ->orderBy("b.date", "DESC")
                ->getQuery();

            $blogs = $query->setMaxResults($limit)->getResult();

        }
        else
        {
            $where = "b.date >= '".$blog->getDate()->format('Y-m-d H:i:s')."'";
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Blog');

            $query = $repository->createQueryBuilder('b')
                ->where($where)
                ->orderBy("b.date", "ASC")
                ->getQuery();

            $blogs = $query->setMaxResults($limit)->getResult();
        }
        sort($blogs);

        return $this->render(":Main:mainView.html.twig", array(
            "blogs" => $blogs
        ));
    }
}