<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MinmaxController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'tab')]
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
    #[Route('/tab/users', name: 'tab.users')]
    public  function  users(): Response {
        $users= [
            ['firstname'=>'Ndong', 'lastname'=>'Aboubakry', 'age'=>27],
            ['firstname'=>'soumaré', 'lastname'=>'Marieme', 'age'=>67],
            ['firstname'=>'Ndong', 'lastname'=>'Sadio', 'age'=>20],

        ];
        return $this->render('/todo/users.html.twig', [
            'users'=>$users
        ]);
    }
}
