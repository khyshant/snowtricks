<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\services\ResetPassword;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class emailController extends AbstractController
{

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
    * @return Response
    */
    public function forgottenpassword(Request $request,\Swift_Mailer $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', TextType::class,[
                'constraints' => new NotBlank(),
                'label' => 'Username or Email',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $reset = new ResetPassword($this->userRepository, $this->entityManager);
            $reset->sendEmail($data, $mailer);
            return $this->forward('App\Controller\HomeController::index');
        }

        return $this->render("pages/login/forgot_password.html.twig", [
            "form" => $form->createView()
        ]);
    }
}