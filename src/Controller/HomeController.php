<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TeamRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(TeamRepository $team): Response
    {
        return $this->render('home/index.html.twig', [
            'teams' => $team->findAll(),
             
        ]);
    }
}
