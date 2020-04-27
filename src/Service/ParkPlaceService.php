<?php

namespace App\Service;

use App\Repository\ParkPlaceRepository;

class ParkPlaceService
{

    private $parkPlaceRepository;

    public function __construct(ParkPlaceRepository $parkPlaceRepositoryInject)
    {
        $this->parkPlaceRepository = $parkPlaceRepositoryInject;
    }

    public function takeParkingPlace($parkPlaceName)
    {
        $parkPlaceId = substr($parkPlaceName, 9);
        $parkPlace = $this->parkPlaceRepository->findOneBy(['id' => $parkPlaceId]);
        if ($this->parkPlaceRepository->setUser($parkPlace)) {
            return array('isSuccess' => true);
        } else {
            return array('isSuccess' => false, 'errorMessage' => "Sorry, but the parking space '"
                . $parkPlaceName . "' is occupied");
        }
    }

    public function vacateParkingPlace($parkPlaceName)
    {
        $parkPlaceId = substr($parkPlaceName, 9);
        $parkPlace = $this->parkPlaceRepository->findOneBy(['id' => $parkPlaceId]);
        if ($this->parkPlaceRepository->deleteUser($parkPlace)) {
            return array('isSuccess' => true);
        } else {
            return array('isSuccess' => false, 'errorMessage' => "Sorry, but the parking space '"
                . $parkPlaceName . "' is not yours");
        }
    }

    public function findAll()
    {
        return $this->parkPlaceRepository->findAll();
    }
}