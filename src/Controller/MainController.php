<?php

namespace App\Controller;

use App\Service\ParkPlaceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private $parkPlaceService;

    public function __construct(ParkPlaceService $placeService)
    {
        $this->parkPlaceService = $placeService;
    }

    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'parkPlaces' => $this->parkPlaceService->findAll()
        ]);
    }
}
