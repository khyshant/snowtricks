<?php


namespace App\services;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResetPassword extends AbstractController
{

    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * SendMailer constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository  =   $userRepository;
        $this->entityManager = $entityManager;
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
            self::mailResetPassword($mailer);
        }
    }

    private function mailResetPassword($mailer)
    {
        $message = (new \Swift_Message('test'))
            ->setFrom("khyshant@msn.com")
            ->setTo("anth.blanchard@gmail.com")
            ->setBody(
               'ici je dois mettre ma route vers lle llien de password'
            );
        $mailer->send($message);
    }

    public function resetUserPassword($data, $user)
    {
        dump($data);
        $user->setPassword($this->userPasswordEncoder()->encodePassword($user,$data['password']));
        $user->setToken('');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}