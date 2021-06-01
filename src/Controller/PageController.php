<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index() : Response{
        return $this->render('page/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     * @return Response
     */
    public function about() : Response{
        return $this->render('page/about.html.twig');
    }

    /**
     * @Route("/services", name="services")
     * @return Response
     */
    public function services(): Response{
        return $this->render('page/services.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function contact(): Response{
        return $this->render('page/contact.html.twig');
    }

    /**
     * @Route("/sign-up", name="sign-up")
     * @return Response
     */
    public function signup(): Response{
        return $this->render('page/sign-up.html.twig');
    }

    /**
     * @Route("/sign-in", name="sign-in")
     * @return Response
     */
    public function signin(): Response{
        return $this->render('page/sign-in.html.twig');
    }
}