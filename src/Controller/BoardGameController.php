<?php

namespace App\Controller;

use App\Entity\BoardGame;
use App\Form\BoardGameType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Uuid;

class BoardGameController extends AbstractController
{
    #[Route('/', name: 'app_board_game')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $boardGameManager = $doctrine->getRepository(BoardGame::class);
        $boardGames = $boardGameManager->findAll();
        dump($boardGames);

        return $this->render('board_game/index.html.twig', [
            'controller_name' => 'BoardGameController',
            'boardgames' => $boardGames
        ]);
    }

    #[Route('/boardgame/new', name: 'app_new_boardgame')]
    public function new(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $boardGame = new BoardGame;

        $form = $this
            ->createForm(BoardGameType::class, $boardGame)
            ->add('save', SubmitType::class, ['label' => 'Ajouter']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardGame = $form->getData();

            /** @var UploadeFile $imageFile */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $fileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($fileName);
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $imageFile->guessExtension();
                dump($newFileName);
            }

            try {
                $imageFile->move($this->getParameter('images_directory'), $newFileName);
            } catch (FileException $e) {
                dump($e);
            }

            $boardGame->setImage($newFileName);
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($boardGame);
            $entityManager->flush();
 
            $this->addFlash('success', 'Votre jeu a été enregistré !');

            return $this->redirectToRoute('app_board_game');
            
        }

        return $this->render('board_game/new.html.twig', [
            'controller_name' => 'BoardGameController',
            'form' => $form
        ]);
    }

    #[Route('/boardgame/{id}', name: 'app_board_game_details', requirements: ['page' => '\d+'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $boardGameManager = $doctrine->getRepository(BoardGame::class);
        $boardGame = $boardGameManager->find($id);

        return $this->render('board_game/details.html.twig', [
            'boardgame' => $boardGame
        ]);
    }
}
