<?php


namespace App\Controller;

use App\Entity\Server;
use App\Entity\Distribution;
use App\Entity\DataCenter;
use App\Form\Type\ServerType;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}