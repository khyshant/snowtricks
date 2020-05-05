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
     * @return Response
     */
    public function ResetPassword(Request $request, string $token, ResetPassword $resetPassword): Response
    {
        $user = $this->userRepository->findOneBy(['token' => $token]);
        $returnhome = $this->generateUrl(
            'home' // 1er argument : le nom de la route
        );
        $returnLogin= $this->generateUrl(
            'home' // 1er argument : le nom de la route
        );
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
                //$reset = new ResetPassword($this->userRepository, $this->entityManager, $this->twig);
                $resetPassword->resetUserPassword($data,$user);
                return $this->redirect($returnLogin);
            }

            return $this->render("pages/login/reset_password.html.twig", [
                "form" => $form->createView()
            ]);


        }
        return $this->redirect($returnhome);
    }

    private function findUserByToken() {
       $user = $this->userRepository->FindOneBy(['token'=>$token]);
    }
}