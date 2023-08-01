<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends AbstractController
{
    // Route de la page d'accueil
    #[Route('/', name: 'app_homepage')]
    public function index(
        NoteRepository $notes, // Chargement du repository Note
        PaginatorInterface $paginator, //Chargement de PaginatorInterface
        Request $request // Chargement de Request
    ): Response
    {
        // On créer une requête pour récupérer les snippets
        $query = $notes->findBy(
            ['isPublished' => true], // Pour sélectionner les snippets publiés
            ['createdAt' => 'DESC'], // Pour trier
            100 // Pour limiter l'affichage
        );

        // On utilise le paginator pour paginer les snippets
        $pagination = $paginator->paginate(
            $query, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
            9 // Nombre de résultats par page
        );
        
        return $this->render('homepage/index.html.twig', [
            'notes' => $pagination,
        ]);
    }
}
