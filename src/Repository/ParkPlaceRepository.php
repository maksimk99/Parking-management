<?php

namespace App\Repository;

use App\Entity\ParkPlace;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * @method ParkPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParkPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParkPlace[]    findAll()
 * @method ParkPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParkPlaceRepository extends ServiceEntityRepository
{

    private $tokenStorage;

    public function __construct(ManagerRegistry $registry, TokenStorageInterface $tokenStorageInject)
    {
        parent::__construct($registry, ParkPlace::class);
        $this->tokenStorage = $tokenStorageInject;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     * @param ParkPlace $parkPlace
     * @return bool
     */
    public function setUser(ParkPlace $parkPlace): bool
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        if ($parkPlace->getUser() === null) {
            $parkPlace->setUser($user);
            try {
                $this->_em->flush();
            } catch (ORMException $e) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     * @param ParkPlace $parkPlace
     * @return bool
     */
    public function deleteUser(ParkPlace $parkPlace): bool
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        if ($parkPlace->getUser() == $user) {
            $parkPlace->setUser(null);
            try {
                $this->_em->flush();
            } catch (ORMException $e) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
