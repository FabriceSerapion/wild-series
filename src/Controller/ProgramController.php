<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(ProgramRepository $programRepository): Response
  {
    $programs = $programRepository->findAll();
    return $this->render('index.html.twig', [
      'programs' => $programs,
    ]);
  }

  #[Route('/show/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
  public function show(int $id, ProgramRepository $programRepository): Response
  {
    $program = $programRepository->findOneBy(['id' => $id]);

    if (!$program) {
      throw $this->createNotFoundException(
        'No program with id : ' . $id . 'found in program\'s table.'
      );
    }
    return $this->render('show.html.twig', ['program' => $program]);
  }
}
