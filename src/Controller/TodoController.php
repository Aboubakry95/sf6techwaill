<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/todo")]
class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('todos')) { // Correction du nom de la clé dans la condition
            $todos = [
                'achat' => 'acheter une clé USB', // Correction de la valeur ici
                'cours' => 'finaliser mes cours',
                'correction' => 'corriger mes exercices', // Correction de la valeur ici
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "la liste des todos vient d'être initialisée");
        }

        return $this->render('todo/index.html.twig');
    }
//defaults: ['name'=>'sf6', 'content'=>'techwail'
    #[Route('/add/{name?test}/{content?tes}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')) { // Correction du nom de la clé dans la condition
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                $this->addFlash('error', "le todo de l'id $name existe déjà dans la liste");
            } else {
                $todos[$name] = $content;
                $this->addFlash('success', "le todo avec l'id $name a été ajouté avec succès");
                $session->set('todos', $todos); // Correction de la syntaxe pour définir la session
            }
        } else {
            $this->addFlash('error', "la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo'); // Correction du nom de la route
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')) { // Correction du nom de la clé dans la condition
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo de l'id $name n'existe pas dans la liste");
            }
            else {
                $todos[$name] = $content;
                $this->addFlash('success', "le todo avec l'id $name a été modifier avec succès");
                $session->set('todos', $todos); // Correction de la syntaxe pour définir la session
            }
        } else {
            $this->addFlash('error', "la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo'); // Correction du nom de la route
    }
    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')) { // Correction du nom de la clé dans la condition
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo de l'id $name n'existe pas dans la liste");
            }
            else {
           unset($todos[$name]);
                $this->addFlash('success', "le todo avec l'id $name a été supprimer   avec succès");
                $session->set('todos', $todos); // Correction de la syntaxe pour définir la session
            }
        } else {
            $this->addFlash('error', "la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo'); // Correction du nom de la route
    }
    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo(Request $request):RedirectResponse
    {
        $session = $request->getSession();
       $session->remove('todos');
        return $this->redirectToRoute('todo'); // Correction du nom de la route
    }

        }
