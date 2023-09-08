<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // Ajout de l'import pour Request
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/order/{maVar}', name: 'test.order.route')]
    public   function testOrderRoute($maVar){
        return new Response("<html><body>$maVar</body></html>");
    }

    #[Route('/first', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'Ndongo',
            'firstname' => 'Aboubakry'
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        // Utilisation de $request pour accéder aux données de la requête
        //dd($request);

        return $this->render('first/hello.html.twig', [
            'nom' => $name,
            'firstname' => $firstname
        ]);
    }
// requirements: ['entier1'=>'\d+', 'entier2'=>'\d+']
#[Route('/multi/{entier1<\d+>}/{entier2<\d+>}', name: 'multiplication')]
public function  multiplication($entier1, $entier2){
      $resultat = $entier1 * $entier2;
        return  new Response("<h1>$resultat</h1>") ;
}

}