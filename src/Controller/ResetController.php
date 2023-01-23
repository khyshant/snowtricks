<?php


namespace App\Controller;

use App\Repository\UserRepository;
use App\services\ResetPassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/newPassword/{token}", name="newPassword", requirements={"token": "[a-z0-9\-]*"})
     *
     * @param Request $request
     * @param string $token
     * @param ResetPassword $resetPassword
     * @return Response
     */
    public function ResetPassword(Request $request, string $token, ResetPassword $resetPassword): Response
    {
        $user = $this->userRepository->findOneBy(['token' => $token]);
        if($user) {
            $form = $this->createFormBuilder()
                ->add('password', PasswordType::class,[
                    'constraints' => new NotBlank(),
                    'label' => 'Password',
                ])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // data is an array with "name", "email", and "message" keys
                $data = $form->getData();
                $resetPassword->resetUserPassword($data,$user);
                return $this->redirect($this->generateUrl('home' ));
            }
            return $this->render("pages/login/reset_password.html.twig", [
                "form" => $form->createView()
            ]);
        }
        return $this->redirect($this->generateUrl('home' ));
    }

}