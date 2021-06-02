<?php


namespace App\Controller\Admin;

use App\Controller\NameServer;
use App\Entity\Server;
use App\Form\Type\ServerType;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServerController extends AbstractController
{
    /**
     * @var ServerRepository
     */
    private $serverRepository;

    public function __construct(ServerRepository $serverRepository) {
        $this->serverRepository = $serverRepository;
    }

    /**
     * @Route("/account/newserver", name="newserver")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, NameServer $nameServer): Response{

        $server = new Server();

        $form = $this->createForm(ServerType::class, $server);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if(empty($server->getName())) {
                $nameServer->NameServer($server);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($server);
            $em->flush();

            return $this->redirectToRoute("dashboard", [
                'id' => $server->getId(),
            ]);
        }
        return $this->render('account/newserver.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}