<?php

namespace App\Controller;


use App\Entity\User;
use App\Handler\ResetEmailHandler;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\services\ResetPassword;
use Exception;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;


class emailController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * emailController constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository  =   $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/forgottenPassword", name="forgotten_password")
     *
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @param ResetPassword $resetPassword
     * @param ResetEmailHandler $handler
     * @return Response
     * @throws Exception
     */
    public function forgottenPassword(Request $request, Swift_Mailer $mailer, ResetPassword $resetPassword, ResetEmailHandler $handler): Response
    {
        $user = new User();
        if($handler->handle($request, $user)) {
            return $this->redirectToRoute("home");
        }
        $form = $this->createFormBuilder()
            ->add('email', TextType::class,[
                'constraints' => new NotBlank(),
                'label' => 'Username or Email',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resetPassword->sendEmail($data, $mailer);
            return $this->forward('App\Controller\HomeController::index');
        }

        return $this->render("pages/login/forgot_password.html.twig", [
            "form" => $form->createView()
        ]);
    }
}