<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
        //session_start();
        $session = $request->getSession();
        if ($session->has('nbVisite')) {
            $nbreVisite = $session->get('nbVisite');
            $nbreVisite++;
        } else {
            $nbreVisite = 1;
        }
        $session->set('nbVisite', $nbreVisite); // Utilisez "->" au lieu de "=" pour définir la valeur dans la session

        return $this->render('session/index.html.twig');
    }
}
