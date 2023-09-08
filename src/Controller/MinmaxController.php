<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MinmaxController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'app_minmax')]
    public function index($nb): Response
    {
        $notes = [];
        for ($i = 0; $i <= $nb; $i++) {
            $notes[] = rand(0, 20);
        }

        return $this->render('minmax/index.html.twig', [
            'notes' => $notes // Supprimez les guillemets autour de $notes
        ]);
    }
}
