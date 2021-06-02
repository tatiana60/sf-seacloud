<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/sign-up", name="sign-up")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("sign-in");
        }

        return $this->render('page/sign-up.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/profile", name="profile")
     */
    public function update(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->find($this->getUser()->getId());

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('dashboard', [
                'id' => $user->getId(),
            ]);
        }

        // Affiche le formulaire
        return $this->render('account/profile.html.twig', [
            'user' => $user,
            // On passe au template une VUE du formulaire
            'form' => $form->createView(),
        ]);
    }
}