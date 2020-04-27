<?php

namespace App\Controller;

use App\Service\ParkPlaceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ParkPlaceRestController extends AbstractController
{

    private $parkPlaceService;

    public function __construct(ParkPlaceService $placeService)
    {
        $this->parkPlaceService = $placeService;
    }

    /**
     * @Route("/park/place/list", name="park_place_list")
     * @return Response
     */
    public function listParkingPlaces()
    {
        $parkPlaces = $this->parkPlaceService->findAll();
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $parkPlacesJson = [];

        foreach ($parkPlaces as $parkPlace) {
            $parkPlaceJson = [];
            $parkPlaceJson['id'] = $parkPlace->getId();
            $parkPlaceJson['number'] = $parkPlace->getNumber();
            $user = $parkPlace->getUser();
            $parkPlaceJson['user'] = $user != null ? $user->getUsername() : 'none';

            array_push($parkPlacesJson, $parkPlaceJson);
        }
        $response = new Response($serializer->serialize($parkPlacesJson, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}