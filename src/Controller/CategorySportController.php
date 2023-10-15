<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TeamRepository;
use App\Repository\SportRepository;


class CategorySportController extends AbstractController
{
    #[Route('/category/sport', name: 'app_category_sport')]
    public function index(TeamRepository $team, SportRepository $sport): Response
    {
        return $this->render('category_sport/index.html.twig', [
            'teams' => $team->findAll(),
            'sports' => $sport->findAll(),
        ]);
    }
}
