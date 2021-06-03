<?php


namespace App\Controller;

use App\Entity\Server;
use App\Entity\Distribution;
use App\Entity\DataCenter;
use App\Form\Type\ServerType;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @var ServerRepository
     */
    private $repository;

    public function __construct(ServerRepository $repo) {
        $this->repository = $repo;
    }

    /**
     * @Route("/account", name="dashboard")
     */
    public function account(): Response{

        /** @var \App\Entity\Server[] $list */
        $list = $this->repository->findAll();

        return $this->render('account/account.html.twig', [
            'servers' => $list,
        ]);
    }

    /**
     * @Route("/account/{id}", name="server_detail", requirements={"id": "\d+"})
     */
    public function detail(string $id): Response{

        $server = $this->repository->find($id);

        return $this->render('account/serverdetail.html.twig', [
            'server' => $server,
        ]);
    }

    /**
     * @Route ("/{id}/reboot", name="server_reboot", requirements={"id": "\d+"})
     */
    public function reboot(int $id): Response{

        /** @var Server $server */

        $server = $this->repository->find($id);

        $server->setState(Server::STATE_STOPPED);

        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route ("/{id}/restart", name="server_restart", requirements={"id": "\d+"})
     */
    public function restart(int $id): Response{

        /** @var Server $server */

        $server = $this->repository->find($id);

        $server->setState(Server::STATE_PENDING);

        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route ("/api/{id}/ready", name="server_ready", requirements={"id": "\d+"})
     */
    public function ready(int $id): Response
    {
        /** @var Server $server */

        $server = $this->repository->find($id);

        $server->setState(Server::STATE_READY);

        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        return $this->redirectToRoute('dashboard');
    }
}