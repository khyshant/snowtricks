<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\services\ResetPassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


class ResetController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $UserPasswordEncoder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $userRepository,UserPasswordEncoderInterface $UserPasswordEncoder, EntityManagerInterface $entityManager)
    {
        $this->userPasswordEncoder = $UserPasswordEncoder;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/resetPassword/{token}", name="forgotten_password", requirements={"token": "[a-z0-9\-]*"})
     *
     * @param Request $request
     * @return Response
     */
    public function ResetPassword(Request $request, string $token): Response
    {
        $user = $this->userRepository->findOneBy(['token' => $token]);
        if($user) {
            $form = $this->createFormBuilder()
                ->add('password', TextType::class,[
                    'constraints' => new NotBlank(),
                    'label' => 'Password',
                ])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // data is an array with "name", "email", and "message" keys
                $data = $form->getData();
                $reset = new ResetPassword($this->userRepository, $this->entityManager);
                $reset->resetUserPassword($data,$user);
            }

            return $this->render("pages/login/forgot_password.html.twig", [
                "form" => $form->createView()
            ]);
            return $this->forward('App\Controller\HomeController::index');
        }



    }

    private function findUserByToken() {
       $user = $this->userRepository->FindOneBy(['token'=>$token]);
    }
}