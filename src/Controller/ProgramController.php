<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', methods: ['GET'], name: 'home')]
  public function index(ProgramRepository $programRepository): Response
  {
    $programs = $programRepository->findAll();
    return $this->render('index.html.twig', [
      'programs' => $programs,
    ]);
  }

  #[Route('/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
  public function show(int $id, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
  {
    $program = $programRepository->findOneBy(['id' => $id]);

    if (!$program) {
      throw $this->createNotFoundException(
        'No program with id : ' . $id . ' found in program\'s table.'
      );
    } else {
      $seasons = $program->getSeasons();
    }
    return $this->render('show.html.twig', ['program' => $program, 'seasons' => $seasons]);
  }

  #[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}', methods: ['GET'], name: 'season_show')]
  public function showSeason(
    int $programId,
    int $seasonId,
    ProgramRepository $programRepository,
    SeasonRepository $seasonRepository
  ): Response {
    $program = $programRepository->findOneBy(['id' => $programId]);

    if (!$program) {
      throw $this->createNotFoundException(
        'No program with id : ' . $programId . ' found in program\'s table.'
      );
    } else {
      $season = $seasonRepository->findOneBy(['id' => $seasonId]);
    }
    return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season]);
  }
}
