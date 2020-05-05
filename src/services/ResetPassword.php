<?php


namespace App\services;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class ResetPassword extends AbstractController
{

    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     */
    private $twig;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * SendMailer constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param Environment $twig
     * @param UserPasswordEncoderInterface $UserPasswordEncoder
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, Environment $twig,UserPasswordEncoderInterface $UserPasswordEncoder)
    {
        $this->userRepository  =   $userRepository;
        $this->entityManager = $entityManager;
        $this->twig = $twig;
        $this->userPasswordEncoder = $UserPasswordEncoder;
    }

    /**
     * @param $data
     * @param $mailer
     * @throws \Exception
     */
    public function sendEmail($data, $mailer)
    {
        $user =  $this->userRepository->FindOneByEmail($data);
        if($user) {
            do {
                $token = bin2hex(random_bytes(32));
            } while ($this->userRepository->FindOneBy(['token'=>$token]));
            $user->setToken($token);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            self::mailResetPassword($mailer,$user);
        }
    }

    private function mailResetPassword($mailer, $user)
    {
        $message = (new \Swift_Message('test'))
            ->setFrom("khyshant@msn.com")
            ->setTo("anth.blanchard@gmail.com")
            ->setBody(
                $this->twig->render('pages/mails/send_mail.html.twig', ['user' => $user,]),
                'text/html'
            );
        $mailer->send($message);
    }

    public function resetUserPassword($data, $user)
    {
        dump($data);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user,$data['password']));
        $user->setToken('');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}