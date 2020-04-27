<?php

namespace App\Controller;

use App\Service\ParkPlaceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParkPlaceController extends AbstractController
{

    private $parkPlaceService;

    public function __construct(ParkPlaceService $placeService)
    {
        $this->parkPlaceService = $placeService;
    }

    /**
     * @Route("/park/place/take", name="park_place_take")
     * @param Request $request
     * @return JsonResponse
     */
    public function takeParkingPlace(Request $request)
    {
        $parkPlaceName = $request->request->get('parkPlaceId');
        return new JsonResponse($this->parkPlaceService->takeParkingPlace($parkPlaceName));
    }

    /**
     * @Route("/park/place/vacate", name="park_place_vacate")
     * @param Request $request
     * @return JsonResponse
     */
    public function vacateParkingPlace(Request $request)
    {
        $parkPlaceName = $request->request->get('parkPlaceId');
        return new JsonResponse($this->parkPlaceService->vacateParkingPlace($parkPlaceName));
    }
}
