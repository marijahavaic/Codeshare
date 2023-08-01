<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    private $em;
    private $noteRepository;
    public function __construct(EntityManagerInterface $em, NoteRepository $noteRepository) 
    {
        $this->em = $em;
        $this->noteRepository = $noteRepository;
    }
    // Route de la page d'accueil
    #[Route('/', name: 'app_homepage')]
    public function index(
        NoteRepository $notes, // Chargement du repository Note
    ): Response
    {
        $notes = $this->noteRepository->findAll();
        
        return $this->render('homepage/index.html.twig', [
            'notes' => $notes,
        ]);
    }
}
