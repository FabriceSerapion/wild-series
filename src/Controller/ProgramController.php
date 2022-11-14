<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(): Response
  {
    return $this->render('index.html.twig', [
      'welcome' => 'Bienvenue !',
    ]);
  }

  #[Route('/{id}', methods: ['GET'], name: 'list')]
  public function show(int $id): Response
  {
    return $this->render('show.html.twig', ['id' => $id]);
  }
}
