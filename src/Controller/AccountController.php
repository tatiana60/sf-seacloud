<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="dashboard")
     */
    public function account(): Response{
        return $this->render('account/account.html.twig');
    }

    /**
     * @Route("/account/profile", name="profile")
     */
    public function profile(): Response{
        return $this->render('account/profile.html.twig');
    }

    /**
     * @Route("/account/newserver", name="newserver")
     */
    public function newserver(): Response{
        return $this->render('account/newserver.html.twig');
    }
}