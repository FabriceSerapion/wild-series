<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

// This route shows all programs 
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

  // This route shows all programs
  // #[Route('/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
  // public function show(int $id, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
  // {
  //   $program = $programRepository->findOneBy(['id' => $id]);

  //   if (!$program) {
  //     throw $this->createNotFoundException(
  //       'No program with id : ' . $id . ' found in program\'s table.'
  //     );
  //   } else {
  //     $seasons = $program->getSeasons();
  //   }
  //   return $this->render('show.html.twig', ['program' => $program, 'seasons' => $seasons]);
  // }

  // This route shows one program find by ID
  #[Route('/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
  // #[ParamConverter('program')]
  public function show(Program $program): Response
  {
    return $this->render('show.html.twig', ['program' => $program]);
  }

  // This route shows one program find by ID and its seasons
  #[Route('/{program_id<^[0-9]+$>}/season/{season_id<^[0-9]+$>}', methods: ['GET'], name: 'season_show')]
  #[Entity('program', options: ['id' => 'program_id'])]
  #[Entity('season', options: ['id' => 'season_id'])]
  public function showSeason(Program $program, Season $season): Response
  {
    return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season]);
  }

  // This route shows one episode of a season
  #[Route('/{program_id<^[0-9]+$>}/season/{season_id<^[0-9]+$>}/episode/{episode_id<^[0-9]+$>}', methods: ['GET'], name: 'episode_show')]
  #[Entity('program', options: ['id' => 'program_id'])]
  #[Entity('season', options: ['id' => 'season_id'])]
  #[Entity('episode', options: ['id' => 'episode_id'])]
  public function showEpisode(Program $program, Season $season, Episode $episode): Response
  {
    return $this->render('program/episode_show.html.twig', ['program' => $program, 'season' => $season, 'episode' => $episode]);
  }
}
