<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserveController extends AbstractController
{
    #[Route('/reserve/{name}', name: 'reserve')]
    public function index(ManagerRegistry $doctrine, $name): Response
    {

        $repository = $doctrine->getRepository(Room::class);
        $rooms = $repository->findAll();
        $name = $repository->findOneBy(['name' => $name]);
        return $this->render('reserve/index.html.twig', [
            'controller_name' => 'RoomController',
            'rooms' => $rooms,
            'name' => $name,
        ]);
        
    }
}
