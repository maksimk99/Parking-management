<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{

    private $userRepository;
    private $passEncoder;

    public function __construct(UserRepository $userRepositoryInject, UserPasswordEncoderInterface $passEncoderInject)
    {
        $this->userRepository = $userRepositoryInject;
        $this->passEncoder = $passEncoderInject;
    }

    public function registerUser(User $user): bool
    {
        $user->setPassword($this->passEncoder->encodePassword($user, $user->getPassword()));
        return $this->userRepository->addUser($user);
    }
}