<?php

namespace App\Handler;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * TrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(EntityManagerInterface $entityManager,UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function getForm(): string
    {
        // TODO: Implement getForm() method.
        return UserType::class;
    }

    protected function process($data): void
    {
        // TODO: Implement process() method.
        dump($data);
        if ($this->entityManager->getUnitOfWork()->getEntityState($data) === UnitOfWork::STATE_NEW) {
            $data->setPassword($this->userPasswordEncoder->encodePassword($data,$data['password']));
            $this->entityManager->persist($data);

        }
        $this->entityManager->flush();

    }

}